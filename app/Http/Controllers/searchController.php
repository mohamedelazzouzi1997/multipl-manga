<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        if($request->has('manga')){
  $manga = Manga::where('slug',$request->manga)->first();
        }else{
            $manga = Manga::first();

        }
        $chapters = Chapter::where('manga_id',$manga->id)->get();
        $last_tree_chapters = Chapter::where('manga_id',$manga->id)->latest()->take(3)->get();

        if ($request->has('search')) {
            $chapters = Chapter::where('name', 'like', '%' . $request->search . '%')->get();
            return view('welcome',compact('chapters','last_tree_chapters','manga'))->withQuery ( $request->search );
        }else{
            return view('welcome',compact('chapters','last_tree_chapters','manga'));
        }
    }
}