<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePortfolio;
use App\Models\ServicePortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicePortfolioController extends Controller
{
    public function index()
    {
        $portfolios = ServicePortfolio::with('images')->paginate(20);
        return view('admin.service_portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.service_portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|max:5120',
            'thumbnail_image_path' => 'nullable|string',
        ]);

        $portfolio = ServicePortfolio::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                if ($i >= 50) break;
                $path = $file->store('service_portfolios/'.$portfolio->id, 'public');
                $portfolio->images()->create(['image_path' => $path, 'sort_order' => $i]);
            }

            // Set thumbnail to first image
            if ($portfolio->images()->count() > 0) {
                $portfolio->update(['thumbnail_image_path' => $portfolio->images()->first()->image_path]);
            }
        }

        return redirect()->route('admin.service-portfolios.index')
                         ->with('success', 'Service portfolio created');
    }

    public function edit(ServicePortfolio $servicePortfolio)
    {
        $servicePortfolio->load('images');
        return view('admin.service_portfolios.edit', compact('servicePortfolio'));
    }

    public function update(Request $request, ServicePortfolio $servicePortfolio)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|max:5120',
            'thumbnail_id' => 'nullable|exists:service_portfolio_images,id',
        ]);

        $servicePortfolio->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        // Handle delete images
        if ($request->has('delete_images')) {
            $imagesToDelete = $request->input('delete_images');
            foreach ($imagesToDelete as $imageId) {
                $image = ServicePortfolioImage::find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentCount = $servicePortfolio->images()->count();
            foreach ($request->file('images') as $i => $file) {
                if ($currentCount + $i >= 50) break;
                $path = $file->store('service_portfolios/'.$servicePortfolio->id, 'public');
                $servicePortfolio->images()->create(['image_path' => $path, 'sort_order' => $currentCount + $i]);
            }
        }

        // Update thumbnail if specified
        if ($request->has('thumbnail_id')) {
            $thumbnailImage = ServicePortfolioImage::find($request->input('thumbnail_id'));
            if ($thumbnailImage && $thumbnailImage->service_portfolio_id == $servicePortfolio->id) {
                $servicePortfolio->update(['thumbnail_image_path' => $thumbnailImage->image_path]);
            }
        }

        return redirect()->route('admin.service-portfolios.index')
                         ->with('success', 'Service portfolio updated');
    }

    public function destroy(ServicePortfolio $servicePortfolio)
    {
        // Delete all images from storage
        foreach ($servicePortfolio->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $servicePortfolio->delete();
        return back()->with('success', 'Service portfolio deleted');
    }
}
