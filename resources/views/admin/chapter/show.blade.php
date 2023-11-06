@extends('layouts.admin')

@section('title')
@endsection

@section('links')
@endsection

@section('content')
    <div class="container  px-38 mx-auto pb-20">
        <h1 class="text-3xl text-center font-bold text-gray-900 mb-10">{{ $chapter->title }}</h1>

        <div class="overflow-x-auto relative sm:rounded-lg  ">
            @foreach ($chapter->img as $chapter_image)
                <div class="mx-auto my-2">
                    <img class="mx-auto"
                        src="{{ asset('mangas/' . $manga->name . '/' . $chapter->slug . '/' . $chapter_image) }}"
                        alt="">
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('scripts')
@endsection
