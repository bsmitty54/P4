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
    <h1>Salespeople Maintenance</h1>
    <br>
    <span class="button"><a href="">Add New Salesperson</a></span>
    <span class="button"><a href="">Filter Salespeople</a></span>

    <br>
</div>
<div class="tablelist">
    <br>
    <table class="masterlist">
        <tr>

            <th><a href="{{ action("SalespeopleController@getIndex",['sortOrder' => 'Employee ID']) }}">Employee ID</a></th>
            <th><a href="{{ action("SalespeopleController@getIndex",['sortOrder' => 'Name']) }}">Name</a></th>
            <th><a href="{{ action("SalespeopleController@getIndex",['sortOrder' => 'Address']) }}">Address</a></th>
            <th>Email</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        @foreach ($salespeople as $salesperson)
            <tr>
                <td>{{ $salesperson->employee_id }}</td>
                <td>{{ $salesperson->last_name }},{{ $salesperson->first_name }}</td>
                <td>
                    {{ $salesperson->street1 }}<br>
                    {{ $salesperson->city }},{{ $salesperson->state }}&nbsp;{{ $salesperson->zip_code }}
                </td>

                <td>{{ $salesperson->email }}</td>
                <td>
                    @if (is_null($salesperson->termination_date) || ($salesperson->termination_date == '') ||($salesperson->termination_date == '0000-00-00'))
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>&nbsp;&nbsp;
                    <a href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="#"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
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
