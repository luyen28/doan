<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminRequestAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    public function index()
    {
        if (!check_admin()) return redirect()->route('get.admin.index');
        $admins = Admin::all();
        return view('admin.admin.index', ['admins' => $admins]);
    }

    public function create()
    {
        if (!check_admin_level(1)) return redirect()->back()->with('error', 'Bạn không có quyền tạo tài khoản!');
        return view('admin.admin.create');
    }

    public function store(AdminRequestAccount $request)
    {
        if (!check_admin_level(1)) return redirect()->back()->with('error', 'Bạn không có quyền tạo tài khoản!');
        $data = $request->except("_token");
        $data['password']   =  Hash::make($data['password']);
        $data['created_at'] = Carbon::now();
        Admin::insert($data);
        return redirect()->route('admin.index')->with('success', 'Thêm admin thành công!');
    }

    public function edit($id)
    {
        if (!check_admin_level(1)) return redirect()->back()->with('error', 'Bạn không có quyền sửa!');
        $admin = Admin::findOrFail($id);
        return view('admin.admin.update', compact('admin'));
    }

    public function update(AdminRequestAccount $request, $id)
    {
        if (!check_admin_level(1)) return redirect()->back()->with('error', 'Bạn không có quyền sửa!');
        $data = $request->except("_token", "password");
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        Admin::findOrFail($id)->update($data);
        return redirect()->route('admin.index')->with('success', 'Cập nhật thành công!');
    }

    public function delete($id)
    {
        if (!check_admin_level(1)) return redirect()->back()->with('error', 'Bạn không có quyền xóa!');
        $admin = Admin::findOrFail($id);

        if ($admin->id == get_data_user('admins', 'id')) {
            return redirect()->back()->with('error', 'Không thể xóa chính bạn!');
        }

        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Xóa thành công!');
    }
}
