@extends('_layouts.master')

@section('header')

    {!! $page->fontawesome !!}
    {!! $page->polyfill !!}

@endsection

@section('body')

    <div id="app" class="container">
        <h1 class="title">Tree Town Stomp Registration 2019</h1>

        <div class="box">
            You do not need a PayPal account in order to pay via PayPal. You may use a credit card.
        </div>


        <tts-registration></tts-registration>

    </div>

    <script src="{{ mix('js/vue.js', 'assets/build') }}"></script>

@endsection
