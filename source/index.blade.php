@extends('_layouts.master')

@section('header')

    {!! $page->moment !!}
    {!! $page->polyfill !!}

@endsection


@section('body')

    <div class="container">
        {{--<figure class="image is-3by1">--}}
        {{--<img src="https://source.unsplash.com/600x200/?dance">--}}
        {{--</figure>--}}

        <p class="title">Ann Arbor Community for Traditional Music and Dance</p>
        <div class="box">Connect with a great community while you dance, play music, hear and feel traditional music
            made just for you. Non-profit AACTMAD volunteers welcome you at lively music and dance events every week.
            Fun, easy to learn, no partner or experience necessary.
        </div>

        <div id="app">
            <coming-events-container></coming-events-container>
        </div>

        <div class="level is-mobile">
            <div class="level-item has-text-centered">
                <a class="button is-danger is-fullwidth is-small" href="/events/">
                    <span class="icon">
                      <i class="far fa-calendar-alt"></i>
                    </span> <span>Find an Event</span> </a>
            </div>
            <div class="level-item has-text-centered">
                <a class="button is-info is-fullwidth is-small" href="/membership">
                    <span class="icon">
                      <i class="fas fa-users"></i>
                    </span> <span>Support</span>
                </a>
            </div>
            <div class="level-item has-text-centered">
                <a class="button is-primary is-fullwidth is-small"
                   href="/email.lists/">
                    <span class="icon">
                      <i class="far fa-envelope-open"></i>
                    </span> <span>Join an Email List</span> </a>
            </div>
        </div>

        <div class="columns">
            {{--<div class="column is-2">--}}
                {{--<div class="buttons">--}}
                    {{--<a class="button is-danger is-fullwidth" href="/events/">--}}
                    {{--<span class="icon">--}}
                      {{--<i class="far fa-calendar-alt"></i>--}}
                    {{--</span> <span>Find an Event</span> </a> <a class="button is-info is-fullwidth" href="/membership">--}}
                    {{--<span class="icon">--}}
                      {{--<i class="fas fa-users"></i>--}}
                    {{--</span> <span>Support</span>--}}
                    {{--</a> <a class="button is-primary is-fullwidth"--}}
                                                                 {{--href="/email.lists/">--}}
                    {{--<span class="icon">--}}
                      {{--<i class="far fa-envelope-open"></i>--}}
                    {{--</span> <span>Join an Email List</span> </a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="column is-12" style="order: -1;">
                <div class="columns">
                    <div class="column is-6">
                        <div class="card">
                            <a href="/contra">
                                <header class="card-header">
                                    <h1 class="subtitle is-3">Contra Dance</h1>
                                </header>
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="https://assets.aactmad.org/images/DawnDance.1_dsc2063.jpg"
                                             alt="Image" title="Image by Don Theyken">
                                        <figcaption class="small-image-credit">Image by Don Theyken</figcaption>
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="card">
                            <a href="/ecd">
                                <header class="card-header">
                                    <span class="subtitle is-size-3-mobile is-size-4-tablet is-size-3-desktop">English Country Dance</span>
                                </header>
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="https://assets.aactmad.org/images/ECD.tuesday.jpg"
                                             alt="Image" title="Image by Don Theyken">
                                        <figcaption class="small-image-credit">Image by Don Theyken</figcaption>
                                    </figure>
                                </div>

                            </a>
                        </div>
                    </div>
                    {{--<div class="column is-3">--}}
                        {{--<div class="card">--}}
                            {{--<a href="/ecd">--}}
                                {{--<div class="card-image">--}}
                                    {{--<figure class="image">--}}
                                        {{--<img src="https://assets.aactmad.org/images/ECD.16May2017.8478.jpg"--}}
                                             {{--alt="Image" title="Image by Don Theyken">--}}
                                        {{--<figcaption class="small-image-credit">Image by Don Theyken</figcaption>--}}
                                    {{--</figure>--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<span class="subtitle is-size-3-mobile is-size-5-tablet is-size-3-desktop">English Country Dance</span>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="column is-6">
                        <div class="card">
                            <a href="/swing/">
                                <header class="card-header">
                                    <h1 class="subtitle is-3">Swing Dance</h1>
                                </header>
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="http://www.kissmeinannarbor.com/images/KissME.jpg"
                                             alt="Image" title="Image by Kenny Schabow">
                                        <figcaption class="small-image-credit">Image by Kenny Schabow</figcaption>
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="card">
                            <a href="/pob">
                                <header class="card-header">
                                    <p class="subtitle is-3">Pittsfield Open Band</p>
                                </header>
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="https://assets.aactmad.org/images/2017 09 30 POB 25th Dance 9839 The Band.jpg"
                                             alt="Image" title="Image by Don Theyken">
                                        <figcaption class="small-image-credit">Image by Don Theyken</figcaption>
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="card">
                            <a href="/dits">
                                <header class="card-header">
                                    <h1 class="subtitle is-3">Dancing in the Streets</h1>
                                </header>
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="https://assets.aactmad.org/images/MayPole_0097.jpg"
                                             alt="Image" title="Image by Don Theyken">
                                        <figcaption class="small-image-credit">Image by Don Theyken</figcaption>
                                    </figure>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ mix('js/coming.events.js', 'assets/build') }}"></script>

@endsection
