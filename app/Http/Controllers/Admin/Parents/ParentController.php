<?php

namespace App\Http\Controllers\Admin\Parents;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $my_parents = MyParent::all();
        return view('Admin.MyParents.all-parents',compact('my_parents'));
    }
}
