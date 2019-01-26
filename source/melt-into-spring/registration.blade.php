@extends('_layouts.master')

@section('header')

    {!! $page->fontawesome !!}
    {!! $page->polyfill !!}

    <style>
        .table td {
            padding: 0.2em 0.75em;
        }
    </style>
@endsection

@section('body')

    <div id="app" class="container">
        <h1 class="title">Melt Into Spring Registration 2019</h1>



        <div class="box">
            You do not need a PayPal account in order to pay via PayPal. You may use a credit card.
        </div>

        <table class="table" >
            <tr>
                <td></td>
                <td></td>
                <td class='price student'>Students</td>
            </tr>
            <tr>
                <td>All dances and catered dinner <i class="fas fa-asterisk fa-xs"></i></td>
                <td class='price'>$78</td>
                <td class='price student'>$53</td>
            </tr>
            <tr>
                <td>All dances, not including dinner</td>
                <td class='price'>$50</td>
                <td class='price student'>$25</td>
            </tr>

            <tr>
                <td>Saturday dances and catered dinner <i class="fas fa-asterisk fa-xs"></i></td>
                <td class='price'>$65</td>
                <td class='price student'>$46.50</td>
            </tr>
            <tr>
                <td>Saturday dances, not including dinner</td>
                <td class='price'>$37</td>
                <td class='price student'>$18.50</td>
            </tr>
            <tr>
                <td>Friday night dance</td>
                <td class='price'>$15</td>
                <td class='price student'>$7.50</td>
            </tr>
            <tr>
                <td>Saturday practice only (at the door)</td>
                <td class='price'>$13</td>
                <td class='price student'>$6.50</td>
            </tr>

            <tr>
                <td colspan='3'><i class="fas fa-asterisk fa-xs"></i> <strong>Important: </strong>To
                    include dinner, registration must be received by March 14.</td>
            </tr>
        </table>


        <mis-registration></mis-registration>

    </div>

    <script src="{{ mix('js/vue.js', 'assets/build') }}"></script>



@endsection
