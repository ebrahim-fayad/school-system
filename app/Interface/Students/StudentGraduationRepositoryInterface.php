<?php
namespace App\Interface\Students;

interface StudentGraduationRepositoryInterface{
    public function index();

    public function create();
    public function store($request);
    public function restore($id);
    public function destroy($id);
}
