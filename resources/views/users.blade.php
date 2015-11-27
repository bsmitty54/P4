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
    <h2>User Maintenance</h2>

    <?php
    if (Session::has('message')) {
        echo '<span class="msg">';
        echo Session::get('message');
        echo '</span>';
        echo '<br>';
    }
    ?>

    <a class="button" href="{{ URL::to('/useredit/New/Add') }}"><i class="fa fa-plus"></i>&nbsp;Add New User</a>
    <a class="button showfilter" onclick="showfilters()" href="#"><i class="fa fa-filter"></i>&nbsp;Filter Users</a>

</div>

<?php
  $user = Request::input('user', '');
  $role = Request::input('role', '');
 ?>

 <script>
     $(document).ready(function(){
         setSalesDropDowns('role','{{ $role }}');
     });
 </script>

 <div class="filters">
     <br>
     <hr class="homepage">
     <form method="post" class="filterform" action="{{ url('/users')}}">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="field">
             <label for='product'>Match User Name or Email On:</label>
             <input type="text" id="user" name="user" placeholder="User Name / Email" size="30" maxlength="30" value="{{ $user }}" }} autofocus>
         </div>
         <div class="field">
             <label for='role'>Role:</label>
             <select id="role" name="role">
                 <option value="">Select a Role</option>
                 <option value="End User">End User</option>
                 <option value="Administrator">Administrator</option>
             </select>
         </div>
         <br><br>
         <label>&nbsp</label>
         <a class="formbutton" onclick="hidefilters()" title="Back" alt="Back" href="#">Cancel</a>
         <button onclick="hidefilters()" type="submit" id="submit" class="btn btn-primary showfilter">Apply</button>
     </form>
     <hr class="homepage">
 </div>

<div class="tablelist">

    <table class="masterlist">
        <tr>

            <th width="30%"><a href="{{ action("UserController@sortUsers",['column' => 'last_name']) }}">User Name</a></th>
            <th width="30%">Email</a></th>
            <th width="30%"><a href="{{ action("UserController@sortUsers",['column' => 'role']) }}">Role</a></th>
            <th width="10%">Actions</th>
        </tr>
    </table>
</div>
<div class="tablelist">
    <table class="masterlist">
        @foreach ($users as $user)
            <tr>
                <td width="30%">{{ $user->last_name }}, {{ $user->first_name }}</td>
                <td width="30%">{{ $user->email }}</td>
                <td width="30%">{{ $user->role }}</td>

                <td width="10%" class="actions">&nbsp;&nbsp;
                    <a href="{{ URL::to('/useredit') }}/{{ $user->id}}/Edit"><i class="fa fa-pencil-square-o" data-toggle="tooltip" title="Edit"></i></a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ URL::to('/useredit') }}/{{ $user->id}}/Delete"><i class="fa fa-trash-o" data-toggle="tooltip" title="Delete"></i></a>
                </td>
            </tr>
        @endforeach
    </table>

</div>

<div class="record-count"><span>{{ count($users) }}&nbsp;Records Displayed</span></div>


@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
