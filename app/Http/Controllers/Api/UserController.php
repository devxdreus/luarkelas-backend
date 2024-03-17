<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // index
    public function index()
    {
        $users = User::get();

        return response()->json([
            "status" => true,
            "message" => "Welcome to Luarkelas API",
            "data" => UserResources::collection($users->loadMissing(["student", "teacher"])),
        ]);
    }

    // show
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User Not Found",
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "User Detail",
            "data" => new UserResources($user->loadMissing(["student", "teacher"])),
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            "name" => "required",
            "phone" => "required",
            "address" => "required",
            "parentname" => "required",
            "nickname" => "required",
            "birthdate" => "required|date",
            "birthplace" => "required",
            "schoolname" => "required",
            "grade" => "required|numeric",
            "age" => "required|numeric",
            "religion" => "required",
        ]);

        $user = User::with(["student", "teacher"])->find($id);

        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User Not Found",
            ]);
        }

        if ($request->hasFile("image")) {
            $fileName = $this->generateRandomString();
            $extension = $request->image->extension();

            // validate extension
            if (!in_array($extension, ["jpg", "jpeg", "png"])) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Image Extension",
                ]);
            }

            // Storage::disk('public')->putFileAs('images', $request->image, $fileName . "." . $extension);

            // delete old image
            if ($user->image) {
                unlink(public_path("images/" . $user->image));
            }

            // store image in public/images
            $request->image->move(public_path("images"), $fileName . "." . $extension);

            // update user
            if ($user->student != null) {
                // is student
                $user->update([
                    "image" => $fileName . "." . $extension,
                ]);

                // // update student
                // $student = Student::where("user_id", $user->user_id)->first();

                $user->student->update([
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "parentname" => $request->parentname,
                    "nickname" => $request->nickname,
                    "birthdate" => $request->birthdate,
                    "birthplace" => $request->birthplace,
                    "schoolname" => $request->schoolname,
                    "grade" => $request->grade,
                    "age" => $request->age,
                    "religion" => $request->religion,
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User Updated",
                    "data" => new UserResources($user),
                ]);
            } else {
                // is teacher
                $user->update([
                    "image" => $fileName . "." . $extension,
                ]);

                // update teacher
                $user->teacher->update([
                    "name" => $request->name,
                    "jobdesc" => $request->jobdesc,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "age" => $request->age,
                    "religion" => $request->religion,
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User Updated",
                    "data" => new UserResources($user),
                ]);
            }

        } else {
            // update user without image
            if ($user->student != null) {
                // is student
                $user->update([
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "parentname" => $request->parentname,
                    "nickname" => $request->nickname,
                    "birthdate" => $request->birthdate,
                    "birthplace" => $request->birthplace,
                    "schoolname" => $request->schoolname,
                    "grade" => $request->grade,
                    "age" => $request->age,
                    "religion" => $request->religion,
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User Updated",
                    "data" => new UserResources($user),
                ]);
            } else {
                // is teacher
                $user->update([
                    "name" => $request->name,
                    "jobdesc" => $request->jobdesc,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "age" => $request->age,
                    "religion" => $request->religion,
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User Updated",
                    "data" => new UserResources($user),
                ]);
            }
        }
    }

    public function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}