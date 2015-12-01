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
<div class="tablecap">
    <h2>Salespeople Maintenance</h2>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    ?>

    <a class="button" href="{{ URL::to('/salespersonedit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New Salesperson</a>
    <a class="button" onclick="showfilters()" href="#"><i class="fa fa-filter"></i>&nbsp;Filter Salespeople</a>

</div>

<?php
  $salesperson = Request::input('salesperson', '');
  $city = Request::input('city', '');
  $state = Request::input('state', '');
  $active = Request::input('active', '2');
?>

<div class="filters">
    <br><br>
    <hr class="homepage">
    <form method="post" class="filterform" action="{{ url('/salespeople')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="field">
            <label for='salesperson'>Match Emp ID/ Name /Email On:</label>
            <input type="text" id="salesperson" name="salesperson" placeholder="Employee ID/Name" size="30" maxlength="30" value="{{ $salesperson }}" }} autofocus>
        </div>
        <div class="field">
            <label for='city'>Match City On:</label>
            <input type="text" id="city" name="city" placeholder="City" size="20" maxlength="20" value="{{ $city }}" }}>
        </div>
        <div class="field">
            <label for='state'>Match State On:</label>
            <input type="text" id="state" name="state" placeholder="State" size="5" maxlength="2" value="{{ $state }}" }}>
        </div>
        <br>
        <label>Active:</label>
        <input type="radio" name="active" id="Yes" value="1" {{ $active == '1' ? 'checked' : ''}} required> Yes
        <input type="radio" name="active" id="No" value="0" {{ $active == '0' ? 'checked' : ''}} required> No
        <input type="radio" name="active" id="Both" value="2" {{ $active == '2' ? 'checked' : ''}} required> Both
        <br><br>
        <label>&nbsp</label>
        <a class="formbutton" onclick="hidefilters()" title="Back" alt="Back" href="#">Cancel</a>
        <button onclick="hidefilters()" type="submit" id="submit" class="btn btn-primary showfilter">Apply</button>
    </form>
    <hr class="homepage">
</div>


<div class="tablelist">

    <table class="masterlist">
        <tr>

            <th width="15%"><a href="{{ action("SalespersonController@sortSalespeople",['column' => 'employee_id']) }}">Emp ID#</a></th>
            <th width="25%"><a href="{{ action("SalespersonController@sortSalespeople",['column' => 'last_name']) }}">Name</a></th>
            <th width="25%"><a href="{{ action("SalespersonController@sortSalespeople",['column' => 'city']) }}">Address</a></th>
            <th width="15%">Email</th>
            <th width="10%">Active</th>
            <th width="10%">Actions</th>
        </tr>
    </table>
</div>
<div class="tablelist">
    <table class="masterlist">
        @foreach ($salespeople as $salesperson)
            <tr>
                <td width="15%">{{ $salesperson->employee_id }}</td>
                <td width="25%">{{ $salesperson->last_name }},{{ $salesperson->first_name }}</td>
                <td width="25%">
                    {{ $salesperson->street1 }}<br>
                    {{ $salesperson->city }},{{ $salesperson->state }}&nbsp;{{ $salesperson->zip_code }}
                </td>

                <td width="15%">{{ $salesperson->email }}</td>
                <td width="10%">
                    @if (is_null($salesperson->termination_date) || ($salesperson->termination_date == '') ||($salesperson->termination_date == '0000-00-00'))
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td width="10%" class="actions">&nbsp;&nbsp;
                    <a href="{{ URL::to('/salespersonedit') }}/{{ $salesperson->id}}/Edit"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Edit"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::to('/salespersonedit') }}/{{ $salesperson->id}}/Delete"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="record-count"><span>{{ count($salespeople) }}&nbsp;Records Displayed</span></div>

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
