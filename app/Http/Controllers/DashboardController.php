<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all inventory items
        $inventaris = Inventaris::all();

        // Group items by name (and category if needed)
        $groupedItems = $inventaris->groupBy('name'); // Grouping by name for simplicity

        return view('dashboard', compact('groupedItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Fetch the item by ID
        $item = Inventaris::findOrFail($id);

        // Update quantity based on status
        switch ($request->status) {
            case 'Available':
                $item->quantity += $request->quantity; // Increase quantity when status is 'Available'
                break;
            case 'Borrowed':
                $item->quantity -= $request->quantity; // Decrease quantity when status is 'Borrowed'
                break;
            case 'Damaged':
                $item->quantity -= $request->quantity; // Decrease quantity when status is 'Damaged'
                break;
            case 'Lost':
                $item->quantity -= $request->quantity; // Decrease quantity when status is 'Lost'
                break;
        }

        // Ensure the quantity does not go below 0
        $item->quantity = max($item->quantity, 0);

        // Save the updated item
        $item->status = $request->status; // Update status field as well
        $item->save();

        // Redirect back to the dashboard with success message
        return redirect()->route('dashboard')->with('status', 'Item updated successfully!');
    }
}
