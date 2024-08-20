<?php
namespace App\Repository\Receipts;

use App\Interface\Receipts\ReceiptStudentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('Admin.Receipts.index', compact('receipt_students'));
    }
  public function create() {
  }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            #============================= insert into receipt students ======================================
            $receipt = ReceiptStudent::create([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id,
                'Debit'=>$request->Debit,
                'description'=>$request->description,
                ]);
            #============================= insert into fundAccount  ======================================
            FundAccount::create([
                'date'=>date('Y-m-d'),
                'student_id'=>$request->student_id,
                'receipt_id'=> $receipt->id,
                'Debit'=>$request->Debit,
                'credit'=>0.00,
                'description'=>$request->description,
                ]);
            #============================= insert into Students Accounts  ======================================
            StudentAccount::create([
                'date'=>date('Y-m-d'),
                'type'=>'receipt',
                'student_id'=>$request->student_id,
                'fee_invoice_id'=>null,
                'receipt_id'=> $receipt->id,
                'debit'=>0.00,
                'credit'=>$request->Debit,
                'description'=>$request->description,
                ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            // return redirect()->back();
            return redirect()->route('admin.Receipts.index');
            } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error_receipts' => $e->getMessage()]);
        }
    }
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            #============================= update into receipt students ======================================
             $receipt =ReceiptStudent::findOrFail($id);
            $receipt->update([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'Debit' => $request->Debit,
                'description' => $request->description,
            ]);
            #============================= update into fundAccount  ======================================
            $fund_accounts = FundAccount::where('receipt_id', $id)->first();
            $fund_accounts->update([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'receipt_id' => $id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);
            #============================= update into Students Accounts  ======================================
            $fund_accounts = StudentAccount::where('receipt_id', $id)->first();
            $fund_accounts->update([
                'date' => date('Y-m-d'),
                'type' => 'receipt',
                'student_id' => $request->student_id,
                'fee_invoice_id' => null,
                'receipt_id' => $id,
                'debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('admin.Receipts.index');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error_receipts' => $e->getMessage()]);
        }
    }

  /**
   * @inheritDoc
   */
  public function destroy($id) {
    ReceiptStudent::destroy($id);
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('admin.Receipts.index');
  }

  /**
   * @inheritDoc
   */
  public function edit($id) {
  }

  /**
   * @inheritDoc
   */


  /**
   * @inheritDoc
   */
  public function show($id) {
  }

  /**
   * @inheritDoc
   */


  /**
   * @inheritDoc
   */

}
