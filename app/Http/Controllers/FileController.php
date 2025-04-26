<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Resources\FileResource;

class FileController extends Controller
{
    public function myFiles(string $folder = null )  
    {
        if ( $folder ) {
            $folder = File::query()->where('created_by', Auth::id())
                ->where('path', $folder)
                ->firstOrFail();
        }

        if ( !$folder ) {
            $folder = $this->getRoot();
        }

        $files = File::query()
                    ->where('parent_id', $folder->id)
                    ->where('created_by', Auth::id())
                    ->orderBy('is_folder', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $files = FileResource::collection($files);
        return Inertia::render('Files/MyFiles', compact('files'));
    }

    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent ?: $this->getRoot();

        $existing = File::where('name', $data['name'])
                        ->where('created_by', Auth::id())
                        ->where('parent_id', $parent->id)
                        ->whereNull('deleted_at')
                        ->first();

        if ($existing) {
            return back()->withErrors([
                'name' => "'$existing->name folder already exists'"
            ]);
        }

        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        $parent->appendNode($file);
    }


    private function getRoot()
    {
        return File::query()->whereIsRoot()->where('created_by', Auth::id())->firstOrFail();
    }
}
