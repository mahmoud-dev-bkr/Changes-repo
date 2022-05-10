<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentDetailsController extends Controller
{
    //
    public function paymentDetailspage()
    {
        return view("Dashboard-pages.PaymentDetails.paymentdetails");
    }

    public function getpaymentdetailsdata()
    {
        $query = PaymentDetail::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("company_name", function (PaymentDetail $payment) {
                $id = $payment->company_id;
                $companyname = DB::table("payment_details")
                    ->select("companies.name_en")
                    ->join(
                        "companies",
                        "companies.id",
                        "=",
                        "payment_details.company_id"
                    )
                    ->where("payment_details.company_id", "=", $id)
                    ->get();
                return $companyname[0]->name_en;
            })
            ->addColumn("plan_name", function (PaymentDetail $payment) {
                $id = $payment->plan_id;
                $planname = DB::table("payment_details")
                    ->select("plans.name_en")
                    ->join("plans", "plans.id", "=", "payment_details.plan_id")
                    ->where("payment_details.plan_id", "=", $id)
                    ->get();
                return $planname[0]->name_en;
            })
            ->addColumn("payment_method", function (PaymentDetail $payment) {
                $id = $payment->paymethod_id;
                $paymentmthod = DB::table("payment_details")
                    ->select("payment_methods.name")
                    ->join(
                        "payment_methods",
                        "payment_methods.id",
                        "=",
                        "payment_details.paymethod_id"
                    )
                    ->where("payment_details.paymethod_id", "=", $id)
                    ->get();
                return $paymentmthod[0]->name;
            })
            ->toJson();
        return $data;
    }

    public function addpaymentdetails()
    {
        $plan = DB::table("plans")
            ->select("plans.name_en", "id")
            ->get();
        $company = DB::table("companies")
            ->select("companies.name_en", "id")
            ->get();
        $paymentMthod = DB::table("payment_methods")
            ->select("payment_methods.name", "id")
            ->get();

        return view(
            "Dashboard-pages.PaymentDetails.insert",
            compact("plan", "company", "paymentMthod")
        );
    }

    public function storepaymentdetails(Request $req)
    {
        $req->validate([
            "company" => "required",
            "plan" => "required",
            "paymentmethod" => "required",
            "pay_date" => "required",
            "start_date" => "required",
            // "end_date" => "required",
        ]);
        $pay = new PaymentDetail();
        $pay->plan_id = $req->plan;
        $pay->company_id = $req->company;
        $pay->paymethod_id = $req->paymentmethod;
        $pay->pay_date = $req->pay_date;
        $pay->start_date = $req->start_date;

        $date = Carbon::createFromFormat("Y-m-d", $req->start_date);
        $daysToAdd = Plan::find($req->plan)->duration_days;
        $pay->end_date = $date->addDays($daysToAdd);

        // $pay->user_id = Auth::id();
        $pay->save();
        return response(["msg" => "inserted"]);
    }
}
