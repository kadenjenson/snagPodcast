@extends('index')
@section('title', 'Snag Podcast')
@section('page-class', 'home page')

@section('page-header')
    
    @php ($episode = $episodes[array_key_first($episodes)])

    <div class="title">
        <h1>{{ $episode->title }}</h1>
    </div>
    
@endsection

@section('page-content')
    
    @php ($latestEpisodeID = array_key_first($episodes))
    
    @foreach ($episodes as $id => $item)
        @if ($latestEpisodeID === $id)
            @continue
        @endif
        
        <div class="flex overflow-hidden h-60 w-full mb-8 bg-gray-100 rounded-xl">
            <img class="flex-none h-auto w-60" src="{{ $item->artworkUrl }}" alt="Snag Podcast Episode {{ $item->episodeNum }}">
            
            <div class="flex-1 flex flex-col justify-between p-5">
                <div class="title font-semibold">
                    <a class="text-2xl" href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>
                    <div class="text-md text-gray-500 font-medium">- {{ $item->publishedAt }}</div>
                </div>
                
                <div class="font-medium">
                    <p class="text-lg">"{{ $item->summary }}"</p>
                    <div class="text-gray-500">Hosts: {{ $item->artist }}</div>
                </div>
                {{-- TODO: refactor tags & create dedicated page for them. --}}
                {{--<div class="tag">this is a tag</div>--}}
                {{--<div class="sub title">{{ $item->tags }}</div>--}}
            </div>
        </div>
    @endforeach
    
@endsection
