@extends('_layouts.master')

@section('header')

    {!!  $page->moment !!}

@endsection


@section('body')


    <div class="container">
        <div class="columns">
            <div class="column">
                <figure class="image ">
                    <img src="https://assets.aactmad.org/images/ECD.tuesday.jpg"
                         title="Image by Don Theyken">
                    <figcaption class="image-credit">Image by Don Theyken</figcaption>
                </figure>
                <h1 class="title">Tuesday English Country Dancing</h1>

                <div id="venueNotice" class="notification is-danger is-invisible">
                    <p class="subtitle">NOTICE: Temporary Change of Venue</p>
                    <p>January - February 2019<br>
                        Gretchen's House Child Care Center Oak Valley, 2340 Oak Valley Drive, Ann Arbor MI, 48103</p>
                    <a href="https://goo.gl/maps/HrkfeM5qfws" target="_blank">MAP</a>
                </div>

                <div class="box content">
                    <p>Ann Arbor's Tuesday English country dance, now in its <span id="nthyear">XXth</span> year, welcomes beginners and
                        experienced dancers. We offer <strong>live music</strong>, friendly informal
                        <strong>instruction</strong>, an intimate acoustic setting, a <strong>wood floor</strong>, and a
                        wonderful community of dancers. It’s great fun.
                    </p>
                    <ul>
                        <li>Every Tuesday night at Chapel Hill Condominium Clubhouse.</li>
                        <li>7 to 9:30 pm</li>
                        <li>Adults: $8, students: $4, supervised children under 14 with parent: free.</li>
                    </ul>
                    <p>
                        <a target="_blank"
                           href="https://maps.google.com/maps/ms?msid=206170289426797003462.0004aec282ac4ff127ec7&amp;msa=0&amp;ll=42.312037,-83.694406&amp;spn=0.021231,0.038581"
                           target="_blank">Chapel Hill Condo Clubhouse<br/> 3350 Green Road<br/> Ann Arbor 48105</a>
                    </p>
                    <p><strong>Please</strong> do not park in the clubhouse driveway.</p>
                    <p><strong>Newcomers</strong>, please come at 7 pm and get started learning basic vocabulary and
                        easier dances. Come by yourself or bring a friend. Wear comfortable clothes and flat,
                        flexible-soled shoes with a little grip. Children are welcome.</p>
                    <p><strong>Contact us:</strong> <a href="mailto:ecd@aactmad.org">ecd@aactmad.org</a></p>
                </div>


            </div>

            <div class="column">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            What is English country dancing?
                        </p>
                    </header>
                    <div class="card-content">
                        It started in England about the time of Elizabeth I and peaked in Jane Austen’s era. Dancers
                        today enjoy wonderful tunes, a nearly limitless repertoire, and variety from lively to elegant
                        and in-between. No complicated steps; if you can walk, you can dance. All dances are taught
                        first and prompted as they go.
                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            See videos of English Country Dancing
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <ul style="list-style-type: none;">
                                <li><a href="http://dancevideos.childgrove.org/ecd" target="_blank"> Childgrove Country
                                        Dancers</a>
                                </li>
                                <li><a href="http://lambertvillecountrydancers.org/videolist3.html" target="_blank">
                                        Lambertville Country Dancers</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Downloads
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <ul style="list-style-type: none;">
                                <li><a href="https://assets.aactmad.org/pdfs/ECT_flyer.pdf">Tuesday Night Flyer.</a>
                                    (PDF - 1 page)
                                </li>
                                <li><a href="https://assets.aactmad.org/pdfs/ECT_repertoire.pdf">ECD Repertoire
                                        List.</a> (PDF - 1 page)
                                </li>
                                <li>
                                    <a target="_blank"
                                       href="https://drive.google.com/open?id=0Bz2GhOdCxtlHU2dvZ0FOc2dCTnc">Dances
                                        called since 2004</a></li>

                                </li>
                                <li><a href="https://assets.aactmad.org/pdfs/ECT_leaders.pdf">Index of Tuesday Night
                                        Leaders.</a>(for pre 09-10 seasons)
                                </li>
                                <li><a href="https://assets.aactmad.org/pdfs/English_Library.pdf">AACTMAD English
                                        Resources.</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <h1 class="title">Upcoming Events</h1>
        <iframe src="https://events.aactmad.org/justevents?nocontrols=1&orgId=797"
                style="width: 100%; height: 500px;"></iframe>
    </div>

    <script>
        function nth(n){return["st","nd","rd"][((n+90)%100-10)%10-1]||"th"}

        let begin = moment('1984-09-01', 'YYYY-MM-DD');
        let now = moment();
        let diff = now.diff(begin, 'year');
        let diffStr = diff + nth(diff);
        let nthyear = document.getElementById('nthyear');
        nthyear.innerHTML = diffStr;

        let end = moment('2019-03-01', 'YYYY-MM-DD');
        let element = document.getElementById("venueNotice");
        if (now.isBefore(end))
            element.classList.remove('is-invisible');
        if (now.isAfter(end))
            element.parentNode.removeChild(element);
    </script>



@endsection
