<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ATTENDANCE EMPLOYEE</title>
        <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">.. EMS  RTDS.. </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../newhomepage">Home</a></li>

      <li><a href="#">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    
    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                        </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
</li>
<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }} <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">View Profile</a></li>
          <li><a href="{{ route('changePassword') }}">Change Password</a></li>
        
        </ul>
      </li>
                                         
        </ul>
      </li>
    </ul>
  </div>
</nav>
      <div class="row">
    <div class="col-md-12">
    <form method="post" action="{{url('attendance')}}">

        <fieldset>
          
          <legend><span class="number">1</span>Enter Attendance Information</legend>
          <label for="shift_date_from">Shift Date From:</label>
          <input type="date" id="shift_date_from" name="shift_date_from" class="form-control{{ $errors->has('shift_date_from') ? ' is-invalid' : '' }}">  
        @if ($errors->has('shift_date_from'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('shift_date_from') }}</strong>
            </span>
        @endif
          <label for="shift_date_to">Shift date to:</label>
          <input type="date" id="shift_date_to" name="shift_date_to" class="form-control{{ $errors->has('shift_date_to') ? ' is-invalid' : '' }}">
        @if ($errors->has('shift_date_to'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('shift_date_to') }}</strong>
            </span>
        @endif
          <label for="location">Location:</label>
          <input type="text" id="location" name="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}">
        @if ($errors->has('location'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif
          <label for="message">Message:</label>
          <textarea id="message" name="message" ></textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}">
        @if ($errors->has('message'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('message') }}</strong>
            </span>
        @endif


          <input type="submit" class="btn btn-info" value="Submit">
                         
                         <input type="reset" class="btn btn-warning" value="Reset">

   
                         <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>                   
          
        </fieldset>