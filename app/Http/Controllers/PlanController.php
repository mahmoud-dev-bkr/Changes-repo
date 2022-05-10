<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class PlanController extends Controller
{
    public function index()
    {
        /*
            mahmoud Bkr
            1- method To get a view name index in folder Plans
            Dirctory Dashboard-pages/Paln/index.blade.php
        */
        return view("Dashboard-pages.plan.index");
    }

    public function insertPage()
    {
        /*
            mahmoud Bkr
            1- method To get a view name insert in folder Plans
            2- This File To create A new Plan 
            Dirctory Dashboard-pages/Paln/insert.blade.php
        */
        return view("Dashboard-pages.plan.insert");
    }

    public function createPlan(Request $req)
    {
        /*
            Mahmoud Bkr
            1- This Method To Insert All Data Plan Into DataBase And Validate
            
        */

        $validator = $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "coast" => "integer|required",
            "max_employee" => "integer|required",
            "duration_day" => "integer|required",
        ]);
        $id = Auth::user()->id;
        $plan = new Plan();
        $plan->name_en = $validator["name_en"];
        $plan->name_ar = $validator["name_ar"];
        $plan->max_emp = $validator["max_employee"];
        $plan->coast = $validator["coast"];
        $plan->duration_days = $validator["duration_day"];
        $plan->create_user_id = $id;
        $plan->save();
        return response()->json([
            "msg" => "Plan created successfully",
        ]);
    }

    public function getPlansData()
    {
        /*
            Mahmoud Bkr
            1- This Method To  Show The DataTable To Get All data Plan
        */
        $query = Plan::query();
        $data = Datatables()
            // here Edit View But Doesn't Work
            ->eloquent($query->latest())
            ->addColumn("action", function (Plan $plan) {
                $plan_id = $plan->id;
                return view("dashboard-layouts.actions", [
                    "type" => "plan_profile",
                    "plan_id" => $plan_id,
                ]);
            })
            // Here Get A Admin Name -> That Create This Plan
            ->addColumn("admin", function (Plan $plan) {
                $Admin_id = $plan->create_user_id;
                $Admin = DB::table("plans")
                    ->join("users", "plans.create_user_id", "=", "users.id")
                    ->where("plans.create_user_id", $Admin_id)
                    ->get();
                return $Admin[0]->name_en;
            })
            ->addColumn("edit", function (Plan $plan) {
                $Admin_id = $plan->update_user_id;
                if ($Admin_id == null) {
                    return "-";
                } else {
                    $Admin = DB::table("plans")
                        ->join("users", "plans.create_user_id", "=", "users.id")
                        ->where("plans.create_user_id", $Admin_id)
                        ->get();
                    return $Admin[0]->name_en;
                }
            })
            // Here Get A Status OF This Plan 0 => Not Activated 1 => Activate
            // Note You Must To Be Migrate To => Add The Status Plan
            ->addColumn("activate", function (Plan $plan) {
                $activate = $plan->activate;
                if ($activate == 0) {
                    return "Not Activate";
                } else {
                    return "Activate";
                }
            })

            ->toJson();
        return $data;
    }

    public function EditPage($paln_id)
    {
        $plan = DB::table("plans")
            ->where("id", $paln_id)
            ->first();
        return view("Dashboard-pages.plan.Update", ["plan" => $plan]);
    }

    public function EditPlan(Request $req)
    {
        /*
            Mahmoud Bkr
            1- This Method To Update  Data Plan Into DataBase 
        */
        // dd($req);
        $id = Auth::user()->id;
        $plan = Plan::find($req->id);
        $plan->name_en = $req->name_en;
        $plan->name_ar = $req->name_ar;
        $plan->activate = $req->status;
        $plan->update_user_id = $id;
        $plan->update();
        return response()->json([
            "msg" => "Plan update successfully",
        ]);
    }
}
