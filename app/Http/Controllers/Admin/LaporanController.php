<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

public function dashboard()
{

$total=Laporan::count();

$baru=Laporan::where('status','baru')->count();

$proses=Laporan::where('status','proses')->count();

$selesai=Laporan::where('status','selesai')->count();

return view('admin.dashboard',compact(
'total','baru','proses','selesai'
));

}



public function index()
{

$data=Laporan::latest()->paginate(10);

return view('admin.laporan.index',compact('data'));

}



public function detail($id)
{

$data=Laporan::findOrFail($id);

return view('admin.laporan.detail',compact('data'));

}



public function status(Request $request,$id)
{

Laporan::where('id',$id)->update([
'status'=>$request->status
]);

return back();

}

}