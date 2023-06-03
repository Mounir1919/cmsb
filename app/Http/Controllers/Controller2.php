<?php

namespace App\Http\Controllers;

use ZipArchive;
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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' || auth()->user()->status =='Low')) {
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
        
        if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium')) {
            $deletedUsers = Post::onlyTrashed()
                ->latest('deleted_at')
                ->paginate(10);
                    
                return view('DeletedUsers')->with('deletedUsers', $deletedUsers);
            }
        
            return redirect()->back();
        }
    public function show($id)
    {
        if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' || auth()->user()->status == 'Low' )) {
            $post = Post::find($id);
            return view('show')->with(['post' => $post]);
        }
        
        return redirect()->back(); 
    }
    public function show2($id)
    {
        if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' || auth()->user()->status == 'Low' )) {
            $del = Post::onlyTrashed()->find($id);
            return view('showdeleted')->with(['del' => $del]);
        }
        
        return redirect()->back(); 
    }
    
public function create()
{
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' )) {
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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' || auth()->user()->status == 'Low' )) {
        $softDeletedUserCount = Post::onlyTrashed()->count();
        $posts = Post::all();
        
        if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium' ||  auth()->user()->status == 'Low')) {
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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required',
            'salary' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'Gender' => 'required',
            'pdf' => 'nullable|mimes:pdf|max:5124',
            'pdf2' => 'nullable|mimes:pdf|max:5124',

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
        if ($request->hasFile('pdf')) {
            // Upload the new image if provided
            $file = $request->file('pdf');
            $pdf = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs'), $pdf);
            
            // Delete the old image if it exists
            if ($unconfirmedUser->pdf) {
                $old_image_path = public_path('pdfs') . '/' . $unconfirmedUser->pdf;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
    
            $unconfirmedUser->pdf = $pdf;
        }
        if ($request->hasFile('pdf2')) {
            // Upload the new image if provided
            $file = $request->file('pdf2');
            $pdf2 = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pdfs2'), $pdf2);
            
            // Delete the old image if it exists
            if ($unconfirmedUser->pdf2) {
                $old_image_path = public_path('pdfs2') . '/' . $unconfirmedUser->pdf2;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }
    
            $unconfirmedUser->pdf2 = $pdf2;
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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {

    $post = Post::find($id);
    return view('edit')->with([
        'post'=>$post
    ]);
}
return redirect()->back();
}
public function update(Request $request, $id)
{
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {
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
    if (auth()->check() && (auth()->user()->status == 'high' || auth()->user()->status == 'Medium')) {
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
    if (auth()->check() && (auth()->user()->status == 'high' || auth()->user()->status == 'Medium')) {
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
    if (auth()->check() && (auth()->user()->status == 'high' || auth()->user()->status == 'Medium')) {
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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {

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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {

    $post= Post::onlyTrashed()->restore();
    return redirect('tables ')->with([
        'restoreall'=>'All Users has been Restored'
    ]);
}
return redirect()->back();

}

public function deleteMultiple(Request $request)
{
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {
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
    $post->pdf = $unconfirmedUser->pdf;
    $post->pdf2 = $unconfirmedUser->pdf2;

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
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {
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
        $post->pdf = $unconfirmedUser->pdf;
        $post->pdf2 = $unconfirmedUser->pdf2;

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


public function deletenotif($id)
{
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium'  )) {

    $unconfirmedUser = unconfirmed_users::findOrFail($id);
    $unconfirmedUser->delete();
    
    $notificationsToDelete = DB::table('notifications')->where('data->unconfirmed_user_id', $id);    
    $notificationsToDelete->delete();
    }
    return redirect('admin')->with([
        'success' => 'deleted',
    ]);
}
public function deleteall()
{
    if (auth()->check() && (auth()->user()->status == 'High' || auth()->user()->status == 'Medium')) {

    $unconfirmedUser = unconfirmed_users::get();
    foreach($unconfirmedUser as $deleted){
    $deleted->delete();  }
     DB::table('notifications')->delete();
   
}
    return redirect('admin')->with([
        'success' => 'deleted',
    ]);
}

public function downloadRAR($pdf, $pdf2, $name, $image)
{
    $archiveName = 'Confirmed_'.$name .'.rar';
    $archivePath = storage_path('app/'.$archiveName);

    // Create a new ZIP archive
    $zip = new ZipArchive;
    if ($zip->open($archivePath, ZipArchive::CREATE) === true) {
        // Add the PDF files to the ZIP archive
        $zip->addFile(public_path('pdfs/'.$pdf), $pdf);
        $zip->addFile(public_path('pdfs2/'.$pdf2), $pdf2);
        $zip->addFile(public_path('uploads/'.$image), $image);
        // Close the ZIP archive
        $zip->close();
    }

    // Serve the ZIP archive for download
    return response()->download($archivePath);
}
public function trashRAR($pdf, $pdf2, $name, $image)
{
    $archiveName = 'Trash_'.$name .'.rar';
    $archivePath = storage_path('app/'.$archiveName);

    // Create a new ZIP archive
    $zip = new ZipArchive;
    if ($zip->open($archivePath, ZipArchive::CREATE) === true) {
        // Add the PDF files to the ZIP archive
        $zip->addFile(public_path('pdfs/'.$pdf), $pdf);
        $zip->addFile(public_path('pdfs2/'.$pdf2), $pdf2);
        $zip->addFile(public_path('uploads/'.$image), $image);
        // Close the ZIP archive
        $zip->close();
    }

    // Serve the ZIP archive for download
    return response()->download($archivePath);
}
public function downloadAll()
{
    $users = Post::whereNull('deleted_at')->get(); // Retrieve only users with NULL value in 'deleted_at' column

    if ($users->isEmpty()) {
        return redirect('tables')->with([
            'empty' => 'Table Is Empty !'
        ]);
    }

    $archiveName = 'Table Users.rar';
    $archivePath = storage_path('app/'.$archiveName);

    // Create a new ZIP archive
    $zip = new ZipArchive;
    if ($zip->open($archivePath, ZipArchive::CREATE) === true) {
        foreach ($users as $user) {
            $userName = $user->name; // Assuming each user has a "name" property indicating their name
            $userFolder = $userName . '/'; // Create a folder using the user's name

            // Create the user's folder inside the ZIP archive
            $zip->addEmptyDir($userFolder);

            $pdf = $user->pdf; // Assuming each user has a "pdf" property indicating their PDF file
            $pdfPath = public_path('pdfs/'.$pdf);
            $pdfFilename = $userFolder . $pdf; // Store the PDF inside the user's folder

            $pdf2 = $user->pdf2; // Assuming each user has a "pdf2" property indicating their second PDF file
            $pdf2Path = public_path('pdfs2/'.$pdf2);
            $pdf2Filename = $userFolder . $pdf2; // Store the second PDF inside the user's folder

            $image = $user->image; // Assuming each user has an "image" property indicating their image file
            $imagePath = public_path('uploads/'.$image);
            $imageFilename = $userFolder . $image; // Store the image inside the user's folder

            // Check if the files exist before adding them to the ZIP archive
            if (file_exists($pdfPath)) {
                $zip->addFile($pdfPath, $pdfFilename);
            }

            if (file_exists($pdf2Path)) {
                $zip->addFile($pdf2Path, $pdf2Filename);
            }

            if (file_exists($imagePath)) {
                $zip->addFile($imagePath, $imageFilename);
            }
        }

        // Close the ZIP archive
        $zip->close();
    } else {
        return response()->json(['message' => 'Failed to create ZIP archive'], 500);
    }

    // Serve the ZIP archive for download with the appropriate Content-Disposition header
    return response()->download($archivePath, $archiveName, ['Content-Disposition' => 'attachment'])->deleteFileAfterSend(true);
}
public function downloadAlltrash()
{
    $users = Post::onlyTrashed()->get(); // Retrieve only users with NULL value in 'deleted_at' column

    if ($users->isEmpty()) {
        return redirect('tables')->with([
            'empty' => 'Table Is Empty !'
        ]);
    }

    $archiveName = 'Trash Users.rar';
    $archivePath = storage_path('app/'.$archiveName);

    // Create a new ZIP archive
    $zip = new ZipArchive;
    if ($zip->open($archivePath, ZipArchive::CREATE) === true) {
        foreach ($users as $user) {
            $userName = $user->name; // Assuming each user has a "name" property indicating their name
            $userFolder = $userName . '/'; // Create a folder using the user's name

            // Create the user's folder inside the ZIP archive
            $zip->addEmptyDir($userFolder);

            $pdf = $user->pdf; // Assuming each user has a "pdf" property indicating their PDF file
            $pdfPath = public_path('pdfs/'.$pdf);
            $pdfFilename = $userFolder . $pdf; // Store the PDF inside the user's folder

            $pdf2 = $user->pdf2; // Assuming each user has a "pdf2" property indicating their second PDF file
            $pdf2Path = public_path('pdfs2/'.$pdf2);
            $pdf2Filename = $userFolder . $pdf2; // Store the second PDF inside the user's folder

            $image = $user->image; // Assuming each user has an "image" property indicating their image file
            $imagePath = public_path('uploads/'.$image);
            $imageFilename = $userFolder . $image; // Store the image inside the user's folder

            // Check if the files exist before adding them to the ZIP archive
            if (file_exists($pdfPath)) {
                $zip->addFile($pdfPath, $pdfFilename);
            }

            if (file_exists($pdf2Path)) {
                $zip->addFile($pdf2Path, $pdf2Filename);
            }

            if (file_exists($imagePath)) {
                $zip->addFile($imagePath, $imageFilename);
            }
        }

        // Close the ZIP archive
        $zip->close();
    } else {
        return response()->json(['message' => 'Failed to create ZIP archive'], 500);
    }

    // Serve the ZIP archive for download with the appropriate Content-Disposition header
    return response()->download($archivePath, $archiveName, ['Content-Disposition' => 'attachment'])->deleteFileAfterSend(true);
}
public function show_admin()
{
    if (auth()->check() && (auth()->user()->status == 'High' )) {
        $users = User::all();
        
        

        return view('show_admin')->with([
            'users' => $users,
        ]);
    }
    
    return redirect()->back();
}

public function delete_admin($id)
{
    $User = User::findOrFail($id);

    $User->delete(); // Soft delete the post

    return redirect('show_admin')->with([
        'delete_admin' => 'Admin Deleted'
    ]);
}

public function up(Request $request, $id)
{
    // Validate the form input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'status' => 'required'
    ]);

    // Retrieve the user by ID
    $user = User::find($id);

    if (!$user) {
        // Handle the case if the user is not found
        return redirect()->back()->with('error_admin', 'User not found');
    }

    // Update the user information
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->status = $request->input('status');

    // Save the changes
    if ($user->isDirty()) {
        $user->save();
        return redirect()->back()->with('success_admin', 'Admin updated successfully');
    }else{
        return redirect()->back()->with('info_admin', 'No changes made');

    }
    
}

}
