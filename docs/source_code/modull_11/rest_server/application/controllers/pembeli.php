<?
require APPPATH . '/libraries/REST_Controller.php';
class pembeli extends REST_Controller {
	//$this->response(array("status"=>"success","result" => $get_pembeli));
	//$this->response(array("status"=>"success"));
	function user_get(){
		$get_pembeli = $this->db->query("SELECT p.id_pembeli, p.nama, p.alamat, p.telpn, p.photo_id FROM pembeli as p")->result();
        $this->response(array("status"=>"success","result" => $get_pembeli));
	}

	function user_post() {

		$action  = $this->post('action');
		$data_pembeli = array(
	                'id_pembeli' => $this->post('id_pembeli'),
	                'nama'       => $this->post('nama'),
	                'alamat'     => $this->post('alamat'),
	                'telpn'      => $this->post('telpn'),
	                'photo_id'   => $this->post('photo_id')
	                );
		if ($action==='post'){
			$this->insertPembeli($data_pembeli);
		}else if ($action==='put'){
			$this->updatePembeli($data_pembeli);
		}else if ($action==='delete'){
			$this->deletePembeli($data_pembeli);
		}else{
			$this->response(array("status"=>"failed","message" => "action harus diisi"));
		}
	}
	function insertPembeli($data_pembeli){
		//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
	           echo mkdir($uploaddir, 0750, true);
	    }

	    if (!empty($_FILES)){
	    	$path = $_FILES['photo_id']['name'];
		    $ext = pathinfo($path, PATHINFO_EXTENSION);
		    // $user_img = time() . rand() . '.' . $ext;
		    $user_img =  $data_pembeli['id_pembeli']. '.' . "png";
		    $uploadfile = $uploaddir . $user_img;

		    $data_pembeli['photo_id'] = "upload/".$user_img;	
	    }else{
	    	$data_pembeli['photo_id']="";
	    }
	    
