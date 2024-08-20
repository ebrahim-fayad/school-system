<?php

namespace App\Http\Controllers\Admin\ProcessingFees;

use App\Http\Controllers\Controller;
use App\Interface\ProcessingFees\ProcessingFeesRepositoryInterface;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    private $ProcessingFee;
    public function __construct(ProcessingFeesRepositoryInterface $ProcessingFee)
    {
        $this->ProcessingFee = $ProcessingFee;
    }
    public function index()
    {
        return $this->ProcessingFee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->ProcessingFee->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->ProcessingFee->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->ProcessingFee->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->ProcessingFee->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->ProcessingFee->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->ProcessingFee->destroy($id);
    }
}
