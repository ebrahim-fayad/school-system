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
        return view('Admin.Students.Promotion.add-promotion',compact('Grades'));
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
                    'academic_year' => $request->academic_year_new,
                ]);
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'academic_year' => $request->academic_year,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error_promotions' => $e->getMessage()]);
        }
    }
    /**
     * @inheritDoc
     */
    public function show() {
        $promotions = Promotion::all();
        return view('Admin.Students.Promotion.show', compact('promotions'));
    }
    /**
     * @inheritDoc
     */
    public function destroy($request,$id) {
        DB::beginTransaction();
        try {
            if ($request->page_id == 1) {
                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion) {
                    Student::where('id', $Promotion->student_id)->update([
                        'Grade_id' => $Promotion->from_grade,
                        'Classroom_id' => $Promotion->from_Classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);
                }
                Promotion::truncate();
            } else {
                $Promotion = Promotion::findOrFail($id);
                Student::where('id', $Promotion->student_id)->update([
                    'Grade_id' => $Promotion->from_grade,
                    'Classroom_id' => $Promotion->from_Classroom,
                    'section_id' => $Promotion->from_section,
                    'academic_year' => $Promotion->academic_year,
                ]);
                $Promotion->delete();
                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error_promotions' => $e->getMessage()]);
        }
    }
}
