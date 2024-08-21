<?php
namespace App\Repository\Attendance;
use App\Interface\Attendance\AttendanceRepositoryInterface;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $Grades = Grade::all();
        $Teachers = Teacher::all();
        return view('Admin.Attendance.Sections', compact('Grades',  'Teachers'));
    }
  /**
   * @inheritDoc
   */
  public function create() {
  }
  public function show($id) {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('Admin.Attendance.attendance-Table', compact('students'));
  }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $attendance = $request->attendance;
            foreach ($request->attendances as $student_id => $attendance) {
                if ($attendance == 'presence') {
                    $attendance_status = true;
                } else if ($attendance == 'absent') {
                    $attendance_status = false;
                }
                Attendance::create([
                    'student_id' => $student_id,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendance_date' => date('Y-m-d'),
                    'attendance_status' => $attendance_status
                    ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update attendance. '. $e->getMessage());
        }
        // return $request;
    }
  /**
   * @inheritDoc
   */
  public function destroy($id) {
  }
  public function update($request, $id) {
  }
    public function edit($id) {
    }
}
