<?php

use App\Models\Manga;
use App\Models\Chapter;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\adminController;
use App\Http\Controllers\mangaController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\chapterController;
use App\Http\Controllers\categoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    if($request->has('manga')){
        $manga = Manga::where('slug',$request->manga)->first();
    }else{
        $manga = Manga::first();
    }
    $chapters = Chapter::where('manga_id',$manga->id)->latest()->get();
    $last_tree_chapters = $chapters->take(3);
    return view('welcome',compact('chapters','last_tree_chapters','manga'));
});
//search
Route::get('/manga/search',[searchController::class,'search'])->name('search');
//manga chapter

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','is_admin'])->group(function () {
    Route::get('/dashboard',[adminController::class,'index'])->name('dashboard');
    //manga
    Route::get('/manga/details/{id}',[mangaController::class,'mangaDetails'])->name('manga.detail');
    Route::get('/manga/create',[mangaController::class,'create'])->name('manga.create');
    Route::post('/manga/store',[mangaController::class,'store'])->name('manga.store');
    Route::get('/manga/edit/{id}',[mangaController::class,'edit'])->name('manga.edit');
    Route::put('/manga/update/{id}',[mangaController::class,'update'])->name('manga.update');
    Route::get('/manga/delete/{id}',[mangaController::class,'delete'])->name('manga.delete');

    //category
    Route::get('/category',[categoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[categoryController::class,'create'])->name('category.create');
    Route::post('/category/store',[categoryController::class,'store'])->name('category.store');
    Route::get('/category/edit/{id}',[categoryController::class,'edit'])->name('category.edit');
    Route::put('/category/update/{id}',[categoryController::class,'update'])->name('category.update');
    Route::get('/category/delete/{id}',[categoryController::class,'delete'])->name('category.delete');

    //chapter
    Route::get('/chapter',[chapterController::class,'index'])->name('chapter.index');
    Route::get('/chapter/show/{slug}',[chapterController::class,'show'])->name('chapter.show');
    Route::get('chapter/manga/{slug}',[chapterController::class,'mangaChapters'])->name('chapter.detail');
    Route::get('/chapter/create',[chapterController::class,'create'])->name('chapter.create');
    Route::get('/chapter/create/{slug}',[chapterController::class,'createChapterForManga'])->name('chapter.create.manga');
    Route::post('/chapter/store',[chapterController::class,'store'])->name('chapter.store');
    Route::get('/chapter/edit/{id}/{manga_id}',[chapterController::class,'edit'])->name('chapter.edit');
    Route::put('/chapter/update/{id}',[chapterController::class,'update'])->name('chapter.update');
    Route::get('/chapter/delete/{id}/{manga_id}',[chapterController::class,'delete'])->name('chapter.delete');
});
Route::get('/manga/{manga_name}/{slug}',[clientController::class,'show'])->name('client.show');
