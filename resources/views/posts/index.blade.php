@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <p> Posts: </p>
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="w-2/4 p-0.5 m-5 rounded-xl shadow-md">
                <img class="" src={{ asset('placeholder.jpg') }} alt="">
                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}
                    </div>
                    <p class="text-base text-gray-600">
                        {{ $post->content }}
                    </p>
                </div>


                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-gray-400 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-100 mr-2 mb-2"><a
                            href="{{ $post->link }}">View post</a>
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
