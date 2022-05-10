<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class AlertsController extends Controller
{
    //
    public function alertpage()
    {
        return view("Dashboard-pages.Alerts.Alert");
    }

    public function getalertdata()
    {
        $query = Alert::query();
        $data = Datatables()
            ->eloquent($query->latest())

            ->addColumn("username", function (Alert $alert) {
                $Admin_id = $alert->user_id;
                $Admin = DB::table("alerts")
                    ->join("users", "alerts.user_id", "=", "users.id")
                    ->where("alerts.user_id", $Admin_id)
                    ->get();
                return $Admin[0]->name_en;
            })

            ->addColumn("message_type", function (Alert $alert) {
                $msgtype = $alert->type;
                return view("Dashboard-pages.Alerts.action", [
                    "type" => "alert",
                    "msg_type" => $msgtype,
                ]);
            })
            ->addColumn("isActive", function (Alert $alert) {
                $active = $alert->is_activate;
                $id = $alert->id;
                return view("Dashboard-pages.Alerts.action", [
                    "type" => "togglealertActive",
                    "active_state" => $active,
                    "id" => $id,
                ]);
            })
            ->addColumn("action", function (Alert $alert) {
                $id = $alert->id;
                return view("Dashboard-pages.Alerts.action", [
                    "type" => "action",
                    "id" => $id,
                ]);
            })
            ->toJson();
        return $data;
    }

    public function toggleactivate(Request $req)
    {
        $id = $req->id;
        $state = $req->active_state;

        $payment_method = Alert::find($id);

        $payment_method->is_activate = $state ? false : true;
        $payment_method->save();
        $state_text = $state ? "not active any more" : "active now";
        return response()->json([
            "msg" => "Alert is " . $state_text,
        ]);
    }

    public function deletealert($id)
    {
        DB::table("alerts")->delete($id);
        return redirect()->back();
    }
    public function addalert()
    {
        // $users = DB::table("users")
        // ->select("id", "users.name")
        // ->get();
        return view("Dashboard-pages.Alerts.insert");
    }
    public function storealert(Request $req)
    {
        $req->validate([
            "msg_en" => "required",
            "msg_ar" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);
        $alert = new Alert();
        $alert->message_en = $req->msg_en;
        $alert->message_ar = $req->msg_ar;
        $alert->start_date = $req->start_date;
        $alert->end_date = $req->end_date;
        $alert->type = $req->type;
        $alert->user_id = Auth::id();
        $alert->save();
        return response(["msg" => "inserted"]);
    }
    public function EditPage($alert_id)
    {
        /*
            mahmoud 
            Here We can Update The Alert Give ID Alert To Update
        */
        $alert = DB::table("alerts")
            ->where("id", $alert_id)
            ->first();
        return view("Dashboard-pages.Alerts.Update", ["alert" => $alert]);
    }

    public function EditAlert(Request $req)
    {
        // here
        $id = Auth::user()->id;
        $alert = Alert::find($req->alert_id);
        $alert->message_en = $req->msg_en;
        $alert->message_ar = $req->msg_ar;
        $alert->start_date = $req->start_date;
        $alert->end_date = $req->end_date;
        $alert->type = $req->type;

        $alert->user_id = $id;
        $alert->update();
        return response()->json([
            "msg" => "alert update successfully",
        ]);
    }
}
