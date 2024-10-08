<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Interface\Students\StudentPromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private $Promotion;
    public function __construct(StudentPromotionRepositoryInterface $Promotion ) {
        $this->Promotion = $Promotion;
    }
    public function index()
    {
        return $this->Promotion->index();
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
        return $this->Promotion->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Promotion->show();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        return $this->Promotion->destroy($request,$id);
    }
}
