<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\unconfirmed_users;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;

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

public function mamado()
{
        return view('_mamado');
    
}




public function admin()
{
    // Count the total number of posts
    $userCount = Post::count();
    $userunconfirmed = unconfirmed_users::count();

    // Count the number of posts in the trash (soft deleted)
    $userTrash = Post::onlyTrashed()->count();
    
    // Retrieve the monthly registrations data
    $registrations = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as created_count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Retrieve the monthly deleted registrations data
    $deletedRegistrations = Post::onlyTrashed()
        ->selectRaw('MONTH(deleted_at) as month, COUNT(*) as deleted_count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Retrieve the monthly unconfirmed users data
    $unconfirmedUsers = unconfirmed_users::selectRaw('MONTH(created_at) as month, COUNT(*) as created_count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Initialize arrays to store labels, created data, deleted data, and unconfirmed users data
    $labels = [];
    $createdData = [];
    $deletedData = [];
    $unconfirmedUsersData = [];

    // Loop through each month (from 1 to 12) to populate the data arrays
    for ($month = 1; $month <= 12; $month++) {
        // Get the month name based on the month number
        $monthName = date('F', mktime(0, 0, 0, $month, 1));
        $labels[] = $monthName;

        // Find the registration data for the current month
        $registration = $registrations->firstWhere('month', $month);

        // Find the deleted registration data for the current month
        $deletedRegistration = $deletedRegistrations->firstWhere('month', $month);

        // Find the unconfirmed users data for the current month
        $unconfirmedUser = $unconfirmedUsers->firstWhere('month', $month);

        // Store the count of created registrations for the current month, or 0 if not found
        $createdData[] = $registration ? $registration->created_count : 0;

        // Store the count of deleted registrations for the current month, or 0 if not found
        $deletedData[] = $deletedRegistration ? $deletedRegistration->deleted_count : 0;

        // Store the count of unconfirmed users for the current month, or 0 if not found
        $unconfirmedUsersData[] = $unconfirmedUser ? $unconfirmedUser->created_count : 0;
    }

    // Return a view called 'admin' with the necessary data passed to it
    return view('admin')->with([
        'userCount' => $userCount,
        'userTrash' => $userTrash,
        'labels' => $labels,
        'createdData' => $createdData,
        'deletedData' => $deletedData,
        'userunconfirmed' => $userunconfirmed,
        'unconfirmedUsersData' => $unconfirmedUsersData,
    ]);
}

public function tables()
{
    if (auth()->user()->is_admin || auth()->user()->is_admin3 || auth()->user()->is_admin2) {
        $softDeletedUserCount = Post::onlyTrashed()->count();
        $posts = Post::all();
        
        if (auth()->user()->is_admin || auth()->user()->is_admin3) {
            $deletedUsers = Post::onlyTrashed()->get();
            return view('tables')->with([
                'posts' => $posts,
                'softDeletedUserCount' => $softDeletedUserCount,
                'deletedUsers' => $deletedUsers,
            ]);
        }

        return view('tables')->with([
            'posts' => $posts,
            'softDeletedUserCount' => $softDeletedUserCount,
        ]);
    }
    
    return redirect()->back();
}

public function store(Request $request)
{
    if (auth()->user()->is_admin || auth()->user()->is_admin3) {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'salary' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'Gender' => 'required',
        ]);

        $user = auth()->user();

        // Create a new unconfirmed user record
        $unconfirmedUser = new unconfirmed_users();
        $unconfirmedUser->name = $request->name;
        $unconfirmedUser->age = $request->age;
        $unconfirmedUser->salary = $request->salary;
        $unconfirmedUser->Status = 'Not Confirmed';
        $unconfirmedUser->user_id = $user->id;
        $unconfirmedUser->Gender = $request->Gender;
        
        if ($request->hasFile('image')) {
            // Upload the new image if provided
            $file = $request->file('image');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_name);
            
            // Delete the old image if it exists
            if ($unconfirmedUser->image) {
                $old_image_path = public_path('uploads') . '/' . $unconfirmedUser->image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
    
            $unconfirmedUser->image = $image_name;
        }

        $unconfirmedUser->save();

        // Send notification to the user if the status is 'Not Confirmed'
        if ($unconfirmedUser->Status === 'Not Confirmed') {
            $unconfirmedUserId = $unconfirmedUser->id;
            $unconfirmedUsername = $unconfirmedUser->name;
            $unconfirmedUserimage = $unconfirmedUser->image ?? '';
            $unconfirmedUsergender = $unconfirmedUser->Gender;
            // Set default value if image is not set
            Notification::send($user, new NewUserNotification($unconfirmedUserId, $unconfirmedUsername, $unconfirmedUserimage,$unconfirmedUsergender));
        }

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

            return redirect('tables')->with([
                'delete' => 'User Deleted Temporary'
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

            return redirect('tables')->with([
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

        return redirect('tables')->with([
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
    return redirect('tables ')->with([
        'restored'=>$message
    ]);
}
return redirect()->back();

}
public function restoreall(){
    if(auth()->user()->is_admin || auth()->user()->is_admin3){

    $post= Post::onlyTrashed()->restore();
    return redirect('tables ')->with([
        'restoreall'=>'All Users has been Restored'
    ]);
}
return redirect()->back();

}

public function deleteMultiple(Request $request)
{
    if (auth()->user()->is_admin || auth()->user()->is_admin3) {
        $selectedIds = $request->input('selected_ids', []);
        $user = auth()->user();

        foreach ($selectedIds as $postId) {
            $post = Post::find($postId);

            if ($post) {
                $post->user_id3 = $user->id;
                $post->save(); // Save the user_id3 value before soft deleting

                $post->delete(); // Soft delete the post
            }
        }
    }

    return redirect()->back()->with('success', 'Selected posts deleted successfully');
}
public function downloadUsers()
{
    $uniqueIdentifier = uniqid(); // Generate a unique identifier

    $fileName = 'users_' . $uniqueIdentifier . '.xlsx'; // Append the unique identifier to the filename

    return Excel::download(new UsersExport(), $fileName);
}


public function confirmUser(Request $request, $id)
{
    $unconfirmedUser = unconfirmed_users::findOrFail($id);
    
    // Create a new post record
    $post = new Post();
    $post->name = $unconfirmedUser->name;
    $post->age = $unconfirmedUser->age;
    $post->salary = $unconfirmedUser->salary;
    $post->image = $unconfirmedUser->image;
    $post->status = 'Confirmed'; // corrected the capitalization of 'status'
    $post->Gender = $unconfirmedUser->Gender;

    // Set other attributes if needed
    $post->save();

    // Delete the unconfirmed user record
    $unconfirmedUser->delete();
    
    // Delete the notification for the specific unconfirmed user
    $notificationsToDelete = DB::table('notifications')
        ->where('data->unconfirmed_user_id', $id);    
    $notificationsToDelete->delete();

    return redirect('admin')->with([
        'success' => 'User confirmed and moved to posts',
    ]);
}
public function confirmed()
{
    if(auth()->user()->is_admin || auth()->user()->is_admin3){
        return view('confirmed');
    }
    return redirect()->back();
}
public function confirmAllUsers()
{
    $unconfirmedUsers = unconfirmed_users::all();

    foreach ($unconfirmedUsers as $unconfirmedUser) {
        // Create a new post record
        $post = new Post();
        $post->name = $unconfirmedUser->name;
        $post->age = $unconfirmedUser->age;
        $post->salary = $unconfirmedUser->salary;
        $post->image = $unconfirmedUser->image;
        $post->status = 'Confirmed'; // corrected the capitalization of 'status'
        $post->Gender = $unconfirmedUser->Gender;

        // Set other attributes if needed
        $post->save();

        // Delete the notification for the specific unconfirmed user
        $notificationsToDelete = DB::table('notifications')
            ->where('data->unconfirmed_user_id', $unconfirmedUser->id);    
        $notificationsToDelete->delete();

        // Delete the unconfirmed user record
        $unconfirmedUser->delete();
    }

    return redirect('admin')->with([
        'success' => 'All users confirmed and moved to posts',
    ]);
}

}