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
    <h1>Sales Transaction Maintenance</h1>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    ?>

    <br>
    <a class="button" href="{{ URL::to('/salestransactionedit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New Sale</a>
    <a class="button" href=""><i class="fa fa-filter"></i>&nbsp;Filter Sales</a>
    <br>
</div>
<div class="tablelist">
    <br>
    <table class="masterlist">
        <tr>

            <th><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'transaction_date']) }}">Sale Date</a></th>
            <th>
            <a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'product_name']) }}">Product Name /</a>
            <br>
            <a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'product_id']) }}">Product ID</a>
            </th>
            <th><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'salesperson_name']) }}">Salesperson /<br> Employee ID</a></th>
            <th>Qty</th>
            <th>Price/<br>Discount</th>
            <th><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'total']) }}">Sale Total $</a></th>
            <th>Actions</th>
        </tr>
        @foreach ($salestransactions as $salestransaction)
            <tr>
                <td>{{ $salestransaction->transaction_date }}</td>
                <td>{{ $salestransaction->product->product_name}}<br>({{ $salestransaction->product->product_id}})</td>
                <td>{{ $salestransaction->salesperson->last_name . ', ' . $salestransaction->salesperson->first_name}}<br>({{$salestransaction->salesperson->employee_id}})</td>
                <td class="rj">{{ number_format($salestransaction->quantity,0,'.',',') }}</td>
                <td class="rj">{{ $salestransaction->product->price}}<br>({{ $salestransaction->discount }}%) </td>

                <?php

                    $tot = $salestransaction->quantity * $salestransaction->product->price;
                    $tot = $tot * ((100 - $salestransaction->discount) / 100);
                    $tot = number_format($tot,2,'.',',');
                ?>
                <td class="rj">{{ $tot }}</td>
                <td>&nbsp;&nbsp;
                    <a href="{{ URL::to('/salestransactionedit') }}/{{ $salestransaction->id}}/Edit"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                    <br>
                    <a href="{{ URL::to('/salestransactionedit') }}/{{ $salestransaction->id}}/Delete"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
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
