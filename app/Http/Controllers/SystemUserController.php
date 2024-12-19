<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\UserPermission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SystemUserController extends Controller
{
    public function index()
    {
        $data = [];
        $data['users'] = User::where('owner_id', session('owner_id'))->get();
        // if (session('auth_id') == session('owner_id')) {
        //     $data['branches'] = Branch::where('owner_id', session('owner_id'))->get();
        //     $data['update_branches'] = Branch::where('owner_id', session('owner_id'))->get();
        // } else {
        //     $branch_id = UserPermission::where('owner_id', session('owner_id'))->where('user_id', session('auth_id'))->pluck('id')->toArray();
        //     $data['branches'] = Branch::where('owner_id', session('owner_id'))->whereIn('id', $branch_id)->where('status', 1)->get();
        // }

        // $data['menuList'] = menuList();
        return view('root.system-user', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'responsibility' => $request->responsibility,
                'email_verified_at' => now()
            ]);

            if (!is_null($request->permission)) {

                UserPermission::create([
                    'owner_id' => session('owner_id'),
                    'user_id' => $user->id,
                    'permission' => $request->permission
                ]);
            }
            DB::commit();
            return back()->withToastSuccess('New system user created successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $user = User::where('owner_id', session('owner_id'))->where('id', $id)->first();
            if (!$user) {
                return back()->withToastError('No data found');
            }

            $image = null;
            if ($request->hasFile('image')) {
                $file_name = $request->file('image');
                $image = uploadImage('user', $file_name);

                $user->update([
                    'image' => $image
                ]);
            }

            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'responsibility' => $request->responsibility,
            ]);

            if ($request->password) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            if (isset($user->userPermission)) {
                $user->userPermission()->delete();
            }

            if ($request->permission) {

                UserPermission::create([
                    'owner_id' => session('owner_id'),
                    'user_id' => $user->id,
                    'permission' => $request->permission
                ]);
            }
            DB::commit();
            return back()->withToastSuccess('system user updated successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function status(Request $request, $id)
    {
        $item = UserPermission::where('owner_id', session('owner_id'))->where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
        return back()->withToastSuccess('System user status updated successfully');
    }
    public function delete(Request $request, $id)
    {
        $item = UserPermission::where('owner_id', session('owner_id'))->where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        $item->delete();
        return back()->withToastSuccess('User access permission deleted successfully');
    }
    public function rootStatus(Request $request, $id)
    {
        $item = User::where('owner_id', session('owner_id'))->where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        $item->status = $item->status == 1 ? 0 : 1;
        $item->save();
        return back()->withToastSuccess('User status updated successfully');
    }
    public function deleteRootUser(Request $request, $id)
    {
        $item = User::where('owner_id', session('owner_id'))->where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        if ($item->userPermission() !== null) {
            $item->userPermission()->delete();
        }
        $item->delete();
        return back()->withToastSuccess('User deleted successfully');
    }
}
