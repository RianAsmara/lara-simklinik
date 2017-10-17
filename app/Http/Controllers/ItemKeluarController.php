<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB; 
use App\ItemKeluar; 
use App\TbsItemKeluar;
use App\DetailItemKeluar;  
use App\EditTbsItemKeluar;
use App\Produk;  
use Session;
use Auth;
use Laratrust;

class ItemKeluarController extends Controller
{
    //MENAMPILKAN DATA YG ADA DI ITEM KELUAR
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $item_keluar = ItemKeluar::all();
            return Datatables::of($item_keluar)->addColumn('action', function($itemkeluar){
              $detail_item_keluar = DetailItemKeluar::with(['produk'])->where('no_faktur',$itemkeluar->no_faktur)->get();
                return view('item_keluar._action', [
                    'model'             => $itemkeluar,
                    'id_item_keluar'     => $itemkeluar->id,
                    'data_detail_item_keluar'     => $detail_item_keluar,
                    'form_url'          => route('item-keluar.destroy', $itemkeluar->id),
                    'edit_url'          => route('item-keluar.proses_form_edit', $itemkeluar->id),
                    'confirm_message'   => 'Anda Yakin Ingin Menghapus Item Keluar '.$itemkeluar->no_faktur.'?',
                ]);
            })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'no_faktur', 'name' => 'no_faktur', 'title' => 'No. Faktur'])

            ->addColumn(['data' => 'keterangan', 'name' => 'keterangan', 'title' => 'Keterangan'])
         
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Waktu'])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Waktu Edit'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('item_keluar.index')->with(compact('html'));

    }


