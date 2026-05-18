<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventItem;
use App\Models\EventImage;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventItemController extends Controller
{
    public function index()
    {
        $items = EventItem::with('category')->paginate(20);
        return view('admin.event_items.index', compact('items'));
    }

    public function create()
    {
        $categories = EventCategory::all();
        return view('admin.event_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:event_categories,id',
            'client_name' => 'required|string|max:255',
            'event_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*'    => 'image|max:5120',
        ]);

        $item = EventItem::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                if ($i >= 50) break;
                $path = $file->store('event_items/'.$item->id, 'public');
                $item->images()->create(['image_path' => $path, 'sort_order' => $i]);
            }
        }

        return redirect()->route('admin.event-items.index')
                         ->with('success', 'Event item created');
    }

    public function edit(EventItem $eventItem)
    {
        $categories = EventCategory::all();
        return view('admin.event_items.edit', compact('eventItem', 'categories'));
    }

    public function update(Request $request, EventItem $eventItem)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:event_categories,id',
            'client_name' => 'required|string|max:255',
            'event_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*'    => 'image|max:5120',
        ]);

        $eventItem->update($data);

        // Handle image deletion
        if ($request->has('delete_images')) {
            $imagesToDelete = $request->input('delete_images');
            foreach ($imagesToDelete as $imageId) {
                $image = EventImage::find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentCount = $eventItem->images()->count();
            foreach ($request->file('images') as $i => $file) {
                if ($currentCount + $i >= 50) break;
                $path = $file->store('event_items/'.$eventItem->id, 'public');
                $eventItem->images()->create(['image_path' => $path, 'sort_order' => $currentCount + $i]);
            }
        }

        return redirect()->route('admin.event-items.index')
                         ->with('success', 'Event item updated');
    }

    public function destroy(EventItem $eventItem)
    {
        $eventItem->delete();
        return back()->with('success', 'Event item deleted');
    }
}
