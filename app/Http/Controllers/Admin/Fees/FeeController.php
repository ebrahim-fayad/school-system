<?php

namespace App\Http\Controllers\Admin\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeesRequest;
use App\Interface\Fees\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    private $Fees;
    public function __construct(FeesRepositoryInterface $Fees)
    {
        $this->Fees = $Fees;
    }
    public function index()
    {
        return $this->Fees->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Fees->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeesRequest $request)
    {
        return $this->Fees->store($request);
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
        return $this->Fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeesRequest $request, string $id)
    {
        return $this->Fees->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Fees->destroy($id);
    }
}
