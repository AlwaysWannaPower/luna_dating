<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseController extends Controller
{
    /**
     * Swipe page view - returns the empty container for Alpine.js to populate.
     */
    public function index(Request $request): View
    {
        return view('browse.index');
    }

    /**
     * Get the next swipe card via AJAX.
     */
    public function nextCard(Request $request): JsonResponse
    {
        $currentUser = $request->user();

        // Build query based on user's profile preferences
        $query = User::query()
            ->where('users.id', '!=', $currentUser->id)
            // Exclude users already liked by current user
            ->whereNotIn('users.id', function ($q) use ($currentUser) {
                $q->select('to_user_id')
                    ->from('likes')
                    ->where('from_user_id', $currentUser->id);
            })
            // Exclude users that were skipped
            ->whereNotIn('users.id', function ($q) use ($currentUser) {
                $q->select('to_user_id')
                    ->from('skips')
                    ->where('from_user_id', $currentUser->id);
            })
            // Filter by gender preference
            ->when($currentUser->looking_for && $currentUser->looking_for !== 'both', function ($q) use ($currentUser) {
                $q->where('gender', $currentUser->looking_for);
            })
            // Age range filter from profile preferences
            ->when($currentUser->age_min, function ($q) use ($currentUser) {
                $q->whereRaw('extract(year from age(users.birth_date)) >= ?', [$currentUser->age_min]);
            })
            ->when($currentUser->age_max, function ($q) use ($currentUser) {
                $q->whereRaw('extract(year from age(users.birth_date)) <= ?', [$currentUser->age_max]);
            });

        // Optional city filter
        if ($request->filled('city')) {
            $query->where('city', 'ilike', "%{$request->city}%");
        }

        $card = $query->inRandomOrder()->first();

        if (!$card) {
            return response()->json([
                'data' => null,
                'hasMore' => false,
            ]);
        }

        return response()->json([
            'data' => [
                'id' => $card->id,
                'name' => $card->name,
                'age' => $card->age,
                'city' => $card->city,
                'bio' => $card->bio,
                'avatar' => $card->avatar ? asset('storage/' . $card->avatar) : null,
            ],
            'hasMore' => true,
        ]);
    }

    /**
     * Save a skip action.
     */
    public function storeSkip(Request $request): JsonResponse
    {
        $currentUser = $request->user();
        
        \App\Models\Skip::create([
            'from_user_id' => $currentUser->id,
            'to_user_id' => $request->input('to_user_id'),
        ]);

        return response()->json(['success' => true]);
    }
}
