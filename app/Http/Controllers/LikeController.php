<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LikeController extends Controller
{
    public function index(Request $request): View
    {
        $likes = $request->user()
            ->likesSent()
            ->with('toUser')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('likes.index', compact('likes'));
    }

    public function store(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id || $request->user()->hasLiked($user)) {
            return back();
        }

        $like = Like::create([
            'from_user_id' => $request->user()->id,
            'to_user_id' => $user->id,
        ]);

        // Проверяем взаимный лайк и создаём match
        $wasLikedByMe = Like::where('from_user_id', $user->id)
            ->where('to_user_id', $request->user()->id)
            ->exists();

        if ($wasLikedByMe) {
            // Создаём match (логика для спринта 4)
            // В будущем: Match::create([...])
        }

        return back();
    }

    public function destroy(Like $like): RedirectResponse
    {
        if ($like->from_user_id !== auth()->id()) {
            abort(403);
        }

        $like->delete();

        return back();
    }
}
