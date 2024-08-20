<?php

namespace App\Http\Controllers\Admin\Receipts;

use App\Http\Controllers\Controller;
use App\Interface\Receipts\ReceiptStudentRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    private $ReceiptStudent;
    public function __construct(ReceiptStudentRepositoryInterface $ReceiptStudent)
    {
        $this->ReceiptStudent = $ReceiptStudent;
    }
    public function index()
    {
        return $this->ReceiptStudent->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->ReceiptStudent->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->ReceiptStudent->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->ReceiptStudent->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->ReceiptStudent->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->ReceiptStudent->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->ReceiptStudent->destroy($id);
    }
}
