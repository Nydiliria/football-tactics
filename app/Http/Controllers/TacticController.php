<?php

namespace App\Http\Controllers;

use App\Models\Tactic;

class TacticController extends Controller
{
    public function index()
    {
        // Get all tactics from the database
        $tactics = Tactic::all();

        // Pass them to the view
        return view('tactics', compact('tactics'));
    }
}


