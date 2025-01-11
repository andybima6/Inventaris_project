<?php
namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{

    public function index()
    {
        // Menampilkan semua inventaris
        $inventaris = Inventaris::all();
        return view('inventaris.index', compact('inventaris'));
    }

    public function create()
    {
        // Menampilkan form untuk menambah inventaris
        return view('inventaris.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Borrowed,Damaged,Lost',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Menyimpan file gambar jika ada
        $imageUrl = null;
        if ($request->hasFile('image')) {
            // Menyimpan gambar di storage/app/public/inventaris_images
            $imageUrl = $request->file('image')->store('inventaris_images', 'public');
        }

        // Menyimpan data inventaris tanpa user_id
        Inventaris::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
            'image_url' => $imageUrl, // Menyimpan URL gambar
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Inventaris::findOrFail($id);
        return view('inventaris.edit', compact('item'));
    }

     // Handle update form submission
     public function update(Request $request, $id)
     {
         // Validate the incoming data
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'category' => 'required|string|max:255',
             'quantity' => 'required|integer|min:1',
             'status' => 'required|string|in:Available,Unavailable',
             'image' => 'nullable|image|max:2048',
         ]);

         // Find the item to be updated
         $item = Inventaris::findOrFail($id);

         // Update the item fields
         $item->name = $validated['name'];
         $item->category = $validated['category'];
         $item->quantity = $validated['quantity'];
         $item->status = $validated['status'];

         // Handle image upload if a new one is provided
         if ($request->hasFile('image')) {
             // Delete the old image if exists
             if ($item->image_url) {
                 Storage::delete('public/' . $item->image_url);
             }

             // Store the new image
             $imagePath = $request->file('image')->store('inventaris_images', 'public');
             $item->image_url = $imagePath;
         }

         // Save the changes to the database
         $item->save();

         return redirect()->route('inventaris.index')->with('success', 'Inventaris updated successfully!');
     }


    public function destroy(Inventaris $inventaris)
    {
        // Hapus gambar jika ada
        if ($inventaris->image_url) {
            Storage::delete(str_replace('/storage/', '', $inventaris->image_url));
        }

        // Hapus data inventaris
        try {
            $inventaris->delete();
            return redirect()->route('inventaris.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan
            return back()->with('error', 'Terjadi kesalahan saat menghapus barang: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        // Find the item by ID
        $item = Inventaris::findOrFail($id);

        // Return the view with the item data
        return view('inventaris.show', compact('item'));
    }
}
