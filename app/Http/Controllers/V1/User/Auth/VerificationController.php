<?php

namespace App\Http\Controllers\V1\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('auth')->except(['verify']);
        $this->middleware('force:users')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Response to send when email is successfully
     * verified.
     * 
     * @return [type] [description]
     */
    public function success()
    {
        return response()->json([
            'message'   =>  'Your email has been verified successfully. 🎉🎊🥳',
        ], 200);
    }

    /**
     * The route to redirect to upun
     * successful verify.
     * 
     * @return [type] [description]
     */
    protected function redirectTo()
    {
        return Config::get('app.user-domain', 'https://accounts.incharge.com.ng') . '/email-verified';
    }
}
