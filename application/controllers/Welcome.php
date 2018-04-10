<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function ocr()
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
		echo'<pre>';
		print_r(json_decode($result));
		echo'</pre>';
	}
}
