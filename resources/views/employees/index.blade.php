<!-- index.blade.php -->

@extends('layouts.app')
@section('content')
  <div class="container">

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