@extends('layout')

@section('title', 'SnagPodcast Contact')
@section('page-class', 'contact page')

@section('page')
    <div class="page-title">
        <h1>Contact Us!</h1>
    </div>
    
    <form action="/contact" method="POST" class="contact-form card">
        <div class="row-items">
            <div class="row">
                <label for="first-name">First Name</label>
                <input type="text" name="first-name" value="{{ old('first-name') }}">
                <div class="{{ ($errors->first('first-name')) ? 'error' : '' }}">{{ $errors->first('first-name') }}</div>
            </div>
            <div class="row">
                <label for="last-name">Last Name</label>
                <input type="text" name="last-name" value="{{ old('last-name') }}">
                <div class="{{ ($errors->first('last-name')) ? 'error' : '' }}">{{ $errors->first('last-name') }}</div>
            </div>
        </div>
        <div class="row">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ old('email') }}">
            <div class="{{ ($errors->first('email')) ? 'error' : '' }}">{{ $errors->first('email') }}</div>
        </div>
        <div class="row">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="15">{{ old('message') }}</textarea>
            <div class="{{ ($errors->first('message')) ? 'error' : '' }}">{{ $errors->first('message') }}</div>
        </div>

        @csrf

        <div class="row">
            <button type="submit" class="submit-btn">Send Message</button>
        </div>
    </form>
@endsection