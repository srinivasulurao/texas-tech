<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);//E_ALL

class Web extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('date');
	$this->load->library('session');
	$this->load->database();
	$this->load->library('email');
	$this->load->model('web_model',"temp");	
	
}
//--------------------------------- Functions ---------------------------------//	

public function registerDevice()
{
	$result=$this->temp->model_insertDevice();
	if($result)
	echo'{"success":true,"result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Please Try Again"}';
}


//--------------------------------- SignIn/Register (Copied from Kuuzazz) ---------------------------------//
 public function SignIn()
 {
	$result=$this->temp->SignIn_model();
	if($result){	
	echo '{"success":"true","result":'.json_encode($result).'}';
	}
	else{	
	echo '{"success":"false","result":"Invalid Login !"}';
	}
 }
 
 public function Forgetpassword()
 {
	$result=$this->temp->Forgetpassword_model();
	echo json_encode($result);
 }
 
 public function save_Password_byAccountID()
 {
	$result=$this->temp->save_Password_byAccountID_Model();
	echo json_encode($result);
 }
 
 // -------- Save Device Token --------
 public function save_Device()
{
	$result=$this->temp->save_Device_Model();
	echo json_encode($result);
}


 public function SignUp()
{
	$result = $this->temp->SignUp_model();
	
	if($result['Success']=='true')
	{
		echo '{"success":"true","result":'.json_encode($result['Result']).'}';
	} else {
		echo '{"success":"'.$result['Success'].'","result":"'.$result['Result'].'"}';
	}
}

 public function save_AccountInfo_byAccountID()
 {
	$result=$this->temp->save_AccountInfo_byAccountID_Model();
	echo json_encode($result);
 }
 
public function get_AccountInfo_byAccountID()
{
	$result=$this->temp->get_AccountInfo_byAccountID_Model();
	if($result)
	{	
		echo '{"success":"true","result":'.json_encode($result).'}';
	}
	else
	{	
		echo '{"success":"false","result":"No Record Found !"}';
	}
}

	
 public function save_ProfileImage_byAccountID()
 {
	$result=$this->temp->save_ProfileImage_byAccountID_Model();
	echo json_encode($result);
 }
 
 
  public function Account_setup()
 {
	$result=$this->temp->Account_setup_model();
	echo json_encode($result);
 }
 

//Login screen methods - newly created from April-9th-2015
 public function signUpCreateAccount()
 {
	$result=$this->temp->save_signup_create_account();
	echo json_encode($result);
 }

public function getProfileDetails(){
	$result = $this->temp->get_profile_details();
	if($result)
		echo'{"success":true,"result":'.json_encode($result).'}';
	else
		echo '{"success":false,"error":"data not found...."}';

}

public function getStatusTypes(){
	$result = $this->temp->get_status_types();
	if($result)
		echo'{"success":true,"result":'.json_encode($result).'}';
	else
		echo '{"success":false,"error":"data not found...."}';
}

 public function uploadUserImage()
 {
	$result=$this->temp->upload_user_image();
	echo json_encode($result);
 }
 
  public function saveUserAccountDevice()
{
	$result=$this->temp->save_UserDevice_Model();
	echo json_encode($result);
}

public function sendpush()
{
	$userId=$_REQUEST['login_id'];
	$status_id=$_REQUEST['status_id'];
	$status_types_arr = $this->temp->get_status_types_by_id();
	$status_type = $status_types_arr[$status_id];
	
	$pushFor=$status_type;
	$pushId=$_REQUEST['pushId'];	
	$message=$_REQUEST['message'];
    $time=$_REQUEST['time'];
	$insertPush=$this->temp->savePushMsg($userId,$message,$pushFor,$pushId,$time);
	$deviceId=$this->temp->getdeviceId($userId,$status_id,$pushId);
	if($deviceId)
	{
		$i=0;
		foreach($deviceId as $data)
		{
			$test=$this->temp->sendpush($data['deviceId'],$message);
			if($test)
			{
				$i++;
			}
		}
		echo '{"success":true, "result":"Push notification sent successfully"}';
	}
	else
	{
		echo '{"success":false,"error":"No device found"}';
	}
}

