@extends('layout')

@section('title', 'SnagPodcast Welcome!')
@section('page-class', 'index page')

@section('page-header')
    <div class="latest-episode">
        <div class="episode-info">
            <div class="title">
                <div class="episode-num"><i>S</i> {{ $episodes['0']->season }} <i>E</i> {{ $episodes['0']->episode }}</div>
                <a href={{ url('/episode/' . $episodes['0']->id) }}>{{ $episodes['0']->title }}</a>
            </div>
            <div class="sub title">{{ $episodes['0']->summary }}</div>
            <div class="sub title">{{ $episodes['0']->artist }}</div>
            {{-- <div class="sub title">{{ $episodes['0']->tags }}</div> --}}
            <div class="date">{{ $episodes['0']->published }}</div>
        </div>
    </div>
@endsection

@section('page')
    @foreach ($episodes as $item)

        @if ($item->episode === sizeof($episodes))
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