<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);

        return view('home')->with([
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'salary' => 'required',
            'image' => [
                'nullable',
                'mimes:png,jpg,jpeg',
                'max:2048'
            ]
        ]);

        $user = auth()->user();

        $post = new Post();
        $post->name = $request->name;
        $post->age = $request->age;
        $post->salary = $request->salary;

        if ($request->hasFile('image')) {
            // Upload the new image if provided
            $file = $request->file('image');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_name);

            // Delete the old image if it exists
            if ($post->image) {
                $old_image_path = public_path('uploads') . '/' . $post->image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            $post->image = $image_name;
        }

        $post->user_id = $user->id;
        $post->save();

        return redirect('home')->with([
            'success' => 'added'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('edit')->with([
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'salary' => 'required',
            'image' => [
                'mimes:png,jpg,jpeg',
                'max:2048'
            ]
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')) {
            // Upload the new image if provided
            $file = $request->file('image');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_name);

            // Delete the old image if it exists
            if ($post->image) {
                $old_image_path = public_path('uploads') . '/' . $post->image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            $post->image = $image_name;
        }

        $post->name = $request->name;
        $post->age = $request->age;
        $post->salary = $request->salary;
        $post->user_id2 = $user->id;

        // Check if any data has changed
        if ($post->isDirty()) {
            $post->save();
            return redirect('home')->with([
                'success' => 'Updated'
            ]);
        } else {
            return redirect('home')->with([
                'info' => 'No changes made'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!empty($post->image)) {
            $imagePath = public_path('uploads') . '/' . $post->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();

        return redirect('home')->with([
            'delete' => 'User Deleted'
        ]);
    }
}
