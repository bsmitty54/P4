@extends('layouts.master')

@section('title')
    Joe's Sales Tracker
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')

@stop



@section('content')
<br>
<h1>Joe's Sales Tracker Application - Home Page</h1>
<br>
<?php
if (Session::has('message')) {
    echo '<span class="msg">';
    echo Session::get('message');
    echo '</span>';
    echo '<br>';
}
?>
<hr class="homepage">
<p>
    Welcome to the Sales Tracker!  Use the navigation Menu on the left to
    maintain the product catalog, add or update information for salespeople, and to log and view sales transactions.
</p>
<br>
<br>
<p>
    Click <span class="big"><a class="" href="{{URL::to('/manual')}}"  target="_blank"><i class="fa fa-book"></i>&nbsp;here</a></span> to open a document that describes the system and explains how to use it.  Thanks
    for trying out my application!
</p>
<hr class="homepage">

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
