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

            $url_file = "independiente/$s_credit->id";

            // CI ANVERSO
            $file_ci1 = $request->file('ci1');
            $ext_ci1 = $file_ci1->extension();
            $file_ci1->storeAs($url_file, "Carnet_identidad_anverso_$s_credit->id.$ext_ci1");
            // CI REVERSO
            $file_ci2 = $request->file('ci2');
            $ext_ci2 = $file_ci2->extension();
            $file_ci2->storeAs($url_file, "Carnet_identidad_reverso_$s_credit->id.$ext_ci2");
            // AVISO DE LUZ
            $file_cre = $request->file('cre');
            $ext_cre = $file_cre->extension();
            $file_cre->storeAs($url_file, "Aviso_luz_$s_credit->id.$ext_cre");
            // NIT
            $file_nit = $request->file('nit');
            $ext_nit = $file_nit->extension();
            $file_nit->storeAs($url_file, "NIT_$s_credit->id.$ext_nit");
            // BURO CREDITICIO
            $file_buro_crediticio = $request->file('buro_crediticio');
            $ext_buro_crediticio = $file_buro_crediticio->extension();
            $file_buro_crediticio->storeAs($url_file, "Buro_crediticio_$s_credit->id.$ext_buro_crediticio");
            if (isset($request->license)) {
                // $path_license = $request->file('license')->storeAs($url_file, "Licencia_funcionamiento_$s_credit->id");
                $file_license = $request->file('license');
                $ext_license = $file_license->extension();
                $file_license->storeAs($url_file, "Licencia_funcionamiento_$s_credit->id.$ext_license");
            }
            if (isset($request->entry)) {
                // $path_entry = $request->file('entry')->storeAs($url_file, "Respaldo_ingreso_$s_credit->id");
                $file_entry = $request->file('entry');
                $ext_entry = $file_entry->extension();
                $file_entry->storeAs($url_file, "Respaldo_ingreso_$s_credit->id.$ext_entry");
            }
            if (isset($request->fundempresa)) {
                // $path_fundempresa = $request->file('fundempresa')->storeAs($url_file, "Fundempresa_$s_credit->id");
                $file_fundempresa = $request->file('fundempresa');
                $ext_fundempresa = $file_fundempresa->extension();
                $file_fundempresa->storeAs($url_file, "Fundempresa_$s_credit->id.$ext_fundempresa");
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
