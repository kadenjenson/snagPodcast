@extends('index')

@section('title', 'Snag Podcast')

@section('page-class', 'home page')

@section('page-header')
    @php ($episode = $episodes[array_key_first($episodes)])

    <div class="header-container">
        <div class="title">
            <h1>{{ $episode->title }}</h1>
        </div>
    </div>
@endsection

@section('page-content')
    @php ($latestEpisodeID = array_key_first($episodes))
    @foreach ($episodes as $id => $item)

        @if ($latestEpisodeID === $id)
            @continue
        @endif
        <div class="snagCard card">
            <div class="img-container col">
                <img src="{{ $item->artworkUrl }}" alt="Snag Podcast Episode {{ $item->episodeNum }}">
            </div>
            <div class="episode-info col">
                <div class="title">
                    <span class="text-xl"><i>S</i> {{ $item->seasonNum }} <i>E</i> {{ $item->episodeNum }}</span> <a href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>
                </div>
                <div class="sub title">Host(s): {{ $item->artist }}</div>
                <div class="sub-title date">- {{ $item->publishedAt }}</div>
                
                {{-- TODO: refactor tags & create dedicated page for them. --}}
                {{--<div class="tag">this is a tag</div>--}}
                {{--<div class="sub title">{{ $item->tags }}</div>--}}
            </div>
    
            <p class="text-xl tracking-wide">{{ $item->summary }}</p>
        </div>

    @endforeach
@endsection
