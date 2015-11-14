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

<div class="filters">
    <br>
    <hr class="homepage">
    <form method="post" class="filterform" action="#">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a class="formbutton" onclick="hidefilters()" title="Back" alt="Back" href="">Cancel</a>
        <button onclick="hidefilters()" type="submit" id="submit" class="btn btn-primary showfilter">Apply</button>
    </form>
    <hr class="homepage">
</div>

<div class="tablelist">
    <br>
    <table class="masterlist">
        <tr>
            <th><a href="{{ action("ProductController@sortProducts",['column' => 'product_id']) }}">Product ID</a></th>
            <th><a href="{{ action("ProductController@sortProducts",['column' => 'product_name']) }}">Product Name</a></th>
            <th><a href="{{ action("ProductController@sortProducts",['column' => 'price']) }}">Price</a></th>
            <th><a href="{{ action("ProductController@sortProducts",['column' => 'max_discount']) }}">Discount</a></th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->max_discount }}</td>
                <td>
                    @if ($product->active == 1)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>&nbsp;&nbsp;
                    <a href="{{ URL::to('/productedit') }}/{{ $product->id}}/Edit"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::to('/productedit') }}/{{ $product->id}}/Delete"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
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
