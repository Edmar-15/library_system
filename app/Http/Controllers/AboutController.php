<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display the about page (public view)
     */
    public function index()
    {
        // Get the first (or only) about record
        $about = About::first();
        
        // If no record exists, create a default one
        if (!$about) {
            $about = About::create([
                'title' => 'About the Library System',
                'description' => 'Welcome to our library management system.',
                'mission' => null,
                'vision' => null,
                'features' => null,
                'developer_name' => null,
                'developer_role' => null,
                'developer_email' => null,
                'image' => null,
                'contact_email' => null,
                'contact_phone' => null,
            ]);
        }
        
        return view('about.about', compact('about'));
    }

    /**
     * Show the form for editing the about page (admin)
     */
    public function edit()
    {
        $about = About::first();
        
        if (!$about) {
            $about = About::create([
                'title' => 'About the Library System',
                'description' => 'Welcome to our library management system.',
            ]);
        }
        
        return view('about.edit', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/about', 'public');
        }
        
        $about = About::create($data);
        
        return redirect()->route('show.about')
            ->with('success', 'About page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        return view('about.show', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request)
    {
        // Get the first about record
        $about = About::first();
        
        if (!$about) {
            return redirect()->route('show.about')
                ->with('error', 'About page not found.');
        }
        
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            
            $data['image'] = $request->file('image')->store('uploads/about', 'public');
        }
        
        $about->update($data);
        
        return redirect()->route('show.about')
            ->with('success', 'About page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        // Delete image if exists
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }
        
        $about->delete();
        
        return redirect()->route('show.about')
            ->with('success', 'About page deleted successfully.');
    }
}