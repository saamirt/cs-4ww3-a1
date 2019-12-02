<!-- ends the session after logout -->
<?php
require './config.php';
session_destroy();
header('Location: index.php');
