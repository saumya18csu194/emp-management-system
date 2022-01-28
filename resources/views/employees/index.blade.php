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
<div id='paginationResults'>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">.. EMS RTDS.. </a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="../newhomepage">Home</a></li>

        <li><a href="#">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <form action="">
          <h2>EMPLOYEE DATA</h2>
          <div class="form-group">

            <input type="text" name="search_word" placeholder="Find using employee name...!" class="form-control" />
            <input type="submit" class="btn btn-primary" value="Search" />
          </div>
        </form>
      </div>
      
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email ID</th>
              <th>Age</th>
              <th>Address</th>
              <th>Birth Date</th>
              <th>Joining Date</th>
            </tr>
          </thead>
          <tbody>

            @foreach($employees as $emp)


            <tr>
              <td>{{$emp['emp_id']}}</td>
              <td>{{$emp['full_name']}}</td>
              <td>{{$emp['email']}}</td>
              <td>{{$emp['age']}}</td>
              <td>{{$emp['address']}}</td>
              <td>{{$emp['birth_date']}}</td>
              <td>{{$emp['joining_date']}}</td>
              <td>
                <form class="row" method="POST" action="{{ route('employees.destroy', ['id' => $emp->id]) }}" onsubmit="return confirm('Are you sure?')">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <a href="{{ route('employees.edit', ['id' => $emp->id]) }}" class="btn">
                    Update
                  </a>
                  <button type="submit">
                    Delete
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
      <div id='pagination'>
        {{$employees->links()}}
      </div>
    </div>
    </div>
    <script>
      $(document).ready(function() {

        $("#pagination").on("click", ".pagination a", function(e) {

          e.preventDefault();                                  

          var page = $(this).attr("href").split("page=")[1];

          getEmployees(page);

        });



        function getEmployees(page) {

          $.ajax({

            url: "?page=" + page

          }).done(function(data) {

            $("#paginationResults").html(data);

          });

        }

      });
    </script>