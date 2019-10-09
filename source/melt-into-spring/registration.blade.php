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
                <td class='price student'>Student</td>
                <td class='price'>Door</td>
            </tr>
            <tr>
                <td>All dances and catered dinner <i class="fas fa-asterisk fa-xs"></i></td>
                <td class='price'>$80</td>
                <td class='price student'>$54</td>
                <td class='price'>N/A</td>
            </tr>
            <tr>
                <td>All dances, not including dinner</td>
                <td class='price'>$52</td>
                <td class='price student'>$26</td>
                <td class='price'>$60</td>
            </tr>

            <tr>
                <td>Saturday dances and catered dinner <i class="fas fa-asterisk fa-xs"></i></td>
                <td class='price'>$66</td>
                <td class='price student'>$47</td>
                <td class='price'>N/A</td>
            </tr>
            <tr>
                <td>Saturday dances, not including dinner</td>
                <td class='price'>$38</td>
                <td class='price student'>$19</td>
                <td class='price'>$42</td>
            </tr>
            <tr>
                <td>Saturday practice only</td>
                <td class='price'>$14</td>
                <td class='price student'>$7</td>
                <td class='price'>$15</td>
            </tr>
            <tr>
                <td>Friday night dance</td>
                <td class='price'>$16</td>
                <td class='price student'>$8</td>
                <td class='price'>$18</td>
            </tr>

            <tr>
                <td colspan='3'><i class="fas fa-asterisk fa-xs"></i> <strong>Important: </strong>To
                    include dinner, registration must be received by March 19.</td>
            </tr>
        </table>


        <mis-registration></mis-registration>

    </div>

    <script src="{{ mix('js/vue.js', 'assets/build') }}"></script>



@endsection
