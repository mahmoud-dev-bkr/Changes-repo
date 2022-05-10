<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function viewRoles()
    {
        return view("dashboard-pages.roles.index");
    }

    public function getRulesData()
    {
        $query = Role::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("users", function (Role $role) {
                $users = $role->users;
                return view("dashboard-layouts.actions", [
                    "users" => $users,
                    "type" => "roles_users",
                ]);
            })
            ->addColumn("actions", function (Role $role) {
                $roleId = $role->id;
                return view("dashboard-layouts.actions", [
                    "id" => $roleId,
                    "type" => "roles_actions",
                ]);
            })
            ->toJson();
        return $data;
    }
    public function insertPage()
    {
        $permissions = Permission::orderBy("name", "desc")->get();
        return view("dashboard-pages.roles.create", compact("permissions"));
    }
    public function createRole(Request $req)
    {
        $validator = $req->validate(
            [
                "name" => "required|alpha_dash|unique:roles",
                "display_name" => "required",
                "permissions" => "required",
                "note" => "",
            ],
            [
                "permissions.required" =>
                    "you should select at least on permission",
            ]
        );
        $permissions = $req->permissions;
        $name = $validator["name"];
        $display_name = $validator["display_name"];
        $note = $validator["note"];

        $role = Role::create([
            "name" => $name,
            "display_name" => $display_name,
            "description" => $note,
        ]);

        foreach ($permissions as $p) {
            $role->attachPermission($p);
        }
        return response()->json(["msg" => "role is created successfully"]);
    }

    public function updatePage($id)
    {
        $permissions = Permission::orderBy("name", "desc")->get();

        $role = Role::find($id);
        return view(
            "dashboard-pages.roles.update",
            compact("permissions", "role")
        );
    }
    public function update(Request $req, $id)
    {
        $validator = $req->validate(
            [
                "name" => "required|alpha_dash|unique:roles,name," . $id,
                "display_name" => "required",
                "permissions" => "required",
                "note" => "",
            ],
            [
                "permissions.required" =>
                    "you should select at least on permission",
            ]
        );
        $role = Role::find($id);
        $role->name = $validator["name"];
        $role->display_name = $validator["display_name"];
        $role->note = $validator["note"];
        $role->syncPermissions($req->permissions);
        $role->save();
        return response()->json(["msg" => "role is updated successfully"]);
    }
}
