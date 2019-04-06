<?php
if(isset($_POST['g-recaptcha-response']))
{
   $captcha=$_POST['g-recaptcha-response'];
}

if(!defined('INITIALIZED'))
	exit;

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'logout')
	Visitor::logout();
if(isset($_REQUEST['account_login']) && isset($_REQUEST['password_login']) && $captcha)
{
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lckn44UAAAAAN2lQIjmPj8gKbWWpnkZbTc7SktV&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>Dirty Robot!</h2>';
        }
        else
        {
           Visitor::setAccount($_REQUEST['account_login']);
           Visitor::setPassword($_REQUEST['password_login']);
           //Visitor::login(); // this set account and password from code above as login and password to next login attempt
           //Visitor::loadAccount(); // this is required to force reload account and get status of user
           $isTryingToLogin = true;
        }
}
Visitor::login();