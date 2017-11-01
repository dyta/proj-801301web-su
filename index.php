<?php
require_once 'database/config.inc.php';
session_start();
// require 'views/header.php';

include 'routes/path.php';
// require 'views/footer.php';

$DBConnect->close();
