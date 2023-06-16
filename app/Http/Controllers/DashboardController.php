<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $category = ItemModel::groupBy('category')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->get();
        $supplier =
            ItemModel::groupBy('supplier')
            ->select('supplier', DB::raw('COUNT(*) as total'))
            ->get();
        $status =
            ItemModel::groupBy('status')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->get();

        return view("dashboard.index", [
            'category' => $category,
            'supplier' => $supplier,
            'status' => $status
        ]);
    }
}
