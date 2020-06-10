<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use StdClass;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{

    public function upload(Request $request)
    {
        $files = $request->file('file');
        $multiple = is_array($files);
        $response = $multiple ? [] : $this->packResponse($files);
        if ($multiple) {
            foreach ($files as $file) {
                $response[] = $this->packResponse($file);
            }
        }
        return response()->json($response);
    }

    private function packResponse(UploadedFile $file)
    {
        $json = new StdClass();
        $json->name = $file->getClientOriginalName();
        $json->mime = $file->getClientMimeType();
        $json->path = $file->storePubliclyAs(uniqid('up', true), $file->getClientOriginalName(), 'public');
        $json->url = asset('storage/' . $json->path);
        return $json;
    }

    private function getPublicName(UploadedFile $file)
    {
        return $file->getClientOriginalName();
        if (!$file->guessExtension()) {
            return uniqid('', true) . '.' . $file->clientExtension();
        } else {
            return $file->hashName();
        }
    }

    public function download($id, $name)
    {
        return response()->download(storage_path("app/public/$id"), $name, [
            'Content-Type'  => Storage::drive('public')->mimeType($id),
        ]);
    }

    public function view($id, $name)
    {
        return response()->download(storage_path("app/public/$id"), $name, [
            'Content-Type'  => Storage::drive('public')->mimeType($id),
        ], 'inline');
    }
}
