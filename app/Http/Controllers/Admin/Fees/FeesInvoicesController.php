<?php

namespace App\Http\Controllers\Admin\Fees;

use App\Http\Controllers\Controller;
use App\Interface\Fees\FeesInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeesInvoicesController extends Controller
{
    private $FeesInvoices;
    public function __construct(FeesInvoicesRepositoryInterface $FeesInvoices)
    {
        $this->FeesInvoices = $FeesInvoices;
    }
    public function index()
    {
        return $this->FeesInvoices->index();
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
    public function store(Request $request)
    {
        return $this->FeesInvoices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->FeesInvoices->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->FeesInvoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->FeesInvoices->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->FeesInvoices->destroy($id);
    }
}
