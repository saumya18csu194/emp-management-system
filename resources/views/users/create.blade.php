<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
</head>
<body style= "background-color: rgb(178, 211, 178);">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">.. EMS  RTDS.. </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../../newhomepage">Home</a></li>

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
<form method="post" action="{{url('users')}}">
    
                            <div class="form-group">

                            <legend><span class="number">1</span>Enter Basic Information</legend>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter Full Name">
      
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Valid Email Address">
                            <input type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-warning" value="Reset">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
</body>
</html>