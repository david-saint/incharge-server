<?php

namespace App\Http\Controllers\V1\User\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;


	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => ['changePassword', 'showChangeForm']]);
	}

	/**
     * The authentication guard for the users .
     * 
     * @return [type] [description]
     */
	protected function guard()
	{
		return Auth::guard('users');
	}

	/**
     * The password broker
     * @param  [type] $broker [description]
     * @return [type]         [description]
     */
	protected function broker()
	{
		return Password::broker('users');
	}

	/**
	 * The method that validates and reset the password.
	 * 
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function reset(Request $request)
	{
		$this->validate($request, $this->rules(), $this->validationErrorMessages());

		// Here we will attempt to reset the user's password. If it is successful we
		// will update the password on an actual user model and persist it to the
		// database. Otherwise we will parse the error and return the response.
		$response = $this->broker()->reset(
			$this->credentials($request), function ($user, $password) {
				$this->resetPassword($user, $password);
			}
		);

		// If the password was successfully reset, we will redirect the user back to
		// the application's home authenticated view. If there is an error we can
		// redirect them back to where they came from with their error message.
		return $response == \Password::PASSWORD_RESET
								? $this->sendResetResponse($response)
								: $this->sendResetFailedResponse($request, $response);
	}

	/**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|array
     */
	protected function sendResetResponse($response)
	{
		return response()->json([ 'message'	=>	trans($response) ], 200);
	}

	/**
	 * Get the response for a failed password reset.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $response
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|array
	 */
	protected function sendResetFailedResponse(Request $request, $response)
	{
		return response()->json([
			'errors' => [
				'email' => [ trans($response) ],
			]
		], 422);
	}

	/**
	 * Method to actually change the password.
	 * 
	 * @param  [type] $user     [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	protected function resetPassword($user, $password)
	{
		$user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

		$user->save();

		event(new PasswordReset($user));

		$this->guard()->login($user);
	}

}
