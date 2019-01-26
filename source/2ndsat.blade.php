@extends('_layouts.master')

@section('header')

    <script src="https://events.aactmad.org/assets/build/js/events.js"></script>

    <style>
        .mom-header {
            /*background-image: url('https://assets.aactmad.org/images/moms.know.best.png');*/
            /*background-repeat: no-repeat;*/
            /*background-size: 200px;*/
            font-family: serif;
            font-style: italic;
            text-align: center;
        }
    </style>

@endsection

@section('body')

    <div class="container">

        <div class="level mom-header">
            <div class="level-item">
                <figure class="image">
                    <img src="https://assets.aactmad.org/images/moms.know.best.png" style="width: 250px;">
                </figure>
            </div>
            <div class="level-item has-text-centered">
                <div class="is-size-4">
                    <p> You and your friends need to put those video games away and </p>
                    <p> get yourselves to the </p>
                    <br/> <br/> <br/>
                    <p class="is-size-2" style="line-height: 1em;"> 2nd Saturday Contra Dance Party</p>
                </div>
            </div>
        </div>

        <div class="box content">
            <ul>
                <li>First-time and experienced contra dancers welcome</li>
                <li>Variety of great callers and musicians each month</li>
                <li>Occasional Saturday afternoon special events and pre-dance potlucks or weekends</li>
            </ul>

            <p>
                <strong>Beginners are welcome:</strong> Unless otherwise noted in an announcement, beginners are always
                welcome. There is an introductory session 30 minutes before the dance, so first-timers come early. Come
                alone or bring a friend. Anyone can ask anyone else to dance; experienced dancers are happy to help new
                people. It's a common practice to change partners after each dance sequence, and it works well while
                you're learning the basics; after that, it's up to you. Wear cool, comfortable clothes and flat shoes
                that aren't sticky.
            </p>
            <p><a href="/contra">More information on contra dancing is available here.</a></p>
        </div>

        <h1 class="title">Upcoming Events</h1>
        <iframe src="https://events.aactmad.org/justevents?nocontrols=1&orgId=2762"
            style="width: 100%; height: 500px;"></iframe>


    </div>

@endsection
