<?php

namespace App\Http\Controllers;

use App\Mail\CreditRegistered;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UploadFileIndependent extends Controller
{
    public function index()
    {
        if (Session::has('data_credit')) {
            $inputs = [
                (object)[
                    'id' => 'ci1',
                    'title' => 'Cédula de identidad anverso*',
                    'description' => 'Ingresa una imagen o pdf de la cédula de identidad del lado anverso.',
                ],
                (object)[
                    'id' => 'ci2',
                    'title' => 'Cédula de identidad reverso*',
                    'description' => 'Ingresa una imagen o pdf de la cédula de identidad del lado reverso.',
                ],
                (object)[
                    'id' => 'cre',
                    'title' => 'Aviso de Luz (CRE)*',
                    'description' => 'Ingresa una imagen o pdf de la última factura de cre.',
                ],
                (object)[
                    'id' => 'nit',
                    'title' => 'NIT*',
                    'description' => 'Ingresa una imagen o pdf de tu Número de Identificación Tributario.',
                ],
                (object)[
                    'id' => 'license',
                    'title' => 'Licencia de funcionamiento',
                    'description' => 'Ingresa una imagen o pdf de tu última boleta de pago.',
                ],
                (object)[
                    'id' => 'entry',
                    'title' => 'Respaldo de ingresos',
                    'description' => 'Ingresa una imagen o pdf de tus respaldo de ingresos.',
                ],
                (object)[
                    'id' => 'fundempresa',
                    'title' => 'Registro Fundempresa',
                    'description' => 'Ingresa una imagen o pdf de tu registro de fundempresa.',
                ],
                (object)[
                    'id' => 'buro_crediticio',
                    'title' => 'Autorización de Buro de Información Crediticio*',
                    'description' => 'Ingresa una imagen o pdf de la autorización descargada. Asegurate que este firmada y llenada con tu Datos personales.',
                ]
            ];
            return view('credit.upload_file_independent', compact('inputs'));
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
                "buro_crediticio" => "required|file|max:7168",
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
                "buro_crediticio.required" => "Campo obligatorio.",
                "buro_crediticio.file" => "Necesita subir un archivo.",
                "buro_crediticio.max" => "El archivo no debe pesar mas de 7 mb.",
            ]);
            $data_credit = Session::get('data_credit');
            // dd($data_credit->fullname);
            $fullname = $data_credit->fullname;
            $ci = $data_credit->ci;

            $s_credit = new ModelsRequest();
            $s_credit->fullname = strtoupper($fullname);
            $s_credit->ci = $ci;
            $s_credit->exp = strtoupper($data_credit->exp);
            $s_credit->cellphone = $data_credit->cellphone;
            $s_credit->type = $data_credit->type;
            $s_credit->mount = $data_credit->mount;
            $s_credit->rental = $data_credit->rental;
            $s_credit->credit_commercial = $data_credit->credit_commercial;
            $s_credit->product = strtoupper($data_credit->product);
            $s_credit->credit_finance = $data_credit->credit_finance;

            $s_credit->save();

            $url_file = "dependent/$ci - $fullname";

            $path_ci1 = $request->file('ci1')->store($url_file);
            $path_ci2 = $request->file('ci2')->store($url_file);
            $path_cre = $request->file('cre')->store($url_file);
            $path_nit = $request->file('nit')->store($url_file);
            $path_buro_crediticio = $request->file('buro_crediticio')->store($url_file);
            if (isset($request->license)) {
                $path_license = $request->file('license')->store($url_file);
            }
            if (isset($request->entry)) {
                $path_pago1 = $request->file('entry')->store($url_file);
            }
            if (isset($request->fundempresa)) {
                $path_pago1 = $request->file('fundempresa')->store($url_file);
            }

            if (env('APP_ENV') == 'local') {
                Mail::to('desarrollo@markas.com.bo')->send(new CreditRegistered());
            } else {
                Mail::to('ecommerce@hauscenter.com.bo')->send(new CreditRegistered());
            }

            Session::forget('data_credit');
            return redirect()->route('finish_credit');
        } else {
            return redirect()->view('credit.create');
        }
    }
}
