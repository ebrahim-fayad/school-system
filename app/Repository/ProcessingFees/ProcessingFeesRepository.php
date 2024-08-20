<?php
namespace App\Repository\ProcessingFees;


use App\Interface\ProcessingFees\ProcessingFeesRepositoryInterface;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface
{
    public function index()
    {
       $ProcessingFees = ProcessingFee::all();
       return view('Admin.ProcessingFee.index', compact('ProcessingFees'));
    }

    public function create() {
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Admin.ProcessingFee.add', compact('student'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            #==============================Insert Into Processing Fees==================================
            $ProcessingFee = ProcessingFee::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount'=>$request->Debit,
                'description' => $request->description
            ]);
            #==============================Insert Into Student Account ==================================
            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'processing fee',
                'student_id' => $request->student_id,
                'processing_id'=>$ProcessingFee->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit($id) {
        $ProcessingFee = ProcessingFee::findOrFail($id);
        return view('Admin.ProcessingFee.edit', compact('ProcessingFee'));
    }
    public function update($request, $id) {
        DB::beginTransaction();
        try {
            #==============================Update Into Processing Fees==================================
            $ProcessingFee = ProcessingFee::findOrFail($id);
            $ProcessingFee->update([
                'date' => date('Y-m-d'),
                'student_id' => $ProcessingFee->student->id,
                'amount' => $request->Debit,
                'description' => $request->description
            ]);
            #==============================Update Into Student Account ==================================
            $StudentAccount = StudentAccount::where('processing_id',$id);
            $StudentAccount->update([
                'date' => date('Y-m-d'),
                'type' => 'processing fee',
                'student_id' => $ProcessingFee->student->id,
                'processing_id' => $id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        ProcessingFee::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }

}
