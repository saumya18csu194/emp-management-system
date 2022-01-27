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
        <a class="navbar-brand" href="#">.. EMS RTDS.. </a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="../../newhomepage">Home</a></li>

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
          <h2>ADMIN DATA</h2>
          <div class="form-group">
            <input type="text" name="search_word" placeholder="Find using admin name...!" class="form-control" />
            <input type="submit" class="btn btn-primary" value="Search" />
          </div>
        </form>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email ID</th>

          </tr>
        </thead>
        <tbody>

          @foreach($employees as $emp)

          <tr>
            <td>{{$emp['id']}}</td>
            <td>{{$emp['name']}}</td>
            <td>{{$emp['email']}}</td>

            <td>
              <form class="row" method="POST" action="{{ route('users.destroy', ['id' => $emp->id]) }}" onsubmit="return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('users.edit', ['id' => $emp->id]) }}" class="btn">
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
      {{$employees->links()}}
    </div>