<?php


session_start();

if(session_destroy()) // Destroy all session
{
header("Location:index.html");
}


?>