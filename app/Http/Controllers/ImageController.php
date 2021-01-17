<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\Image;
use App\Models\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Image[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array[]|string[]
     */
    public function store(ImageUploadRequest $request)
    {
        $image = $request->file('image');
        $urls = [];
        foreach ($image as $images){
            $filename = $images->getClientOriginalName();
            $extension = $images->extension();
            $path = Storage::putFileAs('images', $images, $filename);
            array_push($urls,url('') . '/' . $path );
        }

        $image_details = Image::create([
           'title' => $request->title,
            'image_repository_id' => 1,
           'description' => $request->description,
            'price' => $request->price,
            'image_url' => $urls,
        ]);
        return [
            'data' => $image_details
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Image::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageUploadRequest $request, $id)
    {
        $image = $request->file('image');

        $imageUpdate = Image::findOrFail($id);

        $urls = [];
        foreach ($image as $images){
            $filename = $images->getClientOriginalName();
            $extension = $images->extension();
            $path = Storage::putFileAs('images', $images, $filename);
            array_push($urls,url('') . '/' . $path );
        }
        $imageUpdate->update([
            'title' => $request->title,
            'image_repository_id' => 1,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $urls,
        ]);

        return \response([
           'message' => 'Update successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = explode(",", $id);

        foreach ($image as $images) {
            Storage::delete("uploaded-images/{$images}");
        }
        return \response([
           'message' => 'Deleted'
        ]);
    }

    public function filter(Request $request)
    {
        $fad = $request->get('name');
        return Image::where('name','LIKE',"{$fad}%")->get();
    }
}
