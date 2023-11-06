@extends('layouts.admin')

@section('title')
@endsection

@section('links')
@endsection

@section('content')
    <div class="mb-5 mt-5">
        <h1 class="text-3xl text-center font-bold text-gray-900 mb-10">Create Manga</h1>
    </div>

    <div class="block p-6 rounded-lg shadow-lg bg-white mx-auto mb-20">

        @if ($errors->any())
            <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <form action="{{ route('manga.update', $manga->id) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group mb-6">
                <label for="description" class="text-slate-900 text-xl font-bold">Name :</label>
                <input name="name" type="text" value="{{ $manga->name }}"
                    class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="Name">
            </div>
            <div class="form-group mb-6">
                <label for="description" class="text-slate-900 text-xl font-bold">Description :</label>
                <textarea name="description"
                    class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      "
                    id="exampleFormControlTextarea13" rows="3" placeholder="Message">{{ $manga->description }}</textarea>
            </div>
            <div class="form-group mb-6">
                <label for="author" class="text-slate-900 text-xl font-bold">author :</label>
                <input name="author" value="{{ $manga->author }}" type="text"
                    class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="author">
            </div>
            <div class="form-group mb-6">
                <label for="artist" class="text-slate-900 text-xl font-bold">artist :</label>
                <input name="artist" value="{{ $manga->artist }}" type="text"
                    class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="artist">
            </div>
            <div class="form-group mb-6">
                <label for="release_date" class="text-slate-900 text-xl font-bold">release_date :</label>
                <input name="release_date" value="{{ $manga->release_date }}" type="text"
                    class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="release_date">
            </div>
            <div class="form-group mb-6">
                <label for="state" class="text-slate-900 font-bold">state</label>
                <select name="state" id="state" type="datetime-local"
                    class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="container">
                    <option @if ($manga->status == 1) selected @endif value="1">Not finished</option>
                    <option @if ($manga->status == 0) selected @endif value="0">finished</option>
                </select>
            </div>
            <div class="form-group mb-6">
                <label for="rate" class="text-slate-900 font-bold">rate</label>
                <input name="rate" value="{{ $manga->rate }}" type="text"
                    class="form-control block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleInput7" placeholder="rate">
            </div>
            <div class="form-group mb-6">
                <label for="rate" class="text-slate-900 my-10 font-bold">Select category :</label>
                <div class="flex mb-10  border px-10 py-5">
                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                        @foreach (explode(',', $manga->category_id) as $category)
                            @php
                                $checked = false;
                                if (in_array($category, explode(',', $manga->category_id))) {
                                    $checked = true;
                                }
                            @endphp
                            <div>
                                <input id="orange-checkbox" @if ($checked) checked @endif
                                    name="category_id[]" type="checkbox" value="{{ $category }}"
                                    class="w-4 h-4 text-orange-500 bg-gray-100 rounded border-gray-300 focus:ring-white ">
                                <label for="inline-checkbox"
                                    class="text-lg font-bold text-gray-900">{{ $category }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <label for="cover" class="text-slate-900 font-bold">cover</label>
                <div
                    class="form-control block relative hover:bg-slate-200
        w-full
        py-2 pl-2
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        text-center
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    Upload Cover photo<input name='cover' value="{{ $manga->cover }}" type="file"
                        class="opacity-0 w-full cursor-pointer  absolute bottom-0 top-0 right-0 left-0"
                        id="exampleInput8"></div>

            </div>
            <button type="submit"
                class="
      w-full
      px-6
      py-2.5
      bg-slate-700
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-slate-800 hover:shadow-lg
      focus:bg-slate-900 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-slate-900 active:shadow-lg
      transition
      duration-150
      ease-in-out">Edit
                Manga</button>
        </form>

    </div>
@endsection

@section('scripts')
@endsection
