<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Interface\Attendance\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $Attendance;
    public function __construct(AttendanceRepositoryInterface $Attendance)
    {
        $this->Attendance = $Attendance;
    }
    public function index()
    {
        return $this->Attendance->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Attendance->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Attendance->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Attendance->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Attendance->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Attendance->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Attendance->destroy($id);
    }
}
