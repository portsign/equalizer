<?php 
require_once "header.php"; 
require_once "navbar.php";
//require_once "slider.php";
?>    
<div class="col-md-12" style="background-color:#000;">
  <div class="modal-header">
    <?php 
      if (isset($_GET['login'])) {
          if ($_GET['login']=='false') {
                        echo '
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">Error:</span>
                          Enter a valid email address
                        </div>
                        ';
                    }
                }  
            ?>
            <h3 class="modal-title" id="exampleModalLabel">Login</h3>
            <p>Connect dengan Media Sosial</p>
            <a href="#" class="btn btn-info">F | Facebook</a> <a href="#" class="btn btn-info">t | Twitter</a>
          </div>
          <div class="modal-body" style="background-color:#eaeaea;">
            <form action="<?php echo $baseUrl; ?>record.php" method="POST">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Email:</label>
                <input type="email" name="email" class="form-control" id="recipient-name" required>
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Password:</label>
                <input type="password" name="password" class="form-control" id="recipient-name" required>
              </div>
              <a href="#">Forgot Password?</a>
          </div> 
          <div class="modal-footer">
            <a href="register" class="btn btn-default" data-toggle="modal" data-target="#registerModal">Register?</a>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
          </div>
</div>
<?php require_once "footer.php"; ?>