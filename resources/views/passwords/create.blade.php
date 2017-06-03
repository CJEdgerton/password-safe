@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">
	<ol class="breadcrumb">
	    <li>
	        <a href="{{ route('passwords.index') }}">Home</a>
	    </li>
	    <li class="active">Create</li>
	</ol>

	<form action="{{ route('passwords.store') }}" method="POST" role="form">
		{{ csrf_field() }}

		<div class="panel panel-default">

		    <div class="panel-heading">
		        <h3 class="panel-title">Create Password</h3>
		    </div>

			<div class="panel-body">
				<div class="form-group">
					<label for="account">Account</label>
					<input type="text" class="form-control" id="account"  name="account" placeholder="Account Name">
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username"  name="username" placeholder="Username">
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password"  name="password" placeholder="Password">
				</div>

				<div class="form-group">
					<label for="confirm_password">Confirm Password</label>
					<input type="password" class="form-control" id="confirm_password"  name="confirm_password" placeholder="Confirm Password">
				</div>

				@include('includes.errors')
			</div>

		    <div class="panel-footer clearfix">
		        <div class="form-group">
		            <button 
		                type="submit" 
		                class="btn btn-primary btn-save pull-right">
		                Save</button>
		            <a 
		                href="{{ route('passwords.index') }}" 
		                class="btn btn-default pull-right">
		                Cancel</a>
		        </div>
		    </div>
		</div>

	</form>
</div>

@endsection