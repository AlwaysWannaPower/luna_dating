<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseController extends Controller
{
    public function index(Request $request): View
    {
        $currentUser = auth()->user();

        $query = User::query()
            ->where('id', '!=', $currentUser->id)
            ->when($request->gender, fn ($q) => $q->where('gender', $request->gender))
            ->when($request->city, fn ($q) => $q->where('city', 'ilike', "%{$request->city}%"))
            ->when($request->min_age, fn ($q) => $q->whereRaw('extract(year from age(birth_date)) >= ?', $request->min_age))
            ->when($request->max_age, fn ($q) => $q->whereRaw('extract(year from age(birth_date)) <= ?', $request->max_age))
            ->when($request->search, fn ($q) => $q->where(fn ($q2) => $q2->where('name', 'ilike', "%{$request->search}%")->orWhere('city', 'ilike', "%{$request->search}%")));

        $likedUserIds = $currentUser->likesSent()->pluck('to_user_id')->toArray();

        $users = $query->paginate(12)->withQueryString();
        $filters = $request->except('page');

        // Add liked flag to each user without N+1 query
        $users->getCollection()->each(function ($user) use ($likedUserIds) {
            $user->is_liked = in_array($user->id, $likedUserIds);
        });

        return view('browse.index', compact('users', 'filters'));
    }
}
