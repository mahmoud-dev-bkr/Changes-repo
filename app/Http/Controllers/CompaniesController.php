<?php

namespace App\Http\Controllers;

use App\Models\CompaniesRegistrationRequests;
use App\Models\Company;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    public function getCompaniesData()
    {
        $query = Company::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("location", function (Company $c) {
                return $c->long . " , " . $c->lat;
            })
            ->editColumn("commercial_record", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "link" => $c->commercial_record,
                    "type" => "file",
                ]);
            })
            ->editColumn("edite", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "company_id" => $c->id,
                    "type" => "eompany_profile",
                ]);
            })
            ->editColumn("tax_card", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "link" => $c->tax_card,
                    "type" => "file",
                ]);
            })
            ->editColumn("email", function (Company $c) {
                return view("dashboard-layouts.actions", [
                    "email" => $c->email,
                    "type" => "mailto",
                ]);
            })
            ->addColumn("user", function (Company $c) {
                if ($c->user_id) {
                    return User::find($c->user_id)->name_en;
                }
                return "not found";
            })
            ->addColumn("active", function (Company $c) {
                return $c->isActive ? "active" : "not active";
            })
            ->toJson();
        return $data;
    }

    public function companyPage()
    {
        return view("dashboard-pages.companies.index");
    }

    public function inserPage()
    {
        $plans = Plan::all();
        $methods = PaymentMethod::all();
        return view("dashboard-pages.companies.insert", [
            "plans" => $plans,
            "methods" => $methods,
        ]);
    }

    public function addCompany(Request $req)
    {
        $validator = $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "email" => "required|email|unique:companies",
            "tel1" => "required",
            "tel2" => "",
            "tel3" => "",
            "website" => "",
            "address" => "required",
            "long" => "required",
            "lat" => "required",
            "commercial_record" => "required|url",
            "tax_card" => "required|url",
            "timezone" => "required",
            "note" => "",
            "plan_id" => "required",
            "pay_method" => "required",
            "pay_date" => "required",
            "start_date" => "required",
        ]);
        $company = new Company();
        $company->name_en = $validator["name_en"];
        $company->name_ar = $validator["name_ar"];
        $company->Tel_1 = $validator["tel1"];
        $company->Tel_2 = $validator["tel2"];
        $company->Tel_3 = $validator["tel3"];
        $company->email = $validator["email"];
        $company->website = $validator["website"];
        $company->main_address = $validator["address"];
        $company->long = $validator["long"];
        $company->lat = $validator["lat"];
        $company->commercial_record = $validator["commercial_record"];
        $company->commercial_record = $validator["commercial_record"];
        $company->tax_card = $validator["tax_card"];
        $company->note = $validator["note"];
        $company->timezone = $validator["timezone"];
        $company->current_plan_id = $validator["plan_id"];
        $company->registration_num = $this->generateRandomString(12);
        $company->user_id = Auth::id();
        $company->isActive = true;
        $company->save();

        // create a payment details for the company
        $pay = new PaymentDetail();
        $pay->plan_id = $validator["plan_id"];
        $pay->company_id = $company->id;
        $pay->paymethod_id = $validator["pay_method"];

        $pay->pay_date = $req->pay_date;
        $pay->start_date = $req->start_date;

        $date = Carbon::createFromFormat("Y-m-d", $req->start_date);
        $daysToAdd = Plan::find($validator["plan_id"])->duration_days;
        $pay->end_date = $date->addDays($daysToAdd);

        // $pay->user_id = Auth::id();
        $pay->save();

        return response()->json([
            "msg" => "company and payment are added successfully",
        ]);
    }

    function generateRandomString($length)
    {
        $characters = "0123456789";
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function Registration($plan_id)
    {
        return view("Dashboard-pages.companies.registration", [
            "plan_id" => $plan_id,
        ]);
    }
    public function registrationPost(Request $req)
    {
        $validator = $req->validate([
            "name_en" => "required",
            "name_ar" => "required",
            "email" => "required|email|unique:companies",
            "tel1" => "required",
            "tel2" => "",
            "tel3" => "",
            "website" => "",
            "address" => "required",
            "long" => "required",
            "lat" => "required",
            "commercial_record" => "required|url",
            "tax_card" => "required|url",
            "timezone" => "required",
            "note" => "",
            "plan_id" => "required",
            // "pay_method" => "required",
            "pay_date" => "required",
            "start_date" => "required",
        ]);
        $company = new Company();
        $company->name_en = $validator["name_en"];
        $company->name_ar = $validator["name_ar"];
        $company->Tel_1 = $validator["tel1"];
        $company->Tel_2 = $validator["tel2"];
        $company->Tel_3 = $validator["tel3"];
        $company->email = $validator["email"];
        $company->website = $validator["website"];
        $company->main_address = $validator["address"];
        $company->long = $validator["long"];
        $company->lat = $validator["lat"];
        $company->commercial_record = $validator["commercial_record"];
        $company->commercial_record = $validator["commercial_record"];
        $company->tax_card = $validator["tax_card"];
        $company->note = $validator["note"];
        $company->timezone = $validator["timezone"];
        $company->current_plan_id = $validator["plan_id"];
        $company->registration_num = $this->generateRandomString(12);
        // $company->user_id = Auth::id();
        $company->isActive = false;
        $company->save();
        $companies_registration_requests = new CompaniesRegistrationRequests();
        $companies_registration_requests->company_id = $company->id;
        $companies_registration_requests->save();
        return response()->json([
            "msg" => "Added successfully, waiting for activation",
        ]);
    }
    public function EditPageCompany($company_id)
    {
        $company = DB::table("companies")
            ->where("id", $company_id)
            ->first();
        $plans = Plan::all();
        $methods = PaymentMethod::all();
        return view("Dashboard-pages.companies.Update", [
            "plans" => $plans,
            "methods" => $methods,
            "company" => $company,
        ]);
    }

    public function EditCompany(Request $req)
    {
        $id = Auth::user()->id;
        $company = Company::find($req->id);
        $company->name_en = $req->name_en;
        $company->name_ar = $req->name_ar;
        $company->email = $req->email;
        $company->Tel_1 = $req->tel1;
        $company->Tel_2 = $req->tel2;
        $company->Tel_3 = $req->tel3;
        $company->website = $req->website;
        $company->main_address = $req->address;
        $company->long = $req->long;
        $company->lat = $req->lat;
        $company->commercial_record = $req->commercial_record;
        $company->tax_card = $req->tax_card;
        $company->timezone = $req->timezone;
        $company->note = $req->note;
        $company->current_plan_id = $req->plan_id;
        $company->isActive = $req->isActive;
        $company->user_id = Auth::id();

        $company->update();
        return response()->json([
            "msg" => "Plan update successfully",
        ]);
    }

    public function RequestCompanyPage()
    {
        return view("Dashboard-pages.companies.Requests");
    }
    public function RequestCompanyPageEdit($company_id) 
    {
        $company = DB::table("companies")
            ->where("id", $company_id)
            ->first();
        
        $plans = Plan::all();
        $Requests =  CompaniesRegistrationRequests::all();
        $methods = PaymentMethod::all();
        return view("Dashboard-pages.companies.UpdateRequest", [
            "plans" => $plans,
            "methods" => $methods,
            "company" => $company,
            "Requests" => $Requests
        ]);
        
    }
    public function EditRequest(Request $req) 
    {
        $id = Auth::user()->id;
        // return $req;
        $company = Company::find($req->id);
        $company->name_en = $req->name_en;
        $company->name_ar = $req->name_ar;
        $company->email = $req->email;
        $company->Tel_1 = $req->tel1;
        $company->Tel_2 = $req->tel2;
        $company->Tel_3 = $req->tel3;
        $company->website = $req->website;
        $company->main_address = $req->address;
        $company->long = $req->long;
        $company->lat = $req->lat;
        $company->commercial_record = $req->commercial_record;
        $company->tax_card = $req->tax_card;
        $company->timezone = $req->timezone;
        $company->note = $req->note;
        $company->current_plan_id = $req->plan_id;
        $company->isActive = $req->isActive;
        $company->user_id = Auth::id();
        $company->update();
        $Requests = DB::table("companies_registration_requests")
            ->where("company_id", $req->id)
            ->update(['status' => $req->req_status, 'user_id'=>Auth::id()]);
        // return $company;
        // $Requests->status  = $req->req_status;
        // $Requests->user_id = Auth::id();
        // $Requests->update();
        return response()->json([
            "msg" => "Request And Update Company  successfully",
        ]);
    }
    public function RequestCompaniesData()
    {
        $query = CompaniesRegistrationRequests::query()->where('status','!=','3');
        $data = Datatables()
            ->eloquent($query->latest())

            ->addColumn("name_en", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->name_en;
                }
                return "not found";
            })
            ->addColumn("name_ar", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->name_ar;
                }
                return "not found";
            })
            ->addColumn("Tel_1", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->Tel_1;
                }
                return "not found";
            })
            ->addColumn("Tel_2", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->Tel_2;
                }
                return "not found";
            })
            ->addColumn("Tel_3", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->Tel_3;
                }
                return "not found";
            })
            ->addColumn("email", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->email;
                }
                return "not found";
            })
            ->addColumn("website", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->website;
                }
                return "not found";
            })
            ->addColumn("timezone", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->timezone;
                }
                return "not found";
            })
            ->addColumn("main_address", function (
                CompaniesRegistrationRequests $c
            ) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->main_address;
                }
                return "not found";
            })
            ->addColumn("location", function (
                CompaniesRegistrationRequests $c
            ) {
                if ($c->company_id) {
                    $c = Company::find($c->company_id);
                    return $c->long . " , " . $c->lat;
                }
                return "not found";
            })
            ->addColumn("commercial_record", function (
                CompaniesRegistrationRequests $c
            ) {
                if ($c->company_id) {
                    $c = Company::find($c->company_id);
                    return view("dashboard-layouts.actions", [
                        "link" => $c->commercial_record,
                        "type" => "file",
                    ]);
                    // return Company::find($c->company_id)->tax_card;
                }
                return "not found";
            })
            ->addColumn("tax_card", function (
                CompaniesRegistrationRequests $c
            ) {
                if ($c->company_id) {
                    $c = Company::find($c->company_id);
                    return view("dashboard-layouts.actions", [
                        "link" => $c->tax_card,
                        "type" => "file",
                    ]);
                    // return Company::find($c->company_id)->tax_card;
                }
                return "not found";
            })
            ->addColumn("active", function (CompaniesRegistrationRequests $c) {
                if ($c->company_id) {
                    return Company::find($c->company_id)->isActive
                        ? "active"
                        : "not active";
                }
                return "not found";
            })
            ->addColumn("user", function (CompaniesRegistrationRequests $c) {
                $company_id = Company::find($c->company_id);
                if ($company_id->user_id) {
                    return User::find($company_id->user_id)->name_en;
                }
                return "not found";
            })
            ->addColumn("current_plan_id", function (CompaniesRegistrationRequests $c) {
                $company_id = Company::find($c->company_id);
                if ($company_id->id) {
                    return Plan::find($company_id->current_plan_id)->name_en;
                }
                return "not found";
            })
            ->addColumn("status", function (CompaniesRegistrationRequests $c) {
                if($c->status ==1) {
                    return "under revision";
                }elseif($c->status == 2) {
                    return "mistake";
                }elseif($c->status == 3) {
                    return "Activated";
                }
                
                return "not found";
            })

            ->editColumn("edite", function (CompaniesRegistrationRequests $c) {
                return view("dashboard-layouts.actions", [
                    "company_id" => $c->company_id ,
                    "type" => "request_edit",
                ]);
            })


            ->toJson();
        return $data;
    }
}
