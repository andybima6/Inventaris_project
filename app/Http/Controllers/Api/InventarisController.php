<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    // Menampilkan semua data inventaris
    public function index()
    {
        return Inventaris::all();
    }

    // Menyimpan data inventaris baru
    public function store(Request $request)
    {
        $inventaris = Inventaris::create($request->all());
        return response()->json($inventaris, 201);
    }

    // Menampilkan data inventaris berdasarkan ID
    public function show(Inventaris $inventaris)
    {
        return Inventaris::find($inventaris->id);
    }

    // Mengupdate data inventaris berdasarkan ID
    public function update(Request $request, Inventaris $inventaris)
    {
        $inventaris->update($request->all());
        return Inventaris::find($inventaris->id);
    }

    // Menghapus data inventaris berdasarkan ID
    public function destroy(Inventaris $inventaris)
    {
        $inventaris->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}
