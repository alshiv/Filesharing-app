<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 

class FilesController extends Controller
{
    public function index()
    {
        $files = Files::latest()->get();
        $user = auth()->user();
        $username = $user->username;
        $filesArray = json_decode(json_encode($files));
        $filesToShow = [];
        foreach($filesArray as $file){
            $file_path = explode('/', $file->file_name);
            if ($file_path[0] === $username){
                $filesToShow[] = $file;
                continue;
            }
        }
        return response()->json($filesToShow);
    }

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

    public function deleteFile(Request $request){
        $file_path = $request->filepath;
        $file_exist = '../storage/app/'.$file_path;
        $id = $request->id;
        if($file_exist){
            File::delete($file_exist);
            Files::destroy($id);
        } else {
            return response()->json(['error'=>'File not exist!']);
        }
        return response()->json(['success'=>'Uploaded Successfully.']);
    }
}
