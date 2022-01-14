<!-- index.blade.php -->

@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="">
                <h2>Search using employee name</h2>
                <div class="form-group">
                    <input type="text" name="q" placeholder="Find using employee name...!" class="form-control"/>
                    <input type="submit" class="btn btn-primary" value="Search"/>
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
      </tr>
    </thead>
    <tbody>
    <p>TOTAL NUMBER OF EMPLOYEES = {{ $s }}</p>  
      @foreach($employees as $emp)
     
      <tr>
        <td>{{$emp['id']}}</td>
        <td>{{$emp['full_name']}}</td>
        <td>{{$emp['email']}}</td>
        <td>{{$emp['age']}}</td>
        <td>
        <form class="row" method="POST" action="{{ route('employees.destroy', ['id' => $emp->id]) }}" onsubmit = "return confirm('Are you sure?')">
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
  {{$employees->links()}}
  </div>
@endsection