<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();
        $ratings = $user->ratings();

        if ($search) {
            $ratings->where('rating_value', 'like', '%' . $search . '%');
        }

        $ratings = $ratings->paginate(4); // 4 items per page

        return view('ratings.list', compact('ratings'));
    }

    public function create()
    {
        $user = auth()->user();

    // Check if the user has already rated
    if ($user->ratings->count() > 0) {
        return redirect()->back()->with('alreadyRated', true);
    } 
    return view('ratings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating_value' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:10000',
        ]);

        // Create a new rating
        $rating = new Rating();
        $rating->user_id = auth()->user()->id;
        $rating->rating_value = $request->input('rating_value');
        $rating->comments = $request->input('comments');
        $rating->save();

        return redirect()->route('ratings.index')->with('success', 'Rating created successfully.');
    }

    public function show($id)
    {
        // Retrieve the rating using the given $id only if it belongs to the authenticated user.
        $rating = auth()->user()->ratings()->find($id);

        if (!$rating) {
            // Rating doesn't exist or doesn't belong to the user.
            return abort(404);
        }

        return view('ratings.show', compact('rating'));
    }

    public function edit($id)
    {
        $rating = Rating::findOrFail($id);
        return view('ratings.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);

        $validatedData = $request->validate([
            'rating_value' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:10000',
        ]);

        // Update the rating
        $rating->rating_value = $request->input('rating_value');
        $rating->comments = $request->input('comments');
        $rating->save();

        return redirect()->route('ratings.index')->with('success', 'Rating updated successfully.');
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);

        // Delete the rating
        $rating->delete();

        return redirect()->route('ratings.index')->with('success', 'Rating deleted successfully.');
    }
}
