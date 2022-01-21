<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
<form method="post" action="{{url('employees')}}">
                         
                            <div class="form-group">
                                <label>Full Name</label>
                                <input name="full_name" type="text" class="form-control"  placeholder="Enter Full Name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"  placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label>Age</label>
                                <input name="age" type="number" class="form-control"  placeholder="Enter age">
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
                                <input name="phone_number" type="number" class="form-control"  placeholder="Enter phone number">
                            </div>
                            
                            <div class="form-group">
                                <label>Address</label>
                                <input name="address" type="text" class="form-control"  placeholder="Enter Address">
                            </div>
                            <div class="form-group">
                            <label>Birth Date</label>
                                <input name="birth_date" type="date" class="form-control"   >
                            </div>
                            <div class="form-group">
                            <label>Joining Date</label>
                                <input name="joining_date" type="date" class="form-control"  >
                            </div>

                            <input type="checkbox" id="select_manager" name="select_manager" value="On">
                            <label for="select_manager"> Is the employee also a manager?</label><br>
                            <link href="..\css\multiselect.css" rel="stylesheet">
                            <script src="..\js\multiselect.min.js"></script>
	<style>
		/* example of setting the width for multiselect */
		#testSelect1_multiSelect {
			width: 200px;
		}
	</style>
</head>
<div class = "selectEmp">
<select id='selectEmp1' name='selectEmp1' multiple>
    
    @foreach($user1 as $user)
	<option value="{{$user->id}}">{{$user->id}} : {{$user->full_name}}</option>

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






</script> 
<br><br>
                            <input type="submit" class="btn btn-info" value="Submit">
                            <br><br>
                            <input type="reset" class="btn btn-warning" value="Reset">

      
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>
</body>
</html>                        