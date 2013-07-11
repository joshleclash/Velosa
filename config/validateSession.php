<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
if(@count($_SESSION["_User"])==0){
	$location = dirname(dirname(__FILE__));
	$locationExplode = explode("\\",$location);
	$position = count($locationExplode)-1;
	
   
}
?>
