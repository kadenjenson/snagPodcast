@extends('layout')

@section('title', 'SnagPodcast Welcome!')
@section('page-class', 'index page')

@section('page-header')
    @php ($episode = $episodes[0])

    <div class="header-container">
        <div class="latest-episode">
            <audio id="audio-player" controls>
                <source src={{ $episode->audioURL }}>
            </audio>

            {{-- <div class="title">
                <div class="episode-num"><i>S</i> {{ $episode->season }} <i>E</i> {{ $episode->episode }}</div>
                <a href={{ url('/episode/' . $episode->id) }}>{{ $episode->title }}</a>
            </div>
            <div class="sub title">{{ $episode->summary }}</div>
            <div class="sub title">{{ $episode->artist }}</div>
            @foreach ($episode->tags as $tag)
                <div class="tag">{{ $tag }}</div>
            @endforeach
            <div class="date">{{ $episode->published }}</div> --}}
        </div>
    </div>

@endsection

@section('page')
    @foreach ($episodes as $i => $item)

        @if ($i === 0)
            @continue
        @endif

        <div class="snagCard card">
            <div class="img-container col">
                <img src="{{ $item->artURL }}" alt="SnagPodcast Epsiode {{ $item->episode }}">
            </div>
            <div class="episode-info col">
                <div class="title">
                    <div class="episode-num"><i>S</i> {{ $item->season }} <i>E</i> {{ $item->episode }}</div>
                    <a href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>
                </div>
                <div class="sub title">{{ $item->summary }}</div>
                <div class="sub title">{{ $item->artist }}</div>
                <div class="tag">this is a tag</div>
                {{-- <div class="sub title">{{ $item->tags }}</div> --}}
                <div class="date">{{ $item->published }}</div>
            </div>
        </div>

    @endforeach
@endsection