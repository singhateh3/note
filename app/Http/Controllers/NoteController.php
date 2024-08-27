<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notes = $user->notes;
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',

        ]);
        $validated['user_id'] = Auth::id();
        Note::create($validated);
        return redirect()->route('notes.index');
    }

    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show', compact('note'));
    }

    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit', compact('note'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required||id'

        ]);
        Note::find($id)->update($validated);
        return redirect()->route('notes.index');
    }
    public function destroy($id)
    {
        Note::find($id)->delete();
        return redirect()->route('notes.index');
    }
}