//MENAMPILKAN DATA YG ADA DI TBS ITEM KELUAR
    public function create(Request $request, Builder $htmlBuilder){
        if ($request->ajax()) {
            $session_id = session()->getId();
            $tbs_item_keluar = TbsItemKeluar::with(['produk'])->where('session_id', $session_id)->get();
                return Datatables::of($tbs_item_keluar)->addColumn('action', function($tbsitemkeluar){
                  $pesan_alert = 'Anda Yakin Ingin Menghapus Produk "'.$tbsitemkeluar->produk->nama_produk.'" ?';
                return view('item_keluar._hapus_produk', [
                        'model'             => $tbsitemkeluar,
                        'form_url'          => route('item-keluar.proses_hapus_tbs_item_keluar', $tbsitemkeluar->id_tbs_item_keluar),  
                        'confirm_message'   => $pesan_alert
                        ]);
                })->editColumn('data_produk_tbs', function($data_produk_tbs){

                    return $data_produk_tbs->produk->kode_produk.' - '.$data_produk_tbs->produk->nama_produk; 
               
            })->make(true);
        }
        
        $html = $htmlBuilder
            ->addColumn(['data' => 'data_produk_tbs', 'name' => 'data_produk_tbs', 'title' => 'Produk'])
            ->addColumn(['data' => 'jumlah_produk', 'name' => 'jumlah_produk', 'title' => 'Jumlah'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Hapus', 'orderable' => false, 'searchable'=>false]);

        return view('item_keluar.create')->with(compact('html'));
    }

    //PROSES TAMBAH TBS ITEM KELUAR
    public function proses_tambah_tbs_item_keluar(Request $request){
        $this->validate($request, [
            'id_produk'     => 'required|numeric',
            'jumlah_produk' => 'required|numeric|digits_between:1,15',
        ]);

        $session_id = session()->getId();

        $data_tbs = TbsItemKeluar::where('id_produk', $request->id_produk)
        ->where('session_id', $session_id)
        ->count();
        
        $data_produk = Produk::select('nama_produk')->where('id', $request->id_produk)->first();
      
//JIKA PRODUK YG DIPILIH SUDAH ADA DI TBS
        if ($data_tbs > 0) {
            
            $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">warning</i>
                    </div>
                    <b>Warning : Produk "'.$data_produk->nama_produk.'" Sudah Ada, Silakan Pilih Produk Lain !</b>
                </div>';

            Session::flash("flash_notification", [
              "level"=>"warning",
              "message"=> $pesan_alert
            ]); 

            return redirect()->route('item-keluar.create');
        }
        else{

           $pesan_alert = 
             '<div class="container-fluid">
                  <div class="alert-icon">
                  <i class="material-icons">check</i>
                  </div>
                  <b>Sukses : Berhasil Menambah Produk "'.$data_produk->nama_produk.'"</b>
              </div>';

            $tbsitemkeluar = TbsItemKeluar::create([
                'id_produk' =>$request->id_produk,              
                'session_id' => $session_id,
                'jumlah_produk' =>$request->jumlah_produk,
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=> $pesan_alert
            ]);
            return redirect()->route('item-keluar.create');
        }
    }


        //PROSES TAMBAH EDIT TBS ITEM keluar
    public function proses_tambah_edit_tbs_item_keluar(Request $request,$id)
    { 
        $this->validate($request, [
            'id_produk'     => 'required|numeric',
            'jumlah_produk' => 'required|digits_between:1,15|numeric',
            ]);

        $data_item_keluar = ItemKeluar::find($id);    
        $session_id = session()->getId();

        $data_tbs = EditTbsItemKeluar::select('id_produk')
        ->where('id_produk', $request->id_produk)
        ->where('no_faktur', $data_item_keluar->no_faktur)
        ->where('session_id', $session_id)
        ->count();

        $data_produk = Produk::select('nama_produk')->where('id', $request->id_produk)->first();
        $pesan_alert = "Produk '".$data_produk->nama_produk."' Sudah Ada, Silakan Pilih Produk Lain !";


      //JIKA PRODUK YG DIPILIH SUDAH ADA DI TBS
        if ($data_tbs > 0) {
            
            $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">warning</i>
                    </div>
                    <b>Warning : Produk "'.$data_produk->nama_produk.'" Sudah Ada, Silakan Pilih Produk Lain !</b>
                </div>';

            Session::flash("flash_notification", [
              "level"=>"warning",
              "message"=> $pesan_alert
            ]); 

            return back();
        }
        else{

           $pesan_alert = 
             '<div class="container-fluid">
                  <div class="alert-icon">
                  <i class="material-icons">check</i>
                  </div>
                  <b>Sukses : Berhasil Menambah Produk "'.$data_produk->nama_produk.'"</b>
              </div>';

            $tbsitemkeluar = EditTbsItemkeluar::create([
                'id_produk' =>$request->id_produk,    
                'no_faktur' =>$data_item_keluar->no_faktur,                    
                'session_id' => $session_id,
                'jumlah_produk' =>$request->jumlah_produk,
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=> $pesan_alert
            ]);
            return back();

        }
    }


//PROSES HAPUS TBS ITEM KELUAR
    public function proses_hapus_tbs_item_keluar($id){

        if (!TbsItemKeluar::destroy($id)) {
          return redirect()->route('item-keluar.create');
        }
        else{

          $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Menghapus Produk</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "danger",
                "message"   => $pesan_alert
            ]);
        return redirect()->route('item-keluar.create');
        }
    }

       //PROSES HAPUS EDIT TBS ITEM keluar
    public function proses_hapus_edit_tbs_item_keluar($id)
    { 
        if (!EditTbsItemKeluar::destroy($id)) {
          $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">error</i>
                    </div>
                    <b>Gagal : Produk Sudah Terpakai Tidak Boleh Di Hapus</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "danger",
                "message"   => $pesan_alert
            ]);
        return back();
        }
        else{
          $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Menghapus Produk</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);
        return back();
        }
    }




