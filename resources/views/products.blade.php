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
    <h1>Product Maintenance</h1>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    ?>

    <br>
    <a class="button" href="{{ URL::to('/productedit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New Product</a>
    <a class="button showfilter" onclick="showfilters()" href="#"><i class="fa fa-filter"></i>&nbsp;Filter Products List</a>
    <br>
</div>

<?php
  $product = Request::input('product', '');
  $active = Request::input('active', '2');
?>

<div class="filters">
    <br>
    <hr class="homepage">
    <form method="post" class="filterform" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="field">
            <label for='product'>Match Product ID or Name On:</label>
            <input type="text" id="product" name="product" placeholder="Product ID/Name" size="30" maxlength="30" value="{{ $product }}" }} autofocus>
        </div>
        <br>
        <label>Active:</label>
        <input type="radio" name="active" id="Yes" value="1" {{ $active == '1' ? 'checked' : ''}} required> Yes
        <input type="radio" name="active" id="No" value="0" {{ $active == '0' ? 'checked' : ''}} required> No
        <input type="radio" name="active" id="Both" value="2" {{ $active == '2' ? 'checked' : ''}} required> Both
        <br><br>
        <label>&nbsp</label>
        <a class="formbutton" onclick="hidefilters()" title="Back" alt="Back" href="">Cancel</a>
        <button onclick="hidefilters()" type="submit" id="submit" class="btn btn-primary showfilter">Apply</button>
    </form>
    <hr class="homepage">
</div>

<div class="tablelist">
    <br>
    <table class="masterlist">
        <tr>
            <th width="25%"><a href="{{ action("ProductController@sortProducts",['column' => 'product_id']) }}">Product ID</a></th>
            <th width="35%"><a href="{{ action("ProductController@sortProducts",['column' => 'product_name']) }}">Product Name</a></th>
            <th width="12%"><a href="{{ action("ProductController@sortProducts",['column' => 'price']) }}">Price</a></th>
            <th width="9%"><a href="{{ action("ProductController@sortProducts",['column' => 'max_discount']) }}">Discount</a></th>
            <th width="9%">Active</th>
            <th width="10%">Actions</th>
        </tr>
    </table>
</div>
<div class="tablelist">
    <table class="masterlist">
        @foreach ($products as $product)
            <tr>
                <td width="25%">{{ $product->product_id }}</td>
                <td width="35%">{{ $product->product_name }}</td>
                <td width="12%">{{ $product->price }}</td>
                <td width="9%" width="10%">{{ $product->max_discount }}</td>
                <td width="9%">
                    @if ($product->active == 1)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td width="10%" class="actions">&nbsp;&nbsp;
                    <a href="{{ URL::to('/productedit') }}/{{ $product->id}}/Edit"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Edit"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::to('/productedit') }}/{{ $product->id}}/Delete"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>
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
