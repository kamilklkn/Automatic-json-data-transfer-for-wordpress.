<?php
/**
 * @company:Kamilklkn
 * @link:http://kamilklkn.com
 * @editBy:Kamil Kalkan
 * @date:01/12/2015
 */
define("ADMIN_EMAIL", "app@kamilklkn.com");
define("DATE_FORMATE", "Europe/Istanbul");
 
/*
 * Following code will list all the products
 */

$TAG_DETAILS = "details";
$TAG_SUCCESS = "success";
$TAG_MESSAGE = "message";
$COUNT = "count";

$TAG_DETAIL1 = "detail1";
$TAG_DETAIL2 = "detail2";
$TAG_DETAIL3 = "detail3";
$TAG_DETAIL4 = "detail4";

$MESSAGETYPE_SINGLE = 1;
$MESSAGETYPE_GROUP = 2;
$MESSAGETYPE_FRIENDREQUEST = 3;
$MESSAGETYPE_DELIVERY = 3;

// Table Names
$usertable			= "i_user";
$userdetailtable	= "i_friend";

// Names
$id					= "id";

$name 				= "name";
$cat 				= "cat";
$address			= "address";
$phonecod 			= "phonecode";
$phone 				= "phone";
$pic 				= "pic";

$picitem			= "picitem";
$rating				= "rating";
$lat				= "latitude";
$lon				= "longitude";


$user_id 			= "user_id";
$picuser			= "picuser";
$fname 				= "fname";
$lname				= "lname";
$status				= "status";
$user_email			= "email";

$desc 				= "desc";

$type 				= "type";

$image 				= "image";
$message 			= "message";
$time 				= "time";
$item_id                ='';
$query_fetch_some = " $item_id , $name, $cat ";
$serverbusy ="Server is currently busy. Please try again.";	
	
date_default_timezone_set("" . DATE_FORMATE . "");
header("Content-Type:text/html; charset=utf-8");