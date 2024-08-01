<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeacherRequest;
use App\Interface\Teachers\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher ) {
        $this->Teacher = $Teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Teacher->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Teacher->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        return $this->Teacher->store($request);
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
        return $this->Teacher->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {
        return $this->Teacher->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Teacher->destroy($id);
    }
}
