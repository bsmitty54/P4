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
@if ($mode == 'Edit' || $mode == 'Delete')
    <script>
        $(document).ready(function(){
            setSalesDropDowns('product',{{ $salestransaction->product_id }});
            setSalesDropDowns('salesperson',{{ $salestransaction->salesperson_id }});
            updateDiscount();
        });
    </script>
@endif

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
        <div class="field">
            <label for='transactionDate'>Transaction Date:</label>
            <input type="date" id="transactionDate" name="transactionDate" placeholder="Date" size="15" maxlength="15" value="{{ $salestransaction->transaction_date }}" required {{ $mode == 'Delete' ? 'readonly':''}}>
        </div>
        <div class="field">
            <label for='product'>Product:</label>
            {{-- first load the product list --}}
            <?php $productlist = \App\Product::orderBy('product_name')->get(); ?>
            {{-- loop through the product list and add to the dropdown --}}
            <select id="product" name="product" required onchange="updateDiscount()">
                <option value="" disc="0">Select a Product</option>
                @foreach ($productlist as $product)
                    <option value="{{ $product->id }}" disc="{{ $product->max_discount }}">{{ $product->product_name }} ({{ $product->product_id }})</option>
                @endforeach
            </select>

        </div>
        <div class="field">
            <label for='salesperson'>Salesperson:</label>
            {{-- first load the salesperson list --}}
            <?php $salespersonlist = \App\Salesperson::orderBy('last_name')->orderBy('first_name')->orderBy('employee_id')->get(); ?>
            {{-- loop through the salesperson list and add to the dropdown --}}
            <select id="salesperson" name="salesperson" required>
                <option value="" selected>Select a Salesperson</option>
                @foreach ($salespersonlist as $salesperson)
                    <option value="{{ $salesperson->id }}">{{ $salesperson->last_name }}, {{ $salesperson->first_name }} ({{ $product->product_id }})</option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for='quantity'>Quantity:</label>
            <input type="number" id="quantity" name="quantity" placeholder="Qty" size="9" maxlength="9" step="1" value="{{ $salestransaction->quantity }}" {{ $mode == 'Delete' ? 'readonly':''}} min="1" required>
        </div>
        <div class="field">
            <label for='discount'>Discount:</label>
            <input type="number" id="discount" name="discount" placeholder="Discount" size="2" maxlength="2" setp="1" min="0" max="30" required value="{{ $salestransaction->discount }}" {{ $mode == 'Delete' ? 'readonly':''}}>
            &nbsp;
            <span class="discount"></span>
        </div>
        <div class="field">
            <label for='comments'>Comments:</label>
            <input type="text" class="comments" id="comments" name="comments" placeholder="Comments" size="50" maxlength="255" value="{{ $salestransaction->comments }}" {{ $mode == 'Delete' ? 'readonly':''}}>
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
