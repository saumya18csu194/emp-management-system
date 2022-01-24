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
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Shift Date From</th>
        <th>Shift Date To</th>
        <th>Location</th>
        <th>Message</th>
    </thead>
    <tbody>
  
      @foreach($result as $emp)
     
      <tr>
        <td>{{$emp->emp_id}}</td>
        <td>{{$emp->shift_date_from}}</td>
        <td>{{$emp->shift_date_to}}</td>
        <td>{{$emp->location}}</td>
        <td>{{$emp->message}}</td>
        
        <td>
        <form class="row" method="POST" action="{{ url('attendance')}}">
                        
                        <a href="{{ route('attendance.edit', ['attendance_id' => $emp->attendance_id]) }}" class="btn btn-info">
                        Approve Attendance Request
                        </a>
                         <button type="submit" class='btn btn-info'>
                          Delete Attendance Request
                        </button>
                    </form>
                  </td>
                </a>
            </td>
            
            </form>
      </tr>
      @endforeach
    </tbody>
  </table>

     
     
     

