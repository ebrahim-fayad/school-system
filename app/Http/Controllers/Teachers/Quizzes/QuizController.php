<?php

namespace App\Http\Controllers\Teachers\Quizzes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Quizzes\QuizRequest;
use App\Interface\Teachers\Quizzes\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{private $Quiz;
    public function __construct(QuizRepositoryInterface $Quiz ) {
        $this->Quiz = $Quiz;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Quiz->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Quiz->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizRequest $request)
    {
        return $this->Quiz->store($request);
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
        return $this->Quiz->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizRequest $request, string $id)
    {
        return $this->Quiz->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->Quiz->destroy($id);
    }
}
