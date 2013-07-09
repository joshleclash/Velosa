<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
if(empty($_SESSION["_User"])){
    header('location:..');
}
?>
