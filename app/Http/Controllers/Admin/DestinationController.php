<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDestinationRequest;
use App\Http\Requests\Admin\UpdateDestinationRequest;
use App\Models\Destination;
use App\Models\DestinationInformation;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::latest();
        $parent = 0;
        $parentDestination = '';
        if (isset($_GET['parent']) && $_GET['parent']) {
            $destinations = $destinations->where('parent_id', $_GET['parent']);
            $parent = $_GET['parent'];
            $parentDestination = Destination::findOrFail($parent);
        } else {
            $destinations = $destinations->where('parent_id', 0);
        }

        $destinations = $destinations->paginate(20);

        $params = array('parent' => $parent); // for sub destination pagination
        return view('admin.destination.index', compact('destinations', 'parent', 'parentDestination', 'params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestinationRequest $request)
    {
        $input = $request->except('image');
        $input['image'] = $this->fileUpload($request, 'image');
        $input['banner_image'] = $this->fileUpload($request, 'banner_image');

        // for unique slug
        $slug = $request->name;
        if ($request->parent_id) {
            $parentId = $this->getParentDestinationId($request->parent_id);
            $parentDestination = Destination::where('id', $parentId)->first();
            $slug = $parentDestination->name . '-' . $request->name;
        }
        $input['slug'] = Str::slug($slug);
        $destination = Destination::create($input);

        //otherinfo
        foreach ($request->addmoreotherinfo as $key => $value) {
            if ($value['title'] && $value['description']) {
                DestinationInformation::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'destination_id' => $destination->id,
                ]);
            }
        }

        if ($request->parent_id) {
            return redirect()->route('admin.destinations.index', ['parent' => $request->parent_id])->with('success', 'Created Successfully');
        }
        return redirect()->route('admin.destinations.index')->with('success', 'Created Successfully');
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
    public function edit(Destination $destination)
    {
        $destinationOtherinfos = $destination->otherinfos;

        return view('admin.destination.edit', compact('destination', 'destinationOtherinfos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $input = $request->except('image');
        $image = $this->fileUpload($request, 'image');
        $banner_image = $this->fileUpload($request, 'banner_image');

        if ($image) {
            $this->removeFile($destination->image);
            $input['image'] = $image;
        }

        if ($banner_image) {
            $this->removeFile($destination->banner_image);
            $input['banner_image'] = $banner_image;
        }

        // for unique slug
        $slug = $request->name;
        if ($request->parent_id) {
            $parentId = $this->getParentDestinationId($request->parent_id);
            $parentDestination = Destination::where('id', $parentId)->first();
            $slug = $parentDestination->name . '-' . $request->name;
        }
        $input['slug'] = Str::slug($slug);
        $input['status'] = $request->status ? 1 : 0;
        $input['is_shown_homepage'] = $request->is_shown_homepage ? 1 : 0;
        $destination->update($input);

        //otherinfo
        $destination->otherinfos()->delete();
        foreach ($request->addmoreotherinfo as $key => $value) {
            if ($value['title'] && $value['description']) {
                DestinationInformation::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'destination_id' => $destination->id,
                ]);
            }
        }

        if ($request->parent_id) {
            return redirect()->route('admin.destinations.index', ['parent' => $request->parent_id])->with('success', 'Updated Successfully');
        }
        return redirect()->route('admin.destinations.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $this->removeFile($destination->image);
        $this->removeFile($destination->banner_image);
        $destination->delete();
        $destination->otherinfos()->delete();
        return redirect()->route('admin.destinations.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/destination';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $file2 = explode(asset('admin/images/destination') . '/', $file);
        if ($file) {
            $path = public_path() . '/admin/images/destination/' . $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    public function getParentDestinationId($parent_id)
    {
        $destination = Destination::where('id', $parent_id)->first();

        if ($destination->parent_id != 0) {
            return $this->getParentDestinationId($destination->parent_id);
        }

        return $destination->id;
    }
}
