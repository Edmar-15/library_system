<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        Menu::create($request->all());
        return redirect()->back();
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        // Only show content pages
        if ($menu->type !== 'content') {
            abort(404);
        }

        return view('menu.page', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        // Base validation
        $rules = ['title' => 'required|string|max:255'];

        // Only content-type menus need 'content'
        if ($menu->type === 'content') {
            $rules['content'] = 'required|string';
        } else {
            // For other menu types, validate 'type', 'url', and 'order'
            $rules['type'] = 'required|in:internal,external,content';
            $rules['url'] = $request->type !== 'content' ? 'required|string|max:255' : '';
            $rules['order'] = 'required|integer';
        }

        $validated = $request->validate($rules);

        // Update only provided fields
        $menu->update($validated);

        return redirect()->route('menus.show', $menu->id)
                        ->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back();
    }
}