<?php
session_start();
if(!isset($_SESSION['user']['derece']) && $_SESSION['user']['derece'] > 0){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";
?>

<?php 
    if(isset($_GET["pid"])){
        if(isset($_GET['kayitSil'])){
                include("db.php");
                $sorgu=$db->prepare('DELETE FROM kullanici WHERE id=?');
                $sonuc=$sorgu->execute([$_GET["pid"]]);
                if ($sonuc) {
                    header("Location:kullanicilar.php");
            }
        }if(isset($_GET['kayitGuncelle0'])){

            

            ?>
                <?php
        
            $sorgu   = $db->prepare('SELECT * FROM kullanici WHERE id=:uID');
            $res     = $sorgu->execute(['uID' => $_GET["pid"]]);
            $uye    = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <hr>
            <center>
            <div style="width: 50%; text-align: left;">
            <form action="kullanicilar.php?pid=<?php echo $_GET["pid"]; ?>&kayitGuncelle" method="post">  
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-posta</label>
                    <input type="email" class="form-control" name="mail" aria-describedby="emailHelp" value="<?php echo $uye[0]['mail']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Şifre</label>
                    <input type="password" class="form-control" name="pass" value="<?php echo $uye[0]['sifre']; ?>">
                </div>
                <div class=" mb-3">
                    <label for="ad" class="form-label">Telefon</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $uye[0]['telefon']; ?>">
                <div class=" mb-3">
                    <label for="ad" class="form-label">Ad</label>
                    <input type="text" class="form-control" name="ad" value="<?php echo $uye[0]['ad']; ?>">
                </div>
                <div class=" mb-3">
                    <label for="soyad" class="form-label">Soyad</label>
                    <input type="text" class="form-control" name="soyad" value="<?php echo $uye[0]['soyad']; ?>">
                </div>
                <div class="mb-3">
                    <label for="birthday">Doğum Tarihi</label>
                    <input type="date" id="birthday" name="birthday" value="<?php echo $uye[0]['dtarih']; ?>">
                </div>
                <select name="derece" id="derece" >
                    
                    <option value="0" <?php echo ($uye[0]['derece'] == 0)? "selected":""; ?> >Yönetici</option>
                    <option value="1" <?php echo ($uye[0]['derece'] == 1)? "selected":""; ?> >Mağaza Sahibi</option>
                    <option value="2" <?php echo ($uye[0]['derece'] == 2)? "selected":""; ?> >Müşteri</option>
                    
                </select>
                <button type="submit" class="btn btn-primary" name="guncelle">Güncelle</button>
            </form>
        </div>
        </center>
            <hr>
            <?php
            
        }else if(isset($_GET['kayitGuncelle'])){

            $kaydet=$db->prepare("UPDATE kullanici SET
                    mail=:mail,
                    sifre=:sifre,
                    telefon=:telefon,
                    ad=:ad,
                    soyad=:soyad,
                    dtarih=:dtarih,
                    derece=:derece WHERE id=:uID");

                $insert = $kaydet->execute(array(
                    'uID'    =>$_GET['pid'],
                    'mail'   =>$_POST['mail'],
                    'sifre'  =>$_POST['pass'],
                    'telefon'=>$_POST['phone'],
                    'ad'     =>$_POST['ad'],
                    'soyad'  =>$_POST['soyad'],
                    'dtarih' =>$_POST['birthday'],
                    'derece' =>$_POST['derece'] ));

              //  Header("Location:kullanicilar.php?pid=".$_GET['pid']);
        }
    }

?>





<?php
 $sorgu=$db ->prepare("SELECT * FROM kullanici");
 $sorgu->execute();
 $listleme= $sorgu-> fetchAll(PDO::FETCH_OBJ);
  ?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Kullanıcı Liste</title>
  </head>
  <body>    

    <div class="container">
    <div class= "row justify-content-center">
     <div class="col ">
      <table class="table table-border table-striped table-dark">
        <tr>
          <td>ID</td>
          <td>MAİL</td>
          <td>ŞİFRE</td>
          <td>TELEFON</td>
          <td>AD</td>
          <td>SOYAD</td>  
          <td>DTARİH</td>
          <td>DURUM</td>
          <td>SİL</td>
          <td>DÜZENLE</td>
      
        </tr>


        <?php 
        foreach($listleme as $person){?>

          <tr>
            <td><?= $person->id ?></td>
            <td><?= $person->mail ?></td>
            <td><?= $person->sifre ?></td>
            <td><?= $person->telefon ?></td>
            <td><?= $person->ad ?></td>
            <td><?= $person->soyad ?></td>
            <td><?= $person->dtarih ?></td>
            <td><?php 

            if($person->derece == 0)
                echo "Yönetici";
            else if($person->derece == 1)
                echo "Mağaza Sahibi";
            else if($person->derece == 2)
                echo "Müşteri";

                ?></td>
            <td><a href="kullanicilar.php?pid=<?= $person->id ?>&kayitSil" class="btn btn-danger">Sil</a></td>
            <td><a href= "kullanicilar.php?pid=<?= $person->id ?>&kayitGuncelle0" class="btn btn-primary">Güncelle</a></td>
            
          </tr>

        <?php } ?>
        
      </table>
     </div> 
    </div>    
    </div>









    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>