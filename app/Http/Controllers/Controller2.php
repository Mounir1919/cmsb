<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Controller2 extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin || auth()->user()->is_admin3 || auth()->user()->is_admin2) {
            $softDeletedUserCount = Post::onlyTrashed()->count();
            $posts = Post::latest()->paginate(10);
            return view('home')->with([
                'posts' => $posts,
                'softDeletedUserCount' => $softDeletedUserCount,
            ]);
        }
    
        return redirect()->back();
    }
    
    public function index2()
    {
        
            if (auth()->user()->is_admin || auth()->user()->is_admin3) {
                $deletedUsers = Post::onlyTrashed()
                ->latest('deleted_at')
                ->paginate(10);
                    
                return view('DeletedUsers')->with('deletedUsers', $deletedUsers);
            }
        
            return redirect()->back();
        }
    public function show($id)
    {
        if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3 || auth()->user()->is_admin2)) {
            $post = Post::find($id);
            return view('show')->with(['post' => $post]);
        }
        
        return redirect()->back(); 
    }
    public function show2($id)
    {
        if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3 || auth()->user()->is_admin2)) {
            $del = Post::onlyTrashed()->find($id);
            return view('showdeleted')->with(['del' => $del]);
        }
        
        return redirect()->back(); 
    }
    
public function create()
{
    if(auth()->user()->is_admin || auth()->user()->is_admin3){
        return view('create');
    }
    return redirect()->back();
}
public function admin()
{
        return view('admin');
    
}
public function tables()
{
    if (auth()->user()->is_admin || auth()->user()->is_admin3 || auth()->user()->is_admin2) {
        $softDeletedUserCount = Post::onlyTrashed()->count();
        $posts = Post::latest()->paginate(5);
        return view('tables')->with([
            'posts' => $posts,
            'softDeletedUserCount' => $softDeletedUserCount,
        ]);
}
}
public function store(Request $request)
{
    if (auth()->user()->is_admin || auth()->user()->is_admin3) {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'salary' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
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
    
    return redirect()->back();
}

public function edit($id)
{
    if(auth()->user()->is_admin || auth()->user()->is_admin3){

    $post = Post::find($id);
    return view('edit')->with([
        'post'=>$post
    ]);
}
return redirect()->back();
}
public function update(Request $request, $id)
{
    if(auth()->user()->is_admin || auth()->user()->is_admin3){
    $validated = $request->validate([
        'name' => 'required',
        'age' => 'required',
        'salary' => 'required',
        'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',

        ]);
$user= auth()->user();
    $post = Post::find($id);
    if (!$post) {
        $post = new Post();
    }

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
return redirect()->back();

}
public function delete($id)
{
    if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3)) {
        $user = auth()->user();
        $post = Post::findOrFail($id);

        if ($post) {
            $post->user_id3 = $user->id;
            $post->save(); // Save the user_id3 value before soft deleting

            $post->delete(); // Soft delete the post

            return redirect('home')->with([
                'delete' => 'Post Deleted'
            ]);
        }
    }

    return redirect()->back();
}
public function perma($id)
{
    if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3)) {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post) {
            $imagePath = public_path('uploads') . '/' . $post->image;
            if ($post->image && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $post->forceDelete();

            return redirect('deleted')->with([
                'delete2' => 'User Deleted Permanently'
            ]);
        }
    }

    return redirect()->back();
}
public function permaall()
{
    if (auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3)) {
        $posts = Post::onlyTrashed()->get();

        foreach ($posts as $post) {
            $imagePath = public_path('uploads') . '/' . $post->image;
            if ($post->image && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $post->forceDelete();
        }

        return redirect('home')->with([
            'delete3' => 'All Users Have Been Deleted Permanently'
        ]);
    }

    return redirect()->back();
}




public function restore($id){
    if(auth()->user()->is_admin || auth()->user()->is_admin3){

    $post= Post::withTrashed()->where('id',$id)->first();
    $post->restore();
    $message = 'User "' . $post->name . '" Restored';
    return redirect('home ')->with([
        'restored'=>$message
    ]);
}
return redirect()->back();

}
public function restoreall(){
    if(auth()->user()->is_admin || auth()->user()->is_admin3){

    $post= Post::onlyTrashed()->restore();
    return redirect('home ')->with([
        'restoreall'=>'All Users has been Restored'
    ]);
}
return redirect()->back();

}
public function deleteMultiple(Request $request)
{
    if(auth()->user()->is_admin || auth()->user()->is_admin3){

    $selectedIds = $request->input('selected_ids', []);
    $user = auth()->user();

    foreach ($selectedIds as $postId) {
        // Use soft delete to delete the post
        $post = Post::find($postId);
        $post->user_id3 = $user->id;
        $post->save(); // Save the user_id3 value before soft deleting

        $post->delete();
    }
    }
    return redirect()->back()->with('success', 'Selected posts deleted successfully');
}

}
