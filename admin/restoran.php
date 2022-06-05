<?php
session_start();
if(!isset($_SESSION) && !isset($_SESSION['user']['derece']) && $_SESSION['user']['derece'] == 1){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";
?>

<?php 

    if(isset($_GET["pid"])){
        if(isset($_GET['kayitSil'])){
                $sorgu=$db->prepare('DELETE FROM restoran WHERE id=? AND k_id=?');
                $sonuc=$sorgu->execute([$_GET["pid"],$_SESSION['user']['id']]);
                if ($sonuc) {
                    header("Location:restoran.php");
            }

        }
    }
      ?>


<?php
 $sorgu=$db ->prepare("SELECT restoran.id,restoran.isim,restoran.min_siparis,restoran.slogan,restoran.aciklama,iller.il_adi,ilceler.ilce_adi FROM restoran,iller,ilceler,adres WHERE restoran.k_id=:kID AND iller.id = adres.sehir_id AND ilceler.id = adres.ilce_id AND adres.id=restoran.adres_ID ORDER BY restoran.id DESC ");
  
 $sorgu->execute(['kID' => $_SESSION['user']['id']]);
 $listeleme= $sorgu-> fetchAll(PDO::FETCH_OBJ);

  ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Restoranlarım</title>
  </head>
  <body>    

    <div class="container">
    <div class= "row justify-content-center">
        <h4> <a href="restoran1.php?page=ekle&id=<?php echo $_SESSION['user']['id']?>">Restoran Ekle</a></h4>
     <div class="col ">
      <table class="table table-border table-striped table-dark">
        <tr>
          <td>ID</td>
          <td>İSİM</td>
          <td>ŞEHİR</td>
          <td>İLCE</td>
          <td>MİNİMUM SİPARİŞ TUTARI</td>
          <td>SLOGAN</td> 
          <td>ACIKLAMA</td> 
          <td>SİL</td> 
          <td>GÜNCELLE</td> 
          <td>YEMEKLER</td>
          <td>SİPARİŞLER</td>
        </tr>
        <?php 
        foreach($listeleme as $person){?>
          <tr>
            <td><?= $person->id ?></td>
            <td><?= $person->isim ?></td>
            <td><?= $person->il_adi ?></td>
            <td><?= $person->ilce_adi ?></td>
            <td><?= $person->min_siparis ?></td>
            <td><?= $person->slogan ?></td>
            <td><?= $person->aciklama ?></td>
            <td><a href="restoran.php?pid=<?= $person->id ?>&kayitSil" class="btn btn-danger">SİL</a></td>
            <td><a href= "restoran1.php?id=<?php echo $_SESSION['user']['id'];?>&rID=<?php echo $person->id;?>&page=guncelle" class="btn btn-primary">GÜNCELLE</a></td>
            <td><a href= "yemeklerim.php?restoran=<?= $person->id ?>" class="btn btn-primary">YEMEKLER</a></td>
            <td><a href= "restoranSiparis.php?restoran=<?= $person->id ?>" class="btn btn-primary">SİPARİŞLER</a></td>
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