<?php
require 'auth.inc.php';

//update.php?id=2
if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
}else{
    header('Location: select.php');
}


$name = '';
$gender = '';
$color = '';


if(isset($_POST['submit'])) {
//setting the values of the variable
    $ok = true;
    if(!isset($_POST['name']) || $_POST['name'] === ''){
        $ok = false;
    }else {
        $name = $_POST['name']; // do not write with this practice start with isset so that it will check and no problem if no value in the form
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
        $db = new mysqli( //connecting db
            'localhost', //database host
            'root', //database user
            '', //database password
            'php'); //database name
        $sql = sprintf(       
            //inserting the data
            "UPDATE users SET name='%s', gender='%s', color='%s'
            WHERE id=%s",     
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($color),
            $id);
        $db->query($sql); //send to database
        // other method for avoid sql injection
        // $stmt = $db->prepare(
        //     "INSERT INTO table (name, gender, color) VALUES (?, ?, ?)");
        // $stmt->bind_param('ss', $name, $gender, $color);
        // $stmt->execute(); //this is the other way to insert data without sql injection
                echo '<p>User updated.</p>';
        $db->close(); //close connection

    }
} else {
            // add database code here
            $db = new mysqli( //connecting db
                'localhost', //database host
                'root', //database user
                '', //database password
                'php'); //database name
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = $db->query($sql);
            foreach($result as $row){
                $name = $row['name'];
                $gender = $row['gender'];
                $color = $row['color'];
            }
            $db->close();       

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
