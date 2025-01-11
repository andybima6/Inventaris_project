<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Display the dashboard with total inventory counts based on status and category
    public function index()
    {
        // Retrieve all inventaris data
        $data = Inventaris::all();

        // Group by status first, then by category, and count the items
        $totals = $data->groupBy('status')->map(function ($group) {
            return $group->groupBy('category')->map(function ($categoryGroup) {
                return $categoryGroup->count(); // Count the number of items in each category per status
            });
        });

        // Return the view and pass the 'totals' variable to it
        return view('dashboard', compact('totals')); // Pass $totals to the view
    }
}
