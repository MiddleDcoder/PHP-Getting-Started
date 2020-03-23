<?php

$message = '';

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new mysqli(
      MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

    
    $db->close();
}


?>
<?php
readfile('header.tmpl.html');

echo "<div class='text-info'>$message</div>";
?>
<form method="post" action="">
  <div class="form-group">
    <label for="name">User name</label> <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="password">Password</label> <input type="password" class="form-control" name="password" id="password"><br>
  </div>
  <input type="submit" value="Login" class="btn btn-primary">
</form>
</div>
</div>
<?php
readfile('footer.tmpl.html');
?>