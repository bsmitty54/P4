@extends('layouts.master')

@section('title')
    <i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;&nbsp;Joe's Sales Tracker&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-money"></i>
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')

@stop

@section('content')
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
        <div class="field">
            <label for='employeeID'>Employee ID:</label>
            <input type="text" id="employeeID" name="employeeID" placeholder="Employee ID" size="15" maxlength="15" value="{{ $salesperson->employee_id }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='lastName'>Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" size="30" maxlength="30" value="{{ $salesperson->last_name }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='firstName'>First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" size="20" maxlength="20" value="{{ $salesperson->first_name }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='street1'>Street Address 1:</label>
            <input type="text" id="street1" name="street1" placeholder="Street Address Line 1" size="30" maxlength="30" value="{{ $salesperson->street1 }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='street2'>Street Address 2:</label>
            <input type="text" id="street2" name="street2" placeholder="Street Address Line 2" size="30" maxlength="30" value="{{ $salesperson->street2 }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='city'>City:</label>
            <input type="text" id="city" name="city" placeholder="City" size="20" maxlength="20" value="{{ $salesperson->city }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">State:</label>&nbsp
            <input type="text" id="state" name="state" placeholder="ST" size="4" maxlength="22" value="{{ $salesperson->state }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">ZIP:</label>&nbsp
            <input type="text" id="zipCode" name="zipCode" placeholder="Zipcode" size="9" maxlength="9" value="{{ $salesperson->zip_code }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='email'>Email address:</label>
            <input type="email" id="email" name="email" placeholder="Email address" size="30" maxlength="30" value="{{ $salesperson->email }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='hireDate'>Hire Date:</label>
            <input type="date" id="hireDate" name="hireDate" placeholder="Hire date" value="{{ $salesperson->hire_date }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;&nbsp;<label class="secondary">Termination Date:</label>&nbsp
            <input type="date" id="terminationDate" name="terminationDate" placeholder="Term date" value="{{ $salesperson->termination_date }}" {{ $mode == 'Delete' ? 'readonly':''}}>
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
