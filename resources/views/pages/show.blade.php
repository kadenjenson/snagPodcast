@extends('layout')

@section('page')

    <h2>{{ $episode->title }}</h2>

    <audio controls>
        <source src={{ $episode->audioURL }}>
    </audio>

    <div class="snagCast__card">
        <p>{{ $episode->description }}</p>
    </div>

@endsection