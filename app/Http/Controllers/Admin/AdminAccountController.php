<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminRequestAccount;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(AdminRequestAccount $request)
    {
        $data = $request->only('name', 'email', 'password', 'phone');
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return redirect()->route('get.admin.index')->with('success', 'Thêm admin thành công!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin.update', compact('admin'));
    }

    public function update(AdminRequestAccount $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->only('name', 'email', 'phone');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $admin->update($data);
        return redirect()->route('get.admin.index')->with('success', 'Cập nhật thành công!');
    }

    public function delete($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->id == get_data_user('admins', 'id')) {
            return redirect()->back()->with('error', 'Không thể xóa chính bạn!');
        }

        $admin->delete();
        return redirect()->route('get.admin.index')->with('success', 'Xóa thành công!');
    }
}
