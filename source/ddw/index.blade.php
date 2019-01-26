@extends('_layouts.master')

@section('header')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Rochester');

        /*img {*/
            /*width: 400px;*/
            /*height: 400px;*/
        /*}*/

        #tree-header {
            font-family: serif;
            font-size: 3rem !important;
            line-height: 3rem;
            color: brown;
            background-color: yellow;
            border: thick ridge brown;

            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        body, div, p {
            color: brown;
        }

        .content ul {
            margin-left: 1em;
        }

        .imagee {
            height: 400px;
         }

    </style>

@endsection



@section('body')


    <div id="tree" class="tree container">


        <nav id="tree-header" class="level ">
            <div class="level-item has-text-centered">
                <figure class="image">
                    <img src="https://assets.aactmad.org/images/dawn.dance.logo.jpg" style="width:400px;"/>
                </figure>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="is-size-2-mobile">Dawn Dance Weekend</p>

                </div>
            </div>
        </nav>

        <div class="notification is-danger has-text-centered">
            There will be no Dawn Dance weekend in 2019 and probably beyond.
            We hope to bring it back at some point, but we simply do not know if that will be possible.
        </div>



    </div>
@endsection
