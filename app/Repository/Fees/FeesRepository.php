<?php
namespace App\Repository\Fees;

use App\Interface\Fees\FeesRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class FeesRepository implements FeesRepositoryInterface
{

    public function index() {
        $fees = Fee::all();
        return view('Admin.Fees.index',compact('fees'));
    }

    public function create() {
        $Grades = Grade::all();
        return view('Admin.Fees.create', compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            Fee::create([
                'title'=> ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'=>$request->amount,
                'Grade_id'=>$request->Grade_id,
                'Classroom_id'=>$request->Classroom_id,
                'description'=>$request->description,
                'year'=>$request->year,
                'Fee_type'=>$request->Fee_type,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return to_route('admin.Fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit($id) {
        $fee = Fee::find($id);
        $Grades = Grade::all();
        return view('Admin.Fees.edit', compact('fee', 'Grades'));
    }
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $fee = Fee::findOrFail($id);
            $fee->update([
                'title' => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount' => $request->amount,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'description' => $request->description,
                'year' => $request->year,
                'Fee_type' => $request->Fee_type,
            ]);
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.Fees.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        Fee::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('admin.Fees.index');
    }
}
