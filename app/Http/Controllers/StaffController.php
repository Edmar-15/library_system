<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staffByRole = Staff::all()->groupBy('position');
        return view('staff.index', compact('staffByRole'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:staff',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('staff_profiles', 'public');
        }

        Staff::create($data);
        return redirect()->route('staff.index');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $staff->id,
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($staff->profile_picture) Storage::disk('public')->delete($staff->profile_picture);
            $data['profile_picture'] = $request->file('profile_picture')->store('staff_profiles', 'public');
        }

        $staff->update($data);
        return redirect()->route('staff.index');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->profile_picture) Storage::disk('public')->delete($staff->profile_picture);
        $staff->delete();
        return redirect()->route('staff.index');
    }
}