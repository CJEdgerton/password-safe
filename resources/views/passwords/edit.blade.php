@extends('layouts.app')

@section('content')

<div class="col-md-8 col-md-offset-2">

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('passwords.index') }}">Home</a>
        </li>
        <li class="active">Edit</li>
    </ol>

    <form action="{{ route('passwords.update', ['id' => $password->id]) }}" method="POST" role="form">
    	{{ csrf_field() }}
    	{{ method_field('PUT')}}

    	<div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Edit Info</h3>
            </div>

    		<div class="panel-body">
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
                    <a class="btn btn-default pull-left" data-toggle="modal" href='#modal-id'>
                        <span class="glyphicon glyphicon-trash text-danger"></span>
                        Delete
                    </a>
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



    {{--  --}}

<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete {{ $password->account }}</h4>
            </div>
            <div class="modal-body">
                <p class="lead">Are you sure you want to delete this account?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('passwords.destroy', ['id' => $password->id]) }}" method="POST" class="pull-right">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-save pull-right">
                        Delete
                    </button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection