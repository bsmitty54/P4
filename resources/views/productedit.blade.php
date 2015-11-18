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

<?php
    if (count($errors) > 0 && $mode == 'Add') {
        $id = Input::old('productID');
        $name = Input::old('productName');
        $price = Input::old('price');
        $discount = Input::old('discount');
        $active = Input::old('active');

    } else {
        $id = $product->product_id;
        $name = $product->product_name;
        $price = $product->price;
        $discount = $product->max_discount;
        $active = $product->active;
    }
?>

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
        @inject('errorDisplay', '\App\Http\Controllers\ProducteditController')
        <div class="field">
            <label for='productID'>Product ID:</label>
            <input type="text" id="productID" name="productID" placeholder="Product ID" size="15" maxlength="15" value="{{ $id }}" {{ $mode == 'Delete' ? 'readonly':''}} autofocus>
            <?php $errorDisplay->showError($errors,'productID'); ?>
        </div>

        <div class="field">
            <label for='productName'>Product Name:</label>
            <input type="text" id="productName" name="productName" placeholder="Product Name" size="50" maxlength="100" value="{{ $name }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'productName'); ?>
        </div>
        <div class="field">
            <label for='price'>Price:</label>
            <input type="number" id="price" name="price" placeholder="Price" size="9" maxlength="9" step="0.01" value="{{ $price }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'price'); ?>
        </div>
        <div class="field">
            <label for='discount'>Max Discount (0-30):</label>
            <input type="number" id="discount" name="discount" placeholder="Max Discount - no greater than 30" size="2" maxlength="2" setp="1" min="0" max="30" value="{{ $discount }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'discount'); ?>
        </div>
        <br>
        <label>Active:</label>
        <input type="radio" name="active" id="Yes" value="1" {{ $active == '1' ? 'checked' : ''}} {{ $mode == 'Delete' ? 'disabled':''}}> Yes
        <input type="radio" name="active" id="No" value="0" {{ $active == '0' ? 'checked' : ''}} {{ $mode == 'Delete' ? 'disabled':''}}> No
        <?php $errorDisplay->showError($errors,'active'); ?>



        <br><br><label for="submit">&nbsp;</label>
        <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/products')}}">Cancel</a>
        <?php
            $stx = \App\Sales_transaction::where('product_id','=',$pid)->get();
            $count = $stx->count();
        ?>

        @if ($mode == 'Delete')
            @if ($count < '1')
                <button type="submit" id="submit" class="btn btn-primary">DELETE (permanent!)</button>
            @else
                <span class="msg">Cannot delete a product that has been used in a sales transaction!</span>
            @endif
        @else
            <button type="submit" id="submit" class="btn btn-primary">Save</button>
        @endif

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
