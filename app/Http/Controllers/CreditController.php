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
        return view('credit.index');
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
            // "infocenter" => "accepted"
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
            // "infocenter.accepted" => "Debes aceptar la autorización antes."
        ]);
        $data_credit = (object)[
            "fullname" => $request->fullname,
            "ci" => $request->ci,
            "cellphone" => $request->cellphone,
            "exp" => $request->exp,
            "type" => $request->type,
            "product" => $request->product,
            "mount" => $request->mount,
            "rental" => $request->rental ?? 0,
            "credit_commercial" => $request->credit_commercial ?? 0,
            "credit_finance" => $request->credit_finance ?? 0
        ];
        Session::put('data_credit',$data_credit);

        switch ($request->type) {
            case 'dependiente':
                return redirect()->route('upload_file_dependent');
                break;

            case 'independiente':
                return redirect()->route('upload_file_independent');
                break;
        }
    }
    public function buro_crediticio_pdf()
    {
        $pdf = \PDF::loadView('credit.pdf.autorizacion_crediticia');
        return $pdf->setPaper([0, 0, 612.00, 792.00])->download('autorizacion_de_información_crediticia.pdf');
    }
    public function branch_offices()
    {
        return view('credit.branch_offices');
    }
    public function finish()
    {
        return view('credit.finish');
    }
}
