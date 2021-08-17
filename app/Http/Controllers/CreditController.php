<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CreditController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function create(Request $request)
    {
        Session::forget('data_credit');
        if (isset($request->token) && isset($request->product)) {
            $product_ = ['description' => $request->product];
            $product = [(object)$product_];
        } else {
            $response = Http::get('https://hauscenter.com.bo/ecommerce/public/api/only-products');
            $product = json_decode($response->body());
        }
        return view('credit.create',compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "fullname" => "required|min:6",
            "ci" => "required|integer|min:99999",
            "cellphone" => "required|integer|min:9999999",
            "exp" => "required",
            "type" => "required",
            "product" => "required",
            "mount" => "required|integer|min:100",
            "rental" => "required",
            "credit_commercial" => "required",
            "credit_finance" => "required",
            "infocenter" => "accepted"
        ],[
            "fullname.required" => "Campo obligatorio.",
            "fullname.min" => "Mínimo 6 caracteres.",
            "ci.required" => "Campo obligatorio.",
            "ci.min" => "Mínimo 6 caracteres.",
            "cellphone.required" => "Campo obligatorio.",
            "cellphone.min" => "Mínimo 8 caracteres.",
            "exp.required" => "Campo obligatorio.",
            "type.required" => "Campo obligatorio.",
            "product.required" => "Campo obligatorio.",
            "mount.required" => "Campo obligatorio.",
            "mount.min" => "Mínimo 3 caracteres.",
            "rental.required" => "Campo obligatorio.",
            "credit_commercial.required" => "Campo obligatorio.",
            "credit_finance.required" => "Campo obligatorio.",
            "infocenter.accepted" => "Debes aceptar la autorización antes."
        ]);
        $data_credit = [
            "fullname" => $request->fullname,
            "ci" => $request->ci,
            "type" => $request->type,
        ];
        Session::put('data_credit',$data_credit);
        $s_credit = new ModelsRequest();
        $s_credit->fullname = strtoupper($request->fullname);
        $s_credit->ci = $request->ci;
        $s_credit->exp = strtoupper($request->exp);
        $s_credit->cellphone = $request->cellphone;
        $s_credit->type = $request->type;
        $s_credit->mount = $request->mount;
        $s_credit->rental = $request->rental;
        $s_credit->credit_commercial = $request->credit_commercial;
        $s_credit->product = strtoupper($request->product);
        $s_credit->credit_finance = $request->credit_finance;

        $s_credit->save();

        switch ($request->type) {
            case 'dependiente':
                return redirect()->route('upload_file_dependent');
                break;

            case 'independiente':
                return redirect()->route('upload_file_independent');
                break;
        }
    }
}
