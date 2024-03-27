<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResources;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // index
    public function index(Request $request)
    {
        try {
            $reports = Report::get();

            // return response
            return response()->json([
                "status" => true,
                "message" => "Report Lists",
                "data" => ReportResources::collection($reports->loadMissing(["student", "teacher"])),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error while fetching reports",
            ]);
        }
    }

    // show
    public function show(Request $request, $id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                "status" => false,
                "message" => "Report Not Found",
            ]);
        }

        // return response
        return response()->json([
            "status" => true,
            "message" => "Report Detail",
            "data" => new ReportResources($report->loadMissing(["student", "teacher"])),
        ]);
    }

    // store
    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
            "title" => "required",
            "content" => "required",
            "duration" => "required|numeric",
            "date" => "required|date",
            "student_id" => "required|numeric",
            "teacher_id" => "required|numeric",
        ]);

        // create report
        $report = Report::create([
            "student_id" => $request->student_id,
            "teacher_id" => $request->teacher_id,
            "title" => $request->title,
            "content" => $request->content,
            "duration" => $request->duration,
            "created_at" => $request->date,
        ]);

        // return response
        return response()->json([
            "status" => true,
            "message" => "Report Created",
            "data" => new ReportResources($report->loadMissing(["student", "teacher"])),
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            "title" => "required",
            "content" => "required",
            "duration" => "required|numeric",
            "date" => "required|date",
            "student_id" => "required|numeric",
            "teacher_id" => "required|numeric",
        ]);

        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                "status" => false,
                "message" => "Report Not Found",
            ]);
        }

        // update report
        $report->update([
            "user_id" => $request->user_id,
            "title" => $request->title,
            "content" => $request->content,
            "duration" => $request->duration,
            "created_at" => $request->date,
        ]);

        // return response
        return response()->json([
            "status" => true,
            "message" => "Report Updated",
            "data" => new ReportResources($report->loadMissing(["student", "teacher"])),
        ]);
    }

    // destroy
    public function destroy($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json([
                "status" => false,
                "message" => "Report Not Found",
            ]);
        }

        // delete report
        $report->delete();

        // return response
        return response()->json([
            "status" => true,
            "message" => "Report Deleted",
            "data" => new ReportResources($report->loadMissing(["student", "teacher"])),
        ]);
    }
}
