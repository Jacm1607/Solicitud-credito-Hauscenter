<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ModelsRequest::orderBy('id','DESC')->paginate(10);
        return view('dashboard', compact('data'));
    }
    public function show($id)
    {
        $data   = ModelsRequest::findOrFail($id);
        $files  = Storage::allFiles("$data->type/$data->id");
        return view('credit.details_register', compact('files', 'data'));
    }
    public function getFile(Request $request)
    {
        if (Storage::disk('local')->exists($request->file)) {
            $path = Storage::disk('local')->path($request->file);
            return response()->download($path);
        } else {
            return abort(404);
        }
    }
}
