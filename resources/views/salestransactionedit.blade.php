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

<?php
    if (count($errors) > 0 && $mode == 'Add') {
        $date = Input::old('transactionDate');
        $product = Input::old('product');
        $salesperson = Input::old('salesperson');
        $discount = Input::old('discount');
        $quantity = Input::old('quantity');
        $comments = Input::old('comments');

    } else {
        $date = $salestransaction->transaction_date;
        $product = $salestransaction->product_id;
        $salesperson = $salestransaction->salesperson_id;
        $discount = $salestransaction->discount;
        $quantity = $salestransaction->quantity;
        $comments = $salestransaction->comments;
    }
?>


<script>
    $(document).ready(function(){
        setSalesDropDowns('product',{{ $product }});
        setSalesDropDowns('salesperson',{{ $salesperson }});
        updateDiscount();
    });
</script>


@stop

@section('content')

<form method="POST" action="{{URL::to('/salestransactionedit')}}/{{$txid}}/{{$mode}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <fieldset>
    <div class='pwform'>
        <p class="legend">
            @if ($mode == 'Add')
                Enter New Sale
            @elseif ($mode == 'Delete')
                Delete Sale
            @else
                Edit Sale Information
            @endif

        </p>
        @inject('errorDisplay', '\App\Http\Controllers\SalestransactioneditController')
        <div class="field">
            <label for='transactionDate'>Transaction Date:</label>
            <input type="date" id="transactionDate" name="transactionDate" placeholder="Date" size="15" maxlength="15" value="{{ $date }}" {{ $mode == 'Delete' ? 'readonly':''}} autofocus>
            <?php $errorDisplay->showError($errors,'transactionDate'); ?>
        </div>
        <div class="field">
            <label for='product'>Product:</label>
            {{-- first load the product list --}}
            @if ($mode == 'Add')
                <?php $productlist = \App\Product::orderBy('product_name')->where('active','=','1')->get(); ?>
            @else
                <?php $productlist = \App\Product::orderBy('product_name')->get(); ?>
            @endif
            {{-- loop through the product list and add to the dropdown --}}
            <select id="product" name="product" onchange="updateDiscount()">
                <option value="" disc="0">Select a Product</option>
                @foreach ($productlist as $product)
                    <option value="{{ $product->id }}" disc="{{ $product->max_discount }}">{{ $product->product_name }} ({{ $product->product_id }})</option>
                @endforeach
            </select>
            <?php $errorDisplay->showError($errors,'product'); ?>

        </div>
        <div class="field">
            <label for='salesperson'>Salesperson:</label>
            {{-- first load the salesperson list --}}
            <?php $salespersonlist = \App\Salesperson::orderBy('last_name')->orderBy('first_name')->orderBy('employee_id')->get(); ?>
            {{-- loop through the salesperson list and add to the dropdown --}}
            <select id="salesperson" name="salesperson" onchange="updateMaxDate()">
                <option value="" selected>Select a Salesperson</option>
                @foreach ($salespersonlist as $salesperson)
                    <?php
                        if (is_null($salesperson->termination_date) || ($salesperson->termination_date == '')) {
                        $tdate = '2099=12=31';
                            } else {
                                $tdate = $salesperson->termination_date;
                            }
                    ?>
                    <option value="{{ $salesperson->id }}" tdate="{{ $tdate }}">{{ $salesperson->last_name }}, {{ $salesperson->first_name }} ({{ $salesperson->employee_id }})</option>
                @endforeach
            </select>
            <?php $errorDisplay->showError($errors,'salesperson'); ?>
        </div>

        <div class="field">
            <label for='quantity'>Quantity:</label>
            <input type="number" id="quantity" name="quantity" placeholder="Qty" size="9" maxlength="9" step="1" value="{{ $quantity }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            <?php $errorDisplay->showError($errors,'quantity'); ?>
        </div>
        <div class="field">
            <label for='discount'>Discount:</label>
            <input type="number" id="discount" name="discount" placeholder="Discount" size="2" maxlength="2" setp="1" min="0" max="30" value="{{ $discount }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;
            <span class="discount"></span>
            <?php $errorDisplay->showError($errors,'discount'); ?>
        </div>
        <div class="field">
            <label for='comments'>Comments:</label>
            <textarea rows="5" cols="60" class="comments" id="comments" name="comments" placeholder="Comments" size="50" maxlength="255" value="{{ $salestransaction->comments }}" {{ $mode == 'Delete' ? 'readonly':''}}>{{ $comments }}</textarea>
        </div>
        <br>


        <br><br><label for="submit">&nbsp;</label>
        <a class="formbutton" title="Back" alt="Back" href="{{URL::to('/salestransactions')}}">Cancel</a>
        <button type="submit" id="submit" class="btn btn-primary">
            @if ($mode == 'Delete')
                DELETE (permanent!)
            @else
                Save
            @endif
        </button>
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
