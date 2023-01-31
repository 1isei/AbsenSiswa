<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
class JurusanController extends Controller
{
  public function index(){
    $resource=Jurusan::all();
    $resource = Jurusan::paginate(10);
    return view('admin/jurusan', ['resource'=>$resource]);   
  }
   
  public function create(Request $request){ 
    $jurusan = new Jurusan;
    $jurusan->Nama_Jurusan = $request->Nama_Jurusan;
    if($jurusan->save()){
      session()->flash('notif', array('success' => true, 'msgaction' => 'Tambah Data Berhasil!'));
    }
    
    return redirect('/admin/jurusan');
  }
}