<?php

namespace App\Http\Controllers;

use App\Mail\CreditRegistered;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UploadFileDependent extends Controller
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
                    'id' => 'afp',
                    'title' => 'Extracto de AFP',
                    'description' => 'Ingresa una imagen o pdf del extracto de tu extracto de la AFP.',
                ],
                (object)[
                    'id' => 'pago1',
                    'title' => 'Última boleta de pago*',
                    'description' => 'Ingresa una imagen o pdf de tu última boleta de pago.',
                ],
                (object)[
                    'id' => 'pago2',
                    'title' => 'Penúltima boleta de pago',
                    'description' => 'Ingresa una imagen o pdf de tu penúltima boleta de pago.',
                ],
                (object)[
                    'id' => 'pago3',
                    'title' => 'Antepenúltima boleta de pago',
                    'description' => 'Ingresa una imagen o pdf de tu antepenúltima boleta de pago.',
                ],
                (object)[
                    'id' => 'buro_crediticio',
                    'title' => 'Autorización de Buro de Información Crediticio*',
                    'description' => 'Ingresa una imagen o pdf de la autorización descargada. Asegurate que este firmada y llenada con tu Datos personales.',
                ]
            ];
            return view('credit.upload_file_dependent', compact('inputs'));
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
                "afp.file" => "Necesita subir un archivo.",
                "afp.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago1.required" => "Campo obligatorio.",
                "pago1.file" => "Necesita subir un archivo.",
                "pago1.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago2.file" => "Necesita subir un archivo.",
                "pago2.max" => "El archivo no debe pesar mas de 7 mb.",
                "pago3.file" => "Necesita subir un archivo.",
                "pago3.max" => "El archivo no debe pesar mas de 7 mb.",
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
            $path_pago1 = $request->file('pago1')->store($url_file);
            $path_cre = $request->file('buro_crediticio')->store($url_file);

            if (isset($request->afp)) {
                $path_afp = $request->file('afp')->store($url_file);
            }
            if (isset($request->pago2)) {
                $path_pago1 = $request->file('pago2')->store($url_file);
            }
            if (isset($request->pago3)) {
                $path_pago3 = $request->file('pago3')->store($url_file);
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
