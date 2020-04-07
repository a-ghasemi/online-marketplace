<?php

namespace App\Jobs;

use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class InsertCsvContentToDB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filepath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = Storage::disk('local')->get($this->filepath);
        foreach(explode("\n",trim($file)) as $i => $row) {
            $items = explode(',',$row);
            if(count($items) != 5) {
                Log::warning("CSV File Reader: wrong data structure at line {$i}!");
                continue;
            }

            //TODO:We should check cat_id of this row is available in ProductCategory as an id too

            $cat_id = $items[0];
            if(!is_numeric($cat_id)){
                $cat = ProductCategory::FirstOrCreate(['title' => $cat_id]);
                $cat_id = $cat->id;
            }
            elseif(ProductCategory::find(intval($cat_id))->isEmpty()){
                $cat = ProductCategory::Create(['title' => 'Untitled_'.intval($cat_id)]);
                $cat_id = $cat->id;
            }

            $product = Product::create([
                'cat_id' => $cat_id,
                'title' => $items[1],
                'price' => $items[2],
                'description' => $items[3],
            ]);

            $product->setQuantity($items[4]);
        }
    }
}
