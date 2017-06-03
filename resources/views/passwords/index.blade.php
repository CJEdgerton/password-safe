@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-hover">
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
					<td>{{ decrypt($password->password) }}</td>
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

@endsection
