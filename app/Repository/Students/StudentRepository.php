<?php
namespace App\Repository\Students;

use App\Interface\Students\StudentRepositoryInterface;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentRepository implements StudentRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $students = Student::all();
        return view('Admin.Students.all-students', compact('students'));
    }

    /**
     * @inheritDoc
     */

    public function create() {
        $data['grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = TypeBlood::all();
        return view('Admin.Students.add-student', $data);
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $folder = null;
            if ($request->hasFile('photo')) {
                $name = Str::slug($request->name_en);
                $file = $request->photo;
                $filename = 'AP_IMG_' . $name . time() . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("studentsAttachments/$name", $filename, 'upload_image');
                $folder = $path;
            }
           Student::create([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'blood_id' => $request->blood_id,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
                'Date_Birth' => $request->Date_Birth,
                'profilePhoto' => $folder
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
            // $student->sections()->attach($request->sections);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show($id)
    {
        $Student = Student::findOrFail($id);
        return view('Admin.Students.show', compact('Student'));
    }
    /**
     * @inheritDoc
     */

    /**
     * @inheritDoc
     */
    public function edit($id) {
        $data['Student']= Student::findOrFail($id);
        $data['Grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = TypeBlood::all();
        return view('Admin.Students.edit-student', $data);
    }

    /**
     * @inheritDoc
     */


    /**
     * @inheritDoc
     */
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $student = Student::findOrFail($id);
            if ($request->hasFile('photo')) {
                if (Storage::disk('upload_image')->exists("$student->profilePhoto")) {
                    Storage::disk('upload_image')->delete("$student->profilePhoto");
                }
                $name = Str::slug($request->name_en);
                $file = $request->photo;
                $filename = 'AP_IMG_' . $name . time() . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("studentsAttachments/$name", $filename, 'upload_image');
                $student->update([
                    'profilePhoto' => $path
                ]);
            }
            $student->update([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender_id' => $request->gender_id,
                'nationality_id' => $request->nationality_id,
                'blood_id' => $request->blood_id,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'parent_id' => $request->parent_id,
                'academic_year' => $request->academic_year,
                'Date_Birth' => $request->Date_Birth,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.students.index');
            // $student->sections()->attach($request->sections);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id) {
        $student = Student::findOrFail($id);
        $folderName = Str::slug($student->getTranslation('name', 'en'));
        $this->deleteImage('upload_image',$id, 'App\Models\Student');
        if (Storage::disk('upload_image')->exists("studentsAttachments/$folderName")){
            Storage::disk('upload_image')->deleteDirectory("studentsAttachments/$folderName");
        }
        Student::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('admin.students.index');
    }
    /**
     * @inheritDoc
     */
    public function getSections($id) {
        $sections = Section::where('Class_id', $id)->pluck('Name_Section', 'id');
        return $sections;
    }
    public function uploadStudentAttachment( $request, $id)
    {
        $student = Student::findOrFail($id);
        // $path = "images/products/$product->name/";
        $file = $request->file('file');
        $name = Str::slug($student->getTranslation('name','en'));
        $filename = 'AP_IMG_' . $student->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
        //  $path= $file->move(public_path($path), $filename);
        $path = $file->storeAs("studentsAttachments/$name", $filename, 'upload_image');
        Image::create([
            'fileName' => $path,
            'imageable_id' => $student->id,
            'imageable_type' => 'App\Models\Student',
        ]);
    }
    public function getProductImages($id)
    {
        $product = Student::findOrFail($id);
        $html = "";
        if ($product->images->count() > 0) {
            foreach ($product->images as $item) {
                $html .= '<div class="box">
                        <img src="/attachments/' . $item->fileName . '">
                        <a href="javascript:;" data-image="' . $item->id . '" class="btn btn-danger btn-sm" id="deleteStudentAttachment"><i class="fa fa-trash"></i></a>
                     </div>';
            }
        } else {
            $html = '<span class="text-danger">No image(s)</span>';
        }

        return response()->json(['status' => 1, 'data' => $html]);

    } //
    public function deleteStudentAttachment($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('upload_image')->delete($image->fileName);
        $image->delete();
        return response()->json(['status' => 1, 'message' => 'Image deleted successfully']);
    }
    public function downloadAttachments($id)
    {
        $image = Image::findOrFail($id);
        return Storage::disk('upload_image')->download($image->fileName);
    }
    public function showAttachments($id)
    {
        $image = Image::findOrFail($id);
        $filePath = Storage::disk('upload_image')->path($image->fileName);
        return response()->file($filePath);
    }
    public function deleteAttachments($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('upload_image')->delete($image->fileName);
        $image->delete();
        toastr()->error(trans('messages.Delete'));
        return back();
    }
}
