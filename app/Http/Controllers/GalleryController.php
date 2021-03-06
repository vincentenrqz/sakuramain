<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::when(request('search'), function($query) {
            $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('date', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
        })->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'gallery' => $gallery,
            'gallery_count' => $gallery->count()
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $gallery = new Gallery();
        $gallery->name = $request->name;
        $gallery->date = $request->date;
        $gallery->description = $request->description;

        if($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $randomFilename = Str::random(20);
            $filename = $randomFilename.'.'.$extension;
            $destinationPath = ('images/');
            $file->move($destinationPath, $filename);
            $gallery->image = $filename;
            
        }

        $gallery->save();

        return response()->json([
            'status' => (bool) $gallery,
            'data' => $gallery,
            'message' => $gallery ? 'Gallery Created.' : 'Error Creating Gallery'
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        if($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $randomFilename = Str::random(20);
            $filename = $randomFilename.'.'.$extension;
            $destinationPath = ('images/');
            $file->move($destinationPath, $filename);
            return response()->json($filename);
            
        }
    }

    public function show(Gallery $gallery)
    {
        return response()->json($gallery, 200);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $status = $gallery->update(
            $request->only([
                'name',
                'description',
                'image'
            ])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Gallery Updated' : 'Error Updating Gallery'
        ]);
    }

    public function destroy(Gallery $gallery)
    {
        $status = $gallery->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Gallery Deleted.' : 'Error Deleting Gallery'
        ]);
    }
}
