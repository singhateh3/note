<?php

namespace App\Http\Controllers;

use App\Http\Requests\noteStoreRequest;
use App\Http\Requests\noteupdateRequest;
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

    public function store(noteStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        Note::create($validated);
        return redirect()->route('notes.index')->with('success', 'Note created successfully');
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

    public function update(noteupdateRequest $request, $id)
    {
        $validated = $request->validated();

        Note::find($id)->update($validated);
        return redirect()->route('notes.index')->with('success', 'Note updated successfully');
    }
    public function destroy($id)
    {
        Note::find($id)->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully');
    }
}
