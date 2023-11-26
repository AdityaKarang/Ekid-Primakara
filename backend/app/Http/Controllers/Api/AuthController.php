<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        //get bentuk_danas
        $users = User::all();

        //return collection of bentuk_danas as a resource
        return new AuthResource(true, 'List User', $users);
    }
    // Function Add User
    public function addUser(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'username' => 'required|unique:users',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors(), 'data' => null], 409);
        }
        // dd($request->all());
        DB::beginTransaction();

        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'role' => $request->role,
                'prodi' => $request->prodi,
                'nidn' => $request->nidn,
                'jabatan_fungsional' => $request->jabatan_fungsional,
                'level_jabatan' => $request->level_jabatan,
                'ttl' => $request->ttl,
                'password' => bcrypt($request->password)
            ];

            $user = User::create($data);

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Roles added successfullly', 'data' => $user], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        }
    }

    // Function Update User
    public function updateUser(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'username' => 'required|unique:users,username,'.$id, // Menambahkan pengecualian untuk username yang sama dengan user lain
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors(), 'data' => null], 409);
        }

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->role = $request->role;
            $user->prodi = $request->prodi;
            $user->nidn = $request->nidn;
            $user->jabatan_fungsional = $request->jabatan_fungsional;
            $user->level_jabatan = $request->level_jabatan;
            $user->ttl = $request->ttl;

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'User updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        }
    }

    // Function Delete
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true, 'msg' => 'User deleted successfully', 'data' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        }
    }



    public function register(Request $request)
    {
        // $validator = \Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        //     'username' => 'required|unique:users',
        //     'role' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'msg' => $validator->errors(), 'data' => null], 409);
        // }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'prodi' => $request->prodi,
            'nidn' => $request->nidn,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'level_jabatan' => $request->level_jabatan,
            'ttl' => $request->ttl,
            'password' => bcrypt($request->password)
        ];

        $user = User::create($data);

        // $user['token'] = $user->createToken('authToken')->accessToken;

        return response()->json(['data' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $user['token'] = $user->createToken('authToken')->accessToken;

            return response()->json(['data' => $user], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function verify()
    {
        $user = Auth::user();

        if ($user) {
            // Jika pengguna diautentikasi, kembalikan data pengguna
            return response()->json($user);
        } else {
            // Jika pengguna tidak diautentikasi, kembalikan pesan error
            return response()->json(['errors' => 'Unauthorized'], 401);
        }
    }
}
