@extends('layouts.app')
@section('content')
<form method="post" action="{{url('users')}}">
                            <div class="form-group">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control"  placeholder="Enter  Name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"  placeholder="Enter email">
                            </div>

                            <input type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-warning" value="Reset">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>