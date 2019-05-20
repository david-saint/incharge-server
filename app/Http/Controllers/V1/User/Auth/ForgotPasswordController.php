<?php

namespace App\Http\Controllers\V1\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->middleware('guard:users');
    }

    /**
     * [sendResetLinkEmail description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker('users')->sendResetLink(
            $request->only('email')
        );

        return $response == \Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * validateion rule for the email address.
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|array
     */
    protected function sendResetLinkResponse($response)
    {
        return response()->json([ 'message' => trans($response) ], 200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'errors' => [
                'email' => [ trans($response) ]
            ]
        ], 422);
    }

    /**
     * The password broker
     * @param  [type] $broker [description]
     * @return [type]         [description]
     */
    public function broker($broker)
    {
        return \Password::broker($broker);
    }
}
