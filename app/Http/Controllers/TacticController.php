<?php

namespace App\Http\Controllers;

use App\Models\Tactic;

class TacticController extends Controller
{
    public function index()
    {
        $tactics = Tactic::all();
        return view('tactics', compact('tactics'));
    }
}
