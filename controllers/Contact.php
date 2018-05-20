<?php

/**
 * Codeigniter 3 Contact Form with reCaptcha
 * using Twitter Bootstrap CSS
 *
 * @author yuriy eurweb@gmail.com 
 * @created 20.05.2018
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class  Contact  extends CI_Controller
{
	// settings
	protected 	$sendEmailTo =  'YOUR EMAIL';

	//reCAPTCHA  https://www.google.com/recaptcha/admin#site/
	protected 	$data_sitekey = 'recaptcha data-sitekey';
	protected	$recaptcha_secret  = 'recaptcha secret';

	// var for view
	protected 		$data 		= array();
	

	public function index() 
	{
		$this->load->library('form_validation');
		$this->load->library('recaptcha');
		$this->load->helper('security');
		$this->data['js'] = "";
		$this->set_validation_rules();
		$this->data['showform'] = true;
		$this->$data['data_sitekey'] = $this->data_sitekey;
	
		if ($this->form_validation->run() != FALSE)
        {
			$this->data['showform'] = false;
			$message = xss_clean($this->input->post('message'));
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$html = $name.' : '.$email .' <br/><br/>'.$message;
			$subjectLine = "Contact form response from " . $_SERVER['HTTP_HOST'];
			$res = sendMailApi($this->sendEmailTo, $subjectLine, $html);
			if ($res)
			{
				$this->$data['alert_info'] = 'Your mail has been sent successfully!';
			}
			else
			{
				$this->$data['alert_warning'] = 'There is error in sending mail! Please try again later!';
			}
        }
		
		$this->load->view('contact');
	}


	protected function set_validation_rules() 
	{
		$this->form_validation->set_rules('name', 'Your name', 'trim|required');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		$this->form_validation->set_rules('g-recaptcha-response', 'captcha validation', 'required|callback_validate_captcha');
		$this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
	}

	
	public function validate_captcha($grecaptcharesponse)
	{
		$ip = $this->input->ip_address();		
		$this->recaptcha->set_keys($this->data_sitekey, $this->recaptcha_secret);
		$this->recaptcha->set_parameter('remoteip', $ip);
		$is_valid = $this->recaptcha->is_valid($grecaptcharesponse, $ip);		
		return $is_valid['success'];
	}
}
