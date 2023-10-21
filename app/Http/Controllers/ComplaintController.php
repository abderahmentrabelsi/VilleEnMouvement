<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();
        $complaints = $user->complaints();
    
        if ($search) {
            $complaints->where('title', 'like', '%' . $search . '%');
        }
    
        $complaints = $complaints->paginate(4); // 4 items per page
    
        return view('complaints.list', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('screenshot')) {
        $screenshotPath = $request->file('screenshot')->store('screenshots', 'public');
        $validatedData['screenshot'] = $screenshotPath;
    }

    // Log the user ID
    $user = auth()->user();
    $user_id = $user->id;

    // Associate the user_id with the complaint
    $validatedData['user_id'] = $user_id;

    Complaint::create($validatedData);

    return redirect()->route('complaints.index')
        ->with('success', 'Complaint created successfully.');
}


    public function show($id)
    {
        // Retrieve the complaint using the given $id only if it belongs to the authenticated user.
        $complaint = auth()->user()->complaints()->find($id);
    
        if (!$complaint) {
            // Complaint doesn't exist or doesn't belong to the user.
            return abort(404);
        }
    
        return view('complaints.show', compact('complaint'));
    }

    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('complaints.edit', compact('complaint'));
    }

    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('screenshots', 'public');
            $validatedData['screenshot'] = $screenshotPath;
        }

        $complaint->update($validatedData);

        return redirect()->route('complaints.index')
            ->with('success', 'Complaint updated successfully.');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);

        // Delete the associated screenshot file (if it exists)
        if (!empty($complaint->screenshot)) {
            Storage::disk('public')->delete($complaint->screenshot);
        }

        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success', 'Complaint deleted successfully.');
    }
}
