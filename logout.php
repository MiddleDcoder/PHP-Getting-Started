<?php

session_start();

if(isset($_SESSION['username'])){
    unset($_SESSION['username']); //to delete a variable or entry
}
if(isset($_SESSION['isAdmin'])){
    unset($_SESSION['isAdmin']); //to delete a variable or entry
}

echo 'User logged out.';

?>