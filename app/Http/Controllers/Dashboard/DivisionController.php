<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDivisonRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $divisions = Division::latest()->get();
        $title = 'Data Division';
        return view('dashboard.division.index', compact(['divisions', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisonRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Division::create($data);
        return redirect()->route('divisions.index')->with('success', 'Data division has been inserted succesfully');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisionRequest $request, string $id)
    {
        $data = $request->validated();

        Division::find($id)->update($data);
        return Redirect::back()->with('success', 'Division has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Division::find($id)->delete();

        return Redirect::back()->with('success', 'Divison has been deleted');
    }
}
