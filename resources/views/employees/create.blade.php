@extends('layouts.app')
@section('content')
<form method="post" action="{{url('employees')}}">
                            <div class="form-group">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input name="full_name" type="text" class="form-control"  placeholder="Enter Full Name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"  placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label>Age</label>
                                <input name="age" type="number" class="form-control"  placeholder="Enter age">
                            </div>
                            <div class="form-group">
                            <label>Birth Date</label>
                                <input name="joining_date" type="date" class="form-control"   >
                            </div>
                            <div class="form-group">
                            <label>Joining Date</label>
                                <input name="joining_date" type="date" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input name="address" type="text" class="form-control"  placeholder="Enter Address">
                            </div>
                            <input type="submit" class="btn btn-info" value="Submit">
                            <input type="reset" class="btn btn-warning" value="Reset">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>