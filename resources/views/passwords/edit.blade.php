@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<form action="{{ route('passwords.update', ['id' => $password->id]) }}" method="POST" role="form">
			{{ csrf_field() }}
			{{ method_field('PUT')}}

			<legend>Form title</legend>

			<div class="form-group">
				<label for="account">Account</label>
				<input type="text" class="form-control" id="account"  name="account" placeholder="Account Name" value="{{ $password->account }}">
			</div>

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username"  name="username" placeholder="Username" value="{{ $password->username }}">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="text" class="form-control" id="password"  name="password" placeholder="Username" value="{{ $password->password }}">
			</div>

			<button type="submit" class="btn btn-primary pull-left">Save</button>
		</form>

		<form action="{{ route('passwords.destroy', ['id' => $password->id]) }}" method="POST" role="form" class="pull-right">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}

			<button type="submit" class="btn btn-danger">Delete</button>
		</form>
	</div>
</div>

@endsection