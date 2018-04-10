<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	public function ocr_file()
	{
		$api_key = 'AIzaSyAJ-sIixomgpdfHzLWiOpo8ghd0vz9GRTo';
		
		$base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
		$data = new stdClass();
		$data->requests[0] = new stdClass();
		$data->requests[0]->image = new stdClass();
		$data->requests[0]->image->content = $base64;
		$data->requests[0]->features[0] = new stdClass();
		$data->requests[0]->features[0]->type = 'TEXT_DETECTION';
		                                                                 
		$data_string = json_encode($data);                                                                                   

		$ch = curl_init('https://vision.googleapis.com/v1/images:annotate?key='.$api_key);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   

		$result = curl_exec($ch);
		echo $result;
	}
	
	public function ocr_string()
	{
		$api_key = 'AIzaSyAJ-sIixomgpdfHzLWiOpo8ghd0vz9GRTo';
		
		$base64 = $this->input->post('image');
		$data = new stdClass();
		$data->requests[0] = new stdClass();
		$data->requests[0]->image = new stdClass();
		$data->requests[0]->image->content = $base64;
		$data->requests[0]->features[0] = new stdClass();
		$data->requests[0]->features[0]->type = 'TEXT_DETECTION';
		                                                                 
		$data_string = json_encode($data);                                                                                   

		$ch = curl_init('https://vision.googleapis.com/v1/images:annotate?key='.$api_key);                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   

		$result = curl_exec($ch);
		echo $result;
	}
}
