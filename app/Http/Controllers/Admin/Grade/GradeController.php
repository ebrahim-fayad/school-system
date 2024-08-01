<?php

namespace App\Http\Controllers\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GradeRequest;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('Admin.Grades.all-grade',compact('Grades'));
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
    public function store(GradeRequest $request)
    {
        Grade::create([
            'name'=>[
                'ar' => $request->name,
                'en' => $request->input('name_en'),
            ],
            'notes'=>$request->notes,
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();

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
    public function update(GradeRequest $request, string $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update([
            'name'=>[
                'ar' => $request->name,
                'en' => $request->input('name_en'),
            ],
            'notes'=>$request->notes,
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);
        if($grade->classrooms()->count() >0){
            toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return to_route('admin.grades.index');
        }
        Grade::destroy($id);
        toastr()->error(trans('messages.success'));
        return to_route('admin.grades.index');
    }
}
