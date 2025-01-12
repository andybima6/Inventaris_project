<?php

namespace App\Http\Controllers;


use App\Models\Inventaris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

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
        // Get all unique categories from the inventaris table
        $categories = \App\Models\Inventaris::select('category')->distinct()->get();

        // Get all existing names (if needed)
        $names = \App\Models\Inventaris::select('name')->distinct()->get();

        return view('inventaris.create', compact('categories', 'names'));
    }


    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'expired' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Determine the name and category to save
        $name = $request->name ?: $request->input('name_other', null);
        $category = $request->category ?: $request->input('category_other', null);

        // Ensure name and category are not both empty
        if (!$name || !$category) {
            return back()->withErrors(['name' => 'Nama dan Kategori harus diisi']);
        }

        // Save the image if provided
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageUrl = $image->store('images', 'public');
        }

        // Retrieve the expired date
        $expired = $request->expired; // Ambil nilai expired dari input form

        // Always set the status to "Available" (Tersedia)
        $status = 'Available';

        // Create a new Inventaris record
        Inventaris::create([
            'name' => $name,
            'category' => $category,
            'expired' => $expired,
            'quantity' => $request->quantity,
            'status' => $status,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Barang berhasil ditambahkan');
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
            'expired' => 'required|date',
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
        $item->expired = $validated['expired'];
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
    public function view_pdf()
    {
        // Ambil semua data inventaris dari database
        $inventaris = Inventaris::all();

        // Render view ke dalam HTML menggunakan Blade
        $html = view('inventaris.export', compact('inventaris'))->render();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Tambahkan HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Tentukan nama file PDF
        $fileName = 'Laporan-Inventaris-' . Carbon::now()->format('d-m-Y') . '.pdf';

        // Tampilkan PDF di browser
        $mpdf->Output($fileName, 'I'); // 'I' untuk menampilkan di browser
    }
    public function download_pdf()
    {
        // Ambil semua data inventaris dari database
        $inventaris = Inventaris::all();

        // Render view ke dalam HTML menggunakan Blade
        $html = view('inventaris.export', compact('inventaris'))->render();

        // Inisialisasi mPDF
        $mpdf = new Mpdf();

        // Tambahkan HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Tentukan nama file PDF
        $fileName = 'Laporan-Inventaris-' . Carbon::now()->format('d-m-Y') . '.pdf';

        // Unduh PDF
        $mpdf->Output($fileName, 'D'); // 'D' untuk mengunduh file
    }
}
