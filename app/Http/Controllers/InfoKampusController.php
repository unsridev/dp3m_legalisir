<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Str;

class InfoKampusController extends Controller
{


public function index()
{
    return view('welcome');
}

public function lapor()
{
    return view('info.form');
}

public function index1()
{
    return view('index1');
}
public function form()
{
    return view('info.form');
}


public function simpan(Request $request)
{

$kode = 'IK'.date('Ymd').rand(100,999);

$data = $request->all();

$data['kode_tiket']=$kode;

if($request->file('file_identitas'))
{
$data['file_identitas']=$request
->file('file_identitas')
->store('identitas','public');
}

if($request->file('file_badan_hukum'))
{
$data['file_badan_hukum']=$request
->file('file_badan_hukum')
->store('badan','public');
}

Laporan::create($data);

return redirect()->back();

}

}