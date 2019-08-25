@extends('_layouts.master')




@section('body')


    <div class="container">
        <div class="columns">
            <div class="column">
                <figure class="image ">
                    <img src="https://assets.aactmad.org/images/MayPole_0097.jpg"
                         title="Image by Don Theyken">
                    <figcaption class="image-credit">Image by Don Theyken</figcaption>
                </figure>
                <h1 class="title">Dancing in the Streets</h1>

                <div class="box">
                    <div class="notification is-warning has-text-weight-bold has-text-centered">
                        {{$page->labordaysunday()}}
                    </div>

                    <div class="notification is-warning has-text-weight-bold has-text-centered">
                        Kids, Adults, Families, Singles, Seniors, Students
                    </div>


                    <p class="notification is-warning has-text-weight-bold has-text-centered">
                        <a href="schedule">Festival Schedule</a>
                    </p>
                </div>

                <div class="box">
                    Dancing in the Streets is an annual free festival on the <span class="has-text-weight-bold">Sunday of Labor Day weekend in downtown Ann
                    Arbor</span>. It offers local residents a chance to sample lots of different music and dance
                    traditions, enjoy the downtown, and see some friends and neighbors in the process. Multiple stages
                    offer visitors a chance to try many different styles of dancing, as well as enjoy mini-concerts and
                    entertain their children with special activities.
                </div>
            </div>

            <div class="column">

                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title has-text-centered">
                            This event is made possible by volunteers from dance organizations and the general community
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content has-text-centered">
                            <a href='/volunteer' target='_blank' style='font-size: 1em; font-style: italic;'>Please
                                Volunteer to Make it Happen - Sign up here</a><br/> <br/> or <br/> <br/>
                            <a href="mailto:volunteer@aactmad.org?subject=Dancing in the Streets Volunteer">E-mail for
                                more information. <br> volunteer@aactmad.org</a>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Photos and Video
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content has-text-centered  ">
                            We had a great time last Labor Day. See some beautiful photo's from 2012 at
                            <a href="http://www.annarbor.com/entertainment/scenes-from-dancing-in-the-streets-2012"
                               target="_blank">ANNARBOR.COM</a> .
                        </div>
                    </div>
                </div>

                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Location
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <ul>
                                <li><a target="_blank" href="https://goo.gl/maps/khccA4pE3tu"><strong>Main and
                                            Washington, Ann Arbor, MI </strong></a></li>

                                <figure class="image">
                                    <img src="https://assets.aactmad.org/images/logo_AAcity.jpg"
                                         style="height: 90px;width: 90px">
                                </figure>
                                <p style="color: blue; font-style: italic; text-align: center;">Thanks to the City of
                                    Ann Arbor for its support.</p>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



@endsection
