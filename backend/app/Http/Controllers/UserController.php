<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'  => 'sometimes|string|max:100',
            'phone' => 'sometimes|nullable|string|max:20',
            'city'  => 'sometimes|nullable|string|max:100',
            'bio'   => 'sometimes|nullable|string|max:1000',
        ]);

        $user->update($data);

        return new UserResource($user->fresh());
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = $request->user();

        if ($user->avatar_url) {
            $oldPath = str_replace('/storage/', 'public/', $user->avatar_url);
            Storage::delete($oldPath);
        }

        $path = $request->file('avatar')->store('public/avatars');
        $url  = str_replace('public/', '/storage/', $path);

        $user->update(['avatar_url' => $url]);

        return new UserResource($user->fresh());
    }
}
