<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThingRequest;
use App\Http\Requests\UpdateThingRequest;
use App\Models\Thing;

class ThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $things = Thing::orderBy('id','desc')->paginate(5);
        return view('things.index', compact('things'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('things.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreThingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThingRequest $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Thing::create($request->post());
        return redirect()->route('things.index')->with('success','Thing has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function show(Thing $thing)
    {
        return view('things.show', compact('thing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(Thing $thing)
    {
        return view('things.edit', compact('thing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThingRequest  $request
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThingRequest $request, Thing $thing)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        $thing->fill($request->post())->save();

        return redirect()->route('things.index')->with('success','Thing Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thing $thing)
    {
        $thing->delete();
        return redirect()->route('things.index')->with('success','Thing has been deleted successfully');
    }
}