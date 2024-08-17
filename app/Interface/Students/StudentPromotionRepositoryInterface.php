<?php
namespace App\Interface\Students;

interface StudentPromotionRepositoryInterface{
    public function index();
    
    public function store($request);
}
