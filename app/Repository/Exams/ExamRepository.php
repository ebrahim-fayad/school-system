<?php
namespace App\Repository\Exams;

use App\Interface\Exams\ExamRepositoryInterface;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class ExamRepository implements ExamRepositoryInterface
{

    public function index() {
        $exams = Exam::all();
        return view('Admin.Exams.index',compact('exams'));
    }

    public function create() {
        return view('Admin.Exams.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            Exam::create([
                'name'=> ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'term'=>$request->term,
                'academic_year'=>$request->academic_year,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return to_route('admin.Exams.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit($id) {
        $exam = Exam::find($id);
        return view('Admin.Exams.edit', compact( 'exam'));
    }
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $Exam = Exam::findOrFail($id);
            $Exam->update([
                'name' => ['en' => $request->Name_en, 'ar' => $request->Name_ar],
                'term' => $request->term,
                'academic_year' => $request->academic_year,
            ]);
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.Exams.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        Exam::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('admin.Exams.index');
    }
}
