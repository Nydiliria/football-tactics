<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tactic;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TacticController extends Controller
{
    public function __construct()
    {
        // Alleen ingelogde gebruikers kunnen create/update/delete
        $this->middleware('auth')->except(['index', 'show']);

        // Admin kan goedkeuren
        $this->middleware('admin')->only(['approve']);
    }

    /**
     * Toon alle tactics. Gewone users zien alleen goedgekeurde tactics.
     */
    public function index(Request $request)
    {
        $query = Tactic::with('category');

        if (!auth()->check() || !auth()->user()->is_admin) {
            $userId = auth()->id();

            $query->where(function ($q) use ($userId) {
                $q->where('is_approved', true);

                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            });
        }

        // Filter op categorie als aanwezig
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Zoekfunctie
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $tactics = $query->latest()->get();
        $categories = Category::all();

        // dd($tactics->toArray());

        return view('tactics.tactics', compact('tactics', 'categories'));
    }

    /**
     * Formulier voor een nieuwe tactic
     */
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

    /**
     * Sla een nieuwe tactic op
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            abort(403, 'Je moet ingelogd zijn om een tactiek te maken.');
        }

        $loginCount = Login::where('user_id', auth()->id())->count();

        if ($loginCount < 3) {
            return redirect()
                ->route('tactics.index')
                ->with('error', 'Je moet minimaal 3 keer ingelogd zijn om een tactic aan te maken. (Huidige aantal: ' . $loginCount . ')');
        }

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

        $data['user_id'] = auth()->id();

        Tactic::create($data);

        return redirect()->route('tactics.index')->with('success', 'Tactic created successfully.');
    }

    /**
     * Toon één tactic
     */
    public function show(Tactic $tactic)
    {
        if (!$tactic->is_approved && (!auth()->check() ||
                (!auth()->user()->is_admin && auth()->id() !== $tactic->user_id))) {
            abort(403, 'Je mag deze tactic niet bekijken.');
        }

        return view('tactics.show', compact('tactic'));
    }

    /**
     * Formulier voor bewerken
     */
    public function edit(Tactic $tactic)
    {
        if (auth()->id() !== $tactic->user_id && !auth()->user()->is_admin) {
            abort(403, 'Je mag deze tactic niet bewerken.');
        }

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

    /**
     * Update tactic
     */
    public function update(Request $request, Tactic $tactic)
    {
        if (auth()->id() !== $tactic->user_id && !auth()->user()->is_admin) {
            abort(403, 'Je mag deze tactic niet updaten.');
        }

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

    /**
     * Verwijder tactic
     */
    public function destroy(Tactic $tactic)
    {
        if (auth()->id() !== $tactic->user_id && !auth()->user()->is_admin) {
            abort(403, 'Je mag deze tactic niet verwijderen.');
        }

        if ($tactic->image_url && !preg_match('/^https?:\/\//', $tactic->image_url)) {
            Storage::disk('public')->delete($tactic->image_url);
        }

        $tactic->delete();

        return redirect()->route('tactics.index')->with('success', 'Tactic deleted successfully.');
    }

    /**
     * Admin kan tactics goedkeuren of afkeuren
     */
    public function approve(Tactic $tactic)
    {
        $tactic->update(['is_approved' => !$tactic->is_approved]);

        return redirect()->back()->with('success', 'Tactic status bijgewerkt.');
    }

    public function adminIndex(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = Tactic::with(['category', 'user']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $tactics = $query->latest()->get();
        $categories = Category::all();

        return view('tactics.admin', compact('tactics', 'categories'));
    }
}
