<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $siteSettings = Setting::pluck('value', 'key');

        $old_main_logo = $siteSettings['site_main_logo'];
        $old_footer_logo = $siteSettings['site_footer_logo'];
        $old_banner_image = $siteSettings['banner_image'];
        $old_fav_icon = $siteSettings['fav_icon'];
        $old_service_image = $siteSettings['service_image'];
        $old_about_page_image = $siteSettings['about_page_image'];
        $old_contact_page_image = $siteSettings['contact_page_image'];
        $old_affiliated_image = $siteSettings['affiliated_image'];
        $old_coe_image = $siteSettings['coe_image'];
        $old_destination_page_image = $siteSettings['destination_page_image'];

        $input = $request->all();
        $site_main_logo = $this->fileUpload($request, 'site_main_logo');
        $site_footer_logo = $this->fileUpload($request, 'site_footer_logo');
        $banner_image = $this->fileUpload($request, 'banner_image');
        $fav_icon = $this->fileUpload($request, 'fav_icon');
        $service_image = $this->fileUpload($request, 'service_image');
        $about_page_image = $this->fileUpload($request, 'about_page_image');
        $contact_page_image = $this->fileUpload($request, 'contact_page_image');
        $affiliated_image = $this->fileUpload($request, 'affiliated_image');
        $coe_image = $this->fileUpload($request, 'coe_image');
        $destination_page_image = $this->fileUpload($request, 'destination_page_image');

        //delete old file
        if ($site_main_logo) {
            $this->removeFile($old_main_logo);
            $input['site_main_logo'] = $site_main_logo;
        } else {
            unset($input['site_main_logo']);
        }

        if ($site_footer_logo) {
            $this->removeFile($old_footer_logo);
            $input['site_footer_logo'] = $site_footer_logo;
        } else {
            unset($input['site_footer_logo']);
        }

        if ($fav_icon) {
            $this->removeFile($old_fav_icon);
            $input['fav_icon'] = $fav_icon;
        } else {
            unset($input['fav_icon']);
        }

        if ($banner_image) {
            $this->removeFile($old_banner_image);
            $input['banner_image'] = $banner_image;
        } else {
            unset($input['banner_image']);
        }

        if ($service_image) {
            $this->removeFile($old_service_image);
            $input['service_image'] = $service_image;
        } else {
            unset($input['service_image']);
        }

        if ($about_page_image) {
            $this->removeFile($old_about_page_image);
            $input['about_page_image'] = $about_page_image;
        } else {
            unset($input['about_page_image']);
        }

        if ($contact_page_image) {
            $this->removeFile($old_contact_page_image);
            $input['contact_page_image'] = $contact_page_image;
        } else {
            unset($input['contact_page_image']);
        }

        if ($affiliated_image) {
            $this->removeFile($old_affiliated_image);
            $input['affiliated_image'] = $affiliated_image;
        } else {
            unset($input['affiliated_image']);
        }

        if ($coe_image) {
            $this->removeFile($old_coe_image);
            $input['coe_image'] = $coe_image;
        } else {
            unset($input['coe_image']);
        }

        if ($destination_page_image) {
            $this->removeFile($old_destination_page_image);
            $input['destination_page_image'] = $destination_page_image;
        } else {
            unset($input['destination_page_image']);
        }
        //end

        foreach ($input as $key => $value) {
            $setting->updateOrCreate(['key' => $key,], [
                'key' => $key,
                'value' => $value,
            ]);
        }
        return redirect()->back()->with('message', 'Setting Updated Successfully');
    }


    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/setting';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
            return $imageName;
        } else {
            return null;
        }
    }


    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/setting/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function globalFile($id, $entity, $folder, $column)
    {
        $namespace = '\\App\Models\\';
        $model = $namespace . $entity;
        $module = $model::find($id);

        $file2 = explode(asset('admin/images/'), $module->$column);
        if ($column) {
            $path = public_path() . '/admin/images/' .  $file2[1];
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $module->update([$column => NULL]);
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Package::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}
