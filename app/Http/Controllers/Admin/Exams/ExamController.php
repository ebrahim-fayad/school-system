<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamsRequest;
use App\Interface\Exams\ExamRepositoryInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private $Exam;
    public function __construct(ExamRepositoryInterface $Exam)
    {
        $this->Exam = $Exam;
    }
    public function index()
    {
        return $this->Exam->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Exam->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamsRequest $request)
    {
        return $this->Exam->store($request);
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
        return $this->Exam->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamsRequest $request, string $id)
    {
        return $this->Exam->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Exam->destroy($id);
    }
}
