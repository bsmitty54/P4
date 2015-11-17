<!doctype html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'Joes Sales Tracker' --}}
        @yield('title','Joes Sales Tracker')
    </title>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link href="/css/jmscss.css" type='text/css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jss.js"></script>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
</head>
<body>
  <div id="wrapper" class="container-fluid">

    <div id="header" class="row">
      <div id="topHeader" class="">

      	<div class="transbox">
      		<i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;&nbsp;Joe's Sales Tracker&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-money"></i>
        </div>

      </div>
    </div>
    <div id="maincontent" class="row">

        <div id="leftgutter" class="col-sm-2">
          <h2>Menu</h2>
            <ul class="nav nav-stacked">

              <li><a class="" href="http://p1.jsmitty54php.com"><i class="fa fa-picture-o"></i>&nbsp;Back to Portfolio Page</a></li>
              <li><a class="" href="{{URL::to('/')}}"><i class="fa fa-home"></i>&nbsp;Home</a></li>
              <li><a class="" href="{{ action("SalesTransactionController@getIndex") }}"><i class="fa fa-dollar"></i>&nbsp;Maintain Sales Transactions</a></li>
              <li><a class="" href="{{ action("ProductController@getIndex") }}"><i class="fa fa-tags"></i>&nbsp;Maintain Product Catalog</a></li>
              <li><a class="" href="{{ action("SalespersonController@getIndex") }}"><i class="fa fa-user"></i>&nbsp;Maintain Sales People</a></li>

            </ul>
        </div>


        <div id="center" class="col-sm-10">

          {{-- Main page content will be yielded here --}}
          @yield('content')
        </div>

      </div>

      <div id="footer" class="row">
        Dynamic Web Applications&nbsp;*&nbsp;Fall 2015&nbsp;*&nbsp;Instructor: Susan Buck&nbsp;*&nbsp;Author / Student: Joe Smith
      </div>




    </div>
  {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
  @yield('body')

</body>
</html>
