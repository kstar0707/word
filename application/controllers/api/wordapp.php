<?php
class Wordapp extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Load the necessary stuff...
		date_default_timezone_set('Asia/Tokyo');
		$this->load->helper('url');
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model', 'wordapp_model'));	
	}
	
	public function index()  
	{
		$get_user_json = file_get_contents('php://input');		
		$user_data = json_decode($get_user_json);		
		if (!empty($user_data)) {
			if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
				// Retrieve user last updated 30 files
				$user_id = base64_decode($user_data->user_id);
				$response["success"] = 1;
				$response['user_posts'] = $this->wordapp_model->get_post_by_user_id($user_id, 0, 30);
				$response["message"] = "success";
				echo json_encode($response);
			}else{
				$response["success"] = 0;
				$response['user_posts'] = NULL;
				$response["message"] = "API key is wrong";
				echo json_encode($response);
			}
		}					
	}

	public function save()
	{	
		$get_user_json = file_get_contents('php://input');
		$user_data = json_decode($get_user_json);
		
		if (!empty($user_data)) {
			if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
				$post_title = preg_replace("/\s|&nbsp;/",'',$user_data->post_detail);
				$post_title = strip_tags($post_title);  
				$post_title = mb_substr($post_title, 0, 15);		

				if ($post_title !="") {
					$user_id = base64_decode($user_data->user_id);
					$post_id = $user_data->post_id;
					

					if ($post_id === 0) {
				    	$post_data = array(
				    			'post_title' => trim($post_title),
				    			'post_details' => $user_data->post_detail,
				    			'created_by' => $user_id,
				    			'created_at' => date('Y-m-d H:i:s'),
				    			'updated_at' => date('Y-m-d H:i:s')
				    		);

				   		$this->wordapp_model->_table_name = 'post';
                                                $this->wordapp_model->_primary_key = 'post_id';
				   		$post_id = $this->wordapp_model->save($post_data);
				   		
					}else{
	    	    	   	$post_data = array(
	    		    			'post_title' => trim($post_title),
	    		    			'post_details' => $user_data->post_detail,
	    		    			'updated_at' => date('Y-m-d H:i:s')
	    		    		);

	    		   		$this->wordapp_model->_table_name = 'post';
	    	        	$this->wordapp_model->_primary_key = 'post_id';
	    		   		$this->wordapp_model->save($post_data, $post_id);
					}
					$response["success"] = 1;
					$response["post_id"] = $post_id;
					$response["message"] = "success";
					echo json_encode($response);
				}else{
					$response["success"] = 0;
					$response["post_id"] = 0;
					$response["message"] = "Requerd field is empty";
					echo json_encode($response);
				}
				
			}else{
				$response["success"] = 0;
				$response["post_id"] = 0;
				$response["message"] = "API key is wrong";
				echo json_encode($response);
			}
		}
	}

	public function delete()
	{
		$get_user_json = file_get_contents('php://input');
		$user_data = json_decode($get_user_json);
		if (!empty($user_data)) {
			if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
				if (base64_decode($user_data->user_id) != "") {
					if ($this->wordapp_model->delete_post_by_id($user_data->post_id)) {
						$response["success"] = 1;
						$response["message"] = "success";
						echo json_encode($response);
					}else{
						$response["success"] = 0;
						$response["message"] = "post already deleted";
						echo json_encode($response);
					}
					
				}else{
					$response["success"] = 0;
					$response["message"] = "user_id is empty";
					echo json_encode($response);
				}
				
			}else{
				$response["success"] = 0;
				$response["message"] = "API key is wrong";
				echo json_encode($response);
			}
		}		
	}

	public function image_upload()
	{
		if ( $_FILES['userfile']['name'] !="" ) {
		    $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $config['encrypt_name']			= TRUE;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                $response['errors'] = array('error' => $this->upload->display_errors());

            }
            else
            {
            	$upload_data = $this->upload->data();
            	$response['success'] = 1;
            	$response['file_path'] = base_url().'uploads/'.$upload_data['file_name'];
                // $data = array('upload_data' => $this->upload->data());
            }
            echo json_encode($response);
	    }
	} 

	public function save_shapes()
	{
		$get_user_json = file_get_contents('php://input');
		$user_data = json_decode($get_user_json);
		// print_r($get_user_json);
		// exit();
		// if (!empty($user_data)) {
		// 	if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

				$img = str_replace('data:image/png;base64,', '', $user_data->image_data);
				
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				// $file = 'uploads/' . 'ahsanullahJacos' . ".png";
				$file = 'uploads/' . time() . ".png";
				$success = file_put_contents($file, $data);
				if ($success) {
					echo $file;
				}else{
					echo 'error'; 
				}			
		// 	}else{
		// 		$response["success"] = 0;
		// 		$response["message"] = "API key is wrong";
		// 		echo json_encode($response);
		// 	}
		// }

	}
        
        public function post_details_by_id()
	{
            $get_user_json = file_get_contents('php://input');
            $user_data = json_decode($get_user_json);
            
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                $post_id = $user_data->post_id;
                $data['post_details'] = $this->wordapp_model->get_post_by_id($post_id);
                $data['success'] = 1;
                $data['message'] = 'success';
                
            }else{
                $data['post_details'] = NULL;               
                $data['success'] = 0;
                $data['message'] = 'api_key_wrong';
            }	
            echo json_encode($data['post_details']);
	}
	 
}// END Class

?>