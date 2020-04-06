<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $filename = time() . $uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            sprintf("%s/%s", date('Y-m-d', time()), $filename),
            $uploadedFile,
            $filename
        );

        //TODO:We have to record file upload with current permission in a database table

        return response('File Uploaded Successfully',200);
    }
}
