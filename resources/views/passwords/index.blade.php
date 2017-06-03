@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-hover" id="passwords-table">
			<thead>
				<tr>
					<th>Account</th>
					<th>Username</th>
					<th>Password</th>
					<th>Last Updated</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $passwords as $password )
				<tr>
					<td>{{ $password->account }}</td>
					<td>{{ $password->username }}</td>
					<td>
						<a href="#show-password-modal" data-toggle="modal">
							<span class="glyphicon glyphicon-eye-open"></span>
						</a>
					</td>
					{{-- <td>{{ decrypt($password->password) }}</td> --}}
					{{-- <td>{{ $password->created_at->format('m/d/Y') }}</td> --}}
					<td>{{ $password->updated_at }}</td>
					<td>
						<a href="{{ route('passwords.edit', ['id' => $password->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $passwords->links() }}

		<a href="{{ route('passwords.create') }}" class="btn btn-default pull-right">Create</a>
	</div>
</div>

<div class="modal fade" id="show-password-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="lead text-center">{{ decrypt($password->password) }}</p>
			</div>
		</div>
	</div>
</div>

@endsection
