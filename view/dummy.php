<?php
require '../model/interface.php';
require 'commonElements.php';
?>

<!doctype html>
<html lang="en">
<?php echo loadHeader("Dummy"); ?>

<body ng-app="PageApp">
<?php echo loadNavbar(getCategories($conn), $username); ?>

</body>

</html>