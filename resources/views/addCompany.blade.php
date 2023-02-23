@extends('layouts.master')

@section('title')
Add Company
@endsection

@section('css')

@endsection

@section('content')

<!-- ADD COMPANY FORM -->
<div class="container">
  <form method="POST" action="{{ route('company.store') }}">
    @csrf
    <div class="form-group">
      <label for="inputAddress">Company Name</label>
      <input type="text" class="form-control" id="" placeholder="Company Name">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputCity">City</label>
        <input type="text" class="form-control" id="inputCity">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>

@endsection

@section('script')

@endsection