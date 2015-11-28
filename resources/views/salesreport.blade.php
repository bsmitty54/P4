@extends('layouts.reportmaster')

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
<?php
    $salestransactions = Session::get('salestransactions');
 ?>
<div class="tablecap">
    <h2>Sales Report</h2>
</div>

<div class="reporttable">

    <table class="reportlist">

        <tr>

            <th width="10%">Sale Date</a></th>
            <th width="25%">Product Name / <br>Product ID</th>
            <th width="25%">Salesperson / <br>Employee ID</th>
            <th width="10%">Qty</th>
            <th width="10%">Price/<br>Discount</th>
            <th width="10%">Sale Total $</th>

        </tr>

    </table>
</div>
<div class="reporttable">
    <table class="reportlist">
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
            </tr>
        @endforeach
    </tbody>
    </table>
</div>

<div class="record-count"><span>{{ count($salestransactions) }}&nbsp;Records Printed</span></div>

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
