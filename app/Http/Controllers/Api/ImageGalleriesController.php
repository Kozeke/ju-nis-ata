<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Validator, Storage;
class ImageGalleriesController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $x=[];
        if($request->hasfile('image')) {
            $file = $request->file('image');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image1')) {
            $file = $request->file('image1');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image2')) {
            $file = $request->file('image2');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image3')) {
            $file = $request->file('image3');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image4')) {
            $file = $request->file('image4');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image5')) {
            $file = $request->file('image5');
            $url = Storage::putFile('public/image_gallery', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        foreach($x as $text){
            ImageGallery::create([
                'img_url' => $text,
            ]);
        }


        return response()->json(['success'], 200);
    }
}
