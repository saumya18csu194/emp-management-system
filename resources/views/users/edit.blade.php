@extends('layouts.app')
@section('content')
<form method="Post" action="{{route('users.update',$user->id)}}">  
<input name="_method" type="hidden" value="PATCH">
<div class="form-group">
    <label>Name</label>
    <input name="name" type="text" class="form-control"  placeholder="Enter Name" value={{$user->name}}>
</div>

<div class="form-group">
    <label>Email</label>
    <input name="email" type="text" class="form-control"  placeholder="Enter email" value={{$user->email}}>
</div>


<button type="submit" class="btn-btn" >Update</button>  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
@endsection