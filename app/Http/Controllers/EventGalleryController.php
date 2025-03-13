<?php


namespace App\Http\Controllers;

use App\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;

class EventGalleryController extends Controller
{
    public function index()
    {
        $galleries = EventGallery::with('event')->get();
        return view('admin.event_gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120 ',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');

            EventGallery::create([
                'event_id' => $request->event_id,
                'image_url' => $imagePath,
            ]);
        }

        return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
    }

    public function destroy(EventGallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_url);
        $gallery->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            // Hapus gambar dari storage
            $galleries = EventGallery::whereIn('id', $ids)->get();
            foreach ($galleries as $gallery) {
                Storage::delete('public/event_images/' . $gallery->image_url);
            }

            // Hapus data dari database
            EventGallery::whereIn('id', $ids)->delete();
            
            return response()->json(['message' => 'Gambar berhasil dihapus'], 200);
        }

        return response()->json(['message' => 'Tidak ada gambar yang dipilih'], 400);
    }
    public function edit($id)
    {
        $gallery = EventGallery::findOrFail($id);
        $events = Event::all();

        return view('admin.event_gallery.edit', compact('gallery', 'events'));
    }

    // Proses update gambar event
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gallery = EventGallery::findOrFail($id);
        $gallery->event_id = $request->event_id;

        // Jika ada gambar baru, upload dan hapus gambar lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($gallery->image_url) {
                Storage::delete('public/' . $gallery->image_url);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('event_images', 'public');
            $gallery->image_url = $imagePath;
        }

        $gallery->save();

        return redirect()->route('admin.event_gallery.index')->with('success', 'Gambar event berhasil diperbarui!');
    }

}