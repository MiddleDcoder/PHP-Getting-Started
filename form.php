<?php
// if(isset($_POST['searchterm'])) {
//     //isset() - for checking
//     //means isset will return true if there is value 
//     //it means  $_POST['searchterm'] there is something in that key searchterm
//     // if there is something insecure !!!!!!
//     // echo $_POST['searchterm'];
//     echo htmlspecialchars($_POST['searchterm'], ENT_QUOTES); 
// // now this practice will not output the code type in search form but will convert into html entities instead <i>Hello World!</i> will now not count as html 
// }
$name = '';
$password = '';
$gender = '';
$color = '';
$languages = [];  //or array();
$comments = '';
$tc = '';

if(isset($_POST['submit'])) {
//setting the values of the variable
    $ok = true;
    if(!isset($_POST['name']) || $_POST['name'] === ''){
        $ok = false;
    }else {
        $name = $_POST['name']; // do not write with this practice start with isset so that it will check and no problem if no value in the form
    };
    if(!isset($_POST['password']) || $_POST['password'] === ''){
        $ok = false;
    }else{
        $password = $_POST['password'];
    };
    if(!isset($_POST['gender']) || $_POST['gender'] === ''){
        $ok = false;
    }else{
        $gender = $_POST['gender'];
    };
    if(!isset($_POST['color']) || $_POST['color'] === ''){
        $ok = false;
    }else{
        $color = $_POST['color'];
    };
    if(!isset($_POST['languages']) || !is_array($_POST['languages'])
    || count($_POST['languages']) === 0){
        $ok = false;    
    }else{
        $languages = $_POST['languages'];
    };
    if(!isset($_POST['comments']) || $_POST['comments'] === ''){
        $ok = false;
    }else{
        $comments = $_POST['comments'];
    };
    if(!isset($_POST['tc']) || $_POST['tc'] === ''){
        $ok = false;
    }else{
        $tc = $_POST['tc'];
    };

    if($ok) {

    printf('User name: %s
        <br>Password: %s
        <br>Gender: %s
        <br>Color: %s
        <br>Language(s): %s
        <br>Comments: %s
        <br>T&amp;C: %s',
        htmlspecialchars($name, ENT_QUOTES),
        htmlspecialchars($password, ENT_QUOTES),
        htmlspecialchars($gender, ENT_QUOTES),
        htmlspecialchars($color, ENT_QUOTES),
        htmlspecialchars(implode(' ', $languages), ENT_QUOTES),
        htmlspecialchars($comments, ENT_QUOTES),
        htmlspecialchars($tc, ENT_QUOTES));
    }

    }
?>
<form 
action="" 
method="post"> 
<!-- action=""  where to send the form data-->
<!-- method=""  how to send the form data-->
User name: <input type="text" name="name" value="<?php
    echo htmlspecialchars($name, ENT_QUOTES);
?>"><br>
Password: <input type="password" name="password"><br>
Gender: 
    <input type="radio" name="gender" value="f"> Female
    <input type="radio" name="gender" value="m"> Male
    <input type="radio" name="gender" value="o"> Other <br />
Favorite color:
<select name="color">
    <option value="">Please select</option>
    <option value="#f00">Red</option>
    <option value="#0f0">Green</option>
    <option value="#00f">Blue</option>
</select> <br />
Languages spoken:
    <select name="languages[]" multiple size="3">
        <option value="en">English</option>
        <option value="fr">French</option>
        <option value="it">Italian</option>
    </select><br>
Comments: <textarea name="comments"><?php 
    echo htmlspecialchars($comments, ENT_QUOTES);
?></textarea><br>
<input type="checkbox" name="tc" value="ok">I accept the T&amp;C<br>
<input type="submit" name="submit" value="Register">
</form>
