@extends('layouts.master')

@section('title')
    Salespeople Maintenance
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')

@stop



@section('content')
<form method="POST" action="{{URL::to('/salespeople')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
    <p class="legend">Maintain Salespeople Master File</p>
      <div class='field'>

      </div>


      <br><br><label for="submit">&nbsp;</label>
      <button type="submit" id="submit" class="btn btn-primary">Save</button>
    </div>

  </fieldset>
</form>


@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
