<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publications;
use App\Models\Stories;
use App\Models\PublicationsImage;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Validator,Storage;

class PublicationsController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        $publications = Publications::with('publication_images')->get();
        foreach($publications as $publication){
            $publication->date = \Carbon\Carbon::createFromTimeStamp(strtotime($publication->created_at))->isoFormat('MMM Do YYYY');

        }


        return $publications;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'required|mimes:pdf',
            'is_main' => 'required',
            'downloaded' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        $file = $request->file('file');
        $url = Storage::putFile('public/publication_file', new File($file));
        $text = url('/') . '/storage/app/public/' . substr($url, 7);


        $publication = Publications::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'file' => $text,
            'is_main' => $request['is_main'],
            'downloaded' => $request['downloaded']

        ]);
        $x=[];
        if($request->hasfile('image')) {
            $file = $request->file('image');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image1')) {
            $file = $request->file('image1');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image2')) {
            $file = $request->file('image2');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image3')) {
            $file = $request->file('image3');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image4')) {
            $file = $request->file('image4');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        if($request->hasfile('image5')) {
            $file = $request->file('image5');
            $url = Storage::putFile('public/publication_photo', new File($file));
            $text = url('/') . '/storage/app/public/' . substr($url, 7);
            array_push($x,$text);

        }
        foreach($x as $text){
            PublicationsImage::create([
                'publication_id' => $publication->id,
                'img_url' => $text,
            ]);
        }


        return response()->json(['success'], 200);
    }
    public function destroy($id)
    {
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            return response()->json(['error'=> $e->getMessage()]);
        }
        $publication = Publications::where('id',$id)->first();
        if ($publication != null) {
            $publication->delete();
            return response()->json(['success'], 200);
        }
        return response()->json(['wrong id'], 400);
    }

    public function download(Request $request){
        $count=Publications::where('id',$request['id'])->pluck('downloaded');
        $publ = Publications::find($request['id']);
        $publ->downloaded = $count[0]+1;
        $publ->save();
        return response()->json("success",200);
    }
}
