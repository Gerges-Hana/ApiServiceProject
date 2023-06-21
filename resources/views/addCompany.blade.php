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
    <div class="form-row">
      <div class="form-group my-4">
        {{-- <label for="inputName">Company Name</label> --}}
        <input type="text" class="form-control" id="inputName" placeholder="Company Name" name="name">
      </div>
      <div class="form-group my-4">
        {{-- <label for="inputUserName">Company User Name</label> --}}
        <input type="text" class="form-control" id="inputUserName" placeholder="Company User Name" name="user-name">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group my-4">
        {{-- <label for="inputEmail4">Email</label> --}}
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
      </div>
      <div class="form-group my-4">
        {{-- <label for="inputPassword4">Password</label> --}}
        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
      </div>
    </div>
    <div class="form-group my-4">
      {{-- <label for="inputAddress">Address</label> --}}
      <input type="text" class="form-control" id="inputAddress" placeholder="Address:1234 Main St" name="city">
    </div>
    <div class="form-row">
      <div class="form-group my-4">
        {{-- <label for="inputCity">City</label> --}}
        <input type="text" class="form-control" id="inputCity" name="street" placeholder="City">
      </div>
    </div>
    <button type="submit" class="btn btn-primary my-4">Save</button>
  </form>
</div>

@endsection

@section('script')

@endsection
