
<?php 
class PagingAllpost {
    
    function cariPosisi($batas) {
        if(empty($_GET['page'])) {
            $posisi=0;
            $_GET['page']=1;
        } else {
            $posisi = ($_GET['page']-1) * $batas;
        } return $posisi; 
    }


    function jumlahHalaman($jmldata, $batas) {
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    function navHalaman($halaman_aktif, $jmlhalaman) {
    $link_halaman = "";

        for ($i=1; $i<=$jmlhalaman; $i++) {
          if ($i == $halaman_aktif) {
            $link_halaman .= "<a class='btn btn-success'><b>$i</b></a> ";
          } else{
            //include('baseUrl.php');
            $link_halaman .= "<a class='btn btn-success' href=".$baseUrl."../allpost/$i>$i</a>";
          }
        $link_halaman .= " ";
        }
        return $link_halaman;
    }
}

class PagingCategory {
    
    function cariPosisi($batas) {
        if(empty($_GET['page'])) {
            $posisi=0;
            $_GET['page']=1;
        } else {
            $posisi = ($_GET['page']-1) * $batas;
        } return $posisi; 
    }


    function jumlahHalaman($jmldata, $batas) {
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    function navHalaman($halaman_aktif, $jmlhalaman) {
    $link_halaman = "";

        for ($i=1; $i<=$jmlhalaman; $i++) {
          if ($i == $halaman_aktif) {
            $link_halaman .= "<a class='btn btn-success'><b>$i</b></a> ";
          } else{
            //include('baseUrl.php');
            $link_halaman .= "<a class='btn btn-success' href=".$baseUrl."../category/$i>$i</a>";
          }
        $link_halaman .= " ";
        }
        return $link_halaman;
    }
}

class PagingPostIndex {
    
    function cariPosisi($batas) {
        if(empty($_GET['pages'])) {
            $posisi=0;
            $_GET['pages']=1;
        } else {
            $posisi = ($_GET['pages']-1) * $batas;
        } return $posisi; 
    }


    function jumlahHalaman($jmldata, $batas) {
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    function navHalaman($halaman_aktif, $jmlhalaman) {
    $link_halaman = "";

        for ($i=1; $i<=$jmlhalaman; $i++) {
          if ($i == $halaman_aktif) {
            $link_halaman .= "<a class='btn btn-success'><b>$i</b></a> ";
          } else{
            //include('baseUrl.php');
            $link_halaman .= "<a class='btn btn-success' href='$i'>$i</a>";
          }
        $link_halaman .= " ";
        }
        return $link_halaman;
    }
}

class PagingCategoryPost {
    
    function cariPosisi($batas) {
        if(empty($_GET['page'])) {
            $posisi=0;
            $_GET['page']=1;
        } else {
            $posisi = ($_GET['page']-1) * $batas;
        } return $posisi; 
    }


    function jumlahHalaman($jmldata, $batas) {
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    function navHalaman($halaman_aktif, $jmlhalaman) {
    $link_halaman = "";

        for ($i=1; $i<=$jmlhalaman; $i++) {
          if ($i == $halaman_aktif) {
            $link_halaman .= "<a class='btn btn-success'><b>$i</b></a> ";
          } else{
            //include('baseUrl.php');
            $link_halaman .= "<a class='btn btn-success' href='$i'>$i</a>";
          }
        $link_halaman .= " ";
        }
        return $link_halaman;
    }
}

class PagingPagePost {
    
    function cariPosisi($batas) {
        if(empty($_GET['page'])) {
            $posisi=0;
            $_GET['page']=1;
        } else {
            $posisi = ($_GET['page']-1) * $batas;
        } return $posisi; 
    }


    function jumlahHalaman($jmldata, $batas) {
        $jmlhalaman = ceil($jmldata/$batas);
        return $jmlhalaman;
    }

    function navHalaman($halaman_aktif, $jmlhalaman) {
    $link_halaman = "";

        for ($i=1; $i<=$jmlhalaman; $i++) {
          if ($i == $halaman_aktif) {
            $link_halaman .= "<a class='btn btn-success'><b>$i</b></a> ";
          } else{
            //include('baseUrl.php');
            $link_halaman .= "<a class='btn btn-success' href='".$_GET['id'].".html/"."$i'>$i</a>";
          }
        $link_halaman .= " ";
        }
        return $link_halaman;
    }
}
?>

