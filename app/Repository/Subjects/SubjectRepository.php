<?php
namespace App\Repository\Subjects;

use App\Interface\Subjects\SubjectRepositoryInterface;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::all();
        return view('Admin.Subjects.index', compact('subjects'));
    }
    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('Admin.Subjects.create', compact('grades', 'teachers'));
    }
    public function store($request)
    {
        try {
            //code...
            Subject::create([
                'name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en,
                ],
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'teacher_id' => $request->teacher_id,
                ]);
                toastr()->success(trans('messages.success'));
                return redirect()->route('admin.subjects.index');
            }catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    /**
     * @inheritDoc
     */


    /**
     * @inheritDoc
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('Admin.Subjects.edit', compact('subject','grades', 'teachers'));
    }

    /**
     * @inheritDoc
     */
    public function update($request, $id)
    {
        try {
            $subject = Subject::findOrFail($id);
           $subject->update([
                'name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en,
                ],
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'teacher_id' => $request->teacher_id,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.subjects.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        Subject::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }

    /**
     * @inheritDoc
     */


    /**
     * @inheritDoc
     */
}
