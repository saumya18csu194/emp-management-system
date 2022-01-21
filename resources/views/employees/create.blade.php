<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADD EMPLOYEE</title>
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
    <form method="post" action="{{url('employees')}}">
        
        <fieldset>
          
          <legend><span class="number">1</span>Enter Basic Information</legend>
        
          <label for="name">Name:</label>
          <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name">
        
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter Valid Email Address">
       
          <label for="age">Age:</label>
          <input type="number" id="age" name="age" placeholder="Enter age">
          
          
          <label for="gender">Gender:</label>
          <input type="text" id="gender" name="gender" placeholder="Enter gender">
            
          <label for="phone_number">Phone number:</label>
          <input type="number" id="phone_number" name="phone_number" placeholder="Enter 10 digit mobile number">                  <div class="form-group">
                                
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" placeholder="Enter address">               
          <label for="birth_date">Birth Date:</label>
          <input type="date" id="birth_date" name="birth_date" placeholder="Enter date of birth">        
                   
          
        </fieldset>
        <fieldset>  
        
          <legend><span class="number">2</span>Enter Employment Details</legend>
          
          <label for="joining_date">Joining Date:</label>
          <input type="date" id="joining_date" name="joining_date" placeholder="Enter joining date of employee">  
        
       
        
         <label for="job">Job Role:</label>
          <select id="job" name="user_job">
            <optgroup label="Web">
              <option value="frontend_developer">Front-End Developer</option>
              <option value="php_developer">PHP Developer</option>
              <option value="python_developer">Python Developer</option>
              <option value="rails_developer">Rails Developer</option>
              <option value="web_designer">Web Designer</option>
              <option value="wordpress_developer">Wordpress Developer</option>
            </optgroup>
            <optgroup label="Mobile">
              <option value="android_developer">Android Developer</option>
              <option value="ios_developer">IOS Developer</option>
              <option value="mobile_designer">Mobile Designer</option>
            </optgroup>
            <optgroup label="IT">
              <option value="I.T">I.T</option>
            </optgroup>
          </select>
          <legend><span class="number">3</span>Enter Salary Information</legend>
        
        <label for="package">Annual Package:</label>
        <input type="number" id="package" name="package" placeholder="Enter Total Salary">
      
        <label for="rent_allowance">Rent Allowance:</label>
        <input type="number" id="rent_allowance" name="rent_allowance" placeholder="Enter Rent Allowance">
     
        <label for="basic_pay">Basic Pay:</label>
        <input type="number" id="basic_pay" name="basic_pay" placeholder="Enter basic pay">
        
        <label for="variable_salary">Variable Pay:</label>
        <input type="number" id="variable_salary" name="variable_salary" placeholder="Enter variable_salary">
          
        <label for="gratuity">Gratuity:</label>
        <input type="number" id="gratuity" name="gratuity" placeholder="Enter gratuity">       
          <input type="checkbox" id="select_manager" name="select_manager" value="On">
                            <label for="select_manager"> Is the employee also a manager?</label><br>
                            <link href="..\css\multiselect.css" rel="stylesheet">
                            <script src="..\js\multiselect.min.js"></script>
          

         </fieldset>
       	<style>
		#testSelect1_multiSelect {
			width: 200px;
		}
	</style>
</head>
<div class = "selectEmp">
<select id='selectEmp1' name='selectEmp1[]' multiple>
    
    @foreach($user1 as $user)
	<option value="{{$user->emp_id}}">{{$user->emp_id}} : {{$user->full_name}}</option>
    @endforeach

</select>

    </div>

<body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>



<script>
	document.multiselect('#selectEmp1')
		.setCheckBoxClick("checkboxAll", function(target, args) {

			console.log("Checkbox 'Select All' was clicked and got value ", args.checked);
		})
		.setCheckBoxClick("1", function(target, args) {
			console.log("Checkbox for item with value '1' was clicked and got value ", args.checked);
		});


        $(".selectEmp").hide();

        
$('#select_manager').click(function()
 {if ($('#select_manager').is(':checked'))
     {$('.selectEmp').show();
         $('#saved-button').show();
 } 
 else
  {
        $('.selectEmp').hide();
        $('#saved-button').hide();
     }
    });






</script> <br>

                            <input type="submit" class="btn btn-info" value="Submit">
                         
                            <input type="reset" class="btn btn-warning" value="Reset">

      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>
</body>
</html>           
       
        
       </form>
        </div>
      </div>
      
    </body>
</html>
