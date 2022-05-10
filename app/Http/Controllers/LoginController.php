<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view("Dashboard-pages.Auth.login");
    }

    public function sign_in(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);
        $this->checkTooManyFailedAttempts();

        $user = User::where("email", $request->email)->first();

        try {
            $credentials = request(["email", "password"]);

            if (!$user->isActive) {
                return response()->json(
                    [
                        "status_code" => 401,
                        "message" =>
                            "sorry there is a problem with your account try again later",
                    ],
                    401
                );
            }

            if (!Auth::attempt($credentials)) {
                RateLimiter::hit($this->throttleKey(), $seconds = 300);

                return response()->json(
                    [
                        "status_code" => 401,
                        "message" => "Invalid Email and Password",
                    ],
                    401
                );
            }
            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception("Error occured while logging in.");
            }

            $token = $user->createToken("authToken")->plainTextToken;

            RateLimiter::clear($this->throttleKey());

            return response()->json([
                "status_code" => 200,
                "message" => "Success",
                "access_token" => $token,
                "token_type" => "Bearer",
                "user" => $user,
            ]);
            // return redirect("admin/users");
        } catch (Exception $error) {
            return response()->json([
                "status_code" => 500,
                "message" => "Error occured while loggin in.",
                "error" => $error,
            ]);
        }
    }

    public function throttleKey()
    {
        return Str::lower(request("email")) . "|" . request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function checkTooManyFailedAttempts()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }
        throw new Exception("IP address banned. Too many login attempts.");
    }

    public function sign_out(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect("admin/login");
    }
}
