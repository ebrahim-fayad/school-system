<?php
namespace App\Repository\Students;

use App\Interface\Students\StudentPromotionRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function index() {
        $Grades = Grade::all();
        return view('Admin.Students.Promotion.index',compact('Grades'));
    }
    /**
     * @inheritDoc
     */
    public function store($request) {
        DB::beginTransaction();
        try {
            $students = student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where
            ('section_id', $request->section_id)->get();
            foreach ($students as $student) {
                $student->update([
                    'Grade_id' => $request->Grade_id_new,
                    'Classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                ]);
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
