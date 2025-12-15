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

    public function update(Request $request, Menu $menu)
    {
        $menu->update([
            'title' => $request->title,
            'type' => $request->type,
            'url' => $request->url,
            'order' => $request->order,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->back();
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back();
    }
}