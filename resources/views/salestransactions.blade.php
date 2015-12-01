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
    <h2>Sales Transaction Maintenance</h2>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    if (Session::has('show100')) {
        echo '<span class="msg">';
        echo Session::get('show100');
        echo '</span>';
        echo '<br>';
    }

    ?>


    <a class="button" href="{{ URL::to('/salestransactionedit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New Sale</a>
    <a class="button showfilter" onclick="showfilters()" href="#"><i class="fa fa-filter"></i>&nbsp;Filter Sales</a>
    <a class="button" href="{{ URL::to('/salesreport') }}" target="_blank"><i class="fa fa-print"></i>&nbsp;Printable Version</a>
</div>

<?php
    $fromDate = Request::input('fromDate', '');
    $thruDate = Request::input('thruDate', '');
    $cat = Request::input('cat', '0');
    $product = Request::input('product', '0');
    $salesperson = Request::input('salesperson', '0');

 ?>

 <script>
    $(document).ready(function(){
        setSalesDropDowns('cat',{{ $cat }});
        setSalesDropDowns('product',{{ $product }});
        setSalesDropDowns('salesperson',{{ $salesperson }});
    });
</script>

<div class="filters">
    <br><br>
    <hr class="homepage">
    <form method="post" class="filterform" action="{{ url('/salestransactions')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="field">
            <label for='fromDate'>From Date:</label>
            <input type="date" id="fromDate" name="fromDate" placeholder="From Date" value="{{ $fromDate }}" }} autofocus>
        </div>
        <div class="field">
            <label for='thruDate'>Thru Date:</label>
            <input type="date" id="thruDate" name="thruDate" placeholder="Thru Date" value="{{ $thruDate }}" }}>
        </div>
        <div class="field">
            <label for='cat'>Category:</label>
            {{-- first load the category list --}}
            <?php $categorylist = \App\Category::orderBy('category_name')->get(); ?>
            {{-- loop through the category list and add to the dropdown --}}
            <select id="cat" name="cat">
                <option value="0">Select a Category</option>
                @foreach ($categorylist as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label for='product'>Product:</label>
            {{-- first load the product list --}}
            <?php $productlist = \App\Product::orderBy('product_name')->get(); ?>
            {{-- loop through the product list and add to the dropdown --}}
            <select id="product" name="product">
                <option value="0">Select a Product</option>
                @foreach ($productlist as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label for='salesperson'>Salesperson:</label>
            {{-- first load the salesperson list --}}
            <?php $salespersonlist = \App\Salesperson::orderBy('last_name')->orderBy('first_name')->get(); ?>
            {{-- loop through the salesperson list and add to the dropdown --}}
            <select id="salesperson" name="salesperson">
                <option value="0">Select a Salesperson</option>
                @foreach ($salespersonlist as $salesperson)
                    <option value="{{ $salesperson->id }}">{{ $salesperson->last_name }}, {{ $salesperson->first_name }} ({{ $salesperson->employee_id }})</option>
                @endforeach
            </select>
        </div>

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

<div class="record-count"><span>{{ count($salestransactions) }}&nbsp;Records Displayed</span></div>

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
