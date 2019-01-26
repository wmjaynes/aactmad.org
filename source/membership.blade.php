@extends('_layouts.master')

@section('header')

    {!! $page->fontawesome !!}
    {!! $page->polyfill !!}

@endsection

@section('body')

    <div id="app" class="container">
        <h1 class="title">Support AACTMAD. </h1>

        <div class="box content" style="width: fit-content;">
            We believe that singing, dancing, and making music together:
            <ul>
                <li>enriches our lives</li>
                <li>builds community</li>
                <li>speaks to the needs of the present</li>
            </ul>
            If you agree, use the button below to make a one time gift to AACTMAD
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="C3HA8ZCQERRCG">
                <input type="image"
                       src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                       border="0"
                       name="submit"
                       alt="PayPal - The safer, easier way to pay online!"
                >
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>


        <div class="box content"  style="width: fit-content;">
            <p class="subtitle">
            Or Become a Member Now
            </p>
            <ul>
                <li><a href="https://assets.aactmad.org/pdfs/AACTMADMembershipForm.pdf" target="_blank">
                        Download the form here.</a></li>
                <li>Or fill out the online form below and pay with PayPal <br/>(note: a $1 fee is charged for online Family,
                    Individual, and Student memberships)</li>
            </ul>
        </div>
        <div class="box content">
            <p>
                You do not need a PayPal account in order to pay via PayPal. You may use a credit card.
            </p>
        </div>

        <member-registration></member-registration>

    </div>

    <script src="{{ mix('js/vue.js', 'assets/build') }}"></script>

@endsection
