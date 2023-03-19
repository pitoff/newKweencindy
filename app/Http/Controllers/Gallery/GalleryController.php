<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\ResponseTrait;

class GalleryController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $images = Gallery::paginate(3);
        return view('admin.gallery.viewGallery', [
            'images' => $images
        ]);
    }

    public function create()
    {
        return view('admin.gallery.create');
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
            return redirect(route('image-gallery.index'))->with('success', 'You have successfully saved image to gallery');

        }

    }

    public function show($id)
    {
        return view('admin.gallery.show');
    }

    public function edit($id)
    {
        $image = Gallery::find($id);
        return view('admin.gallery.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        // $image = Gallery::where('id',$id)->first();
        $request->validate([
            "imageName" => "required",
            "description" => "required",
        ]);

        $updateImage = Gallery::where('id', $id)->update([
            'imageName' => $request->imageName,
            'description' => $request->description,
        ]);

        if(!$updateImage){
            return back()->with('err', 'Failed to update image details');
        }
        return redirect(route('image-gallery.index'))->with('success', 'You have successfully updated image details');
    }

    public function destroy($id)
    {
        $image = Gallery::where('id',$id)->first();
        $deleteImage = $image->delete();
        if($deleteImage){
            $absolutePath = public_path('imageGallery/'.$image->imageFile);
            File::delete($absolutePath);
            return $this->success('You have successfully removed image from gallery', 200);
        }
        return $this->failure('Image could not be removed from gallery');
    }
}
