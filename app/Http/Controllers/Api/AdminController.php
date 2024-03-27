<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResources;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function newStudents(Request $request)
    {
        $students = Student::where("teacher_id", null)->get();

        return response()->json([
            "status" => true,
            "message" => "Student created",
            "data" => StudentResources::collection($students),
        ], 201);
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            "student_id" => "required",
            "teacher_id" => "required",
        ]);

        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                "status" => false,
                "message" => "Student not found",
            ], 404);
        }

        if ($student->teacher_id) {
            return response()->json([
                "status" => false,
                "message" => "Student already has teacher",
            ], 400);
        }

        // update student
        $student->teacher_id = $request->teacher_id;
        $student->save();

        return response()->json([
            "status" => true,
            "message" => "Student added to teacher",
            "data" => $student->loadMissing("teacher"),
        ], 200);

    }

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            "teacher_id" => "required",
        ]);

        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                "status" => false,
                "message" => "Student not found",
            ], 404);
        }

        $teacher = Teacher::find($request->teacher_id);

        if (!$teacher) {
            return response()->json([
                "status" => false,
                "message" => "Teacher not found",
            ], 404);
        }

        $student->teacher_id = $request->teacher_id;
        $student->save();

        return response()->json([
            "status" => true,
            "message" => "Student updated",
            "data" => $student->loadMissing("teacher"),
        ], 200);
    }
}
