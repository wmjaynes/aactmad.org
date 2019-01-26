@extends('_layouts.master')

@section('header')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Ruge+Boogie');

        img {
            max-width: 300px;
            max-height: 300px;
        }

        .margin20 {
            margin: 20px;
        }

        #tree-header {
            font-family: 'Ruge Boogie', cursive;
            font-size: 4rem !important;
            line-height: 4rem;
            color: #6E6102;
            background-color: #f3d9b3;
            border: thick ridge #df905b;

            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        .is-transparent {
            background-color: transparent;
            background-image: none;
        }

        .content ul {
            margin-left: 1em;
        }

    </style>


@endsection



@section('body')


    <div id="tree" class="tree container">


        <nav id="tree-header" class="level " >
            <div class="level-item has-text-centered">
                <figure class="image ">
                    <img src="https://assets.aactmad.org/images/stomp.logo.500.jpeg" title="Illustration by Asja Boros">
                </figure>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="is-size-2-mobile">Tree Town Stomp</p>
                    <p class="is-size-2-mobile">Caller: George Marshall</p>
                    <p class="is-size-2-mobile">Band: Wild Asparagus</p>
                    <p class="is-size-3">October 25-27 2019</p>
                </div>
            </div>
        </nav>

        <div class="has-text-centered is-transparent title">
            A full weekend of contra dance (and waltz)<br/>
            Additional talent: TBA
        </div>

        <div class="box is-transparent margin20">
            <p class="has-text-centered title is-3">Weekend Schedule 2018 (2019 will be similar)</p>
            <div class="content">
                <ul>
                    <li>Friday &mdash; 8&ndash;11:30pm &mdash; Wild Asparagus &amp; George Marshall</li>
                    <li>Saturday &mdash; Note: Lunch will be provided
                        <ul>
                            <li>10&ndash;11:45am &mdash; Open Waltz &mdash; Peregrine Road</li>
                            <li>12:30&ndash;2:00pm &mdash; Contra Workshop &mdash; Wild Asparagus &amp; George
                                Marshall
                            </li>
                            <li>2:30&ndash;4:45pm &mdash; Contra Dance &mdash; Peregrine Road &amp;</li>
                            <li>8&ndash;11:30pm &mdash; Contra Dance &mdash; Wild Asparagus &amp; George Marshall</li>
                        </ul>
                    </li>
                    <li>Sunday &mdash; 12:30&ndash;3:30pm &mdash; Contra Dance &mdash; Wild Asparagus &amp; George
                        Marshall
                    </li>
                    <li>&nbsp;</li>
                    <li><a href="https://drive.google.com/open?id=1eGzKN23AH7Btov1wg1SUdFkeQCCq5_sq" target='_blank'>Download
                            the 2018 schedule</a></li>
                </ul>
            </div>
        </div>


        <div class="content">
            <ul>
                <li><a href='registration.html' target="_blank">Register in advance to save money.</a> . All mail in
                    registrations will be
                    accepted if received by Friday 10/25. On line registration will be open until noon on Friday 10/25.
                </li>

                <!--
                <li><iframe width='615' height='125' frameborder="1"
                        src="https://docs.google.com/spreadsheets/d/1Hw5QYVrlk4vnvggA2kb77AyuE4P4vC6wUyi3-InJThw/pubhtml"
                    ></iframe></li>
                 -->

                <li><strong> Free weekend admission is available in exchange for help during the weekend, contact us if
                        interested. </strong></li>
                <li>You may register in advance for part of the weekend by sharing a full weekend admission with
                    someone. You have to find
                    someone to share a weekend registration with, just let us know who will attend each session. You may
                    send someone to attend any
                    session you do not attend, just let us know
                </li>
                <li>Walk-ins are welcome at all sessions:
                    <ul>
                        <li>Friday Night: $30 ($20 if 25 or under)</li>
                        <li>Saturday morning/afternoon: $25 ($15 if 25 or under)</li>
                        <li>Saturday Night: $30 ($25 if 25 or under)</li>
                        <li>Sunday: $25 ($15 if 25 or under)</li>
                    </ul>
                </li>
                <li>No gender balancing.</li>
                <li>Refunds are available through Oct 23 (minus $10 cancellation fee)</li>
                <li><strong>Bring clean, indoor shoes for dancing.</strong> No street shoes permitted on the dance
                    floor!
                </li>
                <li>For housing with a dancer, contact <a
                            href="mailto:tts-housing@aactmad.org">tts-housing@aactmad.org</a>.
                </li>
                <li>
                    <a href="https://docs.google.com/file/d/1MLqnnU07nbU1kFtQYjRPT0nJvMzhI8PSyzOY1hAMZo2dV7BD9_bkF1JLa17D/edit?usp=sharing"
                       target='_blank'
                    >Hotels nearby</a></li>
                <li>
                    <a href="https://drive.google.com/file/d/0Bz2GhOdCxtlHT1Zpa19aOUc4VF9SQVBqd25RUTlUOUxlTmR3/view?usp=sharing"
                       target='_blank'>Restaurants
                        nearby</a></li>
                <li>Questions: <a href="mailto:tts@aactmad.org">tts@aactmad.org</a> or call 734 677-0212.
                </li>
                <li>Tree Town Stomp - <a href="https://drive.google.com/open?id=1hRSpRfKFPoDqvctgs56-j2vEme8nTTzZ">Past
                        and future</a></li>
            </ul>
        </div>

        <div class="has-text-centered">
            <p class="title">
                <a target="_blank" href="https://drive.google.com/open?id=1PJQS7vDoPGszfja_g-3pMQWdgXxuQBFJ">Register
                    now via mail. Download flyer
                    here.</a>
            </p>
            <p class="title">
                <a href="/tts/registration">Register on line here.</a>

            </p></div>


    </div>
@endsection
