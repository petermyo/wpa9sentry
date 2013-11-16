<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<body>
	{{ Form::open(array('route' => 'register')) }}
	{{ Form::label('username', 'User Name') }}
	{{ Form::text('username') }}<br />
	{{ Form::label('email', 'Email') }}
	{{ Form::text('email') }}<br />
	{{ Form::label('address', 'Address') }}
	{{ Form::textarea('address') }}<br />
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}<br />
	{{ Form::label('c_password', 'Confirm Password') }}
	{{ Form::password('c_password') }}<br />
	{{ Form::submit('Submit') }}
	{{ Form::close() }}
	
</body>
</html>