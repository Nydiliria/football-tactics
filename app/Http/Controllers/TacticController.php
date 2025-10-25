<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tactic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TacticController extends Controller
{
    public function index(Request $request)
    {
        $query = Tactic::query()->with('category');

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $tactics = $query->latest()->get();
        $categories = Category::all();

        return view('tactics.tactics', compact('tactics', 'categories'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        $fields = [
            'title' => ['type' => 'text'],
            'description' => ['type' => 'textarea'],
            'formation' => ['type' => 'text'],
            'category_id' => [
                'type' => 'select',
                'options' => $categories,
                'value' => old('category_id')
            ],
            'image' => ['type' => 'file']
        ];

        return view('tactics.create', compact('fields'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'formation' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('tactics', 'public');
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
        $categories = Category::pluck('name', 'id');

        $fields = [
            'title' => ['type' => 'text', 'value' => $tactic->title],
            'description' => ['type' => 'textarea', 'value' => $tactic->description],
            'formation' => ['type' => 'text', 'value' => $tactic->formation],
            'category_id' => [
                'type' => 'select',
                'options' => $categories,
                'value' => $tactic->category_id
            ],
            'image' => ['type' => 'file']
        ];

        return view('tactics.edit', compact('fields', 'tactic'));
    }

    public function update(Request $request, Tactic $tactic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'formation' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('image')) {
            if ($tactic->image_url && !preg_match('/^https?:\/\//', $tactic->image_url)) {
                Storage::disk('public')->delete($tactic->image_url);
            }

            $data['image_url'] = $request->file('image')->store('tactics', 'public');
        }

        $tactic->update($data);

        return redirect()->route('tactics.index')->with('success', 'Tactic updated successfully.');
    }


    public function destroy(Tactic $tactic)
    {
        if ($tactic->image_url && !preg_match('/^https?:\/\//', $tactic->image_url)) {
            Storage::disk('public')->delete($tactic->image_url);
        }

        $tactic->delete();

        return redirect()->route('tactics.index')->with('success', 'Tactic deleted successfully.');
    }
}
