@extends('layouts.master')

@section('title')
    <i class="fa fa-money"></i>&nbsp;&nbsp;Joe's Sales Tracker&nbsp;&nbsp;<i class="fa fa-money"></i>
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
<hr>
<p>
    Welcome to the Sales Tracker!  Use the navigation Menu on the left to
    maintain the product catalog, add or update information for salespeople, and to log and view sales transactions.
<hr>

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
