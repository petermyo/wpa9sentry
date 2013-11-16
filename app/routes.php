<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/login', function(){
	try
	{
    // Set login credentials
		$credentials = array(
			'email'    => 'thiha@gmail.com',
			'password' => '123456',
			);

    // Try to authenticate the user
		$user = Sentry::authenticate($credentials, false);
	}
	catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
	{
		echo 'Login field is required.';
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
		echo 'Password field is required.';
	}
	catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
	{
		echo 'Wrong password, try again.';
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
		echo 'User was not found.';
	}
	catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
	{
		echo 'User is not activated.';
	}

// The following is only required if throttle is enabled
	catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
	{
		echo 'User is suspended.';
	}
	catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
	{
		echo 'User is banned.';
	}
});

Route::any('/register', array(
	'as'		=> 'register',
	'uses' 		=> 'UserController@register'
	));

Route::get('/logout', function(){
	Sentry::logout();
});

Route::get('/', array(
	'before' => 'sentry_auth',
	'do' => function(){
		return View::make('hello');
	}));