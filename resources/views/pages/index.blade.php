@extends('layout')

@section('title', 'SnagPodcast Welcome!')
@section('page-class', 'index page')

@section('page')
    <div class="page-title">
        <h1>Snag Podcast</h1>
    </div>

    @foreach ($episodes as $item)

        <div class="snagCard card">
            <div class="img-container col">
                <img src="{{ $item->artURL }}" alt="SnagPodcast Picture">
            </div>
            <div class="episode-info col">
                <div class="title">
                    <div class="episode-num"># {{ $item->episodeNum }}</div>
                    <a href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>
                </div>
                <div class="sub title">{{ $item->summary }}</div>
                <div class="sub-title">{{ $item->artist }}</div>
                <div class="sub-title">{{ $item->tags }}</div>
                <div class="date">{{ $item->published }}</div>
            </div>
        </div>

    @endforeach
@endsection