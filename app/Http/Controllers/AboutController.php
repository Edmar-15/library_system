<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

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

    public function getAboutData()
    {
        $about = About::first();

        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'No about data found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $about
        ]);
    }

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

    public function updateJson(Request $request, $id)
{
    $about = About::findOrFail($id);

    // Update fields safely
    $about->title = $request->input('title', $about->title);
    $about->description = $request->input('description', $about->description);
    $about->mission = $request->input('mission', $about->mission);
    $about->vision = $request->input('vision', $about->vision);
    $about->features = $request->input('features', $about->features);
    $about->contact_email = $request->input('contact_email', $about->contact_email);
    $about->contact_phone = $request->input('contact_phone', $about->contact_phone);

    // Handle image upload
    if ($request->hasFile('image')) {
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }
        $about->image = $request->file('image')->store('uploads/about', 'public');
    }

    try {
        $about->save();
        return response()->json([
            'success' => true,
            'message' => 'About page updated successfully!',
            'data' => $about
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Update failed: ' . $e->getMessage()
        ], 500);
    }
}


    public function update(UpdateAboutRequest $request, $id = null)
    {
        $about = $id ? About::find($id) : About::first();

        if (!$about) {
            return redirect()->route('about.edit')
                ->with('error', 'About page not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('uploads/about', 'public');
        }

        $about->update($data);

        return redirect()->route('about.edit')
            ->with('success', 'About page updated successfully!');
    }
}
