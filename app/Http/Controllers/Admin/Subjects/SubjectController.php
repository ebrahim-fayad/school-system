<?php

namespace App\Http\Controllers\Admin\Subjects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectRequest;
use App\Interface\Subjects\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
  private $Subject;
    public function __construct(SubjectRepositoryInterface $Subject)
    {
        $this->Subject = $Subject;
    }
    public function index()
    {
        return $this->Subject->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Subject->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        return $this->Subject->store($request);
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
        return $this->Subject->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, string $id)
    {
        return $this->Subject->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Subject->destroy($id);
    }
}
