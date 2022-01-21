<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<form method="Post" action="{{route('employees.update',$emp->id)}}">  
<input name="_method" type="hidden" value="PATCH">
        
        <fieldset>
          
          <legend><span class="number">1</span>Edit Basic Information</legend>
        
          <label for="name">Name:</label>
          <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" value={{$emp->full_name}}>
        
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter Valid Email Address" value={{$emp->email}}>
       
          <label for="age">Age:</label>
          <input type="number" id="age" name="age" placeholder="Enter age" value={{$emp->age}}>
          
          
          <label for="gender">Gender:</label>
          <input type="text" id="gender" name="gender" placeholder="Enter gender" value={{$emp->gender}}>
            
          <label for="phone_number">Phone number:</label>
          <input type="number" id="phone_number" name="phone_number" placeholder="Enter 10 digit mobile number" value={{$emp->phone_number}}>                
                                
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" placeholder="Enter address" value={{$emp->address}}>               
          <label for="birth_date">Birth Date:</label>
          <input type="date" id="birth_date" name="birth_date" placeholder="Enter date of birth" value={{$emp->birth_date}}>        
                   
          
        </fieldset>
        <fieldset>  
        
          <legend><span class="number">2</span>Edit Employment Details</legend>
          
          <label for="joining_date">Joining Date:</label>
          <input type="date" id="joining_date" name="joining_date" placeholder="Enter joining date of employee" value={{$emp->joining_date}}>  
          </fieldset>
<fieldset>
          <legend><span class="number">3</span>Edit Salary Information</legend>
        
        <label for="package">Annual Package:</label>
        <input type="number" id="package" name="package" value={{$salary->package}}>
      
        <label for="rent_allowance">Rent Allowance:</label>
        <input type="number" id="rent_allowance" name="rent_allowance" value={{$salary->rent_allowance}}>
     
        <label for="basic_pay">Basic Pay:</label>
        <input type="number" id="basic_pay" name="basic_pay"  value={{$salary->basic_pay}}>
        
        <label for="variable_salary">Variable Pay:</label>
        <input type="number" id="variable_salary" name="variable_salary" value={{$salary->variable_salary}}>
          
        <label for="gratuity">Gratuity:</label>
        <input type="number" id="gratuity" name="gratuity" value={{$salary->gratuity}}>  
   
<fieldset>
         <legend><span class="number">4</span>Edit Employee's Manager Information</legend>

        <label for="m_id">Manager ID:</label>
        <input type="number" id="m_id" name="m_id" value={{$emp->m_id}}>  
        <div class="form-group">
                            <label for="items">Select new manager</label>
                            <select name="mid" class="form-control" >
                                <option value="">--- Select Manager ---</option>
                                @foreach($items as $user)
	<option value="{{$user->id}}">{{$user->id}} : {{$user->name}}</option>
    @endforeach
                            </select>
                            </div>
</fieldset>
















          <button type="submit" class="btn-btn" >Update</button>  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>