<table class="table table-hover">
	<thead>
		<tr>
			<th>Account</th>
			<th>Username</th>
			<th>Password</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $passwords as $password )
		<tr>
			<td>{{ $password->account }}</td>
			<td>{{ $password->username }}</td>
			<td>{{ $password->password }}</td>
			{{-- <td>{{ $password->created_at->format('m/d/Y') }}</td> --}}
			<td>{{ $password->created_at }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

{{ $passwords->links() }}
