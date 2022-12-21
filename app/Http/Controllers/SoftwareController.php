<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\Software;
use Illuminate\Support\Facades\DB;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwares = Software::orderBy('id','desc')->paginate(5);
        return view('softwares.index', compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('softwares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSoftwareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoftwareRequest $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        Software::create($request->post());
        return redirect()->route('softwares.index')->with('success','Software has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function show(Software $software)
    {
        return view('softwares.show',compact('software'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $software)
    {
        return view('softwares.edit',compact('software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSoftwareRequest  $request
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoftwareRequest $request, Software $software)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        $software->fill($request->post())->save();

        return redirect()->route('softwares.index')->with('success','Software Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Software  $software
     * @return \Illuminate\Http\Response
     */
    public function destroy(Software $software)
    {
        $software->delete();
        return redirect()->route('softwares.index')->with('success','Software has been deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guiadesoftwares()
    {
        $softwares = Software::orderBy('id','desc')->paginate(5);
        return view('guiadesoftwares', compact('softwares'));
    }
}