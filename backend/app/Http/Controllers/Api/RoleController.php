<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function addRole(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();

        try {

            $validator = \Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'msg' => $validator->errors(), 'data' => null], 409);
            }

            $data = [
                'name' => $request->name,
            ];

            $role = Role::create($data);

            // foreach ($request->permissions as $key => $value) {
            //     $rolePermission = [
            //         'role_id' => $role->id,
            //         'permission_id' => $value
            //     ];
            //     RolePermission::create($rolePermission);
            // }

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Roles added successfullly', 'data' => $role], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        }
    }
}
