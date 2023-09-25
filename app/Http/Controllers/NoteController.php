<?php

/**
 * @author      Adres Pranata
 * @email       adrespranata0201@gmail.com
 * @copyright   2023
 */

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $notes = Note::all();
        } else {
            $notes = $user->notes;
        }

        return response()->json(['data' => $notes], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $user = Auth::user();
        $note = new Note([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        $user->notes()->save($note);

        $response = [
            'note' => $note,
            'message'=> 'Catatan telah dibuat'
        ];

        return response()->json($response, 201);
    }

    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Catatan tidak ditemukan'], 404);
        }

        $user = Auth::user();
        if ($user->id === $note->user_id) {
            return response()->json(['data' => $note], 200);
        } else {
            return response()->json(['message' => 'Tidak diizinkan'], 403);
        }
    }

    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Catatan tidak ditemukan'], 404);
        }

        $user = Auth::user();
        if ($user->id === $note->user_id) {
            $this->validate($request, [
                'title' => 'required|string',
                'content' => 'required|string',
            ]);

            $note->title = $request->input('title');
            $note->content = $request->input('content');
            $note->save();

            return response()->json(['message' => 'Catatan telah diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Tidak diizinkan'], 403);
        }
    }

    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['message' => 'Catatan tidak ditemukan'], 404);
        }

        $user = Auth::user();
        if ($user->id === $note->user_id) {
            $note->delete();

            return response()->json(['message' => 'Catatan telah dihapus'], 200);
        } else {
            return response()->json(['message' => 'Tidak diizinkan'], 403);
        }
    }
}
