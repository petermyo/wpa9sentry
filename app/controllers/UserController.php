<?php 

class UserController extends BaseController {
	public function register() {
		if(Request::server('REQUEST_METHOD') == 'POST') {
			$rules = array(
				'email'		=> 'required|email|unique:users',
				'username'	=> 'required|unique:users',
				'password'	=> 'required|min:4',
				'c_password'=> 'required|same:password'
				);
			$userdata = array(
				'email'		=> Input::get('email'),
				'username'	=> Input::get('username'),
				'password'	=> Input::get('password'),
				'c_password'=> Input::get('c_password')

				);
			$validator = Validator::make($userdata, $rules);
			if($validator->fails()) {
				return Redirect::route('myregister')
				->withErrors($validator);
			} else {
				$credentials = array(
					'email'		=> Input::get('email'),
					'username'	=> Input::get('username'),
					'password'	=> Input::get('password'),
					);
				try
				{
    				// Create the user
					$user = Sentry::createUser($credentials);
					$userdata = new Userdata;
					$userdata->user_id = $user->id;
					$userdata->address = Input::get('address');
					$userdata->save();
					Session::flash('success', 'User already created!');
					return Redirect::to('/');


					//$adminGroup = Sentry::findGroupById(1);

    				// Assign the group to the user
					// $user->addGroup($adminGroup);
				}
				catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
				{
					echo 'Login field is required.';
				}
				catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
				{
					echo 'Password field is required.';
				}
				catch (Cartalyst\Sentry\Users\UserExistsException $e)
				{
					echo 'User with this login already exists.';
				}
				catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
				{
					echo 'Group was not found.';
				}

			}
		}
		return View::make('register');
	}
}

?>