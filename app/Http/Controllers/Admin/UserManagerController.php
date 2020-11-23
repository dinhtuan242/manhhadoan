<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Property;
use App\Role;
use Toastr;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return view('admin.user.index', compact('users'));
    }
    public function block()
    {
        $users = User::orderBy('updated_at', 'DESC')
                        ->orderBy('status', 'ASC')
                        ->get();
        return view('admin.user.block', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'name'  => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
        ]);
        $username   = Str::slug($request['name']);
        User::create([
            'name'      => $request['name'],
            'email'     => $request['email'],
            'password'  => Hash::make($request['password']),
            'username'  => $username,
            'role_id'   => $request['role_id'],
        ]);
        Toastr::success('Thông báo', 'Thêm mới người dùng thành công');
        return redirect()->route('admin.user-manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->hasRole('Admin')) {
            return redirect()->route('home');
        }
        $agent = User::findOrFail($id);
        $properties = Property::latest()->where('agent_id', $id)->paginate(10);

        return view('pages.agents.single', compact('agent', 'properties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact(['roles', 'user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request['password']) {
            # code...
            $request->validate([
                'name'  => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'role_id' => 'required',
            ]);

            $user->update([
                'name'      => $request['name'],
                'password'  => Hash::make($request['password']),
                'role_id'   => $request['role_id'],
            ]);
        } else {
            $request->validate([
                'name'  => 'required|string|max:255',
                'role_id' => 'required',
            ]);
            $user->update([
                'name'      => $request['name'],
                'role_id'   => $request['role_id'],
            ]);
        }
        Toastr::success('Thông báo', 'Sửa người dùng thành công');
        return redirect()->route('admin.user-manager.index');
    }

    public function updateActive($id)
    {
        $agent = User::findOrFail($id);
        if ($agent->status == 1) {
            $agent->status = 0;
            $agent->save();
            Toastr::success('Thông báo', 'Khoá tài khoản thành công');
            return redirect()->route('admin.user-manager.block');
        } else {
            $agent->status = 1;
            $agent->save();
            Toastr::success('Thông báo', 'Mở tài khoản thành công');
            return redirect()->route('admin.user-manager.block');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('Thông báo', 'Xoá tài khoản thành công');
        return back();
    }

    public function report($id, Request $request)
    {
        $property = Property::findOrFail($id);
        $property->reason = $request['reason'];
        $property->isReport = 1;
        $property->save();
        if ($request->ajax()) {
            return response()->json(['Thông báo' => 'Báo cáo bài viết thành công']);
        }
    }
}
