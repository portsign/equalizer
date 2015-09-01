<?php 
require_once "header.php"; 
error_reporting(0);
session_start();
if (empty($_SESSION['usernameAdmin']) && empty($_SESSION['passwordAdmin'])) { ?>

    <!-- LOGIN -->
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <br /><br /><br />
            <?php 
                if (isset($_GET['login'])) {
                    if ($_GET['login']=='false') {
                        echo '
                            <div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-alert"></i> Login Gagal, Username atau Password Salah</div>
                        ';
                    }
                }
            ?>
            <div class="account-wall">
                <img class="profile-img" src="images/photo.jpg"
                    alt="">
                <form action="<?php echo $baseUrl."record"; ?>" method="post" class="form-signin">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Sign in" />
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- END OF LOGIN -->
<?php } else {
?>
<?php require_once "navbar.php"; ?> 	
<div class="container-fluid main-container">  		
    <?php require_once "sidebar.php"; ?>
    
    <!-- CONTENT HOME ADMIN -->
    <script src="<?php echo $baseUrl; ?>js/jquery.selectit.js"></script>
    <link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/jquery.selectit.css" />
    <script>
    $(function () {
        $('#SelectBox').selectit({
            fieldname: 'tags[]',
            values: [
                
            ]
        });

        $('#SelectBoxEdit').selectit({
            fieldname: 'tags[]',
            values: [
                <?php 
                    $getIDP = $_GET['idPost'];
                    $TAMPILTAG = mysqli_query($connecDB, "SELECT * FROM tags WHERE idPost = '$getIDP'");
                    while($R = mysqli_fetch_array($TAMPILTAG)) {
                        echo "'".$R['namaTags']."',";
                    }
                ?>
            ]
        });

        $('#btnGetTags').click(function () {
            alert($('#SelectBox').selectit('values').join(', '));
        });

        $('#btnClear').click(function () {
            $('#SelectBox').selectit('clear');
        });

        $('#btnAdd').click(function () {
            var tag = prompt('Enter tag to add:', '');
            if (tag && tag !== '') {
                $('#SelectBox').selectit('add', tag);
            }
        });
    });
</script>
<style type="text/css">
#SelectBoxEdit {
    display: block;
  width: 100%;
  height: auto;
  padding: 7px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #e7e7e7;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
#SelectBox {
    display: block;
  width: 100%;
  height: auto;
  padding: 7px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #e7e7e7;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
</style>
    <?php 
    
            if (isset($_GET['type'])) {
                if ($_GET['type']=='editPost') {
                    ?>
                <?php 
                    $getIDPOST = $_GET['idPost'];
                    $tampilEdit=mysqli_query($connecDB, "SELECT * FROM post WHERE idPost = '$getIDPOST'");
                    $p = mysqli_fetch_array($tampilEdit);
                ?>
            <div class="col-md-10 content">
            <div class="panel panel-default">
            <div class="panel-heading">
                Post Page
            </div>
            <div class="panel-body">

                <form action="<?php echo $baseUrl; ?>record" method="POST" enctype="multipart/form-data">
                    Title
                    <input type="hidden" name="id" value="<?php echo $_GET['idPost']; ?>" />
                    <input type="text" name="judul" class="form-control" value="<?php echo $p['judul']; ?>" placeholder="Judul Postingan" /><br />
                    Post on Page<br />
                    <select name="modul">
                        <?php 
                            $tampilPage = mysqli_query($connecDB, "SELECT * FROM menu ORDER BY idMenu ASC");
                            while($r = mysqli_fetch_array($tampilPage)) {
                            $getidMenu = $r['idMenu'];
                            $tampilSub = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idMenu = '$getidMenu' ORDER BY idSubMenu ASC");
                            while($t = mysqli_fetch_array($tampilSub)) {
                        ?>
                            <option value="<?php echo $t['modul']; ?>" <?php if ($t['modul']==$p['modul']) { echo 'selected'; } ?>><?php echo "--".$t['namaSubMenu']; ?></option>
                        <?php } ?>
                            <option value="<?php echo $r['modul']; ?>" <?php if ($r['modul']==$p['modul']) { echo 'selected'; } ?>><?php echo $r['NamaMenu']; ?></option>
                        <?php } ?>
                    </select> <a href="<?php echo $baseUrl."menu"; ?>" class="btn btn-default btn-xs">Add Menu</a><br /><br />
                    Category<br />
                    <style type="text/css">
                    .cont_checkbox {
                        border:1px solid #ccc; width:300px; height: 100px; overflow-y: scroll; padding:10px;
                    }
                    </style>

                    <div class="cont_checkbox">
                        <?php 
                            $getPCIDPOST = $_GET['idPost'];
                            $SHOW_CATEGORY = mysqli_query($connecDB, "SELECT * FROM category")or die(mysql_error());
                            while($C = mysqli_fetch_array($SHOW_CATEGORY)) {


                        ?>  
                            <input type="checkbox" name="category[]" value="<?php echo $C['idCategory']; ?>" /> <?php echo $C['category']; ?> <br />
                         
                        <?php } ?>
        
                    </div>
                    

                    <a href="<?php echo $baseUrl."category/?type=addCategory"; ?>" class="btn btn-default btn-xs">Add Category</a>
                    <br /><br />
                    <b>Tags</b> <font color="gray"><i>(Separate with comma ' , ')</i></font>
                    <!-- 
                    <input type="text" name="tags" class="form-control" value="
                    <?php 

                        //$getUIDPOST = $_GET['idPost'];
                        //$SHOWTAGS = mysqli_query($connecDB, "SELECT * FROM tags WHERE idPost = '$getUIDPOST'");
                        //while($B = mysqli_fetch_array($SHOWTAGS)) {
                            //$string = str_replace(' ', ',', $B['namaTags']);
                            //echo $string;

                        //}
                    ?>
                    
                    " placeholder="ex: bedroom, interior design, other" />
                    -->
                    <div id="SelectBoxEdit" style="width: 100%"></div>
                    <br />
                    <strong>Article</strong>
                    <textarea name="isi" id="editor1" rows="10" cols="80" required><?php echo $p['isi']; ?></textarea><br />
                    <h3>EQUALIZER SEO by IndoCreator</h3>
                    Snippet Preview
                    <h4 style="color:blue"><strong><u>EQUALIZER Seo Feature</strong> - Search Engine Optimization <strong>Plugin</strong> - IndoCreator</u></h4>
                    <p style="color:green; margin-top:-10px;">indocreator.com/equalizer/seo/ - <span style="color:#6181FF">Cached</span>
                        <br /><span style="color:#000">The Most Complete <strong>Equalizer SEO feature</strong>, indoCreator's <strong>Equalizer SEO feature</strong> is an All in<br /> 
                        One <strong>SEO</strong> solution for your <strong>Equalizer</strong> blog, used by experts worldwide.</span>
                    </p>

                    <hr />
                    <strong>Focus Keyword</strong>
                    <input type="text" name="focusKeyword" value="<?php echo $p['focusKeyword']; ?>" class="form-control" />
                    <strong>SEO Title</strong>
                    <input type="text" name="seoTitle" value="<?php echo $p['seoTitle']; ?>" class="form-control" />
                    Title Display in search engines is limited to 70 chars.<br />
                    if the SEO Title is empty, the preview shows what the plugin generates based on your title template.
                    <br /><br />
                    <strong>Meta Description</strong>
                    <textarea name="metaDescription" class="form-control" ><?php echo $p['metaDescription']; ?></textarea>
                    <div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">The meta descriptopn will be limited to 156 chars</div>
                    <br />
                    <center><button type="submit" name="draftopost" class="btn btn-success"><i class='glyphicon glyphicon-send'></i> Update</button><button type="submit" name="draftopostfromedit" class="btn btn-info"><i class='glyphicon glyphicon-floppy-disk'></i> Save</button></center>
                </form> 
                <script>
                    CKEDITOR.replace( 'editor1' );
                </script>
            </div>
        </div>
        </div> 
    
    <?php                
                }
            } else {
        
    ?>
    
    
    <div class="col-md-10 content">
        <div class="panel panel-default">
        <div class="panel-heading">
            Post Page
                        
                <div class="modal fade" id="exampleModalg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Gallery Image to Post <?php echo $ho; ?></h4>
                          </div>
                          <div class="modal-body">
                            
                              
                              
                             
                              
                              
                            </span>
                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="changeCaption" class="btn btn-primary" value="Save">
                          </div>
                        </div>
                      </div>
                    </div>
            
            
        </div>
        <div class="panel-body">
            
            <form action="<?php echo $baseUrl; ?>record" method="POST" enctype="multipart/form-data">
                <b>Title</b>
                <input type="text" name="judul" class="form-control" placeholder="Judul Postingan" required /><br />
                <b>Post on Page</b><br />
                <select name="modul" required>
                    <option>-</option>
                    <?php 
                        $tampilPage = mysqli_query($connecDB, "SELECT * FROM menu ORDER BY idMenu ASC");
                        while($r = mysqli_fetch_array($tampilPage)) {
                        $getidMenu = $r['idMenu'];
                        $tampilSub = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idMenu = '$getidMenu' ORDER BY idSubMenu ASC");
                        while($t = mysqli_fetch_array($tampilSub)) {
                    ?>
                        <option value="<?php echo $t['modul']; ?>"><?php echo "--".$t['namaSubMenu']; ?></option>
                    <?php } ?>
                        <option value="<?php echo $r['modul']; ?>"><?php echo $r['NamaMenu']; ?></option>
                    <?php } ?>
                </select> <a href="<?php echo $baseUrl."menu"; ?>" class="btn btn-default btn-xs">Add Menu</a>
                &nbsp;<font color="#888">This is Additional Feature</font>
                <br /><br />
                <b>Category</b><br />
                
                
         
                <style type="text/css">
                .cont_checkbox {
                    border:1px solid #ccc; width:300px; height: 100px; overflow-y: scroll; padding:10px;
                }
                </style>

                <div class="cont_checkbox">
                    <?php 
                        $SHOW_CATEGORY = mysqli_query($connecDB, "SELECT * FROM category")or die(mysql_error());
                        while($C = mysqli_fetch_array($SHOW_CATEGORY)) {
                    ?>
                        <input type="checkbox" name="category[]" value="<?php echo $C['idCategory']; ?>" /> <?php echo $C['category']; ?> <br />
                    <?php } ?>

                </div>


                <a href="<?php echo $baseUrl."category/?type=addCategory"; ?>" class="btn btn-default btn-xs">Add Category</a>
                <br /><br />
                <b>Tags</b> <font color="gray"><i>(Separate with comma ' , ')</i></font>
                <!-- <input type="text" name="tags" class="form-control" placeholder="ex: bedroom, interior design, other" /> -->
                <div id="SelectBox" style="width: 100%"></div>
                <br />
                <strong>Article</strong>
                <textarea name="isi" id="editor1" rows="10" cols="80" required></textarea><br />
                <h3>EQUALIZER SEO by IndoCreator</h3>
                Snippet Preview
                <h4 style="color:blue"><strong><u>EQUALIZER Seo Feature</strong> - Search Engine Optimization <strong>Plugin</strong> - IndoCreator</u></h4>
                <p style="color:green; margin-top:-10px;">indocreator.com/equalizer/seo/ - <span style="color:#6181FF">Cached</span>
                    <br /><span style="color:#000">The Most Complete <strong>Equalizer SEO feature</strong>, indoCreator's <strong>Equalizer SEO feature</strong> is an All in<br /> 
                    One <strong>SEO</strong> solution for your <strong>Equalizer</strong> blog, used by experts worldwide.</span>
                </p>

                <hr />
                <strong>Focus Keyword</strong>
                <input type="text" name="focusKeyword" class="form-control" />
                <strong>SEO Title</strong>
                <input type="text" name="seoTitle" class="form-control" />
                Title Display in search engines is limited to 70 chars.<br />
                if the SEO Title is empty, the preview shows what the plugin generates based on your title template.
                <br /><br />
                <strong>Meta Description</strong>
                <textarea name="metaDescription" class="form-control" ></textarea>
                <div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">The meta descriptopn will be limited to 156 chars</div>
                <br />
                <center><button type="submit" name="posting" class="btn btn-success"><i class='glyphicon glyphicon-send'></i> Post</button><button type="submit" name="newfromdraft" class="btn btn-info"><i class='glyphicon glyphicon-floppy-disk'></i> Save</button></center>
            </form>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
        </div>
    </div>
    </div> 

    <?php } ?>

    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>