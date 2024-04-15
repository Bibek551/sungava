<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Menu;
use App\Models\MenuLocation;
use App\Models\News;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Page;
use App\Models\Service;
use App\Models\Services;
use Session;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuitems = '';
        $desiredMenu = '';
        if (isset($_GET['id']) && $_GET['id'] != 'new') {
            $id = $_GET['id'];
            $desiredMenu = MenuLocation::where('id', $id)->first();
            if ($desiredMenu->content != '') {
                $menuitems = json_decode($desiredMenu->content);
                if ($menuitems) {
                    $menuitems = $menuitems[0];
                    foreach ($menuitems as $menu) {
                        $menu->title = Menu::where('id', $menu->id)->value('title');
                        $menu->name = Menu::where('id', $menu->id)->value('name');
                        $menu->slug = Menu::where('id', $menu->id)->value('slug');
                        $menu->target = Menu::where('id', $menu->id)->value('target');
                        $menu->type = Menu::where('id', $menu->id)->value('type');

                        if (!empty($menu->children[0])) {
                            foreach ($menu->children[0] as $child) {
                                $child->title = Menu::where('id', $child->id)->value('title');
                                $child->name = Menu::where('id', $child->id)->value('name');
                                $child->slug = Menu::where('id', $child->id)->value('slug');
                                $child->target = Menu::where('id', $child->id)->value('target');
                                $child->type = Menu::where('id', $child->id)->value('type');


                                if (!empty($child->children[0])) {
                                    foreach ($child->children[0] as $subchild) {
                                        $subchild->title = Menu::where('id', $subchild->id)->value('title');
                                        $subchild->name = Menu::where('id', $subchild->id)->value('name');
                                        $subchild->slug = Menu::where('id', $subchild->id)->value('slug');
                                        $subchild->target = Menu::where('id', $subchild->id)->value('target');
                                        $subchild->type = Menu::where('id', $subchild->id)->value('type');

                                        if (!empty($subchild->children[0])) {
                                            foreach ($subchild->children[0] as $newchild) {
                                                $newchild->title = Menu::where('id', $newchild->id)->value('title');
                                                $newchild->name = Menu::where('id', $newchild->id)->value('name');
                                                $newchild->slug = Menu::where('id', $newchild->id)->value('slug');
                                                $newchild->target = Menu::where('id', $newchild->id)->value('target');
                                                $newchild->type = Menu::where('id', $newchild->id)->value('type');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $desiredMenu = MenuLocation::orderby('id', 'DESC')->first();
                if ($desiredMenu) {
                    if ($desiredMenu->content != '') {
                        $menuitems = json_decode($desiredMenu->content);
                        $menuitems = $menuitems[0];
                        foreach ($menuitems as $menu) {
                            $menu->title = Menu::where('id', $menu->id)->value('title');
                            $menu->name = Menu::where('id', $menu->id)->value('name');
                            $menu->slug = Menu::where('id', $menu->id)->value('slug');
                            $menu->target = Menu::where('id', $menu->id)->value('target');
                            $menu->type = Menu::where('id', $menu->id)->value('type');
                            if (!empty($menu->children[0])) {
                                foreach ($menu->children[0] as $child) {
                                    $child->title = Menu::where('id', $child->id)->value('title');
                                    $child->name = Menu::where('id', $child->id)->value('name');
                                    $child->slug = Menu::where('id', $child->id)->value('slug');
                                    $child->target = Menu::where('id', $child->id)->value('target');
                                    $child->type = Menu::where('id', $child->id)->value('type');


                                    if (!empty($child->children[0])) {
                                        foreach ($child->children[0] as $subchild) {
                                            $subchild->title = Menu::where('id', $subchild->id)->value('title');
                                            $subchild->name = Menu::where('id', $subchild->id)->value('name');
                                            $subchild->slug = Menu::where('id', $subchild->id)->value('slug');
                                            $subchild->target = Menu::where('id', $subchild->id)->value('target');
                                            $subchild->type = Menu::where('id', $subchild->id)->value('type');

                                            if (!empty($subchild->children[0])) {
                                                foreach ($subchild->children[0] as $newchild) {
                                                    $newchild->title = Menu::where('id', $newchild->id)->value('title');
                                                    $newchild->name = Menu::where('id', $newchild->id)->value('name');
                                                    $newchild->slug = Menu::where('id', $newchild->id)->value('slug');
                                                    $newchild->target = Menu::where('id', $newchild->id)->value('target');
                                                    $newchild->type = Menu::where('id', $newchild->id)->value('type');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $menuitems = Menu::where('menu_id', $desiredMenu->id)->get();
                    }
                }
            }
        } else {
            $menuitems = '';
            $desiredMenu = '';
        }
        return view('admin.menu.index', ['posts' => Blog::all(), 'pages' => Page::oldest('title')->get(), 'packages' => Package::where('status', 1)->oldest('name')->get(), 'destinations' => Destination::where('status', 1)->oldest('name')->get(), 'menus' => MenuLocation::all(), 'desiredMenu' => $desiredMenu, 'menuitems' => $menuitems]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (MenuLocation::create($data)) {
            $newdata = MenuLocation::orderby('id', 'DESC')->first();
            Session::flash('success', 'Menu saved successfully !');
            return redirect("admin/menus?id=$newdata->id");
        } else {
            return redirect()->back()->with('error', 'Failed to save menu !');
        }
    }

    public function addPostToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = MenuLocation::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = Blog::where('id', $id)->value('title');
                $data['slug'] = '/blogs/' . Blog::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = Blog::where('id', $id)->value('title');
                $data['slug'] = '/blogs/' . Blog::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = Blog::where('id', $id)->value('title');
                $array['slug'] = '/blogs/' . Blog::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'post';
                $array['target'] = NULL;
                $array['id'] = Menu::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $oldata]);
            }
        }
    }

    public function addPageToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = MenuLocation::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = Page::where('id', $id)->value('title');
                $data['slug'] = '/' . Page::where('id', $id)->value('slug');
                $data['type'] = 'page';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = Page::where('id', $id)->value('title');
                $data['slug'] = '/' . Page::where('id', $id)->value('slug');
                $data['type'] = 'post';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = Page::where('id', $id)->value('title');
                $array['slug'] = '/' . Page::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'post';
                $array['target'] = NULL;
                $array['id'] = Menu::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $oldata]);
            }
        }
    }

    public function addPackageToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = MenuLocation::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = Package::where('id', $id)->value('name');
                $data['slug'] = '/packages/' . Package::where('id', $id)->value('slug');
                $data['type'] = 'package';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = Package::where('id', $id)->value('name');
                $data['slug'] = '/packages/' . Package::where('id', $id)->value('slug');
                $data['type'] = 'package';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = Package::where('id', $id)->value('name');
                $array['slug'] = '/packages/' . Package::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'package';
                $array['target'] = NULL;
                $array['id'] = Menu::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $oldata]);
            }
        }
    }

    public function addDestinationToMenu(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $ids = $request->ids;
        $menu = MenuLocation::findOrFail($menuid);
        if ($menu->content == '') {
            foreach ($ids as $id) {
                $data['title'] = Destination::where('id', $id)->value('name');
                $data['slug'] = '/destination/' . Destination::where('id', $id)->value('slug');
                $data['type'] = 'destination';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
        } else {
            $olddata = json_decode($menu->content, true);
            foreach ($ids as $id) {
                $data['title'] = Destination::where('id', $id)->value('name');
                $data['slug'] = '/destination/' . Destination::where('id', $id)->value('slug');
                $data['type'] = 'destination';
                $data['menu_id'] = $menuid;
                $data['updated_at'] = NULL;
                Menu::create($data);
            }
            foreach ($ids as $id) {
                $array['title'] = Destination::where('id', $id)->value('name');
                $array['slug'] = '/destination/' . Destination::where('id', $id)->value('slug');
                $array['name'] = NULL;
                $array['type'] = 'destination';
                $array['target'] = NULL;
                $array['id'] = Menu::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
                $array['children'] = [[]];
                array_push($olddata[0], $array);
                $oldata = json_encode($olddata);
                $menu->update(['content' => $oldata]);
            }
        }
    }

    public function addCustomLink(Request $request)
    {
        $data = $request->all();
        $menuid = $request->menuid;
        $menu = MenuLocation::findOrFail($menuid);
        if ($menu->content == '') {
            $data['title'] = $request->link;
            $data['slug'] = $request->url;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menu::create($data);
        } else {
            $olddata = json_decode($menu->content, true);
            $data['title'] = $request->link;
            $data['slug'] = $request->url;
            $data['type'] = 'custom';
            $data['menu_id'] = $menuid;
            $data['updated_at'] = NULL;
            Menu::create($data);
            $array = [];
            $array['title'] = $request->link;
            $array['slug'] = $request->url;
            $array['name'] = NULL;
            $array['type'] = 'custom';
            $array['target'] = NULL;
            $array['id'] = Menu::where('slug', $array['slug'])->where('name', $array['name'])->where('type', $array['type'])->orderby('id', 'DESC')->value('id');
            $array['children'] = [[]];
            array_push($olddata[0], $array);
            $olddata = json_encode($olddata);
            $menu->update(['content' => $olddata]);
        }
    }

    public function updateMenu(Request $request)
    {
        $newdata = $request->all();
        $menu = MenuLocation::findOrFail($request->menuid);
        $content = $request->data;
        $newdata = [];
        $newdata['location'] = $request->location;
        $newdata['content'] = json_encode($content);
        $menu->update($newdata);
    }

    public function updateMenuItem(Request $request)
    {
        $data = $request->all();
        $item = Menu::findOrFail($request->id);
        $item->update($data);
        return redirect()->back();
    }

    public function deleteMenuItem($id, $key, $in = '')
    {
        $menuitem = Menu::findOrFail($id);
        $menu = MenuLocation::where('id', $menuitem->menu_id)->first();
        if ($menu->content != '') {
            $data = json_decode($menu->content, true);
            $maindata = $data[0];
            if ($in == '') {
                unset($data[0][$key]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            } else {
                unset($data[0][$key]['children'][0][$in]);
                $newdata = json_encode($data);
                $menu->update(['content' => $newdata]);
            }
        }
        $menuitem->delete();
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        Menu::where('menu_id', $request->id)->delete();
        MenuLocation::findOrFail($request->id)->delete();
        return redirect('admin/menus')->with('success', 'Menu deleted successfully');
    }
}
