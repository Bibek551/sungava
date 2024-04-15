<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Destination;
use App\Models\GalleryPackage;
use App\Models\ItenaryPackage;
use App\Models\Package;
use App\Models\PackageActivity;
use App\Models\PackageCategory;
use App\Models\PackageInformation;
use App\Models\PackageService;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $packages = Package::when($request->search, function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->latest()->paginate(20);

        $searchParams =  $_GET ?? '';

        //for created message
        if (isset($_GET['created'])) {
            return redirect()->route('admin.packages.index')->with('success', 'Created/Updated Successfully');
        }

        return view('admin.package.index', compact('packages', 'searchParams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::where('status', 1)->where('parent_id', 0)->get();
        $packageDestinations = [];
        $packagecategories = PackageCategory::where('status', 1)->get();
        return view('admin.package.create', compact('destinations', 'packagecategories', 'packageDestinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $package =  Package::create($input);
        $package->update(['slug' => Str::slug($request->name)]);

        //attach destinations
        $package->destinations()->attach($request->destination_ids);

        //itenary
        foreach ($request->addmore as $key => $value) {
            if ($value['title'] && $value['description']) {
                ItenaryPackage::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //services
        foreach ($request->addmoreservice as $key => $service) {
            if ($service['service'] && $service['price']) {
                PackageService::create([
                    'service' => $service['service'],
                    'price' => $service['price'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //otherinfo
        foreach ($request->addmoreotherinfo as $key => $value) {
            if ($value['title'] && $value['description']) {
                PackageInformation::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //activities
        PackageActivity::updateOrCreate(
            [
                'package_id'   => $package->id,
            ],
            $request->all()
        );

        return redirect()->route('admin.upload.gallery', $package->id);
        // return redirect()->route('admin.packages.index')->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.package.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $packagecategories = PackageCategory::where('status', 1)->get();
        $destinations = Destination::where('status', 1)->where('parent_id', 0)->get();

        $packageDestinations = $package->destinations()->pluck('destination_id')->toArray();
        $packageItenary = $package->itenaries;
        $packageServices = $package->services;
        $packageOtherinfos = $package->otherinfos;
        $packageActivities = PackageActivity::where('package_id', $package->id)->first();

        return view('admin.package.edit', compact('package', 'packageDestinations', 'destinations', 'packagecategories', 'packageItenary', 'packageServices', 'packageActivities', 'packageOtherinfos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $old_image = $package->image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        $input['slug'] = Str::slug($request->name);
        $package->update($input);

        //packages
        // $package->destinations()->detach();
        $package->destinations()->sync($request->destination_ids);

        //iternary
        $package->itenaries()->delete();
        foreach ($request->addmore as $key => $value) {
            if ($value['title'] && $value['description']) {
                ItenaryPackage::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //service
        $package->services()->delete();
        foreach ($request->addmoreservice as $key => $s) {
            if ($s['service'] && $s['price']) {
                PackageService::create([
                    'service' => $s['service'],
                    'price' => $s['price'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //otherinfo
        $package->otherinfos()->delete();
        foreach ($request->addmoreotherinfo as $key => $value) {
            if ($value['title'] && $value['description']) {
                PackageInformation::create([
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'package_id' => $package->id,
                ]);
            }
        }

        //activities
        PackageActivity::updateOrCreate(
            [
                'package_id'   => $package->id,
            ],
            $request->all()
        );


        return redirect()->route('admin.upload.gallery', $package->id);
        // return redirect()->route('admin.packages.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $this->removeFile($package->image);
        $package->delete();
        $package->destinations()->detach();

        //delete galleries according to package
        $galleries = $package->galleries()->get();
        foreach ($galleries as $g) {
            $this->removeFile($g->image);
        }
        $package->galleries()->delete();
        //delete itenary
        $package->itenaries()->delete();
        //delete service
        $package->services()->delete();
        $package->otherinfos()->delete();
        $package->activity()->delete();

        return redirect()->route('admin.packages.index')->with('message', 'Delete Successfully');
    }

    public function galleryUpload($package_id)
    {
        $package = Package::findOrFail($package_id);
        // $galleries = GalleryPackage::where('package_id', $package_id)->get();
        $galleries = $package->galleries()->get();
        return view('admin.package.gallery', compact('package_id', 'galleries', 'package'));
    }

    public function galleryUploadStore(Request $request, $package)
    {
        $fileName = $this->fileUpload($request, 'file');
        GalleryPackage::create([
            'image' => $fileName,
            'package_id' => $package,
        ]);
    }


    public function packageGalleryDelete($image_id)
    {
        $gallery = GalleryPackage::findOrFail($image_id);
        $this->removeFile($gallery->image);
        $gallery->delete();
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/package';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }


    public function removeFile($file)
    {
        $file2 = explode(asset('admin/images/package') . '/', $file);
        if ($file) {
            $path = public_path() . '/admin/images/package/' . $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