	    //////////////////////////////////////////////////////////////////
	    //////////////////////////////////////////////////////////////////
	    //cek validasi
	    if (empty($data_pembeli['id_pembeli'])){
	    	$this->response(array('status' => "failed", "message"=>"Id Pembeli harus diisi"));
	    }else if (empty($data_pembeli['nama'])){
	    	$this->response(array('status' => "failed", "message"=>"nama harus diisi"));
	    }else if (empty($data_pembeli['alamat'])){
	    	$this->response(array('status' => "failed", "message"=>"alamat harus diisi"));
	    }else if (empty($data_pembeli['telpn'])){
	    	$this->response(array('status' => "failed", "message"=>"telpn harus diisi"));
	    }
	    else{
	    	$get_pembeli_baseid = $this->db->query("SELECT * FROM pembeli as p WHERE p.id_pembeli='".$data_pembeli['id_pembeli']."'")->result();
	    	if(empty($get_pembeli_baseid)){

	    		$insert= $this->db->insert('pembeli',$data_pembeli);

		    	if (!empty($_FILES)){
		    		if ($_FILES["photo_id"]["name"]) {
				        if (move_uploaded_file($_FILES["photo_id"]["tmp_name"],$uploadfile)) 
				        {  
				          $insert_image = "success";
						} else{
						  $insert_image = "failed";
				    	}
			    	}else{
			    		$insert_image = "Image Tidak ada Masukan";
			    	}
			    	$data_pembeli['photo_id'] = base_url()."upload/".$user_img;
		    	}else{
					$data_pembeli['photo_id'] = "";
		    	}
			    
			    if ($insert){
				    $this->response(array('status'=>'success','result' => array($data_pembeli),"message"=>$insert));
				}
	    	}else{
	    		$this->response(array('status' => "failed", "message"=>"Id_pembeli sudah ada"));
	    	}    
	    }
	}

	function updatePembeli($data_pembeli){

		//function upload image
		$uploaddir = str_replace("application/", "", APPPATH).'upload/';
		if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
	           echo mkdir($uploaddir, 0750, true);
	    }
		if(!empty($_FILES)){
	    	$path = $_FILES['photo_id']['name'];
		    // $ext = pathinfo($path, PATHINFO_EXTENSION);
		    //$user_img = time() . rand() . '.' . $ext;
		    $user_img =  $data_pembeli['id_pembeli'].'.' ."png";
		    $uploadfile = $uploaddir . $user_img;

		    $data_pembeli['photo_id'] = "upload/".$user_img;
	    }

	    //$this->response(array(base_url()."upload/".$user_img));
	    //////////////////////////////////////////////////////////////////
	    //////////////////////////////////////////////////////////////////
	    //cek validasi
	    if (empty($data_pembeli['id_pembeli'])){
	    	$this->response(array('status' => "failed", "message"=>"Id Pembeli harus diisi"));
	    }else if (empty($data_pembeli['nama'])){
	    	$this->response(array('status' => "failed", "message"=>"nama harus diisi"));
	    }else if (empty($data_pembeli['alamat'])){
	    	$this->response(array('status' => "failed", "message"=>"alamat harus diisi"));
	    }else if (empty($data_pembeli['telpn'])){
	    	$this->response(array('status' => "failed", "message"=>"telpn harus diisi"));
	    }else{
	    	$get_pembeli_baseid = $this->db->query("SELECT * FROM pembeli as p WHERE p.id_pembeli='".$data_pembeli['id_pembeli']."'")->result();
	    	if(empty($get_pembeli_baseid)){
		    	$this->response(array('status' => "failed", "message"=>"Id_pembeli Tidak ada dalam database"));
	    	}else{
	    		//$this->response(unlink($uploadfile));
	    		//cek apakah image 
	    		if (!empty($_FILES["photo_id"]["name"])) {
			       
			        if (move_uploaded_file($_FILES["photo_id"]["tmp_name"],$uploadfile)){  
			          $insert_image = "success";
					} else{
					  $insert_image = "failed";
			    	}
			    }else{
			    	$insert_image = "Image Tidak ada Masukan";
			    }

			    if ($insert_image==="success"){
			    	//jika photo di update eksekusi query
			    	$update= $this->db->query("Update pembeli Set nama ='".$data_pembeli['nama']."', alamat ='".$data_pembeli['alamat']."' , telpn ='".$data_pembeli['telpn']."', photo_id ='".$data_pembeli['photo_id']."' Where id_pembeli ='".$data_pembeli['id_pembeli']."'");

			    	$data_pembeli['photo_id'] = base_url()."upload/".$user_img;
			    }else{
			    	//jika photo di kosong atau tidak di update eksekusi query
					$update= $this->db->query("Update pembeli Set nama ='".$data_pembeli['nama']."', alamat ='".$data_pembeli['alamat']."' , telpn ='".$data_pembeli['telpn']."' Where id_pembeli ='".$data_pembeli['id_pembeli']."'");

					$getPhotoPath =$this->db->query("SELECT photo_id FROM pembeli Where id_pembeli='".$data_pembeli['id_pembeli']."'")->result();
	    	
					if(!empty($getPhotoPath)){
						foreach ($getPhotoPath as $row)
						{
							$user_img = $row->photo_id;
							$data_pembeli['photo_id'] = base_url().$user_img;
						}
					}
			    }
			    
			    if ($update){
				    $this->response(array('status'=>'success','result' => array($data_pembeli),"message"=>$update));
				}
	    	}    
	    }
	}

	function deletePembeli($data_pembeli){

		if (empty($data_pembeli['id_pembeli'])){
	    	$this->response(array('status' => "failed", "message"=>"Id Pembeli harus diisi"));
	    }
	    else{

	    	$getPhotoPath =$this->db->query("SELECT photo_id FROM pembeli Where id_pembeli='".$data_pembeli['id_pembeli']."'")->result();
	    	
			if(!empty($getPhotoPath)){

				foreach ($getPhotoPath as $row)
				{
					$path = str_replace("application/", "", APPPATH).$row->photo_id;
				}
				//delete image
		    	unlink($path);

		    	$this->db->query("Delete From pembeli Where id_pembeli='".$data_pembeli['id_pembeli']."'");
		    	$this->response(array('status'=>'success',"message"=>"Data id = ".$data_pembeli['id_pembeli']." berhasil di delete "));
			} else{
				$this->response(array('status'=>'fail',"message"=>"Id Pembeli tidak ada dalam database"));
			}
	    }
	}
}