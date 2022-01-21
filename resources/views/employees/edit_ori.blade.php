<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">.. EMS  RTDS.. </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>

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
<form method="Post" action="{{route('employees.update',$emp->id)}}">  
<input name="_method" type="hidden" value="PATCH">
<div class="form-group">
    <label>Full Name</label>
    <input name="full_name" type="text" class="form-control"  placeholder="Enter Full Name" value={{$emp->full_name}}>
</div>

<div class="form-group">
    <label>Email</label>
    <input name="email" type="text" class="form-control"  placeholder="Enter email" value={{$emp->email}}>
</div>

<div class="form-group">
    <label>Age</label>
    <input name="age" type="number" class="form-control"  placeholder="Enter age" value={{$emp->age}}>
</div>
<div class="form-group">
<br>
<select name="gender" id="gender">
    <option value="" disabled="disabled" selected="selected">Please select gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select>
</div>
<div class="form-group">
<label>Phone number</label>
<input name="phone_number" type="number" class="form-control"  placeholder="Enter phone number" value={{$emp->phone_number}}>
</div>
<div class="form-group">
<label>Address</label>
<input name="address" type="text" class="form-control"  placeholder="Enter Address"value={{$emp->address}}>
</div>
<div class="form-group">
<label>Birth Date</label>
    <input name="birth_date" type="date" class="form-control" value={{$emp->birth_date}}  >
</div>
<div class="form-group">
<label>Joining Date</label>
    <input name="joining_date" type="date" class="form-control" value={{$emp->joining_date}} >
</div>
<button type="submit" class="btn-btn" >Update</button>  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
