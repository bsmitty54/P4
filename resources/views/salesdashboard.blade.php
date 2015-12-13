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
    <h2>Sales Dashboard</h2>
</div>
@if($query != '')
    <a class="button showfilter" onclick="showfilters()" href="#"><i class="fa fa-filter"></i>&nbsp;Enter Graph Parameters</a>
@else
    <script>
        $(document).ready(function(){
            showfilters();
        });
    </script>
@endif



<div class="filters">
    <br><br>
    <hr class="homepage">
    <form method="post" class="filterform" action="{{ url('/dashboard')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <br>
        <label>Group By:</label>
        <input type="radio" name="grouping" id="Product" value="Product" {{ $grouping == 'Product' ? 'checked' : ''}} required> Product
        <input type="radio" name="grouping" id="Category" value="Category" {{ $grouping == 'Category' ? 'checked' : ''}} required> Category
        <input type="radio" name="grouping" id="Salesperson" value="Salesperson" {{ $grouping == 'Salesperson' ? 'checked' : ''}} required> Salesperson
        <br><br>
        <label>Time Period:</label>
        <input type="radio" name="period" id="Month-to-Date" value="Month To Date" {{ $period == 'Month To Date' ? 'checked' : ''}} required> Month-to-Date
        <input type="radio" name="period" id="Year-to-Date" value="Year To Date" {{ $period == 'Year To Date' ? 'checked' : ''}} required> Year-to-Date
        <input type="radio" name="period" id="Last 30 days" value="Last 30 Days" {{ $period == 'Last 30 Days' ? 'checked' : ''}} required> Last 30 Days
        <br><br>
        <label>Chart Type:</label>
        <input type="radio" name="chart" id="pie" value="pie" {{ $chart == 'pie' ? 'checked' : ''}} required> Pie Chart
        <input type="radio" name="chart" id="bar" value="bar" {{ $chart == 'bar' ? 'checked' : ''}} required> Bar Chart
        <input type="radio" name="chart" id="column" value="column" {{ $chart == 'column' ? 'checked' : ''}} required> Column Chart
        <input type="radio" name="chart" id="line" value="line" {{ $chart == 'line' ? 'checked' : ''}} required> Line Chart
        <br><br>
        <label>Select Which Stat to Show:</label>
        <input type="radio" name="stat" id="Quantity" value="Quantity" {{ $stat == 'Quantity' ? 'checked' : ''}} required> Quantity Sold
        <input type="radio" name="stat" id="Dollars" value="Dollars" {{ $stat == 'Dollars' ? 'checked' : ''}} required> Dollars
        <br><br>
        <label>&nbsp</label>
        @if ($query != '')
            <a class="formbutton" onclick="hidefilters()" title="Back" alt="Back" href="#">Cancel</a>
        @endif
        <button onclick="hidefilters()" type="submit" id="submit" class="btn btn-primary showfilter">Apply</button>
    </form>
    <hr class="homepage">
</div>

<!--
<div>
Query: {{$query}}
</div>
-->

<div id="container" style="width:100%; height:400px;"></div>

@if ($query != '')
    <script>

    $(function () {
        $('#container').highcharts({
            chart: {
                type: '{{ $chart }}'
            },
            <?php $title = $period . " Sales Grouped By " . $grouping; ?>
            title: {
                text: '{{ $title }}'
            },
            xAxis: {
                categories: [
                    @foreach($graphdata as $gd)
                        '{{$gd->Group}}',
                        @endforeach
                    ]
                },
            yAxis: {
                title: {
                    text: 'Sales'
                }
            },
            series:
            @if ($chart == 'pie')
                [{
                    name:'Sales',
                    colorByPoint: true,
                    data:[
                        @foreach($graphdata as $gd)
                        {
                            name:'{{$gd->Group}}',
                            @if ($stat=='Quantity')
                                y:{{$gd->Quantity}}
                            @else
                                y:{{$gd->Dollars}}
                            @endif
                        },
                        @endforeach
                    ]}]
            @else
                [
                    @if ($stat == 'Quantity')
                    {
                        name: 'Quantity Sold',
                        data: [
                            @foreach($graphdata as $gd)
                                {{$gd->Quantity}},
                                @endforeach
                            ]
                        }
                    @else
                    {
                        name: 'Total $$',
                        data: [
                            @foreach($graphdata as $gd)
                                {{$gd->Dollars}},
                                @endforeach
                            ]
                        }
                    @endif
                ]
            @endif
        });
    });
    </script>
@endif


@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
