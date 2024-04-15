<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSocialmediaRequest;
use App\Http\Requests\Admin\UpdateSocialmediaRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialmediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialmedias = SocialMedia::oldest('order')->paginate(10);
        return view('admin.socialmedia.index', compact('socialmedias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socialmedia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialmediaRequest $request)
    {
        $input = $request->all();
        SocialMedia::create($input);
        return redirect()->route('admin.socialmedias.index')->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedia $socialmedia)
    {
        return view('admin.socialmedia.edit', compact('socialmedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialmediaRequest $request, SocialMedia $socialmedia)
    {
        $input = $request->all();
        $socialmedia->update($input);
        return redirect()->route('admin.socialmedias.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialmedia)
    {
        $socialmedia->delete();
        return redirect()->route('admin.socialmedias.index')->with('message', 'Delete Successfully');
    }
}
