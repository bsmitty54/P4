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

            <th width="10%"><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'transaction_date']) }}">Sale Date</a></th>
            <th width="25%">
            <a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'product_name']) }}">Product Name /</a>
            <br>
            <a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'product_id']) }}">Product ID</a>
            </th>
            <th width="25%"><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'salesperson_name']) }}">Salesperson /<br> Employee ID</a></th>
            <th width="10%">Qty</th>
            <th width="10%">Price/<br>Discount</th>
            <th width="10%"><a href="{{ action("SalesTransactionController@sortSalestransactions",['column' => 'total']) }}">Sale Total $</a></th>
            <th width="10%">Actions</th>
        </tr>

    </table>
</div>
<div class="tablelist">
    <table class="masterlist">
    </tbody>
        @foreach ($salestransactions as $salestransaction)
            <tr>
                <td width="10%">{{ $salestransaction->transaction_date }}</td>
                <td width="25%">{{ $salestransaction->product->product_name}}<br>({{ $salestransaction->product->product_id}})</td>
                <td width="25%">{{ $salestransaction->salesperson->last_name . ', ' . $salestransaction->salesperson->first_name}}<br>({{$salestransaction->salesperson->employee_id}})</td>
                <td width="10%" class="rj">{{ number_format($salestransaction->quantity,0,'.',',') }}</td>
                <td width="10%" class="rj">{{ $salestransaction->product->price}}<br>({{ $salestransaction->discount }}%) </td>

                <?php

                    $tot = $salestransaction->quantity * $salestransaction->product->price;
                    $tot = $tot * ((100 - $salestransaction->discount) / 100);
                    $tot = number_format($tot,2,'.',',');
                ?>
                <td width="10%" class="rj">{{ $tot }}</td>
                <td width="10%" class="actions">&nbsp;&nbsp;
                    <a href="{{ URL::to('/salestransactionedit') }}/{{ $salestransaction->id}}/Edit"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Edit"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::to('/salestransactionedit') }}/{{ $salestransaction->id}}/Delete"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
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
