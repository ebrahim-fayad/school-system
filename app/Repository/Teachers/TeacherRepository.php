<?php
namespace App\Repository\Teachers;

use App\Interface\Teachers\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TeacherRepository implements TeacherRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $Teachers = Teacher::all();
        return view('Admin.Teachers.all-teachers', compact('Teachers'));
    }

    /**
     * @inheritDoc
     */
    public function create()
    {
        $sections = Section::all();
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('Admin.Teachers.create-teacher', compact('sections', 'specializations', 'genders'));
    }

    /**
     * @inheritDoc
     */
    public function store($request)
    {

        DB::beginTransaction();
        try {
            $teacher = Teacher::create([
                'Name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en
                ],
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'Specialization_id' => $request->Specialization_id,
                'Gender_id' => $request->Gender_id,
                'Joining_Date' => $request->Joining_Date,
                'Address' => $request->Address,
            ]);
            $teacher->sections()->attach($request->sections);
            $this->uploadImage($request, 'upload_image', 'photo', 'Teachers', $teacher->id, 'App\Models\Teacher');
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            //throw $th;
        }
    }
    /**
     * @inheritDoc
     */
    public function edit($id)
    {
        $Teacher = Teacher::findOrFail($id);
        $sections = Section::all();
        $specializations = Specialization::all();
        $genders = Gender::all();
        return view('Admin.Teachers.edit', compact('Teacher', 'sections', 'specializations', 'genders'));
    }

    /**
     * @inheritDoc
     */
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->update([
                'Name' => [
                    'ar' => $request->Name_ar,
                    'en' => $request->Name_en
                ],
                'email' => $request->Email,
                'password' => Hash::make($request->Password),
                'Specialization_id' => $request->Specialization_id,
                'Gender_id' => $request->Gender_id,
                'Joining_Date' => $request->Joining_Date,
                'Address' => $request->Address,
            ]);
            $teacher->sections()->sync($request->sections);
            if ($request->hasFile('photo')) {
                $this->deleteImage('upload_image', $id, 'App\Models\Teacher');
            }
            $this->uploadImage($request, 'upload_image', 'photo', 'Teachers', $teacher->id, 'App\Models\Teacher');
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            //throw $th;
        }

    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $teacher = Teacher::findOrFail($id);
            $this->deleteImage('upload_image', $id, 'App\Models\Teacher');
            $teacher->delete();
            DB::commit();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('admin.teachers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
            //throw $th;
        }
    }
}
