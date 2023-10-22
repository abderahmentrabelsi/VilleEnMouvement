<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
   
    public function index()
    {
        $posts=Post::all();
        return view('posts.list', compact('posts'));
    }

    
    public function create()
    {
        
        return view('posts.create');
          
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        // Get the currently authenticated user's ID
        $validatedData['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        }

        Post::create($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

   
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.list', ['posts' => Post::orderBy('created_at', 'desc')->paginate(10), 'editing_post_id' => $post->id]);
    }

   
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required|max:255',
    ]);

    $post->title = $validatedData['title'];
    $post->content = $validatedData['content'];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $validatedData['image'] = 'images/' . $imageName;
        $post->image = $validatedData['image'];
    }


    $post->save();

    return redirect()->route('posts.index')
        ->with('success', 'Post updated successfully.');
    }

   
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

       
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
    
}
