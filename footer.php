<div class="col-md-12 footer">
        <ol class="breadcrumb">
          <?php 
            $tampilSETTING = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysql_error());
            $TS = mysqli_fetch_array($tampilSETTING);
          ?>
          <li>&copy; <?php echo $TS['copyright']; ?></li>
          <li>Link To : 
                        <a href="<?php echo $TS['facebookLink']; ?>"><img src="<?php echo $baseUrl; ?>images/facebookIcon.jpg" style="width:26px" /></a>
                        <a href="<?php echo $TS['twitterLink']; ?>"><img src="<?php echo $baseUrl; ?>images/twitterIcon.png" style="width:26px" /></a>
                        <a href="<?php echo $TS['googleplusLink']; ?>"><img src="<?php echo $baseUrl; ?>images/googleplusIcon.png" style="width:26px" /></a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
            $tampilPage = mysqli_query($connecDB, "SELECT * FROM page ORDER BY idPage DESC")or die(mysql_error());
            while($TP = mysqli_fetch_array($tampilPage)) {
          ?>
            <li><a href="<?php echo $baseUrl; ?>p/<?php echo $TP['url']; ?>"><?php echo $TP['judul']; ?></a></li>
          <?php } ?>
            <li><a href="<?php echo $baseUrl; ?>p/sitemap">Sitemap</a></li>
        </ol>
</div>
</body>
</html>