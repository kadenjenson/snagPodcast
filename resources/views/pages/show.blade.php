@extends('layout')

@section('page')

    <h2>{{ $episode['title'] }}</h2>

    <audio controls>
        <source src={{ $episode['audio_url']}}>
    </audio>
@endsection