<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Http\Request;

class clientController extends Controller
{
    //

    public function show($manga_name,$slug){

        $chapter = Chapter::where('slug',$slug)->first();
        $manga = Manga::where('id',$chapter->manga_id)->first();

        $previous = Chapter::where('manga_id',$chapter->manga_id)->where('id', '<', $chapter->id)->max('slug');

        // get next user id
        $next = Chapter::where('manga_id',$chapter->manga_id)->where('id', '>', $chapter->id)->min('slug');

        return view('chapter',compact('chapter','manga','previous','next'));
    }
}