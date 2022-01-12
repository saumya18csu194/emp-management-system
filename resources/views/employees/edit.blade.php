@extends('layouts.app')
@section('content')
<form method="Post" action="{{route('employees.update',$emp->id)}}">  
<input name="_method" type="hidden" value="PATCH">
          <div class="form-group">      
              <label for="first_name">Name:</label><br/><br/>  
              <input type="text" class="form-control" name="full_name" value={{$emp->full_name}}><br/><br/>  
          </div>  
          <div class="form-group">      
              <label for="first_name">Email</label><br/><br/>  
              <input type="text" class="form-control" name="email" value={{$emp->email}}><br/><br/>  
          </div>  
          <div class="form-group">      
              <label for="first_name">contact number</label><br/><br/>  
              <input type="text" class="form-control" name="age" value={{$emp->age}}><br/><br/>  
          </div>  
         
<br/>  
 
<button type="submit" class="btn-btn" >Update</button>  
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>  
 
 
@endsection