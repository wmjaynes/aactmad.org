@extends('_layouts.master')

@section('header')

    {!! $page->fontawesome !!}
    {!! $page->polyfill !!}

@endsection

@section('body')

    <div class="container" id="app">

        <h1 class="title">Join Email Lists of Interest</h1>

        <div class="box">
            The following lists are low volume lists that announce events of interest to dancers and musicians. In
            general, each list sends out no more than one email a week.

        </div>

        <email-lists></email-lists>

        <div class="notification box">
            <strong>Pittsfield Open Band</strong> : To join the POB email list,
            please visit <a href="https://groups.io/g/POBmusicians" target="_blank">the POB group announcement site</a>
            at Groups.io.

        </div>

    </div>

    <script src="{{ mix('js/vue.js', 'assets/build') }}"></script>

@endsection
