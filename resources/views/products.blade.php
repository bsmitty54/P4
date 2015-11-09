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
    <br>
    <span class="button"><a href="">Add New Product</a></span>
    <span class="button"><a href="">Filter Product List</a></span>

    <br>
</div>
<div class="tablelist">
    <br>
    <table class="masterlist">
        <tr>
            <th><a href="{{ action("ProductController@getIndex",['sortOrder' => 'Product ID']) }}">Product ID</a></th>
            <th><a href="{{ action("ProductController@getIndex",['sortOrder' => 'Product Name']) }}">Product Name</a></th>
            <th><a href="{{ action("ProductController@getIndex",['sortOrder' => 'Price']) }}">Price</a></th>
            <th><a href="{{ action("ProductController@getIndex",['sortOrder' => 'Max Discount']) }}">Discount</a></th>
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
