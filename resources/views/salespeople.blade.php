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
<div class="tablecap">
    <h1>Salespeople Maintenance</h1>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    ?>

    <br>
    <a class="button" href="{{ URL::to('/salespersonedit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New Salesperson</a>
    <a class="button" href=""><i class="fa fa-filter"></i>&nbsp;Filter Salespeople</a>
    <br>
</div>
<div class="tablelist">
    <br>
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


@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
