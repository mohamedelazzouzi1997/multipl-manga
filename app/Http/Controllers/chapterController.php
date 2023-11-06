<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class chapterController extends Controller
{
    public function index(){
        $mangas = Manga::all();
        return view('admin.chapter.index',compact('mangas'));
    }
    public function show($slug){
        $chapter = Chapter::where('slug',$slug)->first();
        $manga = Manga::where('id',$chapter->manga_id)->first();

        return view('admin.chapter.show',compact('chapter','manga'));
    }
    public function mangaChapters($slug){
        $manga = Manga::where('slug',$slug)->first();
        $chapters = Chapter::where('manga_id',$manga->id)->latest()->get();
        return view('admin.chapter.detail',compact('manga','chapters'));
    }

    public function create(){
        $mangas = Manga::all();
        return view('admin.chapter.create',compact('mangas'));
    }
    public function edit($id,$manga_id){
        $chapter = Chapter::where('id',$id)->first();
        $manga = Manga::where('id',$manga_id)->first();

        return view('admin.chapter.edit',compact('chapter','manga'));
    }
    public function createChapterForManga($slug){
        $manga = Manga::where('slug',$slug)->first();
        return view('admin.chapter.create-manga',compact('manga'));
    }
    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'manga_id' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:png,jpg,jpeg,webp',
        ]);

        $manga_name = Manga::where('id',$request->manga_id)->first()->name;
        $chapter_name = Str::slug($request->name, '-');

        if($request->hasFile('images'))
        {
            $names = [];
            foreach($request->images as $image)
            {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('mangas/'.$manga_name.'/'.$chapter_name), $filename);
                array_push($names, $filename);
            }
        }
        if($validate){

            $chapter =  Chapter::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'title' => $request->title,
                'manga_id' => $request->manga_id,
                'img' => $names,
            ]);
            if($chapter){
                session()->flash('status','chapter created');
                return redirect()->route('chapter.index');
            }else{
                session()->flash('status','chapter created faild');
                return redirect()->route('chapter.index');
            }
        }
    }
    public function update(Request $request,$id){

        $validate = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'manga_id' => 'required',
            // 'images' => 'required',
            // 'images.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);
        $chapter = Chapter::where('id',$id)->first();
        $manga = Manga::where('id',$request->manga_id)->first();
        $chapter_name = Str::slug($request->name, '-');

        if($request->hasFile('images') && $request->images != null)
        {
            $old_chapter_name = Str::slug($chapter->name, '-');
            File::deleteDirectory(public_path('mangas/'.$manga->name.'/'.$old_chapter_name));

            $names = [];
            foreach($request->images as $image)
            {
                $filename = $image->getClientOriginalName();
                $image->move(public_path('mangas/'.$manga->name.'/'.$chapter_name), $filename);
                array_push($names, $filename);
            }
        }
        if($validate){

            $chapter->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'title' => $request->title,
                'manga_id' => $request->manga_id,
            ]);

            if($chapter){
                session()->flash('status','chapter updated');
                return redirect()->route('chapter.detail',$manga->slug);
            }else{
                session()->flash('status','chapter updated faild');
                return redirect()->route('chapter.detail',$manga->slug);
            }
        }
    }
    public function delete($id,$manga_id){
        $chapter = Chapter::find($id);
        $manga_name = Manga::where('id',$manga_id)->first()->name;
        $chapter_name = Str::slug($chapter->name, '-');
        File::deleteDirectory(public_path('mangas/'.$manga_name.'/'.$chapter_name));

        $chapter->delete();
        session()->flash('status','chapter deleted');
        return back();
    }
}
