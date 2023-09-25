<?php

/**
 * @author      Adres Pranata
 * @email       adrespranata0201@gmail.com
 * @copyright   2023
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        return response()->json(['data' => $user], 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:editor,biasa',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        $user->save();

        $response = [
            'user' => $user,
            'message'=> 'Pengguna telah dibuat'
        ];

        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
            'role' => 'required|in:editor,biasa',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        $response = [
            'user' => $user,
            'message'=> 'Data pengguna telah diperbarui'
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Pengguna telah dihapus'], 200);
    }
}
