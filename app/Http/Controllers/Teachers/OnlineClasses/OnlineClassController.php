<?php

namespace App\Http\Controllers\Teachers\OnlineClasses;

use App\Http\Controllers\Controller;
use App\Interface\Teachers\onlineClasses\OnlineClassRepositoryInterface;
use Illuminate\Http\Request;

class OnlineClassController extends Controller
{
 private $OnlineClass;
    public function __construct(OnlineClassRepositoryInterface $OnlineClass)
    {
        $this->OnlineClass = $OnlineClass;
    }
    public function index()
    {
        return $this->OnlineClass->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->OnlineClass->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->OnlineClass->store($request);
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
        return $this->OnlineClass->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->OnlineClass->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->OnlineClass->destroy($id);
    }
}
