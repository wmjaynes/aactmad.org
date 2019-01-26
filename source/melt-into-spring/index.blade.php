@extends('_layouts.master')

@section('header')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Rochester');

        img {
            max-width: 300px;
            max-height: 300px;
        }

        #tree-header {
            font-family: 'Rochester', cursive;
            font-size: 3rem !important;
            line-height: 3rem;
            color: #066;
            background-color: #A6D0A6;
            border: thick ridge #066;

            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        body, div, p {
            color: #066;
        }

        .content ul {
            margin-left: 1em;
        }

    </style>

@endsection



@section('body')


    <div id="tree" class="tree container">


        <nav id="tree-header" class="level ">
            <div class="level-item has-text-centered">
                <figure class="image">
                    <img src="https://assets.aactmad.org/images/blue.bells.jpg"/>
                </figure>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="is-size-2-mobile">- Melt Into Spring -</p>
                    <p class="is-size-2-mobile">English Country Dance Ball</p>
                    <p class="is-size-3">Dances led by Beverly Francis</p>
                    <p class="is-size-4">Music by Debbie Jackson, Earl Gaddis, and Matt McCoy</p>
                    <p class="is-size-3">March 22–23, 2019</p>
                </div>
            </div>
        </nav>

        <div class="has-text-centered is-transparent subtitle">
            For dancers familiar with ECD figures
        </div>


        <div class="box is-transparent margin20">
            <p class="has-text-centered title is-3">Weekend Schedule 2019</p>
            <div class="content">
                <ul>
                    <li>Friday: English Dance &mdash; 8:00-11:00 &mdash; $15</li>
                    <li>Saturday
                        <ul>
                            <li>Ball Practice &mdash; 1:00-3:30 &mdash; included with the ball</li>
                            <ul>
                                <li>Highly recommended, there will be minimal teaching at the ball. ($13 at the door for
                                    practice only)
                                </li>
                            </ul>
                            <li>Catered Dinner &mdash; 6:00 &mdash; (optional &mdash; reserve by March 14)
                            </li>
                            <ul>
                                <li>Gather at 6:00 for wine, punch and appetizers. Dinner at 6:30.</li>
                            </ul>
                            <li>Ball &mdash; 8:00-11:30 &mdash; $37 ($42 at the door) including ball practice</li>
                            <ul>
                                <li>Attire: your version of Period / Elegant / Dressy / Interesting</li>
                                <li>If you wish, bring refreshments to share at the break.</li>
                            </ul>

                        </ul>
                    </li>
                    <li class="has-text-weight-bold">Catered Dinner & All Dances &mdash; $78</li>
                    <li>Sunday: Potluck brunch 10:30-12:30
                        <ul>
                            <li>Please bring a dish to share if you can. Maps at the dances.</li>
                        </ul>
                    </li>
                    <li class="has-text-weight-bold">Students half price for all dances.</li>
                </ul>
            </div>
        </div>

        <h4 class="box">
            Out-of-towners welcome; for home hospitality or any other
            questions: Call Greg at 734-717-8253 or email <a
                    href='mailto:mis@aactmad.org'>mis@aactmad.org</a>
        </h4>

        <div class="has-text-centered">
            <p class="title">
                <a target="_blank" href="https://assets.aactmad.org/pdfs/melt.into.spring.2019.pdf">Register
                    now via mail. Download flyer here.</a>
            </p>
            <p class="title">
                <a href="/melt-into-spring/registration">Register on line here.</a>

            </p></div>


    </div>
@endsection
