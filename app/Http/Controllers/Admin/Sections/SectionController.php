<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        $Teachers = Teacher::all();
        return view('Admin.Sections.all-section', compact('Grades', 'Teachers'));
    }
    public function getClasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
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
    public function store(SectionRequest $request)
    {
        DB::beginTransaction();
        try {
            $section = Section::create([
                'Name_Section' => [
                    'ar' => $request->Name_Section_Ar,
                    'en' => $request->Name_Section_En,
                ],
                'Grade_id' => $request->Grade_id,
                'Class_id' => $request->Class_id,
            ]);
            $section->teachers()->attach($request->teachers);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.sections.index');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
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
    public function update(SectionRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            $section = Section::findOrFail($id);

            // Sync teachers
            $section->teachers()->sync($request->teachers ?? []);

            // Determine status
            $status = $request->has('Status') ? 1 : 2;

            // Update section
            $section->update([
                'Name_Section' => [
                    'ar' => $request->Name_Section_Ar,
                    'en' => $request->Name_Section_En,
                ],
                'Grade_id' => $request->Grade_id,
                'Class_id' => $request->Class_id,
                'Status' => $status,
            ]);

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.sections.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error for debugging
            Log::error('Section Update Error: ' . $e->getMessage());
            return redirect()->back()->with(['error' => __('An error occurred while updating the section. Please try again later.')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Section::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('admin.sections.index');
    }
}
