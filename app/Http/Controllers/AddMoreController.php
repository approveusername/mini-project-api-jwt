<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserImage;
use App\Models\UserLanguage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AddMoreController extends Controller
{
    public function store(Request $request)
    {
        // Validation Rules (already in place)
        $request->validate([
            'users' => 'required|array',
            'users.*.name' => 'required|string|max:255',
            'users.*.email' => 'required|email|max:255|unique:users,email',
            'users.*.address' => 'required',
            'users.*.gender' => 'required',
            'users.*.languages' => 'nullable|array',
            'users.*.languages.*' => 'required|string|max:255',
            'users.*.images' => 'nullable|array',
            'users.*.images.*' => 'file|image|max:2048',
        ], [
            'users.*.name.required' => 'The name field is required.',
            'users.*.email.required' => 'The email field is required.',
            'users.*.email.unique' => 'This email is already exists.',
            'users.*.address.required' => 'The address field is required.',
            'users.*.gender.required' => 'The gender field is required.',
            'users.*.languages.*.required' => 'Each language is required.',
            'users.*.images.*.file' => 'Each image must be a valid file.',
            'users.*.images.*.image' => 'Each file must be an image.',
            'users.*.images.*.max' => 'Each image must be less than 2MB.',
        ]);
    
        // Start transaction to ensure atomic operation
        DB::beginTransaction();
    
        try {
            $savedUsers = [];
            // dd($request->all(), $request->file());

            // echo '<pre>'; print_R($request->all());die;
            // echo '<pre>'; print_R($_POST['users']['']);die;
            // if($request->hasFile('project_image')){}
    
            foreach ($request->input('users', []) as $userData) {
                // Save user details
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'address' => $userData['address'],
                    'gender' => $userData['gender'],
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345'), // Example password
                    'remember_token' => Str::random(10),
                ]);
    
                // Save languages if any
                if (!empty($userData['languages'])) {
                    foreach ($userData['languages'] as $language) {
                        // Assuming the user has a `languages()` relationship method
                        $user->languages()->create([
                            'language' => $language,
                        ]);
                    }
                }
    
                // Save images if any
                if (!empty($userData['images'])) {
                    foreach ($userData['images'] as $image) {
                        // Store image and get the path
                        $path = $image->store('uploads/users', 'public');
    
                        // Assuming the user has an `images()` relationship method
                        $user->images()->create([
                            'image' => $path,
                        ]);
                    }
                }
    
                // Add the saved user data to the array
                $savedUsers[] = $user;
            }
    
            // Commit the transaction if all is good
            DB::commit();
    
            // Redirect with success message and the saved users to the form
            return redirect()->back()->with('success', 'Users saved successfully!')->with('saved_users', $savedUsers);
    
        } catch (\Exception $e) {
            // Rollback in case of an error
            DB::rollBack();
    
            // Log the error for debugging purposes
            \Log::error("Error saving users: " . $e->getMessage());
    
            // Redirect with error message
            return redirect()->back()->withInput()->with('error', 'An error occurred while saving users. Please try again.');
        }
    }
    
    

    public function index()
    {
        $users = User::with(['images', 'languages'])->get();

        return view('add_more', compact('users'));
    }

}