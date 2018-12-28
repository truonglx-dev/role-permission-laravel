<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Hash;
use DB;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;

    }

    public function index()
    {
        $listPermission = $this->permission->all();
        return view('permission.index', compact('listPermission'));
    }

    public function create()
    {
        return view('permission.add');
    }

    public function store(Request $request)
    {
        // Insert data to user table
        $permissionCreate = $this->permission->create([
            'name' => $request->name,
            'display_name' => $request->display_name,
        ]);
        return redirect()->route('permission.index');
    }

    /**
     * @param $id
     * show form edit
     */
    public function edit($id)
    {
        $permission = $this->permission->findOrfail($id);
        return view('permission.edit', compact('permission'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */

    public function update(Request $request, $id)
    {
        $this->permission->where('id', $id)->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        return redirect()->route('permission.index');
    }


    public function delete($id)
    {
        $permission = $this->permission->find($id);
        $permission->delete($id);
        return redirect()->route('permission.index');
    }
}