public function sendpush_andriod()
{
	$userId=$_REQUEST['login_id'];
	$status_id=$_REQUEST['status_id'];
	$status_types_arr = $this->temp->get_status_types_by_id();
	$status_type = $status_types_arr[$status_id];
	

	$pushFor=$status_type;
	$pushId=$_REQUEST['pushId'];	
	$message=$_REQUEST['message'];
    $time=$_REQUEST['time'];
	$insertPush=$this->temp->savePushMsg($userId,$message,$pushFor,$pushId,$time);
	$deviceId=$this->temp->getdeviceId($userId,$status_id,$pushId); 
	if($deviceId)
	{
		$i=0;
		foreach($deviceId as $data)
		{
			$test=$this->temp->sendpush_andriod($data['deviceId'],$message);
			if($test)
			{
				$i++;
			}
		}
		echo '{"success":true, "result":"Push notification sent successfully"}';
	}
	else
	{
		echo '{"success":false,"error":"No device found"}';
	}
}


//--------------------------------- Other Functions ---------------------------------//
    public function getSplashScreens(){

        $result = $this->temp->getSplashScreens();
        if($result)
            echo'{"success":true,"result":'.json_encode($result).'}';
        else
            echo '{"success":false,"error":"data not found...."}';
    }

    public function getContacts(){

        $result = $this->temp->getContacts();
        //debug($result);
        if($result)
            echo'{"success":true,"result":'.json_encode($result).'}';
        else
            echo '{"success":false,"error":"data not found...."}';

    }

    public function getFacultyDirectoryList(){
        $result=$this->temp->getFacultyDirectoryList();
        //debug($result);
        if($result)
            echo'{"success":true,"result":'.json_encode($result).'}';
        else
            echo '{"success":false,"error":"data not found...."}';

    }
    


    public function getHomeScreen()
{	
	$result=$this->temp->getHomeScreen($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


    public function getCampusMaps()
{	
	$result=$this->temp->getCampusMaps($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


    public function getEvents()
{	
	$result=$this->temp->getEvents($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}

    public function getResources()
{	
	$result=$this->temp->getResources($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


    public function getSocialMedia()
{	
	$result=$this->temp->getSocialMedia($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


    public function getMentalHealth()
{	
	$result=$this->temp->getMentalHealth($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}




    public function getLoginScreen()
{	
	$result=$this->temp->getLoginScreen($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


    public function getPrograms()
{	
	$result=$this->temp->getPrograms($_GET);
	if($result)
	echo '{"success":true, "result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"Error Getting Information"}';
}


//-------------------------------------------------
public function test()
{ echo "test ";
}

public function hello()
{
	//echo date("Y/m/d");
	//echo "<br>";
	//echo mdate('%M %d, %Y at exactly %h:%i %a',strtotime(date("Y/m/d")));
	//echo "<br>";
	//echo mdate('%Y-%m-%d %h:%i %a',strtotime(date("Y/m/d")));
	//echo "<br>";
	//echo mdate('%Y-%m-%d %h:%i %a',strtotime('01/01/2013'));
	/*$result = $this->temp->hello();
	if($result)
	echo'{"success":true,"result":'.json_encode($result).'}';
	else
	echo '{"success":false,"error":"This is test to check websevice"}';*/
	$filename = "./uploads/pdf/test";
	if (!is_dir($filename)) {
		mkdir($filename,0777);
	}
	$string = "This is test string,,";
	echo rtrim($string, ","); 
}


//////////////////////////////////////////////////////////////
public function setStudenttest()
{
$result = $this->temp->setStudenttest($_POST);
if($result)
echo'{"success":true,"msg":"data save "}';
else
echo '{"success":false,"msg": "Unable to save Information"}';
}

public function getGUIDByDeviceParams(){

	error_reporting(~E_NOTICE); //only enable the warning.
	$deviceId=$_REQUEST['DeviceID'];
	$deviceToken=$_REQUEST['DeviceToken'];
	$deviceType=$_REQUEST['DeviceType'];

	$result = $this->temp->getGUIDByDeviceParams_Model($deviceId,$deviceToken,$deviceType);
	if($result)
		echo'{"success":true, "result":'.json_encode($result).'}';
	else
		echo '{"success":false,"msg": "Unable to generate the information."}';


}

public function getUserDetailsFromGUID(){

	error_reporting(~E_NOTICE); //only enable the warning.
	$guid=$_REQUEST['GUID'];
	$result = $this->temp->getUserDetailsFromGUID_Model($guid);
	if($result)
		echo'{"success":true, "result":'.json_encode($result).'}';
	else
		echo '{"success":false,"msg": "Unable to generate the information."}';

}

    public function saveEventSurveyDataByQrCode(){
    
        error_reporting(~E_NOTICE);
        
        $result = $this->temp->saveEventSurveyDataByQrCode_Model();
        if($result)
        echo'{"success":true,"msg":"Event Data saved successfully!"}';
        else
        echo '{"success":false,"msg": "Unable to save Information"}';
        
    }


//------------ End Of Controller -----------------//
}
?>