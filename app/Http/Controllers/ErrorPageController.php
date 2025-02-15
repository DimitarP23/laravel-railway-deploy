<?php

namespace App\Http\Controllers;

use App\Models\ErrorPage;
use Illuminate\Http\Request;

class ErrorPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $errorPages = ErrorPage::all();
        return view('errors.index', compact('errorPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('errors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'error_code' => 'required|integer|unique:error_pages',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ErrorPage::create($validated);

        return redirect()->route('error-pages.index')
            ->with('success', 'Stock created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ErrorPage $errorPage)
    {
        return view('errors.show', compact('errorPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ErrorPage $errorPage)
    {
        return view('errors.edit', compact('errorPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ErrorPage $errorPage)
    {
        $validated = $request->validate([
            'error_code' => 'required|integer|unique:error_pages,error_code,' . $errorPage->id,
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $errorPage->update($validated);

        return redirect()->route('error-pages.index')
            ->with('success', 'Stock  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ErrorPage $errorPage)
    {
        $errorPage->delete();

        return redirect()->route('error-pages.index')
            ->with('success', 'Stock  deleted successfully.');
    }
}
