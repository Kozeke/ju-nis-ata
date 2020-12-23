<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stories;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\StoriesImage;
use Validator;
use Storage;

class StoriesController extends Controller
{
    public function create()
    {
        return view('create');
    }
    public function index()
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        $stories = Stories::with('story_images')->get();
        foreach($stories as $story){
            $story->date = \Carbon\Carbon::createFromTimeStamp(strtotime($story->created_at))->isoFormat('MMM Do YYYY');

        }
        return $stories;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        $story = Stories::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'is_main' => $request['is_main'],
            'author' => $request['author']
        ]);

        $x=[];
        if($request->hasfile('image')) {
            $file = $request->file('image');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image1')) {
            $file = $request->file('image1');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image2')) {
            $file = $request->file('image2');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image3')) {
            $file = $request->file('image3');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image4')) {
            $file = $request->file('image4');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image5')) {
            $file = $request->file('image5');
            $url = Storage::putFile('public/stories_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        foreach($x as $text){
            $document = StoriesImage::create([
                'story_id' => $story->id,
                'img_url' => $text,
            ]);
        }

        return response()->json(['success'], 200);


    }
    public function destroy($id){
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        $story = Stories::where('id',$id)->first();
        if ($story != null) {
            $story->delete();
            return response()->json(['success'], 200);
        }
        return response()->json(['wrong id'], 400);
    }
}
