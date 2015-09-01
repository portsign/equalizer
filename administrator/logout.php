<?php
  session_start();
  session_unset();
  session_destroy();
  setcookie("cookname", '', time()-999999);
  echo "<script>window.location = './'</script>";
?>