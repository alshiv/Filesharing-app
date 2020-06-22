<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    //TODO: do without request username
    public function store(Request $request)
    {
        $files = $this->uploadFiles($request);

        foreach ($files as $fileItem) {
            list($fileName, $title) = $fileItem;

            $file = new Files();
            $file->title = $title;
            $file->file_name = $fileName;
            $file->save();
        }

        return response()->json([
            'uploaded' => true
        ]);
    }

    protected function uploadFiles($request)
    {
        $uploadedFiles = [];

        if ($request->hasFile('file_name') && $request->has('username'))
        {
            $files = $request->file('file_name');
            $username = $request->input('username');

            foreach ($files as $file){
                $uploadedFiles[] = $this->uploadFile($file, $username);
            }
        }

        return $uploadedFiles;
    }

    protected function uploadFile($file, $username)
    {   
        $originalFileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = \Str::slug($fileNameOnly)."-".time().".".$extension;

        $uploadedFileName = $file->storeAs($username, $fileName);

        return [$uploadedFileName, $fileNameOnly];
    }
}
