<form action="route('passwords.store')" method="POST" role="form">
	<legend>Form title</legend>

	<div class="form-group">
		<label for="account">Account</label>
		<input type="text" class="form-control" id="account" placeholder="Account Name">
	</div>

	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" id="username" placeholder="Username">
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="text" class="form-control" id="password" placeholder="Username">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
</form>