<?php
namespace App\Repository\Teachers\Quizzes;

use App\Interface\Teachers\Quizzes\QuizRepositoryInterface;
use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class QuizRepository implements QuizRepositoryInterface
{
    public function index()
    {
      $quizzes = Quizze::all();
      return view('Teachers.Quizzes.index', compact('quizzes'));
    }

    public function create() {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('Teachers.Quizzes.create', compact('subjects', 'teachers', 'grades'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
        Quizze::create([
            'name'=>[
                'ar'=>$request->Name_ar,
                'en'=>$request->Name_en,
            ],
            'subject_id'=>$request->subject_id,
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
           'section_id'=>$request->section_id,
        ]);
        DB::commit();
        toastr()->success(trans('messages.success'));
        return to_route('admin.quizzes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */


    /**
     * @inheritDoc
     */
    public function edit($id) {
        $quizz = Quizze::findOrFail($id);
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('Teachers.Quizzes.edit', compact('quizz','subjects', 'teachers', 'grades'));
    }
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $quiz = Quizze::findOrFail($id);
            $quiz->update([
                'name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en,
                ],
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
            ]);
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return to_route('admin.quizzes.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        Quizze::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
