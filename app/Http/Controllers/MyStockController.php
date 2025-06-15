<?php

namespace App\Http\Controllers;

use App\Models\ErrorPage;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyStockController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the user's stocks.
     */
    public function index()
    {
        // IDOR Prevention: Only show authenticated user's stocks
        $stocks = ErrorPage::forUser(auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new stock.
     */
    public function create()
    {
        return view('my-stocks.create');
    }

    /**
     * Store a newly created stock.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'error_code' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // IDOR Prevention: Always set user_id to authenticated user
        $validated['user_id'] = auth()->id();

        ErrorPage::create($validated);

        return redirect()->route('my-stocks.index')
            ->with('success', 'Stock added to your portfolio successfully!');
    }

    /**
     * Display the specified stock.
     */
    public function show(ErrorPage $myStock)
    {
        // IDOR Prevention: Ensure user owns this stock
        $this->authorize('view', $myStock);

        return view('my-stocks.show', compact('myStock'));
    }

    /**
     * Show the form for editing the specified stock.
     */
    public function edit(ErrorPage $myStock)
    {
        // IDOR Prevention: Ensure user owns this stock
        $this->authorize('update', $myStock);

        return view('my-stocks.edit', compact('myStock'));
    }

    /**
     * Update the specified stock.
     */
    public function update(Request $request, ErrorPage $myStock)
    {
        // IDOR Prevention: Ensure user owns this stock
        $this->authorize('update', $myStock);

        $validated = $request->validate([
            'error_code' => 'required|integer|min:1|unique:error_pages,error_code,' . $myStock->id,
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Note: We don't update user_id to prevent ownership transfer
        $myStock->update($validated);

        return redirect()->route('my-stocks.index')
            ->with('success', 'Stock updated successfully!');
    }

    /**
     * Remove the specified stock.
     */
    public function destroy(ErrorPage $myStock)
    {
        // IDOR Prevention: Ensure user owns this stock
        $this->authorize('delete', $myStock);

        $myStock->delete();

        return redirect()->route('my-stocks.index')
            ->with('success', 'Stock removed from your portfolio!');
    }
}
