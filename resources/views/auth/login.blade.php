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


<br><br><br>
<form method="POST" action="/login">

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
        <p class="legend">
            Enter Login Credentials
        </p>
        @inject('errorDisplay', '\App\Http\Controllers\ProducteditController')
        <div class="field">
            <label for='email'>Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" size="30" maxlength="30" value="" autofocus>
            <?php $errorDisplay->showError($errors,'email'); ?>
        </div>

        <div class="field">
            <label for='password'>Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" size="20" maxlength="16" value="">
            <?php $errorDisplay->showError($errors,'password'); ?>
        </div>

    <!--
        <div class="field">
            <label for='remember'>Remember Me:</label>
            <input type="checkbox" id="remember" name="remember">

        </div>
    -->

        <br><br><label for="submit">&nbsp;</label>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>

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
