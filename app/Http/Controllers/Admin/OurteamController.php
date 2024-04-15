<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOurteamRequest;
use App\Http\Requests\Admin\UpdateOurteamRequest;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class OurteamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourteams = OurTeam::latest()->paginate(10);
        return view('admin.ourteam.index', compact('ourteams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ourteam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOurteamRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $ourteam =  OurTeam::create($input);
        $ourteam->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.ourteams.index')->with('message', 'Created Successfully');
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
    public function edit(OurTeam $ourteam)
    {
        return view('admin.ourteam.edit', compact('ourteam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOurteamRequest $request, OurTeam $ourteam)
    {
        $old_image = $ourteam->image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $ourteam->update($input);
        return redirect()->route('admin.ourteams.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurTeam $ourteam)
    {
        $this->removeFile($ourteam->image);
        $ourteam->delete();
        return redirect()->route('admin.ourteams.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/team';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }


    public function removeFile($file)
    {
        $file2 = explode(asset('admin/images/team') . '/', $file);
        if ($file) {
            $path = public_path() . '/admin/images/team/' . $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
