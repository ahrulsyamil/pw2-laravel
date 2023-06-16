<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Exports\ItemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use PDF;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ItemModel::paginate(10);

        return view('item.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $item = new ItemModel();
        $item->name = $request->name;
        $item->qty = $request->qty;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->supplier = $request->supplier;
        $item->location = $request->location;
        $item->status = $request->status;
        $item->description = $request->description;

        $item->save();

        return redirect()->route('item.index')
            ->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ItemModel::find($id);

        return view('item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $item = ItemModel::find($id);
        $item->name = $request->name;
        $item->qty = $request->qty;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->supplier = $request->supplier;
        $item->location = $request->location;
        $item->status = $request->status;
        $item->description = $request->description;

        $item->update();

        return redirect()->route('item.index')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ItemModel::find($id)->delete();

        return redirect()->route('item.index')
            ->with('success', 'Item deleted successfully!');
    }

    public function export_excel()
    {
        return Excel::download(new ItemExport, 'item.xlsx');
    }

    public function pdf()
    {
        $items = ItemModel::all();
        return view('item.pdf', ['items' => $items]);
    }

    public function export_pdf()
    {
        $items = ItemModel::all();
        $pdf = PDF::loadView('item.pdf', ['items' => $items]);
        return $pdf->download('item.pdf');
    }
}
