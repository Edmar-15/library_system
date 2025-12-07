<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;   
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Request;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.profile');
    }
   public function getProfileApi()
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $profile = $user->profile;

    if (!$profile) {
        
        $profile = new Profile([
            'bio' => '',
            'phone' => '',
            'address' => '',
            'profile_picture' => null,
        ]);
        $profile->user_id = $user->id;
        $profile->save();
    }

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'bio' => $user->profile->bio,
        'phone' => $user->profile->phone,
        'address' => $user->profile->address,
        'profile_picture' => $user->profile->profile_picture 
            ? asset('storage/' . $user->profile->profile_picture)
            : null,
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
         $user = Auth::user();

        // Create a new profile for the user
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->profile_picture = $request->profile_picture;  // You can handle file uploads here
        $profile->bio = $request->bio;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->save();

        // Redirect to profile page
        return redirect()->route('show.profile');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return response()->json([
            'name' => $profile->user->name,  // Assuming 'user' relationship exists in Profile model
            'email' => $profile->user->email,
            'bio' => $profile->bio,
            'phone' => $profile->phone,
            'address' => $profile->address,
            'profile_picture' => $profile->profile_picture,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
       if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public'); // saves to storage/app/public/profile_pictures
        $profile->profile_picture = $path;
    }

    $profile->bio = $request->bio;
    $profile->phone = $request->phone;
    $profile->address = $request->address;

    $profile->save();

    return redirect()->route('show.profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
           $profile->delete();
        return redirect()->route('show.profile');
    }
}
