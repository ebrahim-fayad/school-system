<?php

namespace App\Http\Controllers\Admin\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        $My_Classes=Classroom::all();
        return view('Admin.Classrooms.all-classroom', compact('Grades', 'My_Classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        $validatedData = $request->validated();
        foreach ($validatedData['List_Classes'] as $classData) {
            Classroom::create([
                'Name_Class' => [
                  'ar'=>$classData['Name'],
                  'en' => $classData['Name_class_en'],
                ],
                'Grade_id' => $classData['Grade_id'],
            ]);
        }
        toastr()->success(trans('messages.success'));
        return to_route('admin.classrooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->update([
            'Name_Class'=>[
                'ar'=>$request->Name,
                'en'=>$request->Name_en,
            ],
            'Grade_id'=>$request->Grade_id
        ]);
        toastr()->success(trans('messages.success'));
        return to_route('admin.classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        toastr()->error(trans('messages.Delete'));
        return to_route('admin.classrooms.index');
    }
    public function deleteAll(Request $request)
    {
        $ids = explode(",", $request->delete_all_id);
        Classroom::whereIn('id', $ids)->delete();
        toastr()->error(trans('messages.Delete'));
        return to_route('admin.classrooms.index');
    }
    public function FilterClass(Request $request)
    {
        $Grades = Grade::all();
        $grade_id = $request->Grade_id;
        $My_Classes = Classroom::where('Grade_id', $grade_id)->get();
        return view('Admin.Classrooms.all-classroom', compact('Grades','My_Classes'));
    }
}
