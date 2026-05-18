<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::paginate(20);
        return view('admin.event_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.event_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        EventCategory::create($data);
        return redirect()->route('admin.event-categories.index')
                         ->with('success', 'Category created');
    }

    public function edit(EventCategory $eventCategory)
    {
        return view('admin.event_categories.edit', compact('eventCategory'));
    }

    public function update(Request $request, EventCategory $eventCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        $eventCategory->update($data);
        return redirect()->route('admin.event-categories.index')
                         ->with('success', 'Category updated');
    }

    public function destroy(EventCategory $eventCategory)
    {
        $eventCategory->delete();
        return back()->with('success', 'Category deleted');
    }
}
