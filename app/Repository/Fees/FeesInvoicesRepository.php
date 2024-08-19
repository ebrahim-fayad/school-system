<?php
namespace App\Repository\Fees;

use App\Interface\Fees\FeesInvoicesRepositoryInterface;
use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{

    public function index()
    {
        $Fee_invoices = FeeInvoice::all();
        $Grades = Grade::all();
        return view('Admin.Fees.FeesInvoices.index', compact('Fee_invoices', 'Grades'));
    }
    public function create() {
    }
    public function store($request)
    {
        $List_Fees = $request->List_Fees;
        DB::beginTransaction();
        try {
            foreach ($List_Fees as $fee) {
                #============================= insert into FeeInvoices ================================
               $fees = FeeInvoice::create([
                    'invoice_date'=>date('Y-m-d'),
                    'student_id'=>$fee['student_id'],
                    'Grade_id'=>$request->Grade_id,
                    'Classroom_id'=>$request->Classroom_id,
                    'fee_id'=>$fee['fee_id'],
                    'amount'=>$fee['amount'],
                    'description'=>$fee['description'],
                    ]);
                    #============================= insert into StudentsAccount ================================
                    StudentAccount::create([
                        'date' => date('Y-m-d'),
                        'type'=>'invoice',
                        'fee_invoice_id'=>$fees->id,
                        'student_id' => $fee['student_id'],
                        'Debit' => $fee['amount'],
                        'credit' => 0.00,
                        'description'=>$fee['description'],
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return to_route('admin.FeesInvoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('Classroom_id', $student->Classroom_id)->get();
        return view('Admin.Fees.FeesInvoices.create', compact('student', 'fees'));
    }
    public function edit($id) {
        $fee_invoices= FeeInvoice::findOrFail($id);
        $fees = Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('Admin.Fees.FeesInvoices.edit', compact('fee_invoices', 'fees'));
    }

    public function update($request, $id) {
        DB::beginTransaction();
        try {
            $fee_invoices = FeeInvoice::findOrFail($id);
            $fee_invoices->update([
                'amount'=>$request->amount,
                'description'=>$request->description,
            ]);
            $studentAccount = StudentAccount::where('fee_invoice_id', $id);
            $studentAccount->update([
                'Debit'=>$request->amount,
                'credit'=>0.00,
                'description'=>$request->description
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return to_route('admin.FeesInvoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id) {
        FeeInvoice::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
