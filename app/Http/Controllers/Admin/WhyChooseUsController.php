<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWhychooseusRequest;
use App\Http\Requests\Admin\UpdateWhychooseusRequest;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whychooseus = WhyChooseUs::latest()->paginate(10);
        return view('admin.whychooseus.index', compact('whychooseus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.whychooseus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWhychooseusRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $blog =  WhyChooseUs::create($input);
        $blog->update(['slug' => Str::slug($request->title)]);
        return redirect()->route('admin.whychooseus.index')->with('message', 'Created Successfully');
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
    public function edit(WhyChooseUs $whychooseu)
    {
        return view('admin.whychooseus.edit', compact('whychooseu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWhychooseusRequest $request, WhyChooseUs $whychooseu)
    {
        $old_image = $whychooseu->image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->title);
        $whychooseu->update($input);
        return redirect()->route('admin.whychooseus.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhyChooseUs $whychooseu)
    {
        $this->removeFile($whychooseu->image);
        $whychooseu->delete();
        return redirect()->route('admin.whychooseus.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/whychooseus';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $file2 = explode(asset('admin/images/whychooseus') . '/', $file);
        if ($file) {
            $path = public_path() . '/admin/images/whychooseus/' . $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
