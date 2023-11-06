<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class mangaController extends Controller
{
    //


    public function mangaDetails($id){

        $manga = Manga::find($id);
        return view('admin.mangaDetails',compact('manga'));
    }


    public function create(){
        $categories = Category::all();
        return view('admin.create',compact('categories'));
    }

    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required',
            'cover' => 'required|image|mimes:png,jpg,jpeg',
            'description' => 'required',
            'category_id' => 'required|array',
            'rate' => 'required',
            'author' => 'required',
            'artist' => 'required',
            'release_date' => 'required',
            'state' => 'required',
        ]);
        $imageName = time().'.'.$request->cover->getClientOriginalName();
        $categories = implode(', ', $request->category_id);
        if($validate){
            $manga =  Manga::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'cover' => $imageName,
                'description' => $request->description,
                'category_id' => str_replace(['[', ']', '"'], "", $categories)  ,
                'rate' => $request->rate,
                'author' => $request->author,
                'artist' => $request->artist,
                'release_date' => $request->release_date,
                'state' => $request->state,
            ]);
            if($manga){
                $request->cover->move(public_path('images/covers'), $imageName);
                session()->flash('status','manga created');
                return redirect()->route('dashboard');
            }else{
                session()->flash('status','manga created faild');
                return redirect()->route('dashboard');
            }

        }
    }

    public function edit($id){
    $manga = Manga::find($id);
        $categories = Category::all();
        return view('admin.edit',compact('categories','manga'));
    }

    public function update(Request $request,$id){

        $validate = $request->validate([
            'name' => 'required',
            'cover' => 'image|mimes:png,jpg,jpeg',
            'description' => 'required',
            'category_id' =>  'required|array',
            'rate' => 'required',
            'author' => 'required',
            'artist' => 'required',
            'release_date' => 'required',
            'state' => 'required',
        ]);
        $imageName = null;
        if($request->has('cover')){
            $imageName = time().'.'.$request->cover->getClientOriginalName();
        }
        $categories =  implode(', ', $request->category_id);
        if($validate){
            $manga = Manga::find($id);
            $oldcover = $manga->cover;
            $manga->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'cover' => ($request->has('cover'))? $imageName :  $oldcover ,
                'description' => $request->description,
                'category_id' => str_replace(['[', ']', '"'], "", $categories),
                'rate' => $request->rate,
                'author' => $request->author,
                'artist' => $request->artist,
                'release_date' => $request->release_date,
                'state' => $request->state,
            ]);
            if($manga){
                if($request->has('cover')){
                    if (File::exists(public_path('images/covers/'.$oldcover))) {
                        File::delete(public_path('images/covers/'.$oldcover));
                    }
                    $request->cover->move(public_path('images/covers'), $imageName);
                }
                session()->flash('status','manga updated');
                return redirect()->route('dashboard');
            }else{
                session()->flash('status','manga update faild');
                return redirect()->route('dashboard');
            }

        }
    }

    public function delete($id){
        $manga = Manga::find($id)->delete();

        session()->flash('status','manga deleted');
        return redirect()->route('dashboard');
    }
}