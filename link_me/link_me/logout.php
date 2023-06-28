

<?php
echo "log out successfull.....";
if (isset($_GET["logout"])) {
    unset($_SESSION['id']);
    setcookie("id", "", time() - 3600);
    $_COOKIE['id'] = "";
  } ?>