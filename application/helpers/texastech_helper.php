<?php
// All set of widely used functions to be kept here.

function helloHelper(){
    echo "balle balle";

}

function getDashboardHeaderLinks(){

    $links=array();
     $links['Splash Screen']="admin/splash_screen";
     $links['Login Screen']="admin/login_screen";
     $links['Push Notification']="admin/push_notification";
     $links['Home Screen']="admin/home_screen";
     $links['Contacts']="admin/contacts";
     $links['Campus Map']="admin/campus_map";
     $links['Faculty Directory']="admin/faculty_directory";
     $links['Events']="admin/events";
     $links['Student Resources']="admin/resources";
     $links['Virtual Tours']="admin/virtual_tours";
	 $links['Social Media']="admin/social_media";
	 $links['Health Resources']="admin/mental_health_resources";

        return $links;
}

function getMenuImages(){

    $images=array();
    $images['Splash Screen']="splash-screen.png";
    $images['Login Screen']="login-screen.png";
    $images['Home Screen']="home-screen.png";
    $images['Contacts']="contacts.png";
    $images['Campus Map']="campus-map.png";
    $images['Faculty Directory']="contacts.png";
    $images['Events']="events.png";
    $images['Student Resources']="resources.png";
    $images['Virtual Tours']="virtual-tours.png";
	

    return $images;
}

function userLoginName($session){
    return $session['firstName']." ".$session['lastName'];
}


function debug($arrayObject){
    echo "<pre>";
    print_r($arrayObject);
    echo"</pre>";
}
?>