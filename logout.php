<?php

session_start();

session_unset();
session_destroy();

setcookie(
  'ingat_saya',
  null,
  time() - 3600, // masa lalu
  '/'
);

header('Location: login.php');
exit;