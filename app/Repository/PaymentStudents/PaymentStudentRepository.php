<?php
namespace App\Repository\PaymentStudents;


use App\Interface\PaymentStudents\PaymentStudentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepository implements PaymentStudentRepositoryInterface
{

    public function index()
    {
        $payment_students = PaymentStudent::all();
        return view('Admin.Payments.index', compact('payment_students'));
    }
    public function create()
    {
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            #====================== Insert into Payments table ==========================
            $Payment = PaymentStudent::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            #====================== Insert into FunAccounts table ==========================
            FundAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'payment_id' => $Payment->id,
                'student_id' => $request->student_id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            #====================== Insert into Students Accounts table ==========================
            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'payment_id' => $Payment->id,
                'student_id' => $request->student_id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);
            #====================== Commit the transaction ==========================
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.Payment_students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Admin.Payments.add', compact('student'));
    }
    public function edit($id)
    {
        $payment_student = PaymentStudent::findOrFail($id);
        return view('Admin.Payments.edit', compact('payment_student'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            #====================== Update into Payments table ==========================
            $Payment = PaymentStudent::findOrFail($id);
            $Payment->update([
                'date' => date('Y-m-d'),
                'student_id' => $Payment->student->id,
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            #====================== Update into FunAccounts table ==========================
            $FundAccount = FundAccount::where('payment_id', $id)->first();
           $FundAccount->update([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'payment_id' => $Payment->id,
                'student_id' => $Payment->student->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            #====================== Update into Students Accounts table ==========================
            $StudentAccount = StudentAccount::where('payment_id', $id)->first();
            $StudentAccount->update([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'payment_id' => $id,
                'student_id' => $Payment->student->id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);
            #====================== Commit the transaction ==========================
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.Payment_students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        PaymentStudent::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
