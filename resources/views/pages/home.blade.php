@extends('index')

@section('page-class', 'index page')

@section('page-header')
{{--    @php ($episode = $episodes[0])--}}

    <div class="header-container">
        <div class="latest-episode">
            <h1>This is the page's header.</h1>
        </div>
    </div>

@endsection

@section('page-content')
    <h1>This is the page content.</h1>
{{--    @foreach ($episodes as $i => $item)--}}

{{--        @if ($i === 0)--}}
{{--            @continue--}}
{{--        @endif--}}

{{--        <div class="snagCard card">--}}
{{--            <div class="img-container col">--}}
{{--                <img src="{{ $item->artUrl }}" alt="SnagPodcast Episode {{ $item->episode }}">--}}
{{--            </div>--}}
{{--            <div class="episode-info col">--}}
{{--                <div class="title">--}}
{{--                    <div class="episode-num"><i>S</i> {{ $item->season }} <i>E</i> {{ $item->episode }}</div>--}}
{{--                    <a href={{ url('/episode/' . $item->id) }}>{{ $item->title }}</a>--}}
{{--                </div>--}}
{{--                <div class="sub title">{{ $item->summary }}</div>--}}
{{--                <div class="sub title">{{ $item->artist }}</div>--}}
{{--                <div class="tag">this is a tag</div>--}}
{{--                --}}{{-- <div class="sub title">{{ $item->tags }}</div> --}}
{{--                <div class="date">{{ $item->published }}</div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    @endforeach--}}
@endsection
