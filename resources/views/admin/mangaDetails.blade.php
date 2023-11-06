@extends('layouts.admin')

@section('title')
@endsection

@section('links')
@endsection

@section('content')
    <div class="mb-5 mt-5">
        <h1 class="text-3xl text-center font-bold text-gray-900 mb-10">Manga {{ $manga->name }} Details</h1>
    </div>

    <div class="block p-6 rounded-lg shadow-lg bg-white mx-auto mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="text-center">
                <img height="300px" class="h-[300px] rounded-lg" src="{{ asset('images/covers/' . $manga->cover) }}"
                    alt="">
            </div>
            <div class="text-center mt-3 md:mt-0 md:text-start space-y-5">
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">Name: </span><span
                        class="text-md text-gray-500">{{ $manga->name }} </span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">author: </span><span
                        class="text-md text-gray-500">{{ $manga->author }} </span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">artist: </span><span
                        class="text-md text-gray-500">{{ $manga->artist }} </span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900 ">Description: </span><span
                        class="break-words text-md text-gray-500">{{ $manga->description }} </span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">rate: </span><span
                        class="text-md text-gray-500">{{ $manga->rate }} <i
                            class="text-yellow-500 fa-sharp fa-solid fa-star"></i></span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">status: </span>
                    @if ($manga->state == 1)
                        <span class="text-md text-gray-50 py-1 px-2 rounded bg-blue-300">Not finished</span>
                    @else
                        <span class="text-md text-gray-50 py-1 px-2 rounded bg-red-300">finished</span>
                    @endif

                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">release date: </span><span
                        class="text-md text-gray-500">{{ $manga->release_date }}</span>
                </div>
                <div class="ml-5">
                    <span class="font-extrabold text-xl text-slate-900">status: </span>
                    @foreach (explode(',', $manga->category_id) as $category)
                        <span class="text-md text-gray-900 py-1 px-2 rounded bg-orange-300 mr-2">{{ $category }}</span>
                    @endforeach

                </div>
            </div>
            <div></div>
            <div class="text-end">
                <a href="{{ route('manga.edit', $manga->id) }}"
                    class="px-3 py-2 text-white hover:bg-slate-800 rounded bg-slate-900">Edit this manga</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
