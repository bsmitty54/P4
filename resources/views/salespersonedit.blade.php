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
        $id = Input::old('employeeID');
        $lastName = Input::old('lastName');
        $firstName = Input::old('firstName');
        $city = Input::old('city');
        $zipCode = Input::old('zipCode');
        $state = Input::old('state');
        $street1 = Input::old('street1');
        $street2 = Input::old('street2');
        $email = Input::old('email');
        $hireDate = Input::old('hireDate');
        $terminationDate = Input::old('terminationDate');

    } else {
        $id = $salesperson->employee_id;
        $lastName = $salesperson->last_name;
        $firstName = $salesperson->first_name;
        $city = $salesperson->city;
        $zipCode = $salesperson->zip_code;
        $state = $salesperson->state;
        $street1 = $salesperson->street1;
        $street2 = $salesperson->street2;
        $email = $salesperson->email;
        $hireDate = $salesperson->hire_date;
        $terminationDate = $salesperson->termination_date;
    }
?>

<form method="POST" action="{{URL::to('/salespersonedit')}}/{{$sid}}/{{$mode}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
        <p class="legend">
            @if ($mode == 'Add')
                Enter New Salesperson
            @elseif ($mode == 'Delete')
                Delete Salesperson
            @else
                Edit Salesperson Information
            @endif

        </p>
        @inject('errorDisplay', '\App\Http\Controllers\SalespersoneditController')
        <div class="field">
            <label for='employeeID'>Employee ID:</label>
            <input type="text" id="employeeID" name="employeeID" placeholder="Employee ID" size="15" maxlength="15" value="{{ $id }}" {{ $mode == 'Delete' ? 'readonly':''}} autofocus>
            <?php $errorDisplay->showError($errors,'employeeID'); ?>
        </div>
        <div class="field">
            <label for='lastName'>Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" size="30" maxlength="30" value="{{ $lastName }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'lastName'); ?>
        </div>
        <div class="field">
            <label for='firstName'>First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" size="20" maxlength="20" value="{{ $firstName }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'firstName'); ?>
        </div>
        <div class="field">
            <label for='street1'>Street Address 1:</label>
            <input type="text" id="street1" name="street1" placeholder="Street Address Line 1" size="30" maxlength="30" value="{{ $street1 }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'street1'); ?>
        </div>
        <div class="field">
            <label for='street2'>Street Address 2:</label>
            <input type="text" id="street2" name="street2" placeholder="Street Address Line 2" size="30" maxlength="30" value="{{ $street2 }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='city'>City:</label>
            <input type="text" id="city" name="city" placeholder="City" size="20" maxlength="20" value="{{ $city }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">State:</label>&nbsp
            <input type="text" id="state" name="state" placeholder="ST" size="4" maxlength="2" value="{{ $state }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">ZIP:</label>&nbsp
            <input type="text" id="zipCode" name="zipCode" placeholder="Zipcode" size="9" maxlength="9" value="{{ $zipCode }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'city'); ?>
            <?php $errorDisplay->showError($errors,'state'); ?>
            <?php $errorDisplay->showError($errors,'zipCode'); ?>
        </div>
        <div class="field">
            <label for='email'>Email address:</label>
            <input type="text" id="email" name="email" placeholder="Email address" size="30" maxlength="30" value="{{ $email }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'email'); ?>
        </div>
        <div class="field">
            <label for='hireDate'>Hire Date:</label>
            <input type="date" id="hireDate" name="hireDate" placeholder="Hire date" value="{{ $hireDate }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">Termination Date:</label>&nbsp
            <input type="date" id="terminationDate" name="terminationDate" placeholder="Term date" value="{{ $terminationDate }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'hireDate'); ?>
            <?php $errorDisplay->showError($errors,'terminationDate'); ?>
        </div>


        <br><br><label for="submit">&nbsp;</label>
        <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/salespeople')}}">Cancel</a>
        <?php
            $stx = \App\Sales_transaction::where('salesperson_id','=',$sid)->get();
            $count = $stx->count();
        ?>

        @if ($mode == 'Delete')
            @if ($count < '1')
                <button type="submit" id="submit" class="btn btn-primary">DELETE (permanent!)</button>
            @else
                <span class="msg">Cannot delete a salesperson that has been used in a sales transaction!</span>
            @endif
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
