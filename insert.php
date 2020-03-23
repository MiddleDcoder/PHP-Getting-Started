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
require 'config.inc.php';

$name = '';
$gender = '';
$color = '';
$password = '';


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
    if($ok) {
        // add database code here
        $db = new mysqli( //connecting db
            // 'localhost', //database host
            // 'root', //database user
            // '', //database password
            // 'php'); //database name

            //Use Constant From the config.inc.php
            MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $sql = sprintf(
            //inserting the data
            "INSERT INTO users (name, gender, color) VALUES (
                '%s','%s','%s')",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),$db->real_escape_string($color));
        $db->query($sql); //send to database
        // other method for avoid sql injection
        // $stmt = $db->prepare(
        //     "INSERT INTO table (name, gender, color) VALUES (?, ?, ?)");
        // $stmt->bind_param('ss', $name, $gender, $color);
        // $stmt->execute(); //this is the other way to insert data without sql injection
                echo '<p>User added.</p>';
        $db->close(); //close connection

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
Gender: 
    <input type="radio" name="gender" value="f"<?php 
        if($gender === 'f'){
            echo ' checked';
        }
    ?>> Female
    <input type="radio" name="gender" value="m"<?php 
        if($gender === 'm'){
            echo ' checked';
        }
    ?>> Male
    <input type="radio" name="gender" value="o"<?php 
        if($gender === 'o'){
            echo ' checked';
        }
    ?>> Other <br />
Favorite color:
<select name="color">
    <option value="">Please select</option>
    <option value="#f00"<?php
        if($color === '#f00'){
            echo ' selected';
        }
    ?>>Red</option>
    <option value="#0f0"<?php
        if($color === '#0f0'){
            echo ' selected';
        }
    ?>>Green</option>
    <option value="#00f"<?php
        if($color === '#00f'){
            echo ' selected';
        }
    ?>>Blue</option>
</select> <br />
<input type="submit" name="submit" value="Register">
</form>
