@extends('layouts.app')
 
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
       
        
        <img width="100px" height="100px" src="{{ asset('uploads/avatars/'.$user->avatar) }}">
        <h2>{{ $user->full_name }}</h2>
        <h4>Edit avatar</h4>
        {{ Form::open(['route' => ['user.profile.update'], 'files' => true, 'method' => 'PATCH']) }}
          <p>{{ Form::file('avatar') }}</p>
          <p>{{ Form::submit('Update', ['name' => 'submit']) }}</p>
        {{ Form::close() }
    </div>
  </div>
</div>
@endsection