<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuGroup;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Show menu groups + menus
    public function index()
    {
        $groups = MenuGroup::all();
        return view('admin.menu.index', compact('groups'));
    }

    public function create()
    {
        $menu_groups = MenuGroup::all();
        return view('admin.menu.create',compact('menu_groups'));
    }
    public function edit($group_id)
    {
        // Get the Menu Group
        $menu_group = MenuGroup::findOrFail($group_id);

        // Get all Menus under this group
        $menus = Menu::where('group_id', $group_id)->orderBy('sort_order')->get();

        // Get all groups for dropdown
        $menu_groups = MenuGroup::all();

        return view('admin.menu.edit', compact('menu_group', 'menus', 'menu_groups'));
    }



    public function menuGroupStore(Request $request)
    {
        MenuGroup::create([
            'group_name'=>$request->group_name
        ]);

        return redirect()->back()->with('success', 'Menu group created successfully!');
    }
    public function menuGroupUpdate(Request $request,$id)
    {
        $menu_group = MenuGroup::findOrFail($id);
        $menu_group->group_name = $request->group_name;
        $menu_group->save();
        return redirect()->back()->with('success', 'Menu group update successfully!');
    }
    public function menuStore(Request $request)
    {
        Menu::create([
            'group_id'=>$request->group_id,
            'title'=>$request->title, 
            'url'=>$request->url, 
            'sort_order'=>$request->sort_order, 
            'status'=>$request->status
        ]);

        return redirect()->back()->with('success', 'Menu created successfully!');
    }
    public function menuUpdate(Request $request,$id)
    {
        $menu = Menu::findOrFail($id);
        $menu->group_id = $request->group_id;
        $menu->title = $request->title;
        $menu->url = $request->url;
        $menu->sort_order = $request->sort_order;
        $menu->status = $request->status;
        $menu->save();
        return redirect()->back()->with('success', 'Menu update successfully!');
    }

    public function update(Request $request, $id)
    {
        Menu::findOrFail($id)->update($request->all());

        return redirect()->route('admin.menu.index', ['group_id' => $request->group_id])
            ->with('success', 'Menu updated successfully!');
    }

    public function delete($id)
    {
        $menuGroup = MenuGroup::findOrFail($id);
        $menuGroup->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully!');
    }

    public function toggleStatus(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $menu->status = !$menu->status;
        $menu->save();

        return response()->json(['success' => true]);
    }
}
