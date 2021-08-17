<?php

namespace App\Http\Controllers;

use App\Mail\CreditRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UploadFileIndependent extends Controller
{
    public function index()
    {
        if (Session::has('data_credit')) {
            return view('credit.upload_file_independent');
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
                "nit" => "required|file|max:7168",
                "license" => "file|max:7168",
                "entry" => "file|max:7168",
                "fundempresa" => "file|max:7168",
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
                "nit.required" => "Campo obligatorio.",
                "nit.file" => "Necesita subir un archivo.",
                "nit.max" => "El archivo no debe pesar mas de 7 mb.",
                "license.file" => "Necesita subir un archivo.",
                "license.max" => "El archivo no debe pesar mas de 7 mb.",
                "entry.file" => "Necesita subir un archivo.",
                "entry.max" => "El archivo no debe pesar mas de 7 mb.",
                "fundempresa.file" => "Necesita subir un archivo.",
                "fundempresa.max" => "El archivo no debe pesar mas de 7 mb.",
            ]);
            $data_credit = Session::get('data_credit');
            $name = $data_credit['fullname'];
            $ci = $data_credit['ci'];

            $url_file = "independent/$ci - $name";

            $path_ci1 = $request->file('ci1')->store($url_file);
            $path_ci2 = $request->file('ci2')->store($url_file);
            $path_cre = $request->file('cre')->store($url_file);
            $path_nit = $request->file('nit')->store($url_file);
            if (isset($request->license)) {
                $path_nit = $request->file('license')->store($url_file);
            }
            if (isset($request->entry)) {
                $path_pago1 = $request->file('entry')->store($url_file);
            }
            if (isset($request->fundempresa)) {
                $path_pago1 = $request->file('fundempresa')->store($url_file);
            }
            Mail::to('desarrollo@markas.com.bo')->send(new CreditRegistered());
            Session::forget('data_credit');
            return view('credit.finish');
        } else {
            return redirect()->view('credit.create');
        }
    }
}
