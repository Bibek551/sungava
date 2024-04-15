<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageCategoryRequest;
use App\Http\Requests\Admin\UpdatePackageCategoryRequest;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagecategories = PackageCategory::latest()->paginate(10);
        return view('admin.packagecategory.index', compact('packagecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packagecategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageCategoryRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $packagecategory =  PackageCategory::create($input);
        $packagecategory->update(['slug' => Str::slug($request->name)]);
        return redirect()->route('admin.packagecategories.index')->with('message', 'Created Successfully');
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
    public function edit(PackageCategory $packagecategory)
    {
        return view('admin.packagecategory.edit', compact('packagecategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageCategoryRequest $request, PackageCategory $packagecategory)
    {
        $old_image = $packagecategory->image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $packagecategory->update($input);
        return redirect()->route('admin.packagecategories.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageCategory $packagecategory)
    {
        $this->removeFile($packagecategory->image);
        $packagecategory->delete();
        return redirect()->route('admin.packagecategories.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/packagecategory';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }


    public function removeFile($file)
    {
        $file2 = explode(asset('admin/images/packagecategory') . '/', $file);
        if ($file) {
            $path = public_path() . '/admin/images/packagecategory/' . $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
