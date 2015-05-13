<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class AdminModel extends CI_Model
{
    public function __construct()
    {
        //error_reporting(0);
        parent::__construct();
        $this->load->database();

    }

    public function debug($arrayObject){

        echo "<pre>";
        print_r($arrayObject);
        echo"</pre>";

    }

    public function getCampusList(){
        $result=$this->db->get('campus');
        return $result->result_array();
    }

    public function deleteSplashScreen(){
        if($this->input->post('delete_splash_screen')):
        $deleteId=$this->input->post('delete_splash_id');
        $this->db->where('splashScreenId',$deleteId);
        $this->db->delete('splashscreens');
        $this->session->set_userdata('messageType','success');
        $this->session->set_userdata('message',"Splash Screen Deleted Successfully !");
        endif;
    }

    public function updateSplashScreen(){

        if($this->input->post('edit_splash_screen')):
            $update=array();
            $update['titlebartextcolor']=$this->input->post('titlebartextcolor');
            $update['deviceType']=$this->input->post('deviceType');
            $update['deviceResolution']=$this->input->post('deviceResolution');

            if($_FILES['backbutton']['tmp_name']):
                $upload1="uploads/".$_FILES['backbutton']['name'];
                move_uploaded_file($_FILES['backbutton']['tmp_name'],FCPATH.$upload1);
                $update['backbutton']=$upload1;
            endif;

            if($_FILES['icon']['tmp_name']):
                $upload2="uploads/".$_FILES['icon']['name'];
                move_uploaded_file($_FILES['icon']['tmp_name'],FCPATH.$upload2);
                $update['icon']=$upload2;
            endif;

            if($_FILES['background1']['tmp_name']):
                $upload3="uploads/".$_FILES['background1']['name'];
                move_uploaded_file($_FILES['background1']['tmp_name'],FCPATH.$upload3);
                $update['background1']=$upload3;
            endif;

            if($_FILES['background2']['tmp_name']):
                $upload4="uploads/".$_FILES['background2']['name'];
                move_uploaded_file($_FILES['background2']['tmp_name'],FCPATH.$upload4);
                $update['background2']=$upload4;
            endif;

            if($_FILES['titlebar']['tmp_name']):
                $upload5="uploads/".$_FILES['titlebar']['name'];
                move_uploaded_file($_FILES['titlebar']['tmp_name'],FCPATH.$upload5);
                $update['titlebar']=$upload5;
            endif;


            if($this->input->post('remove_icon'))
                $update['icon']='';
            if($this->input->post('remove_background1'))
                $update['background1']='';
            if($this->input->post('remove_background2'))
                $update['background2']='';
            if($this->input->post('remove_backbutton'))
                $update['backbutton']='';
            if($this->input->post('remove_titlebar'))
                $update['titlebar']='';

            $this->db->where('splashScreenId',$this->input->post('edit_splash_id'));
            $this->db->update('splashscreens',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Splash Screen Editted Successfully !");
        endif;

    }

    public function createSplashScreen(){

        if($this->input->post('create_splashscreen')):
            $insert=array();
            $insert['titlebartextcolor']=$this->input->post('titlebartextcolor');
            $insert['deviceType']=$this->input->post('deviceType');
            $insert['deviceResolution']=$this->input->post('deviceResolution');

            if($_FILES['backbutton']['tmp_name']):
                $upload1="uploads/".$_FILES['backbutton']['name'];
                move_uploaded_file($_FILES['backbutton']['tmp_name'],FCPATH.$upload1);
                $insert['backbutton']=$upload1;
            endif;

            if($_FILES['icon']['tmp_name']):
                $upload2="uploads/".$_FILES['icon']['name'];
                move_uploaded_file($_FILES['icon']['tmp_name'],FCPATH.$upload2);
                $insert['icon']=$upload2;
            endif;

            if($_FILES['background1']['tmp_name']):
                $upload3="uploads/".$_FILES['background1']['name'];
                move_uploaded_file($_FILES['background1']['tmp_name'],FCPATH.$upload3);
                $insert['background1']=$upload3;
            endif;

            if($_FILES['background2']['tmp_name']):
                $upload4="uploads/".$_FILES['background2']['name'];
                move_uploaded_file($_FILES['background2']['tmp_name'],FCPATH.$upload4);
                $insert['background2']=$upload4;
            endif;

            if($_FILES['titlebar']['tmp_name']):
                $upload5="uploads/".$_FILES['titlebar']['name'];
                move_uploaded_file($_FILES['titlebar']['tmp_name'],FCPATH.$upload5);
                $insert['titlebar']=$upload5;
            endif;


            if($this->input->post('remove_icon'))
                $insert['icon']='';
            if($this->input->post('remove_background1'))
                $insert['background1']='';
            if($this->input->post('remove_background2'))
                $insert['background2']='';
            if($this->input->post('remove_backbutton'))
                $insert['backbutton']='';
            if($this->input->post('remove_titlebar'))
                $insert['titlebar']='';

            $this->db->insert('splashscreens',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"New Splash Screen Added Successfully !");
        endif;
    }

    public function deleteContactDetails(){
        if($this->input->post('delete_contact')):
        $this->db->where('ID',$this->input->post('delete_contact_id'));
        $this->db->delete('contacts');
        $this->session->set_userdata('messageType','success');
        $this->session->set_userdata('message',"Contact Details Deleted Successfully !");
        endif;
    }

    public function createContactDetails(){

        if($this->input->post('create_contact')):
            $insert=array();
            $insert['Campus']=$this->input->post('Campus');
            $insert['Department']=$this->input->post('Department');
            $insert['Title']=$this->input->post('Title');
            $insert['Name']=$this->input->post('Name');
            $insert['Phone']=$this->input->post('Phone');
            $insert['Email']=$this->input->post('Email');
            $insert['URL']=$this->input->post('URL');

            if($_FILES['Image']['tmp_name']):
                $upload1="uploads/contacts".$_FILES['Image']['name'];
                move_uploaded_file($_FILES['Image']['tmp_name'],FCPATH.$upload1);
                $insert['Image']=$upload1;
            endif;
            $this->db->insert('contacts',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Contact Details Created Successfully !");
        endif;
    }
	
    public function createCampusDetails(){
        if($this->input->post('create_campus')):
            $insert=array();
            $insert['Name']=$this->input->post('Name');
            $insert['Address']=$this->input->post('Address');
            $insert['State']=$this->input->post('State');
            $insert['Zip']=$this->input->post('Zip');
            $insert['Phone']=$this->input->post('Phone');

            $this->db->insert('campus',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Campus Details Created Successfully !");
        endif;
    }	

    public function editContactDetails(){

        if($this->input->post('edit_contact')):
            $update=array();
            $update['Campus']=$this->input->post('Campus');
            $update['Department']=$this->input->post('Department');
            $update['Title']=$this->input->post('Title');
            $update['Name']=$this->input->post('Name');
            $update['Phone']=$this->input->post('Phone');
            $update['Email']=$this->input->post('Email');
            $update['URL']=$this->input->post('URL');

            if($_FILES['Image']['tmp_name']):
                $upload1="uploads/contacts".$_FILES['Image']['name'];
                move_uploaded_file($_FILES['Image']['tmp_name'],FCPATH.$upload1);
                $update['Image']=$upload1;
            endif;

            $this->db->where('ID',$this->input->post('edit_contact_id'));
            $this->db->update('contacts',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Contact Details Editted Successfully !");

        endif;
    }

    public function getSplashScreeens($conferenceId){
        $result=$this->db->query("SELECT *,dt.id as dt_id,dr.id as dr_id FROM splashscreens as s INNER JOIN device_type as dt ON s.deviceType=dt.id INNER JOIN device_resolutions as dr ON s.deviceResolution=dr.id");
        return $result->result_array();
    }

    public function getDeviceTypes(){
        $result=$this->db->get('device_type');
        return $result->result_array();
    }

    public function getDeviceResolutions(){
        $result=$this->db->get('device_resolutions');
        return $result->result_array();
    }

    public function getContacts(){

        $result=$this->db->query('select contacts.*,campus.ID as campus_id, campus.Name as campus_name from contacts LEFT JOIN campus ON contacts.Campus=campus.ID');
        return $result->result_array();
    }
	
    public function getSocialMedia(){
        $result=$this->db->query('select *  from socialmedia');
        return $result->result_array();
    }
	
    public function deleteSocialMedia(){
        if($this->input->post('delete_social_media')):
        $this->db->where('ID',$this->input->post('delete_social_media_id'));
        $this->db->delete('socialmedia');
        $this->session->set_userdata('messageType','success');
        $this->session->set_userdata('message',"Social Media Deleted Successfully !");
        endif;
    }

    public function createSocialMedia(){

        if($this->input->post('create_social_media')):
            $insert=array();
            $insert['Title']=$this->input->post('Title');
            $insert['URL']=$this->input->post('URL');

            if($_FILES['Image']['tmp_name']):
			$randnumber = rand();
                $upload1="uploads/social/".$randnumber.$_FILES['Image']['name'];
                move_uploaded_file($_FILES['Image']['tmp_name'],FCPATH.$upload1);
                $insert['Logo']=$upload1;
            endif;
            $this->db->insert('socialmedia',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Social Media Created Successfully !");
        endif;
    }

    public function editSocialMedia(){

        if($this->input->post('edit_social_media')):
            $update=array();
            $update['Title']=$this->input->post('Title');
            $update['URL']=$this->input->post('URL');

            if($_FILES['Image']['tmp_name']):
			$randnumber = rand();
                $upload1="uploads/social/".$randnumber.$_FILES['Image']['name'];
                move_uploaded_file($_FILES['Image']['tmp_name'],FCPATH.$upload1);
                $update['Logo']=$upload1;
            endif;

            $this->db->where('ID',$this->input->post('edit_social_media_id'));
            $this->db->update('socialmedia',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Social Media Editted Successfully !");

        endif;
    }
		

    public function getEvents(){
        $result=$this->db->get('events');
        return $result->result_array();
    }

    public function editEventDetails(){

        if($this->input->post('edit_event')):
            $update=array();
            $update['Date']=date("Y-m-d H:i:s",strtotime($this->input->post('Date')));
            $update['Description']=$this->input->post('Description');
            $update['Title']=$this->input->post('Title');
            $update['Address']=$this->input->post('Address');
            $update['Latitude']=$this->input->post('Latitude');
            $update['Longitude']=$this->input->post('Longitude');
            $update['UploadURL']=$this->input->post('UploadURL');
			$update['Active']=$this->input->post('Active');

            if($_FILES['Icon']['tmp_name']):
                $upload1="uploads/events".$_FILES['Icon']['name'];
                move_uploaded_file($_FILES['Icon']['tmp_name'],FCPATH.$upload1);
                $update['Icon']=$upload1;
            endif;

            $this->db->where('ID',$this->input->post('edit_event_id'));
            $this->db->update('events',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Event Details Editted Successfully !");

        endif;

    }

    public function deleteEventDetails(){

        if($this->input->post('delete_event')):
            $this->db->where('ID',$this->input->post('delete_event_id'));
            $this->db->delete('events');
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Event Details Deleted Successfully !");
        endif;

    }

    public function createEventDetails(){

        if($this->input->post('create_event')):
            $insert=array();
            $insert['Date']=date("Y-m-d H:i:s",strtotime($this->input->post('Date')));
            $insert['Description']=$this->input->post('Description');
            $insert['Title']=$this->input->post('Title');
            $insert['Address']=$this->input->post('Address');
            $insert['Latitude']=$this->input->post('Latitude');
            $insert['Longitude']=$this->input->post('Longitude');
            $insert['UploadURL']=$this->input->post('UploadURL');
			$insert['Active']=$this->input->post('Active');

            if($_FILES['Icon']['tmp_name']):
                $upload1="uploads/events".$_FILES['Icon']['name'];
                move_uploaded_file($_FILES['Icon']['tmp_name'],FCPATH.$upload1);
                $insert['Icon']=$upload1;
            endif;

            $this->db->where('ID',$this->input->post('edit_event_id'));
            $this->db->insert('events',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Event Details Created Successfully !");


        endif;


    }


    public function getResources(){
        $results=$this->db->get('resources');
        return $results->result_array();
    }

    public function createResourceDetails(){

        if($this->input->post('create_resource')):
            $insert=array();
            $insert['Title']=$this->input->post('Title');
            $insert['TeaserSentence']=$this->input->post('TeaserSentence');
            $insert['Latitude']=$this->input->post('Latitude');
            $insert['Longitude']=$this->input->post('Longitude');
            $insert['Address']=$this->input->post('Address');
            $insert['DateTime']=date("Y-m-d H:i:s",strtotime($this->input->post('DateTime')));
            $insert['SubmittedBy']=$this->session->userdata('user_id');
			
            if($_FILES['UploadURL']['tmp_name']):
                $upload1="uploads/student-resources/".$_FILES['UploadURL']['name'];
                move_uploaded_file($_FILES['UploadURL']['tmp_name'],FCPATH.$upload1);
                $insert['UploadURL']=$upload1;
            endif;			
			
            $this->db->insert('resources',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"New Resource Created Successfully !");
        endif;

    }

    public function deleteResourceDetails(){
       if($this->input->post('delete_resource')):
           $this->db->where('ID',$this->input->post('delete_resource_id'));
           $this->db->delete('resources');
           $this->session->set_userdata('messageType','success');
           $this->session->set_userdata('message',"Resource Details Deleted Successfully !");
       endif;
    }

    public function editResourceDetails(){

        if($this->input->post('edit_resource')):
            $update=array();
            $update['Title']=$this->input->post('Title');
            $update['TeaserSentence']=$this->input->post('TeaserSentence');
            $update['Latitude']=$this->input->post('Latitude');
            $update['Longitude']=$this->input->post('Longitude');
            $update['Address']=$this->input->post('Address');
            $update['DateTime']=date("Y-m-d H:i:s",strtotime($this->input->post('DateTime')));
            $update['SubmittedBy']=$this->session->userdata('user_id');
			
            if($_FILES['UploadURL']['tmp_name']):
                $upload1="uploads/student-resources/".$_FILES['UploadURL']['name'];
                move_uploaded_file($_FILES['UploadURL']['tmp_name'],FCPATH.$upload1);
                $update['UploadURL']=$upload1;
            endif;			
			
            $this->db->where('ID',$this->input->post('edit_resource_id'));
            $this->db->update('resources',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Resource Details Editted Successfully !");
        endif;


    }	
	
    public function createMentalHealthDetails(){

        if($this->input->post('create_resource')):
            $insert=array();
            $insert['Campus']=$this->input->post('Campus');
            $insert['Address']=$this->input->post('Address');
            $insert['Latitude']=$this->input->post('Latitude');
            $insert['Longitude']=$this->input->post('Longitude');
            $insert['Details']=$this->input->post('Details');
			$insert['ContactPerson']=$this->input->post('ContactPerson');
			
			$insert['Phone']=$this->input->post('Phone');
			$insert['Email']=$this->input->post('Email');
			$insert['Details2']=$this->input->post('Details2');
			$insert['Details3']=$this->input->post('Details3');			

            $insert['SubmittedBy']=$this->session->userdata('user_id');
            $this->db->insert('mentalhealth',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"New Mental Health Resource Created Successfully !");
        endif;
    }
	
    public function editMentalHealthDetails(){

        if($this->input->post('edit_resource')):
            $update=array();
            $update['Campus']=$this->input->post('Campus');
            $update['Address']=$this->input->post('Address');
            $update['Latitude']=$this->input->post('Latitude');
            $update['Longitude']=$this->input->post('Longitude');
            $update['Details']=$this->input->post('Details');
			$update['ContactPerson']=$this->input->post('ContactPerson');
			
			$update['Phone']=$this->input->post('Phone');
			$update['Email']=$this->input->post('Email');
			$update['Details2']=$this->input->post('Details2');
			$update['Details3']=$this->input->post('Details3');
			
            $update['SubmittedBy']=$this->session->userdata('user_id');
            $this->db->where('ID',$this->input->post('edit_resource_id'));
            $this->db->update('mentalhealth',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Mental Health Resource Details Editted Successfully !");
        endif;
    }		
	
    public function deleteMentalHealthDetails(){
       if($this->input->post('delete_resource')):
           $this->db->where('ID',$this->input->post('delete_resource_id'));
           $this->db->delete('mentalhealth');
           $this->session->set_userdata('messageType','success');
           $this->session->set_userdata('message',"Mental Health Resource Details Deleted Successfully !");
       endif;
    }
	
    public function getMentalHealthResources(){
        $results=$this->db->get('mentalhealth');
        return $results->result_array();
    }		

    public function getFacultyDirectoryList(){

        $result=$this->db->query('SELECT fd.*,c.Name as campus_name, c.ID as campus_id from facultydirectory as fd INNER JOIN campus as c ON fd.Campus=c.ID ORDER BY fd.ID DESC');
        return $result->result_array();
    }

    public function createFacultyDirectory(){
        if($this->input->post('create_faculty')):
            $insert=array();
            $insert['Campus']=$this->input->post('Campus');
            $insert['Title']=$this->input->post('Title');
            $insert['FirstName']=$this->input->post('FirstName');
            $insert['LastName']=$this->input->post('LastName');
            $insert['Rank']=$this->input->post('Rank');
            $insert['Phone']=$this->input->post('Phone');
            $insert['Email']=$this->input->post('Email');
            $insert['URL']=$this->input->post('URL');
            $insert['Image']=$this->input->post('Image');
        
            if($_FILES['ImageLocal']['tmp_name']):
                $upload1="uploads/faculty".$_FILES['ImageLocal']['name'];
                move_uploaded_file($_FILES['ImageLocal']['tmp_name'],FCPATH.$upload1);
                $insert['Image']=site_url().$upload1;
            endif;

            $this->db->insert('facultydirectory',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"New Faculty Details Saved Successfully !");

        endif;
    }

    public function editFacultyDirectory(){

        if($this->input->post('edit_faculty')):
            $update=array();
            $update['Campus']=$this->input->post('Campus');
            $update['Title']=$this->input->post('Title');
            $update['FirstName']=$this->input->post('FirstName');
            $update['LastName']=$this->input->post('LastName');
            $update['Rank']=$this->input->post('Rank');
            $update['Phone']=$this->input->post('Phone');
            $update['Email']=$this->input->post('Email');
            $update['URL']=$this->input->post('URL');
            $update['Image']=$this->input->post('Image');

            if($_FILES['ImageLocal']['tmp_name']):
                $upload1="uploads/faculty".$_FILES['ImageLocal']['name'];
                move_uploaded_file($_FILES['ImageLocal']['tmp_name'],FCPATH.$upload1);
                $update['Image']=site_url().$upload1;
            endif;

            $this->db->where('ID',$this->input->post('edit_faculty_id'));
            $this->db->update('facultydirectory',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Faculty Details Editted Successfully !");

        endif;

    }

    public function deleteFacultyDirectory(){
      if($this->input->post('delete_faculty')):
          $this->db->where('ID',$this->input->post('delete_faculty_id'));
          $this->db->delete('facultydirectory');
          $this->session->set_userdata('messageType','success');
          $this->session->set_userdata('message',"Faculty Details Deleted Successfully !");
      endif;
    }

    public function deleteCampusMap(){

        if($this->input->post('delete_campusmap')):
        $this->db->where('map_id',$this->input->post('delete_campusmap_id'));
        $this->db->delete('campus_maps');
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Campus Map Details Deleted Successfully !");
        endif;

    }

    public function createCampusMap(){

        if($this->input->post('create_campusmap')):
            $insert=array();
            $insert['campus_id']=$this->input->post('campus_id');
            $insert['map_title']=$this->input->post('map_title');
            $insert['call_us']=$this->input->post('call_us');
            $insert['directions']=$this->input->post('directions');
            $insert['email_id']=$this->input->post('email_id');
            $insert['map_link']=$this->input->post('map_link');
            $insert['latitude']=$this->input->post('latitude');
            $insert['longitude']=$this->input->post('longitude');

            if($_FILES['map_image']['tmp_name']):
                $upload1="uploads/campus-maps".$_FILES['map_image']['name'];
                move_uploaded_file($_FILES['map_image']['tmp_name'],FCPATH.$upload1);
                $insert['map_image']=$upload1;
            endif;


            $this->db->insert('campus_maps',$insert);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Campus Map Details Saved Successfully !");

        endif;


    }

    public function editCampusMap(){

        if($this->input->post('edit_campusmap')):

            $update=array();
            $update['campus_id']=$this->input->post('campus_id');
            $update['map_title']=$this->input->post('map_title');
            $update['call_us']=$this->input->post('call_us');
            $update['directions']=$this->input->post('directions');
            $update['email_id']=$this->input->post('email_id');
            $update['map_link']=$this->input->post('map_link');
            $update['latitude']=$this->input->post('latitude');
            $update['longitude']=$this->input->post('longitude');

            if($_FILES['map_image']['tmp_name']):
                $upload1="uploads/campus-maps".$_FILES['map_image']['name'];
                move_uploaded_file($_FILES['map_image']['tmp_name'],FCPATH.$upload1);
                $update['map_image']=$upload1;
            endif;


            $this->db->where('map_id',$this->input->post('edit_campusmap_id'));
            $this->db->update('campus_maps',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Campus Map Details Changed Successfully !");

        endif;
    }

    public function getCampusMapList(){

        $result=$this->db->query('SELECT cm.*,c.Name as campus_name, c.ID as campus_id from campus_maps as cm INNER JOIN campus as c ON cm.campus_id=c.ID');
        return $result->result_array();
    }

    public function getHomeScreens(){

        //$result=$this->db->query("SELECT * FROM apps_homescreens as h INNER JOIN device_resolutions as r ON h.image_size=r.id INNER JOIN device_type as t ON h.Device=t.id");
		 $result=$this->db->query("SELECT * FROM apps_homescreens order by SortOrder asc");
        return $result->result_array();
    }

    public function createHomeScreen(){

        if($this->input->post('create_homescreen')):

        $insert=array();
        $insert['Title']=$this->input->post('Title');
        $insert['SortOrder']=$this->input->post('SortOrder');
        $insert['Active']=$this->input->post('Active');

        if($_FILES['IconIphone']['tmp_name']):
			$randnumber = rand();
            $upload0="uploads/home-screens/".$randnumber.$_FILES['IconIphone']['name'];
            move_uploaded_file($_FILES['IconIphone']['tmp_name'],FCPATH.$upload0);
            $insert['IconIphone']=$upload0;
        endif;
		
        if($_FILES['IconIpad']['tmp_name']):
			$randnumber = rand();
            $upload1="uploads/home-screens/".$randnumber.$_FILES['IconIpad']['name'];
            move_uploaded_file($_FILES['IconIpad']['tmp_name'],FCPATH.$upload1);
            $insert['IconIpad']=$upload1;
        endif;		
		
        if($_FILES['IconAndroid']['tmp_name']):
			$randnumber = rand();
            $upload2="uploads/home-screens/".$randnumber.$_FILES['IconAndroid']['name'];
            move_uploaded_file($_FILES['IconAndroid']['tmp_name'],FCPATH.$upload2);
            $insert['IconAndroid']=$upload2;
        endif;	
		
        if($_FILES['IconTablet']['tmp_name']):
			$randnumber = rand();
            $upload3="uploads/home-screens/".$randnumber.$_FILES['IconTablet']['name'];
            move_uploaded_file($_FILES['IconTablet']['tmp_name'],FCPATH.$upload3);
            $insert['IconTablet']=$upload3;
        endif;			


        $this->db->insert('apps_homescreens',$insert);
        $this->session->set_userdata('messageType','success');
        $this->session->set_userdata('message',"New Home Screen Created Successfully !");

        endif;


    }

    public function deleteHomeScreen(){

     if($this->input->post('delete_homescreen')):
         $this->db->where(ID,$this->input->post('delete_homescreen_id'));
         $this->db->delete('apps_homescreens');
         $this->session->set_userdata('messageType','success');
         $this->session->set_userdata('message',"Home Screen Icon Deleted Successfully !");
     endif;
    }

    public function editHomeScreen(){

        if($this->input->post('edit_homescreen')):

            $update=array();
            $update['Title']=$this->input->post('Title');
            $update['SortOrder']=$this->input->post('SortOrder');
            $update['Active']=$this->input->post('Active');
			
        if($_FILES['IconIphone']['tmp_name']):
			$randnumber = rand();
            $upload0="uploads/home-screens/".$randnumber.$_FILES['IconIphone']['name'];
            move_uploaded_file($_FILES['IconIphone']['tmp_name'],FCPATH.$upload0);
            $update['IconIphone']=$upload0;
        endif;
		
        if($_FILES['IconIpad']['tmp_name']):
			$randnumber = rand();
            $upload1="uploads/home-screens/".$randnumber.$_FILES['IconIpad']['name'];
            move_uploaded_file($_FILES['IconIpad']['tmp_name'],FCPATH.$upload1);
            $update['IconIpad']=$upload1;
        endif;		
		
        if($_FILES['IconAndroid']['tmp_name']):
			$randnumber = rand();
            $upload2="uploads/home-screens/".$randnumber.$_FILES['IconAndroid']['name'];
            move_uploaded_file($_FILES['IconAndroid']['tmp_name'],FCPATH.$upload2);
            $update['IconAndroid']=$upload2;
        endif;	
		
        if($_FILES['IconTablet']['tmp_name']):
			$randnumber = rand();
            $upload3="uploads/home-screens/".$randnumber.$_FILES['IconTablet']['name'];
            move_uploaded_file($_FILES['IconTablet']['tmp_name'],FCPATH.$upload3);
            $update['IconTablet']=$upload3;
        endif;					
			

            $this->db->where('ID',$this->input->post('edit_homescreen_id'));
            $this->db->update('apps_homescreens',$update);
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"New Home Screen Editted Successfully !");

        endif;

    }

    public function deleteLoginScreen(){
       if($this->input->post('delete_loginscreen')):
           $this->db->where('id',$this->input->post('delete_loginscreen_id'));
           $this->db->delete('push_messages');
           $this->session->set_userdata('messageType','success');
           $this->session->set_userdata('message',"Login Screen Data removed Successfully !");
       endif;
    }

    public function editLoginScreen(){
       if($this->input->post('edit_loginscreen')):
           $update=array();
           $update['GUID']=$this->input->post('GUID');
           $update['username']=$this->input->post('username');
           $update['message']=$this->input->post('message');
           $update['status']=$this->input->post('status');
           $update['createdDate']=date("Y-m-d H:i:s",strtotime($this->input->post('createdDate')));
           $this->db->where('id',$this->input->post('edit_loginscreen_id'));
           $this->db->update('push_messages',$update);
           $this->session->set_userdata('messageType','success');
           $this->session->set_userdata('message',"Login Screen Data Changed Successfully !");
       endif;
    }

    public function createLoginScreen(){
     if($this->input->post('create_loginscreen')):

         $insert=array();
         $insert['GUID']=$this->input->post('GUID');
         $insert['username']=$this->input->post('username');
         $insert['message']=$this->input->post('message');
         $insert['status']=$this->input->post('status');
         $insert['createdDate']=date("Y-m-d H:i:s",strtotime($this->input->post('createdDate')));

         $this->db->insert('push_messages',$insert);
         $this->session->set_userdata('messageType','success');
         $this->session->set_userdata('message',"New  Login Screen Data Created Successfully !");
     endif;
    }

    public function getLoginScreens(){
        $result=$this->db->query('SELECT A.*, st.status_type as status_type FROM Accounts as A Left JOIN status_types as st ON A.status_id=st.status_id');
        return $result->result_array();
    }

    public function getStatusTypes(){
        $result=$this->db->get('status_types');
        return $result->result_array();
    }
	
     public function get_status_types_by_id(){
        $result=$this->db->get('status_types');
		$data = array();
        $result_array =  $result->result_array();
		if($result_array>0){
			foreach($result_array as $types){
				$data[$types['status_id']] = $types['status_type'];
			}
		}
		
		return $data;
    }	

    public function sendPushNotification(){
        if($this->input->post('sendPushNotification')):
            $this->session->set_userdata('messageType','success');
            $this->session->set_userdata('message',"Push Notification has been sent successfully !");
        endif;
    }

public function savePushMsg($userId,$message,$pushFor,$pushId,$time)
{
	if(!empty($userId)){
		$data=array(
					'pushMessage'=>$message,
					'userId'=>$userId,
					'pushFor'=>$pushFor,
					'pushId'=>$pushId,
					'createDate'=>date('Y-m-d h:i:s'),
					'timer'=>$time
			);
		$query=$this->db->insert('push_messages',$data);
		if($this->db->insert_id())
		return true;
	}else{
		return false;
	}
}

public function getdeviceId($userId,$status_id,$pushId)
{


	$query ="SELECT  AD.deviceToken, AD.deviceId, AD.deviceType from Account_Devices AD
	left join Accounts A on A.ID= AD.AccountID  
	 where A.ID= AD.AccountID and A.Active=1";
	 if(!empty($status_id)){
		$query .= " and A.status_id = '".$status_id."'  ";
	 }else if(!empty($pushId)){
		$query .= " and A.ID = '".$pushId."'  ";
	 }	 


	 $query=$this->db->query($query." GROUP BY AD.deviceToken");

	if($query->num_rows()>0)
	return $query->result_array();

}

//This is used to send push notification to IOS
public function sendpush_ios($dvtoken,$message)
{
	$fk_device=0;
	$urltopost = "http://appddiction.org//texasTechAppPushNotificator/simple.php";
	$datatopost = array(
							"tocken"=>trim($dvtoken),
							"msg" =>$message
						);
	$ch = curl_init ($urltopost);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$returndata = curl_exec ($ch);
	if($returndata==1) 
	return $returndata; 
	curl_close($ch); 
	
}

//This is used to send push notification to andriod
function sendpush_andriod($registatoin_ids, $message) {
    //Google cloud messaging GCM-API url
    $url = 'https://android.googleapis.com/gcm/send';
    $fields = array(
        'registration_ids' => $registatoin_ids,
        'data' => $message,
    );
    // Google Cloud Messaging GCM API Key    
    $headers = array(
        'Authorization: key=AIzaSyCL-j6565kqRNUxz0oT97s6OlDBjN3rTE0',
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);             
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
  
}


} //Admin Controller ends here