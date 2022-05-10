<?php

use App\Http\Controllers\AlertsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LandpageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentDetailsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        "prefix" => LaravelLocalization::setLocale(),
        "middleware" => [
            "localeSessionRedirect",
            "localizationRedirect",
            "localeViewPath",
        ],
    ],
    function () {
        // landpage
        Route::get("/", [LandpageController::class, "HomePage"]);
        Route::get("/terms", [LandpageController::class, "TermsPage"]);
        Route::get("/Registration/company/{plan_id}", [
            CompaniesController::class,
            "Registration",
        ])->name("Registration.landpage");
        Route::post("/Registration/post", [
            CompaniesController::class,
            "registrationPost",
        ])->name("Registration.post.landpage");
        // Route::get('/test/purchase', 'OtpController@confirmationPage');
        // Route::get('/test/purchase',    [OtpController::class, 'confirmationPage']);
        Route::get('/test/otp-reques',  [OtpController::class, 'requestForOtp'])->name('validateOtp');
        Route::get('/test/otp-validate',[OtpController::class, 'validateOtp'])->name('resendOtp');
        Route::get('/test/otp-resend',  [OtpController::class, 'validateOtp'])->name('requestForOtp');
        //login routes //
        Route::group(
            ["prefix" => "admin", "middleware" => "user.noauth"],
            function () {
                Route::get("/login", [LoginController::class, "index"])->name(
                    "login"
                );
                Route::post("/login_request", [
                    LoginController::class,
                    "sign_in",
                ])->name("loginRequest");
            }
        );
        ///////////////////////////////////////////////////
        // dashboard pages
        Route::group(
            ["prefix" => "admin", "middleware" => ["user.auth"]],
            function () {
                // main admin page
                Route::get("/", [PagesController::class, "mainAdminPage"]);

                // companies routes
                Route::group(["prefix" => "company"], function () {
                    Route::get("/insert", [
                        CompaniesController::class,
                        "inserPage",
                    ]);

                    Route::get("/reqeusts", [
                        CompaniesController::class,
                        "RequestCompanyPage",
                    ])->name("RequestCompanyPage");
                    
                    Route::get("/reqeusts/data", [
                        CompaniesController::class,
                        "RequestCompaniesData",
                    ])->name("RequestCompaniesData");
                    
                    Route::get("/reqeusts/update/{company_id}", [
                        CompaniesController::class,
                        "RequestCompanyPageEdit",
                    ])->name("RequestCompanyPageEdit");

                    Route::post("/reqeusts/update/", [
                        CompaniesController::class,
                        "EditRequest",
                    ])->name("EditRequest");


                    Route::get("/", [
                        CompaniesController::class,
                        "companyPage",
                    ])->name("indexPage");

                    Route::get("/data", [
                        CompaniesController::class,
                        "getCompaniesData",
                    ])->name("getCompaniesData");
                    Route::post("/insert", [
                        CompaniesController::class,
                        "addCompany",
                    ])->name("addCompany");
                    // Edit view Company
                    Route::get("/update/{company_id}", [
                        CompaniesController::class,
                        "EditPageCompany",
                    ])->name("EditPageCompany");
                    // Edit Post Route A OLD Company
                    Route::post("/update", [
                        CompaniesController::class,
                        "EditCompany",
                    ])->name("EditCompany");
                });
                // start of plans routes-------------------------------------------

                // end of plans routes-------------------------------------------
                //start of users routes---------------------------------------------
                Route::group(["prefix" => "users"], function () {
                    ///////////////////////////////////////// users page
                    Route::get("/", [UsersController::class, "usersPage"]);
                    ///////////////////////////////////////////

                    ////////////////////page for inserting a new user////////////////////////////
                    Route::get("/insert", [
                        UsersController::class,
                        "insertPage",
                    ])->name("insertUserPage");

                    ////////////////////////////////////////////////////////
                    ////////////////////page for updating user////////////////////////////
                    Route::get("/update/{id}", [
                        UsersController::class,
                        "updatePage",
                    ])->name("updatePage");

                    Route::post("/update/{id}", [
                        UsersController::class,
                        "update",
                    ])->name("updateUser");

                    Route::patch("/toggle", [
                        UsersController::class,
                        "toggleActive",
                    ])->name("toggleActiveUser");
                    ////////////////////////////////////////////////////////////////////////////
                    Route::post("/insert", [
                        UsersController::class,
                        "createUser",
                    ])->name("addNewUser");

                    ////////////get users data for the datatable
                    Route::get("/data", [
                        UsersController::class,
                        "getUsersData",
                    ])->name("getUsersData");
                    ///////////////////////////////////////////////
                });
                //end of users routes------------------------------------------------
                // ---------------payment menthods
                Route::group(
                    [
                        "prefix" => "paymentsmethods",
                        "middleware" => ["user.auth"],
                    ],
                    function () {
                        Route::get("/", [
                            PaymentMethodController::class,
                            "PaymentMethodpage",
                        ]);
                        Route::get("/data", [
                            PaymentMethodController::class,
                            "getpaymentmethoddata",
                        ])->name("getPaymentData");
                        Route::patch("/toggleactivate", [
                            PaymentMethodController::class,
                            "toggleactivate",
                        ])->name("toggleactivate");
                    }
                );
                Route::group(["prefix" => "alerts"], function () {
                    Route::get("/", [AlertsController::class, "alertpage"]);

                    Route::get("/data", [
                        AlertsController::class,
                        "getalertdata",
                    ])->name("getalertdata");

                    Route::patch("togglealertactivate", [
                        AlertsController::class,
                        "toggleactivate",
                    ])->name("togglealertactivate");

                    Route::get("deletealert/{id}", [
                        AlertsController::class,
                        "deletealert",
                    ]);
                    Route::get("insertalert", [
                        AlertsController::class,
                        "addalert",
                    ])->name("insertalertPage");

                    Route::post("storealert", [
                        AlertsController::class,
                        "storealert",
                    ])->name("storealert");

                    Route::post("/update", [
                        AlertsController::class,
                        "EditAlert",
                    ])->name("EditAlert");

                    Route::get("/update/{alert_id}", [
                        AlertsController::class,
                        "EditPage",
                    ]);
                });

                // start of roles routes
                Route::group(["prefix" => "roles"], function () {
                    Route::get("/", [RolesController::class, "viewRoles"]);
                    Route::get("/data", [
                        RolesController::class,
                        "getRulesData",
                    ])->name("getRulesData");
                    // view for creating a new role
                    Route::get("/insert", [
                        RolesController::class,
                        "insertPage",
                    ])->name("insertRolePage");

                    Route::get("/update/{id}", [
                        RolesController::class,
                        "updatePage",
                    ])->name("updateRolePage");

                    Route::put("/update/{id}", [
                        RolesController::class,
                        "update",
                    ])->name("updateRole");

                    Route::post("/insert", [
                        RolesController::class,
                        "createRole",
                    ])->name("createRole");
                });
                // end of roles routes
                // start of terms routes
                Route::group(["prefix" => "terms"], function () {
                    Route::get("/", [TermsController::class, "termspage"]);
                    Route::get("/isnert", [
                        TermsController::class,
                        "insertTermPage",
                    ])->name("insertTermPage");

                    Route::post("/isnert", [
                        TermsController::class,
                        "insert",
                    ])->name("insertTerm");

                    Route::get("/update/{id}", [
                        TermsController::class,
                        "updatePage",
                    ])->name("updateTermPage");
                    Route::post("/update/{id}", [
                        TermsController::class,
                        "update",
                    ])->name("updateTerm");

                    Route::patch("/toggle", [
                        TermsController::class,
                        "toggleActive",
                    ])->name("toggleActiveTerm");
                });
                // end of terms routes
                // ----------------------------------< Palne >----------------------------------
                Route::group(
                    [
                        "prefix" => "Plan",
                        "middleware" => ["user.auth"],
                    ],
                    function () {
                        Route::get("/", [PlanController::class, "index"]);
                        // DataTable Get  Plans
                        Route::get("/data", [
                            PlanController::class,
                            "getPlansData",
                        ])->name("getPlansData");
                        // Insert A new Plan
                        Route::get("/insert", [
                            PlanController::class,
                            "insertPage",
                        ])->name("insertPlanPage");

                        // Create Post Route A new Plan
                        Route::post("/insert", [
                            PlanController::class,
                            "createPlan",
                        ])->name("insertPlan");
                        // Edit view Plan
                        Route::get("/update/{plan_id}", [
                            PlanController::class,
                            "EditPage",
                        ])->name("EditPage");
                        // Edit Post Route A OLD Plan
                        Route::post("/update", [
                            PlanController::class,
                            "EditPlan",
                        ])->name("EditPlan");
                    }
                );

                // ----------------------------------< End Plan >--------------------------------
                // start payment details
                Route::group(["prefix" => "paymentdetails"], function () {
                    Route::get("/", [
                        PaymentDetailsController::class,
                        "paymentDetailspage",
                    ]);
                    Route::get("/data", [
                        PaymentDetailsController::class,
                        "getpaymentdetailsdata",
                    ])->name("getpaymentdetailsData");
                    Route::get("addpaymentdetails", [
                        PaymentDetailsController::class,
                        "addpaymentdetails",
                    ])->name("addpaymentdetails");
                    Route::post("storepaymentdetails", [
                        PaymentDetailsController::class,
                        "storepaymentdetails",
                    ])->name("storepaymentdetails");
                });
                // logout user
                Route::delete("/logout", [
                    LoginController::class,
                    "sign_out",
                ])->name("logout");
            }
        );
    }
);
