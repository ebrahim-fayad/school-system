<?php
namespace App\Repository\Students;

use App\Interface\Students\StudentGraduationRepositoryInterface;
use App\Models\Grade;
use App\Models\Student;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentGraduationRepository implements StudentGraduationRepositoryInterface
{
    use UploadTrait;

    /**
     * @inheritDoc
     */
    public function index() {
        $students = Student::onlyTrashed()->get();
        return view('Admin.Students.Graduations.index',compact('students'));
    }
    /**
     * @inheritDoc
     */
    public function create() {
        $Grades = Grade::all();
        return view('Admin.Students.Graduations.create-graduation',compact('Grades'));
    }

    /**
     * @inheritDoc
     */
    public function store($request) {
        $students = student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->get();
        if ($students->count() > 0) {
            foreach ($students as $student) {
                $student->delete();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.graduation.index');
        } else {
            return redirect()->back()->with('error_Graduated', 'There is no students available for this');
        }

    }
    /**
     * @inheritDoc
     */
    public function restore($id) {
        Student::withTrashed()->where('id', $id)->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->route('admin.graduation.index');
    }
    /**
     * @inheritDoc
     */
    public function destroy($id) {
        $student = Student::withTrashed()->where('id', $id)->first();
        $folderName = Str::slug($student->getTranslation('name', 'en'));
        $this->deleteImage('upload_image', $id, 'App\Models\Student');
        if (Storage::disk('upload_image')->exists("studentsAttachments/$folderName")) {
            Storage::disk('upload_image')->deleteDirectory("studentsAttachments/$folderName");
        }
       $student->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('admin.graduation.index');

    }
}
