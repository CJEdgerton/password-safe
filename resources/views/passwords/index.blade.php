@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-body">
		<div id="passwords-table-wrapper">
		    <div class="table-interface-group clearfix">
		        <div class="form-group pull-left search-home" style="width:100%; margin-bottom: 0px;"></div>
		    </div>
		    <hr>
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
						<td>{{ $password->updated_at }}</td>
						<td>
							<a href="{{ route('passwords.edit', ['id' => $password->id]) }}"><span class="glyphicon glyphicon-edit"></span></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
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

@push('scripts')
<script>
	$(document).ready(function() {
    	$('#passwords-table').DataTable({
    		lengthChange: false,
    		pageLength: 15,
            dom:'<".table-search-input"f>tr<"row mt-30"<"col-md-4"p><"col-md-4 text-center"i><"col-md-4 bottom-right-button">B><"clear">',		
    	});

        // Customize the main search input
        $('#passwords-table-wrapper .table-search-input').appendTo("#passwords-table-wrapper .table-interface-group .search-home");
            var $searchFilter = $('#passwords-table_filter input');
            $searchFilter.removeClass('input-sm');
            $searchFilter.attr('placeholder', 'Search');
            $searchFilter.parent().after($searchFilter);
            $($searchFilter).appendTo( $('#passwords-table_filter .input-group') );
            $('#passwords-table-wrapper .search-home label').remove();

        // Add the create button on bottom right
        $('.bottom-right-button').html(
        	'<a href="http://password-safe.dev/passwords/create" class="btn btn-primary pull-right">Create</a>'
        );

	});
</script>
@endpush