<?php

namespace App\Http\Controllers;

use App\Models\Tactic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TacticController extends Controller
{
    public function index()
    {
        $tactics = Tactic::latest()->paginate(12);
        return view('tactics.tactics', compact('tactics'));
    }

    public function create()
    {
        return view('tactics.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'formation' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120'
        ]);

        // Image_url naar path
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tactics', 'public'); // public/storage/tactics/...
            $data['image_url'] = $path;
        }

        Tactic::create($data);

        return redirect()->route('tactics.index')->with('success', 'Tactic created successfully.');
    }

    public function show(Tactic $tactic)
    {
        return view('tactics.show', compact('tactic'));
    }

    public function edit(Tactic $tactic)
    {
        return view('tactics.edit', compact('tactic'));
    }

    public function update(Request $request, Tactic $tactic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'formation' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('image')) {
            // verwijder lokaal opgeslagen file
            if ($tactic->image_url && !preg_match('/^https?:\/\//', $tactic->image_url)) {
                Storage::disk('public')->delete($tactic->image_url);
            }

            $path = $request->file('image')->store('tactics', 'public');
            $data['image_url'] = $path;
        }

        $tactic->update($data);

        return redirect()->route('tactics.index')->with('success', 'Tactic updated.');
    }

    public function destroy(Tactic $tactic)
    {
        if ($tactic->image_url && !preg_match('/^https?:\/\//', $tactic->image_url)) {
            Storage::disk('public')->delete($tactic->image_url);
        }

        $tactic->delete();
        return redirect()->route('tactics.index')->with('success', 'Tactic deleted.');
    }
}