//PROSES BATAL TBS ITEM KELUAR
    public function proses_hapus_semua_tbs_item_keluar(){
      $session_id = session()->getId();

        $data_tbs_item_keluar = TbsItemKeluar::where('session_id', $session_id)->delete();
        
        $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Membatalkan Item Keluar</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);
       return redirect()->route('item-keluar.create');
    }

           //PROSES BATAL EDIT ITEM keluar
    public function proses_hapus_semua_edit_tbs_item_keluar($id)
    {   
        //MENGAMBIL ID ITEM keluar
        $data_item_keluar = ItemKeluar::find($id); 
        //PROSES MENGHAPUS SEMUA EDTI TBS SESUAI NO FAKTUR YANG DI AMBIL 
        $data_tbs_item_keluar = EditTbsItemKeluar::where('no_faktur', $data_item_keluar->no_faktur)->delete(); 
        $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Membatalkan Edit Item keluar</b>
                </div>';

            Session::flash("flash_notification", [
                "level"     => "success",
                "message"   => $pesan_alert
            ]);
       return redirect()->route('item-keluar.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //START TRANSAKSI
      DB::beginTransaction();


        $session_id = session()->getId();
        $user = Auth::user()->id;
        $no_faktur = ItemKeluar::no_faktur();

      //INSERT DETAIL ITEM KELUAR
        $data_produk_item_keluar = TbsItemKeluar::where('session_id', $session_id);

        if ($data_produk_item_keluar->count() == 0) {

           $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">error</i>
                    </div>
                    <b>Gagal : Belum Ada Produk Yang Diinputkan</b>
                </div>';

        Session::flash("flash_notification", [
            "level"     => "danger",
            "message"   => $pesan_alert
        ]);

          
          return redirect()->back();
        }

        $data_produk_item_keluar = TbsItemKeluar::where('session_id', $session_id);
        foreach ($data_produk_item_keluar->get() as $data_tbs) {
          $detail_item_keluar = new DetailItemKeluar();
          if (!$detail_item_keluar->stok_produk($data_tbs->id_produk, $data_tbs->jumlah_produk)) {
            //DI BATALKAN PROSES NYA
            DB::rollBack();
            return redirect()->route('item-keluar.create');            
          }
          else{
            $detail_item_keluar = DetailItemKeluar::create([
                'id_produk' =>$data_tbs->id_produk,              
                'no_faktur' => $no_faktur,
                'jumlah_produk' =>$data_tbs->jumlah_produk,
            ]);

          }
        }

      //INSERT ITEM KELUAR
        if ($request->keterangan == "") {
          $keterangan = "-";
        }
        else{
          $keterangan = $request->keterangan;
        }

        $itemkeluar = ItemKeluar::create([
            'no_faktur' => $no_faktur,
            'keterangan' =>$keterangan
        ]);
        
      //HAPUS TBS ITEM KELUAR
        $data_produk_item_keluar->delete();

        $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Melakukan Transaksi Item Keluar Faktur "'.$no_faktur.'"</b>
                </div>';

        Session::flash("flash_notification", [
            "level"     => "success",
            "message"   => $pesan_alert
        ]);

        DB::commit();
        return redirect()->route('item-keluar.index');
    }


    //PROSES SELESAI TRANSAKSI EDIT ITEM keluar
    public function proses_edit_item_keluar(Request $request,$id) {

        $data_item_keluar = ItemKeluar::find($id);  
        $session_id = session()->getId();
        $user = Auth::user()->id; 

        $hapus_detail_tbs_item_keluar = DetailItemKeluar::where('no_faktur', $data_item_keluar->no_faktur)->delete(); 

      //INSERT DETAIL ITEM keluar
        $data_produk_item_keluar = EditTbsItemKeluar::where('no_faktur', $data_item_keluar->no_faktur);

        if ($data_produk_item_keluar->count() == 0) {

           $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">error</i>
                    </div>
                    <b>Gagal : Belum ada Produk Yang Di inputkan</b>
                </div>';

        Session::flash("flash_notification", [
            "level"     => "danger",
            "message"   => $pesan_alert
        ]);

          
          return redirect()->back();
        }

        foreach ($data_produk_item_keluar->get() as $data_tbs) {
            $detail_item_keluar = DetailItemKeluar::create([
                'id_produk' =>$data_tbs->id_produk,              
                'no_faktur' => $data_item_keluar->no_faktur,
                'jumlah_produk' =>$data_tbs->jumlah_produk,
            ]);
        }

      //INSERT ITEM keluar
        if ($request->keterangan == "") {
          $keterangan = "-";
        }
        else{
          $keterangan = $request->keterangan;
        }

        $itemkeluar = ItemKeluar::find($id)->update([ 
            'keterangan' =>$keterangan
        ]);

        $hapus_edit_tbs_item_keluar = EditTbsItemKeluar::where('no_faktur', $data_item_keluar->no_faktur)->delete(); 


        if (!$itemkeluar) {
          return back();
        }
         
        $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Berhasil Melakukan Edit Transaksi Item keluar Faktur "'.$data_item_keluar->no_faktur.'"</b>
                </div>';

        Session::flash("flash_notification", [
            "level"     => "success",
            "message"   => $pesan_alert
        ]);

        return redirect()->route('item-keluar.index');
    }
 


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
public function proses_form_edit($id)
    {
        //
        $session_id = session()->getId();
        $data_item_keluar = ItemKeluar::find($id);  
        $data_produk_item_keluar = DetailItemKeluar::where('no_faktur', $data_item_keluar->no_faktur);

        $hapus_semua_edit_tbs_item_keluar = EditTbsItemKeluar::where('no_faktur', $data_item_keluar->no_faktur)->delete();
        foreach ($data_produk_item_keluar->get() as $data_tbs) {
            $detail_item_keluar = EditTbsItemKeluar::create([
                'id_produk' =>$data_tbs->id_produk,              
                'no_faktur' => $data_tbs->no_faktur,
                'jumlah_produk' =>$data_tbs->jumlah_produk,          
                'session_id' => $session_id,
            ]);
        }

        return redirect()->route('item-keluar.edit',$id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      //MENAMPILKAN DATA DI TBS ITEM KELUAR
    public function edit(Request $request, Builder $htmlBuilder,$id)
    {   
        if ($request->ajax()) {  
            $item_keluar = ItemKeluar::find($id); 
            $tbs_item_keluar = EditTbsItemKeluar::with(['produk'])->where('no_faktur', $item_keluar->no_faktur)->get();
            return Datatables::of($tbs_item_keluar)->addColumn('action', function($tbsitemkeluar){
                    return view('item_keluar._hapus_produk', [
                        'model'     => $tbsitemkeluar,
                        'form_url'  => route('item-keluar.proses_hapus_edit_tbs_item_keluar', $tbsitemkeluar->id_edit_tbs_item_keluar),  
                        'confirm_message'   => 'Yakin Mau Menghapus Produk ?'
                        ]);
                })->addColumn('data_produk_tbs', function($data_produk_tbs){ 
                    $produk = Produk::find($data_produk_tbs->id_produk);
                    $data_produk = $produk->kode_produk ." - ". $produk->nama_produk;          
                    return $data_produk;   
            })->make(true);
        }

        $html = $htmlBuilder 
        ->addColumn(['data' => 'data_produk_tbs', 'name' => 'data_produk_tbs', 'title' => 'Produk', 'searchable'=>false ]) 
        ->addColumn(['data' => 'jumlah_produk', 'name' => 'jumlah_produk', 'title' => 'Jumlah'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Hapus', 'orderable' => false, 'searchable'=>false]);

        $item_keluar = Itemkeluar::find($id); 
        return view('item_keluar.edit')->with(compact('html','item_keluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    { 
      $pesan_alert = 
               '<div class="container-fluid">
                    <div class="alert-icon">
                    <i class="material-icons">check</i>
                    </div>
                    <b>Sukses : Item Keluar Berhasil Dihapus</b>
                </div>';

        if (!ItemKeluar::destroy($id)) {
          return redirect()->back();
        }

        Session:: flash("flash_notification", [
            "level"=>"danger",
            "message"=> $pesan_alert
            ]);
        return redirect()->route('item-keluar.index');
    }
}
