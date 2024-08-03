<?php
namespace App\Interface\Students;

interface StudentRepositoryInterface{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function show($id);
    public function update($request,$id);
    public function destroy($id);
    public function getSections($id);
    public function uploadStudentAttachment($request,$id);
    public function getProductImages($id);
    public function deleteStudentAttachment($id);
    public function downloadAttachments($id);
    public function showAttachments($id);
    public function deleteAttachments($id);
}
