@extends('layout')

@section('page')
    <h1>Home page</h1>

    @foreach ($body as $item)

        <div class="snagCast__card">
            <div class="snagCast__title">
                <h2>{{ $item['id'] }}</h2>
                <h3>{{ $item['title'] }}</h3>
                <audio controls>
                    <source src={{ $item['audio_url']}}>
                </audio>
            </div>
        </div>

    @endforeach

    {{-- <script src="https://www.buzzsprout.com/249518.js?player=small" type="text/javascript" charset="utf-8"></script> --}}
@endsection