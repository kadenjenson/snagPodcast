@extends('index')

@section('page-class', 'index page')

@section('page-header')
    @php ($episode = $episodes[array_key_first($episodes)])

    <div class="header-container">
        <div class="latest-episode">
            <h1>{{ $episode->title }}</h1>
        </div>
    </div>
@endsection

@section('page-content')
    @php ($id = array_key_first($episodes))
    @foreach ($episodes as $i => $item)
        @if ($id === $i)
            @continue
        @endif

        <div class="snagCard card">
            <div class="img-container col">
                <img src="{{ $item->artworkUrl }}" alt="SnagPodcast Episode {{ $item->episodeNum }}">
            </div>
            <div class="episode-info col">
                <div class="title">
                    <div class="episode-num"><i>S</i> {{ $item->seasonNum }} <i>E</i> {{ $item->episodeNum }}</div>
                    <a href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>
                </div>
                <div class="sub title">{{ $item->summary }}</div>
                <div class="sub title">{{ $item->artist }}</div>
                <div class="tag">this is a tag</div>
{{--                 <div class="sub title">{{ $item->tags }}</div>--}}
                <div class="date">{{ $item->published }}</div>
            </div>
        </div>

    @endforeach
@endsection
