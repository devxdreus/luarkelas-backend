<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\Models\Referral;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // index
    public function index()
    {
        return response()->json([
            "status" => true,
            "message" => "Welcome to Luarkelas API",
        ]);
    }

    // register
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|",
            "role_id" => "required|numeric",
            "referral_code" => "string|max:255"
        ]);

        if ($request->role_id == 3) {
            $request->validate([
                "jobdesc" => "required|string",
            ]);
        }

        if ($request->referral_code && User::where('referral_code', $request->referral_code)->doesntExist()) {
            return response()->json([
                "status" => false,
                "message" => "Referral Code Not Found",
            ], 422);
        }

        $user = User::create([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "email" => $request->email,
            'referral_code' => User::generateCode(),
            "password" => Hash::make($request->password),
        ]);

        if ($request->referral_code){
            $referrer = User::where('referral_code', $request->referral_code)->first();

            Referral::create([
                "referrer_id" => $referrer->user_id,
                "referred_id" => $user->user_id,
            ]);
        }

        if ($request->role_id == 2) {
            $student = Student::create([
                "user_id" => $user->user_id,
                "name" => $request->name,
            ]);

            return response()->json([
                "status" => true,
                "message" => "User registered",
                "data" => new UserResources($user->loadMissing(["student"])),
            ]);
        } else {
            $teacher = Teacher::create([
                "user_id" => $user->user_id,
                "name" => $request->name,
                "jobdesc" => $request->jobdesc,
            ]);

            return response()->json([
                "status" => true,
                "message" => "User registered",
                "data" => new UserResources($user->loadMissing(["teacher"])),
            ]);
        }

    }

    // login
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $user = User::with([
            "student:student_id,user_id,name,parentname,nickname,birthdate,birthplace,schoolname,grade,age,religion",
            "teacher:teacher_id,user_id,name,jobdesc,address,phone,age,religion",
            "role:role_id,description",
        ])->where("email", $request->email)->first();

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials",
            ], 401);
        }
        if ($user->google_id != null) {
            return response()->json([
                "status" => false,
                "message" => "Email has been registered with google",
            ], 401);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials",
            ], 401);
        }

        if ($user->student) {
            $token = $user->createToken("user login")->plainTextToken;

            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "data" => [
                    "user" => new UserResources($user),
                    "token" => $token,
                ],
            ]);
        }

        if ($user->teacher) {
            $token = $user->createToken("user login")->plainTextToken;

            return response()->json([
                "status" => true,
                "message" => "Login successful",
                "data" => [
                    "user" => new UserResources($user),
                    "token" => $token,
                ],
            ]);
        }

        $token = $user->createToken("user login")->plainTextToken;

        return response()->json([
            "status" => true,
            "message" => "Login successful",
            "data" => [
                "user" => new UserResources($user),
                "token" => $token,
            ],
        ]);

    }

    // me
    public function me(Request $request)
    {
        return response()->json([
            "status" => true,
            "message" => "User details",
            "data" => $request->user(),
        ]);
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "status" => true,
            "message" => "Logout successful",
        ]);
    }

    // redirectToGoogle
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // handleGoogleCallback
    public function handleGoogleCallback()
    {
        $google = Socialite::driver('google')->stateless()->user();

        $user = User::where("google_id", $google->id)->first();

        if ($user) {
            $token = $user->createToken("user login")->plainTextToken;

            return redirect()->away("https://luarkelas.id/google?status=true&token=" . $token);
        } else {
            $newUser = User::create([
                "role_id" => 2,
                "google_id" => $google->id,
                "email" => $google->email,
                "password" => Hash::make("password"),
                "image" => $google->avatar,
            ]);

            $newStudent = Student::create([
                "role_id" => 2,
                "user_id" => $newUser->user_id,
                "name" => $google->name,
            ]);

            $token = $newUser->createToken("user login")->plainTextToken;

            return redirect()->away("https://luarkelas.id/google?status=true&token=" . $token);

        }
    }
}
