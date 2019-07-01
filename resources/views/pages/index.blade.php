@extends('layout')

@section('page')
    <h1>Home page</h1>

    @foreach ($episodes as $item)

        <div class="snagCast__card">
            <div class="snagCast__title">
                <h3><a href={{ url('/episode/' . $item['id']) }}>{{ $item['title'] }}</a></h3>
            </div>
        </div>

    @endforeach
@endsection