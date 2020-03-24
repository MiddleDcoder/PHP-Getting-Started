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
require 'config.inc.php'; //including php files

readfile('header.tmpl.html'); //including html files

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
        $hash = password_hash($password, PASSWORD_DEFAULT); //securing password
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
            "INSERT INTO users (name, gender, color, hash) VALUES (
                '%s','%s','%s', '%s')",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($color),
            $db->real_escape_string($hash));
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
  <div class="form-group">
  <label for="name">User name</label>
  <input type="text" class="form-control" name="name" id="name" value="<?php
    echo htmlspecialchars($name, ENT_QUOTES);
  ?>">
  </div>
  <div class="form-group">
  <label for="password">Password</label>
  <input type="password" class="form-control" name="password" id="password">
  </div>
  <div class="form-group">
  <div><label>Gender</label></div>
  <div class="form-check form-check-inline"> 
    <input type="radio" class="form-check-input" name="gender" id="gender-f" value="f"<?php
      if ($gender === 'f') {
        echo ' checked';
      }
    ?>>
    <label class="form-check-label" for="gender-f">female</label>
  </div>
  <div class="form-check form-check-inline"> 
    <input type="radio" class="form-check-input" name="gender" id="gender-m" value="m"<?php
      if ($gender === 'm') {
        echo ' checked';
      }
    ?>>
    <label class="form-check-label" for="gender-m">male</label>
  </div>
  <div class="form-check form-check-inline"> 
    <input type="radio" class="form-check-input" name="gender" id="gender-o" value="o"<?php
      if ($gender === 'o') {
        echo ' checked';
      }
    ?>>
    <label class="form-check-label" for="gender-o">other</label>
  </div>
  </div>
  <div class="form-group">
  <label for="color">Favorite color</label> 
    <select class="form-control" name="color" id="color">
      <option value="">Please select</option>
      <option value="#f00"<?php
        if ($color === '#f00') {
          echo ' selected';
        }
      ?>>red</option>
      <option value="#0f0"<?php
        if ($color === '#0f0') {
          echo ' selected';
        }
      ?>>green</option>
      <option value="#00f"<?php
        if ($color === '#00f') {
          echo ' selected';
        }
      ?>>blue</option>
    </select>
  </div>
  <input type="submit" name="submit" class="btn btn-primary" value="Register">
</form>

<?php
    readfile('footer.tmpl.html');
?>