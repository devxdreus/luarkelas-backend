<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResources;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // index
    public function index()
    {
        $students = Student::get();

        return response()->json([
            "status" => true,
            "message" => "Student Lists",
            "data" => StudentResources::collection($students->loadMissing([
                "user:user_id,email,image",
                "teacher:teacher_id,name,jobdesc,address,phone,age,religion",
            ])),
        ]);
    }

    // show
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                "status" => false,
                "message" => "Student Not Found",
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Student Detail",
            "data" => new StudentResources($student->loadMissing([
                "user:user_id,email,image",
                "teacher:teacher_id,name,jobdesc,address,phone,age,religion",
                "reports:student_id,teacher_id,report_id,title,content,duration,created_at",
            ])),
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

        $student = Student::with([
            "user:user_id,google_id,email,image",
            "teacher:teacher_id,name,jobdesc,address,phone,age,religion",
        ])->find($id);

        if (!$student) {
            return response()->json([
                "status" => false,
                "message" => "Student Not Found",
            ]);
        }

        // is image
        if ($request->hasFile("image")) {
            // validate image
            $this->validate($request, [
                "image" => "image|mimes:jpg,png,jpeg|max:2048",
            ]);

            // delete old image
            if ($student->user->image != null) {
                unlink(public_path("images/" . $user->image));
            }

            // upload new image
            $fileName = $this->generateRandomString();
            $extension = $request->image->extension();

            // store image in public
            $request->image->move(public_path("images"), $fileName . "." . $extension);

            // update student
            $student->update([
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

            $student->user->update([
                "image" => $fileName . "." . $extension,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Student Updated",
                "data" => new StudentResources($student->loadMissing([
                    "user:user_id,email,image",
                    "teacher:teacher_id,name,jobdesc,address,phone,age,religion",
                ])),
            ]);

        } else {
            // update student without image

            $student->update([
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
                "message" => "Student Updated",
                "data" => new StudentResources($student->loadMissing([
                    "user:user_id,email,image",
                    "teacher:teacher_id,name,jobdesc,address,phone,age,religion",
                ])),
            ]);
        }

    }

    // destroy
    public function destroy($id)
    {
        $student = Student::with([
            "user:user_id,email,image",
        ])->find($id);

        if (!$student) {
            return response()->json([
                "status" => false,
                "message" => "Student Not Found",
            ]);
        }

        // delete image
        if ($student->user->image != null) {
            unlink(public_path("images/" . $student->user->image));
        }

        $student->user->delete();
        $student->delete();

        return response()->json([
            "status" => true,
            "message" => "Student Deleted",
        ]);
    }

    public static function generateRandomString($length = 30)
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
