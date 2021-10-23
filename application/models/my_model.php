<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class My_model extends CI_Model {

	public function __construct()
    {
        $this->load->database('default', TRUE);
        parent::__construct();
    }

    function login($username, $password) {

        $this->db->select('username, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }



    function get_bep(){
        $data=array();
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi');
        $this->db->order_by('date', 'desc');
        $hasil=$this->db->get();
        if($hasil->num_rows()>0){
            $data=$hasil->result();
        }
        $hasil->free_result();
        return $data;

    }

    function get_bep_terpilih__(){
        $data=array();
        // $this->db->select('a.id_bep as bep_terpilih, b.bep_id as bep_id, b.namacust as namacust, b.kodebrg as kodebrg, b.namabrg as namabrg, b.total as total, b.dua as dua, b.date as date, b.keterangan as keterangan, b.created_by as created_by ');
        $this->db->from('tabel_bep_terpilih a');
        $this->db->join('tabel_bep_transaksi b','a.id_bep=b.id_bep','LEFT');
        $this->db->order_by('b.date', 'desc');
        $hasil=$this->db->get();
        if($hasil->num_rows()>0){
            $data=$hasil->result();
        }
        $hasil->free_result();
        return $data;

    }

    function get_bep_gambar($id){
        $data=array();
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi');
        $this->db->where('id_bep',$id);
        $data=$this->db->get();

        return $data;
    }

    function get_bep_tabel($postData=null)
    {
        $response =array();

        $draw=$postData['draw'];
        $start=$postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder= $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        // custom search filter

        $searchCustomer= $postData['searchCustomer'];


        $search_arr=array();
        $searchQuery="";
        if($searchValue !=''){
            $search_arr[]="(namacust like '%".$searchValue."%' or
                            kodebrg like '%".$searchValue."%' or
                            namabrg like '%".$searchValue."%' or
                            total like '%".$searchValue."%' or
                            dua like '%".$searchValue."%' or
                            created_by like '%".$searchValue."%' or
                            date like '%".$searchValue."%')";
        }

        if($searchCustomer !=''){
            $search_arr[]=" namacust ='".$searchCustomer."' ";
        }
        if(count($search_arr)>0){
            $searchQuery=implode(" and ",$search_arr);
        }


        //without filter
        $this->db->select('count(*) as allcounts');
        $records=$this->db->get('tabel_bep_transaksi')->result();
        $totalRecords = $records[0]->allcounts;

        // with filter
        $this->db->select('count(*) as allcounta');
        if($searchQuery != '')
        $this->db->where($searchQuery);
        $recordsa=$this->db->get('tabel_bep_transaksi')->result();
        $totalRecordwithFilter=$recordsa[0]->allcounta;

        //fetch records
        $this->db->select('*');
        if($searchQuery !='')
        $this->db->where($searchQuery);
        $this->db->order_by($columnName,$columnSortOrder);
        // $this->db->order_by('date','ASC');
        $this->db->limit($rowperpage,$start);
        $records=$this->db->get('tabel_bep_transaksi')->result();

        $data=array();

        foreach($records as $record){
            $data[]=array(
                "bep_id"  =>$record->bep_id,
                "namacust"  =>$record->namacust,
                "kodebrg"   =>$record->kodebrg,
                "namabrg"   =>$record->namabrg,
                "total"     =>$record->total,
                "dua"       =>$record->dua,
                "date"      =>$record->date,
                "id_bep"    =>$record->id_bep,
                "keterangan"=>$record->keterangan,
                "created_by"=>$record->created_by,
                "filegambar"=>$record->filegambar,
                "filegambar2"=>$record->filegambar2,
                "filegambar3"=>$record->filegambar3,
                "filegambar4"=>$record->filegambar4,
                "filegambar5"=>$record->filegambar5,
            );

        }
        $response=array(
            "draw"=>intval($draw),
            "iTotalRecords"=>$totalRecords,
            "iTotalDisplayRecords" =>$totalRecordwithFilter,
            "aaData" =>$data
        );
        return $response;
    }


    function get_bep_tabel_terpilih($postData=null)
    {
        $response =array();

        $draw=$postData['draw'];
        $start=$postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex = $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder= $postData['order'][0]['dir'];
        $searchValue = $postData['search']['value'];

        // custom search filter

        $searchCustomer= $postData['searchCustomer'];


        $search_arr=array();
        $searchQuery="";
        if($searchValue !=''){
            $search_arr[]="(namacust like '%".$searchValue."%' or
                            kodebrg like '%".$searchValue."%' or
                            namabrg like '%".$searchValue."%' or
                            total like '%".$searchValue."%' or
                            dua like '%".$searchValue."%' or
                            created_by like '%".$searchValue."%' or
                            date like '%".$searchValue."%')";
        }

        if($searchCustomer !=''){
            $search_arr[]=" namacust ='".$searchCustomer."' ";
        }
        if(count($search_arr)>0){
            $searchQuery=implode(" and ",$search_arr);
        }


        //without filter
        $this->db->select('count(*) as allcounts');
        $this->db->from('tabel_bep_terpilih a');
        $this->db->join('tabel_bep_transaksi b','a.id_bep=b.id_bep','LEFT');
        $records=$this->db->get()->result();
        $totalRecords = $records[0]->allcounts;

        // with filter
        $this->db->select('count(*) as allcounta');
        if($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->from('tabel_bep_terpilih a');
        $this->db->join('tabel_bep_transaksi b','a.id_bep=b.id_bep','LEFT');
        $recordsa=$this->db->get()->result();
        $totalRecordwithFilter=$recordsa[0]->allcounta;

        //fetch records
        $this->db->select('*');
        if($searchQuery !='')
        $this->db->where($searchQuery);
        $this->db->order_by($columnName,$columnSortOrder);
        // $this->db->order_by('date','ASC');
        $this->db->limit($rowperpage,$start);
        $this->db->from('tabel_bep_terpilih a');
        $this->db->join('tabel_bep_transaksi b','a.id_bep=b.id_bep','LEFT');
        $records=$this->db->get()->result();

        $data=array();

        foreach($records as $record){
            $data[]=array(
                "bep_id"  =>$record->bep_id,
                "namacust"  =>$record->namacust,
                "kodebrg"   =>$record->kodebrg,
                "namabrg"   =>$record->namabrg,
                "total"     =>$record->total,
                "dua"       =>$record->dua,
                "date"      =>$record->date,
                "id_bep"    =>$record->id_bep,
                "keterangan"=>$record->keterangan,
                "created_by"=>$record->created_by,
                "sumbymold"=>$record->sumbymold,
                "filegambar2"=>$record->filegambar2,
                "filegambar3"=>$record->filegambar3,
                "filegambar4"=>$record->filegambar4,
                "filegambar5"=>$record->filegambar5,
            );

        }
        $response=array(
            "draw"=>intval($draw),
            "iTotalRecords"=>$totalRecords,
            "iTotalDisplayRecords" =>$totalRecordwithFilter,
            "aaData" =>$data
        );
        return $response;
    }

    function hapus_bep($id_bep){
        $this->db->where('id_bep', $id_bep);
         $this->db->delete('tabel_bep_transaksi'); //

    }

    function get_customer(){
            ## Fetch records

            $this->db->select('namacust');
            $this->db->order_by('date','asc');
            $this->db->from('tabel_bep_terpilih a');
            $this->db->join('tabel_bep_transaksi b','a.id_bep=b.id_bep','LEFT');
            $records=$this->db->get()->result();
            // $records = $this->db->get('tabel_bep_transaksi')->result();

            $data = array();

            foreach($records as $record ){
               $data[] = $record->namacust;
            }

            return $data;
    }




    public function getbep($id){
       $data = array();
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_jenis_material j','j.id_jenis=t.material','LEFT');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku','LEFT');
        $this->db->where('id_bep',$id);
        $hasil = $this->db->get();
        if($hasil->num_rows() > 0){
			$data=$hasil->result();
			}

			$hasil->free_result();
			return $data;
    }

    function update_bep($where,$datakirim){
       $this->db->where($where);
       return $this->db->update('tabel_bep_transaksi',$datakirim);

    }

    public function getById($id_bep){
       $query = $this->db->get_where('tabel_bep_transaksi', array('id_bep' =>  $id_bep));
        return $query;
    }

    function bep_material($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku','LEFT');
        $this->db->join('tabel_jenis_material j','t.material=j.id_jenis','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        
        return $data;
    }

    function bep_material2($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku2','LEFT');
        $this->db->join('tabel_jenis_material j','t.material2=j.id_jenis','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        
        return $data;
    }

    function bep_material3($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku3','LEFT');
        $this->db->join('tabel_jenis_material j','t.material3=j.id_jenis','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }

    function bep_material4($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku4','LEFT');
        $this->db->join('tabel_jenis_material j','t.material4=j.id_jenis','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }

    function bep_mesin1($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_std std','std.id_mc=t.mesinp1','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }

    function bep_mesin2($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_std std','std.id_mc=t.mesinp2','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }

    function bep_mesin3($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_std std','std.id_mc=t.mesinp3','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }
    function bep_mesin4($id_bep){
        $this->db->select('*');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_std std','std.id_mc=t.mesinp4','LEFT');
        $this->db->where('id_bep',$id_bep);
        $data = $this->db->get();
        return $data;
    }

    public function get_sub_material($id_rm){
        $query="<option value='0'>--Select Nama Material-->";
    //    $this->db->select('nama_material,max(id_rm) as id_rm');
       $this->db->select('bantu.material_name, tabel_rawmaterial.id_sub, max(id_rm) as id_rm');
        $this->db->from('tabel_rawmaterial');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=tabel_rawmaterial.id_sub','LEFT');
        $this->db->where('id_jenisr',$id_rm);
        $this->db->group_by('tabel_rawmaterial.id_sub, bantu.material_name');

        // $this->db->group_by('nama_material');
        $data=$this->db->get();
        foreach ($data->result_array() as $data) {
                $query.="<option value='$data[id_rm]'>$data[material_name]</option>";

            }
    //    $query = $this->db->get_where('tabel_rawmaterial',array('id_jenisr' =>  $id_rm));
        return $query;

        // $material="<option value='0'>-Select Nama Material-</option>";
        // $this->db->select('bantu.material_name, tabel_rawmaterial.id_sub, max(id_rm) as id_rm');
        // $this->db->from('tabel_rawmaterial');
        // $this->db->join('tabel_bantu_material bantu','bantu.id_sub=tabel_rawmaterial.id_sub','LEFT');
        // $this->db->where('id_jenisr',$id);
        // $this->db->group_by('tabel_rawmaterial.id_sub, bantu.material_name');

        // $query=$this->db->get();
        // foreach ($query->result_array() as $data) {
        //     $material.="<option value='$data[id_rm]'>$data[material_name]</option>";

        // }
        // return $material;
    }

    function get_sub_mesin($id_mc){
        $this->db->select('nama_mc,id_mc');
        $this->db->from('tabel_std');
        $this->db->where('id_mc',$id_mc);
        // $this->db->group_by('tahun');

        $query=$this->db->get();

        return $query;
    }

    public function getBymaterial($id){
       $data = array();
        $this->db->select('rm.nama_material, max(id_rm) as id_rm');
        $this->db->from('tabel_bep_transaksi t');
        $this->db->join('tabel_jenis_material j','j.id_jenis=t.material','LEFT');
        $this->db->join('tabel_rawmaterial rm','rm.id_rm=t.namamaterialku','LEFT');
        $this->db->group_by('rm.nama_material ');
        $this->db->where('id_bep',$id);

        $hasil = $this->db->get();
        if($hasil->num_rows() > 0){
            $data = $hasil->row_array();
        }

        $hasil->free_result();
        return $data;
    }

    function get_jenis_merk(){
        $this->db->order_by('nama_material','ASC');
        $jenis_material=$this->db->get('tabel_rawmaterial');

        return $jenis_material;
    }
// =================================MATERIAL===========================================
    function addNama_Material(){
        $data=array(
            'material_name'     => $this->input->post('NamaMat'),
            'id_jenis_material' => $this->input->post('JenisMat_new')
        );
        $result=$this->db->insert('tabel_bantu_material',$data);

        return $result;
    }

    function addJenis_Material(){
        $data=array(
            'jenis'     => $this->input->post('JenisMaterial')
        );
        $result = $this->db->insert('tabel_jenis_material',$data);
    }

    function get_jenis_material(){
        $this->db->order_by('jenis','ASC');
        $jenis_material=$this->db->get('tabel_jenis_material');

        return $jenis_material;
    }


    function get_material(){
        $material="<option value='0'>-Select Nama Material-</option>";

        $this->db->select('bantu.material_name, tabel_rawmaterial.id_sub, max(id_rm) as id_rm');

        // $this->db->select('nama_material,max(id_rm) as id_rm');
        $this->db->from('tabel_rawmaterial');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=tabel_rawmaterial.id_sub','LEFT');
        $this->db->group_by('tabel_rawmaterial.id_sub, bantu.material_name');

        // $this->db->group_by('nama_material');

        // $this->db->order_by('nama_material','ASC');
        // $jenis_material=$this->db->get('tabel_jenis_material');

        // return $jenis_material;


        $query=$this->db->get();
        foreach ($query->result_array() as $data) {
            $material.="<option value='$data[id_rm]'>$data[material_name]</option>";

        }
        return $query;
    }
    function material($id){
        $material="<option value='0'>-Select Nama Material-</option>";
        $this->db->select('bantu.material_name, tabel_rawmaterial.id_sub, max(id_rm) as id_rm');
        $this->db->from('tabel_rawmaterial');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=tabel_rawmaterial.id_sub','LEFT');
        $this->db->where('id_jenisr',$id);
        $this->db->group_by('tabel_rawmaterial.id_sub, bantu.material_name');

        $query=$this->db->get();
        foreach ($query->result_array() as $data) {
            $material.="<option value='$data[id_rm]'>$data[material_name]</option>";

        }
        return $material;
    }

    function set_harga_baru($id){
        $material="<option value='0'>-Select Nama Material-</option>";
        $this->db->select('bantu.material_name, tabel_rawmaterial.id_sub, max(id_rm) as id_rm');
        $this->db->from('tabel_rawmaterial');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=tabel_rawmaterial.id_sub','LEFT');
        $this->db->where('tabel_rawmaterial.id_sub',$id);
        $this->db->group_by('tabel_rawmaterial.id_sub, bantu.material_name');

        $query=$this->db->get();

        foreach ($query->result_array() as $data) {
            $material.="<option value='$data[id_rm]'>$data[material_name]</option>";
           }
        return $material;
    }

    function hargamaterial($id){
        $data=array();
        $this->db->select('harga');
        $this->db->from('tabel_rawmaterial');
        $this->db->where('id_rm',$id);

        $data=$this->db->get();
        return $data;
    }

    function get_data(){
        $this->db->select('*');
        $result = $this->db->get('tabel_chart');
        return $result;
    }

    function get_submaterial($id){
        $query= $this->db->get_where('tabel_bantu_material', array('id_jenis_material' => $id));
        return $query;

    }

    function cari_nama_material($id){
        $query= $this->db->get_where('tabel_bantu_material', array('id_sub' => $id));
        return $query;
    }




// ===============================ADDITIVE===========================================

    function get_jenis_additive(){
        $this->db->order_by('jenis','ASC');
        $jenis_additive= $this->db->get('tabel_jenis_additive');

        return $jenis_additive->result_array();
    }

    function additive($id){
        $additive="<option value='0'>--Select nama additive--</option>";
        $this->db->select('nama_additive,max(id_additive) as id_adt');
        $this->db->from('tabel_additive');
        $this->db->where('id_jenisa',$id);
        $this->db->group_by('nama_additive');

        $query=$this->db->get();
        foreach ($query->result_array() as $data) {
            $additive.="<option value='$data[id_adt]'>$data[nama_additive]</option>";
            # code...
        }
        return $additive;

    }

    function hargaadditive($id)
    {
        $data=array();
        $this->db->select('harga');
        $this->db->from('tabel_additive');
        $this->db->where('id_additive',$id);

        $data=$this->db->get();
        return $data;
        # code...
    }

 //=============================MASTERBACTH=========================================
function get_jenis_master(){
    $this->db->order_by('jenis','ASC');
    $jenis_master = $this->db->get('tabel_jenis_master');

    return $jenis_master->result_array();
}

function masterbacth($id)
  {
      $masterbacth="<option value='0'>--select--</option>";
      $this->db->select('nama_master,max(id_masterbacth) as id_mb');
      $this->db->from('tabel_master');
      $this->db->where('id_jenism',$id);
      $this->db->group_by('nama_master');
      $query=$this->db->get();
      foreach ($query->result_array() as $value) {
          $masterbacth.="<option value='$value[id_mb]'>$value[nama_master]</option>";

      }
      return $masterbacth;

  }

function hargamaster($id){
    $data=array();
    $this->db->select('harga');
    $this->db->from('tabel_master');
    $this->db->where('id_masterbacth',$id);

    $data=$this->db->get();
    return $data;
}

 //=============================MESIN=========================================

function get_jenis_mesin(){
    $this->db->order_by('nama_mc','ASC');
    $this->db->where('tahun','2021');
    $jenis_mesin = $this->db->get('tabel_std');

    return $jenis_mesin->result_array();
}

function get_jenis_mesin_detail(){
    $this->db->order_by('id_mc','ASC');
    // $this->db->where('tahun','2020');
    $jenis_mesin = $this->db->get('tabel_std');

    return $jenis_mesin->result_array();
}

function get_tahun_mesin(){
    $this->db->order_by('id_tahun','ASC');


    $tahun_mesin=$this->db->get('tabel_std');

    return $tahun_mesin->result_array();
}

function get_tahun(){
    $this->db->order_by('id_tahun','DESC');
    $tahun=$this->db->get('tabel_tahun');

    return $tahun->result_array();
}

function get_mesin($id){

    $material="<option value='0'>--Mesin--</option>";
        $this->db->select('nama_mc,id_mc');
        $this->db->from('tabel_std');
        $this->db->where('tahun',$id);
        // $this->db->group_by('nama_material');


        $query=$this->db->get();
        foreach ($query->result_array() as $data) {
            $material.="<option value='$data[id_mc]'>$data[nama_mc]</option>";
            # code...
        }
        return $material;
}


function carimesin($id){
   $cari=$this->db->query("SELECT * FROM tabel_std WHERE id_mc='$id' ");
   if($cari->num_rows()>0){
    foreach ($cari->result() as $data) {
        $hasil=array(
            'id_mc'     => $data->id_mc,
            'nama_mc'   => $data->nama_mc,
            'harga_mc'  => $data->harga_mc,
            'by_depresiasi' => $data->by_depresiasi,
            'by_listrik'=> $data->by_listrik,
            'by_tk_langsung' => $data->by_tk_langsung,
            'by_tktl'   => $data->by_tktl,
            'by_bop'    => $data->by_bop,
            'by_op_mc'  => $data->by_op_mc,
            'bunga'     => $data->bunga,
        );
    }
    return $hasil;
   }

    $data=$this->db->get();
    return $data;
}


function get_new_mesin($id){
    $this->db->select('nama_mc, max(id_mc) as id_mc');
    $this->db->from('tabel_std');
    $this->db->where('tahun','2021');
    $this->db->group_by('nama_mc');
    $this->db->where('idmesin',$id);
    $jenis_mesin = $this->db->get();

    return $jenis_mesin;
}


function get_ttd($id){
    $data=array();
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$id);
    $data=$this->db->get();

    return $data;
    // echo json_encode($data);

}

function getlastid(){
    $this->db->select_max('id_bep');
    $result=$this->db->get('tabel_bep_transaksi');
    if($result->num_rows()>0){
        return $result->row_array();
    }
}

    function input_bep($data){
        return $this->db->insert('tabel_bep_transaksi',$data);
    }

		function insert_bep_terpilih($post){
			return $this->db->insert('tabel_bep_terpilih',$post);
		}

		function cek_bep_terpilih($id_bep){

			$this->db->select('*');
			$this->db->from('tabel_bep_terpilih');
			$this->db->where('id_bep',$id_bep);
			$data=$this->db->get();
			// $data = $this->db->get_where('tabel_bep_terpilih','id_bep', $id_bep);
		 return $data->result();
		}

    function get_all_mesin(){
        return $this->db->get('tabel_mesin');
    }

    function get_all_jamkerja(){
    return $this->db->get('tabel_jamkerja');
    }


    function filter_mesin($search,$limit, $start, $order_field, $order_ascdesc){
        $this->db->like('nama_mesin',$search);
        $this->db->or_like('merk_mesin',$search);
        $this->db->or_like('seri_mc',$search);
        $this->db->or_like('harga_mc',$search);
        $this->db->order_by($order_field,$order_ascdesc);
        $this->db->limit($limit,$start);

        return $this->db->get('tabel_mesin')->result_array();
    }

    function count_all_mesin(){
        return $this->db->count_all('tabel_mesin');
    }

    function count_filter_mesin($search){
        $this->db->like('nama_mesin',$search);
        $this->db->or_like('merk_mesin',$search);
        $this->db->or_like('seri_mc',$search);
        $this->db->or_like('harga_mc',$search);

        return $this->db->get('tabel_mesin')->num_rows();
    }

    public function fetchDataMesin($id=null){
        if($id){
            $sql    = "SELECT * FROM tabel_mesin WHERE id_mc = ?";
            $query  = $this->db->query($sql, array($id));
            return $query->row_array();
            }

            $sql ="SELECT * FROM tabel_mesin";
            $query = $this->db->query($sql);
            return $query->result_array();
    }


    function fetchDataStandar($id=null){
        if($id){

            $data= array();
            $this->db->select('*');
            $this->db->from('tabel_std std');
            $this->db->join('tabel_tahun th','std.tahun=th.id_tahun','LEFT');
            $this->db->where('std.id_mc',$id);

             $data=$this->db->get();
            return $data->row_array();


        }
        $data= array();
        $this->db->select('*');
        $this->db->from('tabel_std std');
        $this->db->join('tabel_tahun th','std.tahun=th.id_tahun','LEFT');
        $data=$this->db->get();

            return $data->result_array();
    }


    function createMesin(){
         $now = date("Y-m-d");
         $hasilexplode=explode("-",$now);
         $tahunnow=$hasilexplode[0];
        $data = array(
                'nama_mesin' => $this->input->post('NamaMc'),
                'merk_mesin' => $this->input->post('MerkMc'),
                'seri_mc' => $this->input->post('SeriMc'),
                'harga_mc' => $this->input->post('HargaMc'),
                'tahun'=>$tahunnow,
                'status'=> 1
            );
        $sql = $this->db->insert('tabel_mesin',$data);
        if($sql===true){
            return true;
        }else{
            return false;
        }
    }


    function createMaterial(){
        $now = date("Y-m-d");

       $data = array(
                'id_jenisr' => $this->input->post('JenisMat'),
               'nama_material' => $this->input->post('nama_material'),
               'harga'      =>   $this->input->post('HargaMat'),
               'id_sub'     =>   $this->input->post('NamaMat'),
               'bulan'      =>$now
           );
       $sql = $this->db->insert('tabel_rawmaterial',$data);
       if($sql===true){
           return true;
       }else{
           return false;
       }
   }

    function edit($id = null)
    {
        if($id){
            $data = array(
                    'nama_mesin' => $this->input->post('editNamaMc'),
                    'merk_mesin'=> $this->input->post('editMerkMc'),
                    'seri_mc'=> $this->input->post('editSeriMc'),
                    'harga_mc'=> $this->input->post('editHargaMc'),
                    );

                $this->db->where('id_mc',$id);
                $sql = $this->db->update('tabel_mesin',$data);

                if($sql === true){
                    return true;
                }else{
                    return false;
                }
        }
    }

    function remove($id = null){
        if($id){
            $sql = "DELETE FROM tabel_mesin WHERE id_mc = ?";
            $query = $this->db->query($sql, array($id));

            return ($query === true ) ? true : false;
        }
    }

    function fetchDataDepresiasiMesin($id=null){
        if($id){
            $data= array();
            $this->db->select('*');
            $this->db->from('tabel_depresiasi td');
            $this->db->join('tabel_mesin tm','td.id_mc=tm.id_mc','LEFT');
            $this->db->join('tabel_jamkerja tjk','td.id_jamker=tjk.id_jamkerja');
            $this->db->where('td.id_depresiasi',$id);

             $data=$this->db->get();
            return $data->row_array();
        }
            $data=array();
            $this->db->select('*');
            $this->db->from('tabel_depresiasi td');
            $this->db->join('tabel_mesin tm','td.id_mc=tm.id_mc','LEFT');
            $this->db->join('tabel_jamkerja tjk','td.id_jamker=tjk.id_jamkerja');

            $data=$this->db->get();
            return $data->result_array();

    }

    ///===================================MATERIAL=============================

    public function fetchDataMaterial($id=null){

        $datenow=date("Y-m-d");
        $hasilexplode=explode("-",$datenow);
        $tahunnow=$hasilexplode[0];
        $bulannow=$hasilexplode[1];
        if($id){
            $data = array();
            // $this->db->select('*');
            $this->db->order_by('rm.id_rm','ASC');

            $this->db->from('tabel_rawmaterial rm');
            $this->db->join('tabel_jenis_material jenism','rm.id_jenisr=jenism.id_jenis','LEFT');
            $this->db->join('tabel_bantu_material bantu','rm.id_sub=bantu.id_sub','LEFT');
            $this->db->where('rm.id_rm',$id);

            $data=$this->db->get();
            return $data->row_array();
            }

            $data=array();
            // $this->db->select('*');
            $this->db->order_by('rm.id_rm','ASC');
            $this->db->from('tabel_rawmaterial rm');
            $this->db->join('tabel_jenis_material jenism','rm.id_jenisr=jenism.id_jenis','LEFT');
            $this->db->join('tabel_bantu_material bantu','rm.id_sub=bantu.id_sub','LEFT');
            // $this->db->where('month(rm.bulan)',$bulannow);
            // $this->db->where('year(rm.bulan)',$tahunnow);

            $data = $this->db->get();
            return $data->result_array();
    }

    function get_all_material(){
        $data=array();
            $this->db->select('*');

            $this->db->from('tabel_rawmaterial rm');
            $this->db->join('tabel_jenis_material jenism','rm.id_jenisr=jenism.id_jenis','LEFT');

            $data = $this->db->get();
       return $data->result_array();

    }

    function get_all_materialgraph(){
        $data=array();
            $this->db->select('*');
            $this->db->from('tabel_rawmaterial rm');
            $this->db->join('tabel_jenis_material jenism','rm.id_jenisr=jenism.id_jenis','LEFT');
            // $this->db->group_by('nama_material');

            $data = $this->db->get();
       return $data;
    }

    public function rangeDateMaterial($start_date, $end_date){
        $query=array();
        $this->db->from('tabel_rawmaterial rm');
        $this->db->join('tabel_jenis_material jenism','rm.id_jenisr=jenism.id_jenis','LEFT');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=rm.id_sub');
        $this->db->where('rm.bulan >=',$start_date);
        $this->db->where('rm.bulan <=',$end_date);
        $query=$this->db->get();

        return $query->result_array();
    }


    function list_material(){
        $response = array();
        $this->db->select('jenis.jenis as jenis, rm.nama_material as nama_material, rm.harga as harga, rm.bulan as bulan ');
        $this->db->from('tabel_rawmaterial rm');
        $this->db->join('tabel_jenis_material jenis','rm.id_jenisr=jenis.id_jenis');
        $this->db->join('tabel_bantu_material bantu','bantu.id_sub=rm.id_sub');
        $data=$this->db->get();

        return $data->result_array();
    }

    // ==============================HAK AKSES==========================

    function savegroup(){
         $timenow = date("Y-m-d H:i:s");
         
         $config['upload_path'] = './foto/'; //path folder
         $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //Allowing types
         $config['encrypt_name'] = TRUE;
         $this->load->library('upload',$config);
     
         $this->upload->initialize($config);
         if(!$this->upload->do_upload('gambar')){
             echo"upload failed";
             print_r($this->upload->display_errors());
         }
        else{
            $insert=array(
                'username'=>$this->input->post('username'),
                'password'=>$this->input->post('password'),
                'nama'=>$this->input->post('nama'),
                'jenis_k'=>$this->input->post('jenis_k'),
                'born_date'=>$this->input->post('date'),
                'nik'=>$this->input->post('nik'),
                'foto'=>$this->upload->file_name,
                'no_hp'=>$this->input->post('no'),
                'created_at'=>$timenow,
    
            );
            $this->db->insert('users',$insert);
    
            $data=array(
                'username'=>$this->input->post('username'),
                'member'=>1,
                'admin'=>0,
            );
            $this->db->insert('permission',$data);
         }
        
    }

    function editgroup($id){
        $data = array();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('permission.username',$id);
        $this->db->join('permission','users.username=permission.username','LEFT');
        $hasil=$this->db->get();
        if($hasil->num_rows()>0){
            $data=$hasil->result();
        }
        $hasil->free_result();
        return $data;
    }


    function gtgroup(){
        $data = array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('created_at');
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}

		$hasil->free_result();
		return $data;
    }

    function gtgroup_json(){
        $data = array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('created_at');
		$this->db->get();
		
		return $data;
    }

    function getgroup($id){
        $data=array();

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('permission.username', $id);
		$this->db->join('permission','users.username=permission.username','LEFT');
		$hasil=$this->db->get();
		if($hasil->num_rows() > 0){
			$data=$hasil->result();
			}

			$hasil->free_result();
			return $data;
    }

    function hapusgroup($id){
		$this->db->where('username',$id);
		$this->db->delete('users');
		$this->db->where('username',$id);
		$this->db->delete('permission');
	}

	function last_query_permission(){
		$data = array();
		$this->db->select_max("username");
		$hasil = $this->db->get('permission');
		if($hasil->num_rows() > 0){
			return $hasil->row_array(); //return row sebagai associative array
		}
	}


	function simpanedit($data, $username){
		$this->db->where('username',$username);
		$this->db->update('users',$data);
    }

    function simpaneditps($data2,$username){


		$this->db->where('username',$username);
		$this->db->update('users',$data2);
	}


    ///////////////////////PRINT////////////////

    function getlastid_cust_cetak(){
        $this->db->select_max('id');
        $result=$this->db->get('tabel_cust');
        if($result->num_rows()>0){
            return $result->row_array();
        }
    }



    function create_temp_cetak($customer,$id_bep,$top, $fob,$lead_time,$no_quot,$comment,$comment2,$comment3,$comment4){
        $this->db->trans_start();
       $now= date("Y-m-d");
       $data=array(
           'nama_cust'=>$customer,
           'top'=>$top,
           'fob'=>$fob,
           'lead_time'=>$lead_time,
           'no_quotation'=>$no_quot,
           'comment'=>$comment,
           'comment2'=>$comment2,
           'comment3'=>$comment3,
           'comment4'=>$comment4
       );
       $this->db->insert('tabel_cust',$data);

       $id_cust=$this->db->insert_id();
       $result=array();
       foreach($id_bep as $key => $val){
           $result[]=array(
               'id_cust'=>$id_cust,
               'idbep'=>$_POST['id_bep'][$key]
           );
        }
           $this->db->insert_batch('tabel_temp_cetak',$result);
        $this->db->trans_complete();

    }


    function get_SQ(){
        $this->db->select('nama_cust,id,COUNT(id_bep) AS item_product');
        $this->db->from('tabel_cust');
        $this->db->join('tabel_temp_cetak', 'id=id_cust');
        $this->db->join('tabel_bep_transaksi', 'id_bep=idbep');
        $this->db->group_by('nama_cust');
        $this->db->group_by('id');
        $query = $this->db->get();
        return $query;
    }

    function filter_sq($postData=null){
        $response = array();
        
        ##read value
        $draw       = $postData['draw'];
        $start      = $postData['start'];
        $rowperpage = $postData['length'];
        $columnIndex= $postData['order'][0]['column'];
        $columnName = $postData['columns'][$columnIndex]['data'];
        $columnSortOrder = $postData['order'][0]['dir']; 
        $searchValue = $postData['search']['value'];

        ##Search
        $searchQuery=array();
        // $searchQuery="";
        if($searchValue !=''){
            $search_arr[]="(nama_cust like '%".$searchValue."%')";
        }

        # ## Total number of records without filtering
        $this->db->select('count(*) as allcounts');
        $this->db->from('tabel_cust');
        $this->db->join('tabel_temp_cetak ','id=id_cust');
        $this->db->join('tabel_bep_transaksi', 'id_bep=idbep');
        $this->db->group_by('nama_cust');
        $this->db->group_by('id');
        $this->db->group_by('top');

        $records=$this->db->get()->result();
        $totalRecords = $records[0]->allcounts;

         ## Total number of record with filtering
         $this->db->select('count(*) as allcounts');
         if($searchQuery != '')
         $this->db->where($searchQuery);
         $this->db->from('tabel_cust');
         $this->db->join('tabel_temp_cetak ','id=id_cust');
         $this->db->join('tabel_bep_transaksi', 'id_bep=idbep');
         $this->db->group_by('nama_cust');
         $this->db->group_by('id');
         $this->db->group_by('top');

         $records=$this->db->get()->result();
         $totalRecordwithFilter = $records[0]->allcounts;

         ## Fetch records
         $this->db->select('id,nama_cust,top,COUNT(idbep) AS item_product');
         if($searchQuery !='')
         $this->db->where($searchQuery);
         $this->db->from('tabel_cust');
         $this->db->join('tabel_temp_cetak ','id=id_cust');
         $this->db->join('tabel_bep_transaksi', 'id_bep=idbep');
         $this->db->group_by('nama_cust');
         $this->db->group_by('id');
         $this->db->group_by('top');
        //  $this->db->group_by('tabel_bep_transaksi.namabrg');
         $records=$this->db->get()->result();

         $data=array();
         foreach($records as $record){
             $data[]=array(
                 "id"=>$record->id,
                 "top"=>$record->top,
                 "nama_cust"=>$record->nama_cust,
                 "item_product"=>$record->item_product
             );
         }

            ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    function get_sales_q($id){
        $coba=0;
        $data=array();
        $this->db->select('*');
        $this->db->from('tabel_temp_cetak');
        $this->db->join('tabel_cust','id=id_cust');
        $this->db->join('tabel_bep_transaksi','id_bep=idbep');
        $this->db->join('tabel_jenis_material ','id_jenis=material','LEFT');
        $this->db->join('tabel_rawmaterial ','id_rm=namamaterialku','LEFT');
        $this->db->where('id_cust',$id);

        $data=$this->db->get();

        return $data->result();
    }

    function get_cust($id){
        $query = $this->db->get_where('tabel_cust', array('id' =>  $id));
        return $query;
    }



    /*------------------------------MARKETING-------------------------------- */

    function adjust_price($bep_id){
        $this->db->select('a.id_sub AS id_sub1, b.id_sub AS id_sub2, c.id_sub AS id_sub3, d.id_sub AS id_sub4');
        $this->db->from('tabel_bep_transaksi');
        $this->db->join('tabel_rawmaterial a','tabel_bep_transaksi.namamaterialku=a.id_rm','LEFT');
        $this->db->join('tabel_rawmaterial b','tabel_bep_transaksi.namamaterialku2=b.id_rm','LEFT');
        $this->db->join('tabel_rawmaterial c','tabel_bep_transaksi.namamaterialku3=c.id_rm','LEFT');
        $this->db->join('tabel_rawmaterial d','tabel_bep_transaksi.namamaterialku4=d.id_rm','LEFT');
        $this->db->where('id_bep',$bep_id);
        $data=$this->db->get();
        return $data;

    }



}
