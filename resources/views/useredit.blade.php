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
        $role = Input::old('role');

    } else {
        $lastName = $user->last_name;
        $firstName = $user->first_name;
        $email = $user->email;
        $password = '';
        $role = $user->role;
    }
?>

<script>
    $(document).ready(function(){
        $("#role").val({{ $role }});
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

        <div class="field">
            <label for='password'>Password:</label>
            <input type="text" id="password" name="password" placeholder="Passwprd" size="20" maxlength="16" value="{{ $password }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'password'); ?>
        </div>

        <div class="field">
            <label for='role'>Role:</label>
            <select id="role" name="role">
                <option value="" disc="0">Select a Role</option>
                <option value="End User" disc="0">End User</option>
                <option value="Administrator" disc="0">Administrator</option>
            </select>
            <?php $errorDisplay->showError($errors,'role'); ?>
        </div>

        <br><br><label for="submit">&nbsp;</label>
        <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/users')}}">Cancel</a>

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
