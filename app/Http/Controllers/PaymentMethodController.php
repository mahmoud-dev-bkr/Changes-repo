<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //
    public function PaymentMethodpage()
    {
        return view("Dashboard-pages.PaymentMethod.Payment_method");
    }

    public function getpaymentmethoddata()
    {
        $query = PaymentMethod::query();
        $data = Datatables()
            ->eloquent($query->latest())
            ->addColumn("isActive", function (PaymentMethod $pay) {
                $active = $pay->isActive;
                $id = $pay->id;
                return view("Dashboard-pages.PaymentMethod.action", [
                    "type" => "togglePMethodsActive",
                    "active_state" => $active,
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

        $payment_method = PaymentMethod::find($id);

        $payment_method->isActive = $state ? false : true;
        $payment_method->save();
        if ($state) {
            return response()->json([
                "error" => "payment method is not active any more",
            ]);
        } else {
            return response()->json([
                "msg" => "payment method is active now",
            ]);
        }
    }
}
