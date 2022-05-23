<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.viewGallery');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(GalleryRequest $request)
    {
        $request->validated();
        $img = $request->file('imageFile');
        $imgFile = Str::random(12). '.' .$request->imageFile->extension();

        if(!File::exists('imageGallery')){
            File::makeDirectory('imageGallery', 0755, true, true);
        }

        $save = Gallery::create([
            'imageName' => $request->imageName,
            'description' => $request->description,
            'imageFile' => $imgFile
        ]);

        if($save){
            $imagePath = 'imageGallery';
            $img->move($imagePath, $imgFile);
            return redirect(route('image-gallery.index'))->with('success', 'You have stored an image to gallery');

        }

    }

    public function show()
    {

    }

    public function edit()
    {
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
