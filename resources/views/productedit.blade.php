@extends('layouts.master')

@section('title')
    <i class="fa fa-money"></i>&nbsp;&nbsp;Joe's Sales Tracker&nbsp;&nbsp;<i class="fa fa-money"></i>
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')

@stop

@section('content')
<form method="POST" action="{{URL::to('/productedit')}}/{{$pid}}/{{$mode}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
        <p class="legend">
            @if ($mode == 'Add')
                Enter New Product
            @elseif ($mode == 'Delete')
                Delete Product
            @else
                Edit Product Information
            @endif

        </p>
        <div class="field">
            <label for='productID'>Product ID:</label>
            <input type="text" id="productID" name="productID" placeholder="Product ID" size="15" maxlength="15" value="{{ $product->product_id }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='productName'>Product Name:</label>
            <input type="text" id="productName" name="productName" placeholder="Product Name" size="50" maxlength="100" value="{{ $product->product_name }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='price'>Price:</label>
            <input type="number" id="price" name="price" placeholder="Price" size="9" maxlength="9" step="0.01" value="{{ $product->price }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='discount'>Max Discount (0-30):</label>
            <input type="number" id="discount" name="discount" placeholder="Max Discount - no greater than 30" size="2" maxlength="2" setp="1" min="0" max="30" value="{{ $product->max_discount }}" {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <br>
        <label>Active:</label>
        <input type="radio" name="active" id="Yes" value="1" {{ $product->active == '1' ? 'checked' : ''}} {{ $mode == 'Delete' ? 'disabled':''}} required> Yes
        <input type="radio" name="active" id="No" value="0" {{ $product->active == '0' ? 'checked' : ''}} {{ $mode == 'Delete' ? 'disabled':''}} required> No



        <br><br><label for="submit">&nbsp;</label>
        <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/products/Name')}}">Cancel</a>
        <button type="submit" id="submit" class="btn btn-primary">Save</button>
    </div>

  </fieldset>
</form>


@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
