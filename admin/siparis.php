<?php 

    if(isset($_GET["id"])){
        if(isset($_GET['siparisSil'])){
                $sorgu=$db->prepare('DELETE FROM siparis WHERE id=? AND k_id=?');
                $sonuc=$sorgu->execute($_GET['siparisSil'],$_SESSION['user']['id']);
                if ($sonuc) {
                    header("Location:restoran.php");
            }

        }
    }
      ?>