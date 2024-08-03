<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Interface\Students\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $Student;
    public function __construct(StudentRepositoryInterface $Student ) {
        $this->Student = $Student;
    }
    public function index()
    {
        return $this->Student->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        return $this->Student->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Student->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Student->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        return $this->Student->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Student->destroy($id);
    }
    public function getSections($id)
    {
      return $this->Student->getSections($id);
    }
    public function uploadStudentAttachment(Request $request,$id)
    {
        return $this->Student->uploadStudentAttachment($request,$id);
    }
    public function getProductImages($id)
    {
        return $this->Student->getProductImages($id);
    } //
    public function deleteStudentAttachment($id)
    {
        return $this->Student->deleteStudentAttachment($id);
    }
    public function downloadAttachments($id)
    {
        return $this->Student->downloadAttachments($id);
    }
    public function showAttachments($id)
    {
        return $this->Student->showAttachments($id);
    }
    public function deleteAttachments($id)
    {
        return $this->Student->deleteAttachments($id);
    }
}
