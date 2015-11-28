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
</head>
<body>
  <div class="container-fluid">

    <div class="transbox">
        <table>
            <tr>
                <td class="hdr-left">Created By: {{ Auth::check() ? Auth::user()->first_name : '' }}</td>
      		    <td class="hdr-center"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;&nbsp;Joe's Sales Tracker&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-money"></i></td>
                <td class="hdr-right">{{ Carbon\Carbon::now()->toDateTimeString() }}</td>
            </tr>
        </table>
    </div>

    <div class="row">

        {{-- Main page content will be yielded here --}}
          @yield('content')
    </div>
</div>

     {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
     @yield('body')

</body>
</html>
