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

{{-- need to retain old input if validation failed --}}

<?php
    if (count($errors) > 0 && $mode == 'Add') {
        $lastName = Input::old('lastName');
        $firstName = Input::old('firstName');
        $email = Input::old('email');
        $password = Input::old('password');
        $confirm = Input::old('confirm');
        $role = Input::old('role');

    } else {
        $lastName = $user->last_name;
        $firstName = $user->first_name;
        $email = $user->email;
        $password = '';
        $confirm = '';
        $role = $user->role;
    }
?>

<script>
    $(document).ready(function(){
        $("#role").val('{{ $role }}');
    });
</script>


<form method="POST" action="{{URL::to('/useredit')}}/{{$uid}}/{{$mode}}">

  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
        <p class="legend">
            @if ($mode == 'Add')
                Enter New User
            @elseif ($mode == 'Delete')
                Delete User
            @else
                Edit User Information
            @endif

        </p>
        @inject('errorDisplay', '\App\Http\Controllers\UsereditController')
        <div class="field">
            <label for='lastName'>Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" size="30" maxlength="30" value="{{ $lastName }}" {{ $mode == 'Delete' ? 'readonly':''}} autofocus>
            <?php $errorDisplay->showError($errors,'lastName'); ?>
        </div>

        <div class="field">
            <label for='firstName'>First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" size="30" maxlength="30" value="{{ $firstName }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'firstName'); ?>
        </div>

        <div class="field">
            <label for='email'>Email:</label>
            <input type="email" id="email" name="email" placeholder="E-mail" size="30" maxlength="30" value="{{ $email }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'email'); ?>
        </div>

        <div>
            <label></label>
            <span class="msg-long">
                If you enter a new password, you must confirm it exactly.  If you leave the password blank
                for an existing user, the previous password will be retained.
                @if (Auth::user()->role == 'Administrator')
                    If this is a new user and you leave the password blank,
                    the user will not be able to login.
                @endif
            </span><br><br>
        </div>

        <div class="field">
            <label for='password'>Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" size="20" maxlength="16" value="{{ $password }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'password'); ?>
        </div>

        <div class="field">
            <label for='password_confirmation'>Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Passwprd" size="20" maxlength="16" value="{{ $confirm }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'confirm'); ?>
        </div>

        <div class="field">
            <label for='role'>Role:</label>
            <select id="role" name="role">
                @if (Auth::user()->role == 'End User')
                    <option value="End User" disc="0">End User</option>
                @else
                    <option value="" disc="0">Select a Role</option>
                    <option value="End User" disc="0">End User</option>
                    <option value="Administrator" disc="0">Administrator</option>
                @endif
            </select>
            <?php $errorDisplay->showError($errors,'role'); ?>
        </div>

        <br><br><label for="submit">&nbsp;</label>

        @if (Auth::user()->role == 'Administrator')
            <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/users')}}">Cancel</a>
        @else
            <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/')}}">Cancel</a>
        @endif


        @if ($mode == 'Delete')
            <button type="submit" id="submit" class="btn btn-primary">DELETE (permanent!)</button>
        @else
            <button type="submit" id="submit" class="btn btn-primary">Save</button>
        @endif

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
