<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    public function __construct() {

        error_reporting(~E_NOTICE); // Only serious errors are shown.
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('url');
        $this->load->helper('texasTech');
        $this->load->model('eventModel','eventModel',true);
    }

    public function index()
    {
        //debug($this->session->userdata);
        $authentication_result=array();
        $data['message']=$authentication_result['message'];
        $data['title']="Texas Tech -  Dashboard";
        $data['messageType']=$authentication_result['messageType'];
        $this->load->view('dashboard',$data);
    }

    public function eventsurvey(){
        $data=array();
        $data['title']="Texas Tech - Event Attender's Page.";
        $result=$this->eventModel->storeEventAttenderDetails();
        $data['message']=$result['message'];
        $data['messageType']=$result['messageType'];
        $data['event_id']=$this->uri->segment(3,0);
        $data['roles']=$this->eventModel->statusTypes();
        $data['programs']=$this->eventModel->Programs();
        $this->load->view('surveyEvent',$data);

    }


}//Controller ends here.
