<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Interface\Students\StudentGraduationRepositoryInterface;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    private $Graduation;
    public function __construct(StudentGraduationRepositoryInterface $Graduation)
    {
        $this->Graduation = $Graduation;
    }
    public function index()
    {
        return $this->Graduation->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Graduation->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Graduation->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return  $this->Graduation->restore($id);
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
    public function destroy(string $id)
    {
        return $this->Graduation->destroy($id);
    }
}
