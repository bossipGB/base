<?php
session_start();

function isLogged()
{
    if(!$_SESSION){
        return false;
    }
    if(!$_SESSION["user"]){
       return false;
    }
    return true;
}

function isAdmin()
{
   return isLogged() && is_array($_SESSION["user"]) && $_SESSION["user"]["role"] && $_SESSION["user"]["role"] === "admin";
}

?>