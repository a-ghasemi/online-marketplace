<?php

namespace App\Http\Controllers\AdminPanel;

use App\Jobs\InsertCsvContentToDB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CsvController extends Controller
{

    public function create(Request $request)
    {
        return view('admin.products.csv_upload');
    }

    public function upload(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $file_extension = substr($filename,strrpos($filename,'.'));
        $filename = time() . $file_extension;

        $file = Storage::disk('local')->putFileAs(
            date('Y-m-d', time()),
            $uploadedFile,
            $filename
        );

        InsertCsvContentToDB::dispatch($file);

        //TODO:We have to record file upload with current permission in a database table

        return redirect()->route('admin_panel.product.index')->with('message','CSV File Upload Successfully');
    }
}
