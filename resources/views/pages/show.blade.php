@extends('index')

@section('page')

    {{-- <h2>{{ $episode->title }}</h2>

    <audio controls>
        <source src={{ $episode->audioURL }}>
    </audio>

    <div class="snagCast__card">
        <p>{{ $episode->description }}</p>
    </div> --}}

    <div id="buzzsprout-player-2913148"></div>
    <script src="https://www.buzzsprout.com/249518/2913148-s3-episode-1-it-came-to-pass-it-did-not-come-to-stay-heidi-neilson-s-story.js?container_id=buzzsprout-player-2913148&player=small" type="text/javascript" charset="utf-8"></script>

@endsection
