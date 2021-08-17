<?php

namespace App\Http\Controllers;

use App\Mail\CreditRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UploadFileDependent extends Controller
{

    public function index()
    {
        if (Session::has('data_credit')) {
            return view('credit.upload_file_dependent');
        } else {
            return abort(404);
        }
    }

    public function store(Request $request)
    {
        if (Session::has('data_credit')) {
            $request->validate([
                "ci1" => "required|file|max:7168",
                "ci2" => "required|file|max:7168",
                "cre" => "required|file|max:7168",
                "afp" => "file|max:7168",
                "pago1" => "required|file|max:7168",
                "pago2" => "file|max:7168",
                "pago3" => "file|max:7168",
            ],[
                "ci1.required" => "Campo obligatorio.",
                "ci1.file" => "Necesita subir un archivo.",
                "ci1.max" => "El archivo no debe pesar mas de 7 mb.",
                "ci2.required" => "Campo obligatorio.",
                "ci2.file" => "Necesita subir un archivo.",
                "ci2.max" => "El archivo no debe pesar mas de 7 mb.",
                "cre.required" => "Campo obligatorio.",
                "cre.file" => "Necesita subir un archivo.",
                "cre.max" => "El archivo no debe pesar mas de 7 mb.",
                "afp.file" => "Necesita subir un archivo.",
                "afp.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago1.required" => "Campo obligatorio.",
                "pago1.file" => "Necesita subir un archivo.",
                "pago1.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago2.file" => "Necesita subir un archivo.",
                "pago2.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago3.file" => "Necesita subir un archivo.",
                "pago3.max" => "El archivo no debe pesar mas de 7 mb.",
            ]);
            $data_credit = Session::get('data_credit');
            $name = $data_credit['fullname'];
            $ci = $data_credit['ci'];

            $url_file = "dependent/$ci - $name";

            $path_ci1 = $request->file('ci1')->store($url_file);
            $path_ci2 = $request->file('ci2')->store($url_file);
            $path_cre = $request->file('cre')->store($url_file);
            $path_pago1 = $request->file('pago1')->store($url_file);
            if (isset($request->afp)) {
                $path_afp = $request->file('afp')->store($url_file);
            }
            if (isset($request->pago2)) {
                $path_pago1 = $request->file('pago2')->store($url_file);
            }
            if (isset($request->pago3)) {
                $path_pago3 = $request->file('pago3')->store($url_file);
            }
            Mail::to('desarrollo@markas.com.bo')->send(new CreditRegistered());
            Session::forget('data_credit');
            return view('credit.finish');
        } else {
            return redirect()->view('credit.create');
        }
    }
}
