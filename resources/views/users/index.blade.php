<!-- index.blade.php -->

@extends('layouts.app')
@section('content')
  <div class="container">
  <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="">
                <h2>Search using admin name</h2>
                <div class="form-group">
                    <input type="text" name="q" placeholder="Find using admin name...!" class="form-control"/>
                    <input type="submit" class="btn btn-primary" value="Search"/>
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
    <p>TOTAL NUMBER OF ADMINS = {{ $s }}</p>  
      @foreach($employees as $emp)
     
      <tr>
        <td>{{$emp['id']}}</td>
        <td>{{$emp['name']}}</td>
        <td>{{$emp['email']}}</td>
        
        <td>
        <form class="row" method="POST" action="{{ route('users.destroy', ['id' => $emp->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('users.edit', ['id' => $emp->id]) }}" class="btn">
                        Update
                        </a>
                         
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