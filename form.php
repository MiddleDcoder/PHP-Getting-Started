<?php
if(isset($_POST['searchterm'])) {
    //isset() - for checking
    //means isset will return true if there is value 
    //it means  $_POST['searchterm'] there is something in that key searchterm
    // if there is something insecure !!!!!!
    // echo $_POST['searchterm'];
    echo htmlspecialchars($_POST['searchterm'], ENT_QUOTES); 
// now this practice will not output the code type in search form but will convert into html entities instead <i>Hello World!</i> will now 
}
?>
<form 
action="" 
method="post"> 
<!-- action=""  where to send the form data-->
<!-- method=""  how to send the form data-->
<input type="text" name="searchterm">
<input type="submit" value="search">
</form>