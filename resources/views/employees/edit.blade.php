

 
 

@extends('layouts.app')
@section('content')
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

<button type="submit" class="btn-btn" >Update</button>  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
@endsection