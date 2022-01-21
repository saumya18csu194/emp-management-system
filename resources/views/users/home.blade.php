
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css\styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
     .center{
      display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
     }
     </style>
<body style=" background-color: rgb(178, 211, 178);">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">.. EMS  RTDS.. </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>

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
  </div>
</nav>
<img src="uploads/bg.png" class="center">
<div class="sidenav" style="background-color: black">

  <a href="{{ route('employees.create') }}">Add Employees</a>
  <a href="{{ route('employees.index') }}">View All Employees</a>
  <a href="{{ route('users.create') }}">Add Admins</a>
  <a href="{{ route('users.index') }}">View All Admins</a>
  
</div>




   

</html> 
