<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherResources;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // index
    public function index()
    {
        $teachers = Teacher::with([
            "user:user_id,email,image",
        ])->get();

        return response()->json([
            "status" => true,
            "message" => "Teacher Lists",
            "data" => TeacherResources::collection($teachers),
        ]);
    }

    // show
    public function show($id)
    {
        $teacher = Teacher::with([
            "user:user_id,email,image",
            "students:teacher_id,student_id,name,parentname,nickname,birthdate,birthplace,schoolname,grade,phone,address,age,religion",
            "reports:teacher_id,student_id,report_id,title,content,duration,created_at",
        ])->find($id);

        if (!$teacher) {
            return response()->json([
                "status" => false,
                "message" => "Teacher Not Found",
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Teacher Detail",
            "data" => new TeacherResources($teacher),
        ]);
    }

    // store
    public function store(Request $request)
    {
        // validate
        $this->validate(request(), [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "phone" => "required",
            "address" => "required",
            "jobdesc" => "required",
            "age" => "required|numeric",
            "religion" => "required",
        ]);

        // create user
        $user = User::create([
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        // create teacher
        $teacher = Teacher::create([
            "user_id" => $user->user_id,
            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "jobdesc" => $request->jobdesc,
            "age" => $request->age,
            "religion" => $request->religion,
        ]);

        return response()->json([
            "status" => true,
            "message" => "Teacher Created",
            "data" => new TeacherResources($teacher->loadMissing("user:user_id,google_id,email,image")),
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
            "jobdesc" => "required",
            "age" => "required|numeric",
            "religion" => "required",
        ]);

        $teacher = Teacher::with([
            "user:user_id,google_id,email,image",
            "students:teacher_id,student_id,name,parentname,nickname,birthdate,birthplace,schoolname,grade,phone,address,age,religion",
            "reports:teacher_id,student_id,report_id,title,content,duration,created_at",
        ])->find($id);

        if (!$teacher) {
            return response()->json([
                "status" => false,
                "message" => "Teacher Not Found",
            ]);
        }

        // is image
        if ($request->hasFile("image")) {
            // validate image
            $this->validate($request, [
                "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
            ]);

            // delete old image
            if ($teacher->user->image != null) {
                unlink(public_path("images/" . $teacher->user->image));
            }

            // get generateRandomString() from studentcontroller class

            // upload new image
            $fileName = StudentController::generateRandomString();
            $extension = $request->image->extension();

            // store image in public
            $request->image->move(public_path("images"), $fileName . "." . $extension);

            // update user
            $teacher->user->update([
                "image" => $fileName . "." . $extension,
            ]);

            // update teacher
            $teacher->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "jobdesc" => $request->jobdesc,
                "age" => $request->age,
                "religion" => $request->religion,
                "image" => $fileName . "." . $extension,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Teacher Updated",
                "data" => new TeacherResources($teacher),
            ]);

        } else {
            // update teacher without image
            $teacher->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "jobdesc" => $request->jobdesc,
                "age" => $request->age,
                "religion" => $request->religion,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Teacher Updated",
                "data" => new TeacherResources($teacher),
            ]);
        }

    }

    // destroy
    public function destroy($id)
    {
        $teacher = Teacher::with("user")->find($id);

        if (!$teacher) {
            return response()->json([
                "status" => false,
                "message" => "Teacher Not Found",
            ]);
        }

        // delete image
        if ($teacher->user->image != null) {
            unlink(public_path("images/" . $teacher->user->image));
        }

        // delete teacher
        $teacher->delete();

        // delete user
        $teacher->user->delete();

        return response()->json([
            "status" => true,
            "message" => "Teacher Deleted",
            "data" => new TeacherResources($teacher),
        ]);
    }
}