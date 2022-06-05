<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['user']) || !isset($_GET['id']) || $_GET['id'] != $_SESSION['user']['id']){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<h2>Adres Ekle</h2> 
<?php

    if(isset($_POST["addAdres"])){

        $kaydet=$db->prepare('INSERT INTO adres SET 
            k_id='.$_SESSION['user']['id'].',
            acik_adres="'.$_POST['acikAdres'].'",
            adres_isim="'.$_POST['adresIsim'].'",
            sehir_id='.$_POST['il'].',
            ilce_id='.$_POST['ilce']);
        $insert = $kaydet->execute();
        if($insert){
            //header("Location:adres.php?id=2&adres");
            //exit();
        }else
            echo "kaydedilmedi";
        
    }else if(isset($_GET["adresSil"])){
        $sorgu=$db->prepare('DELETE FROM adres WHERE id=?');
        $sonuc=$sorgu->execute([$_GET["adresSil"]]);
        if ($sonuc) {
                //header("Location:adres.php?id=2&adres");
        }   
        
    }

?>

<?php
    $sorgu  = $db->prepare('SELECT * FROM iller');
    $res    = $sorgu->execute();
    $iller  = $sorgu->fetchAll(PDO::FETCH_ASSOC);
 ?>
<form action="adres.php?id=<?php echo $_GET['id']."&adres";?>" method="post">
    Adres İsmi : 
    <input type="text" name="adresIsim"  value="<?php if(isset($_POST) && isset($_POST['adresIsim'])) echo $_POST['adresIsim'];?>">
    
    Açık Adresi Giriniz :
    <textarea name="acikAdres" ><?php if(isset($_POST) && isset($_POST['acikAdres'])) echo $_POST['acikAdres'];?></textarea>
    İl : 
    <select name="il" id="il" onchange="this.form.submit()">
        <?php 
            foreach($iller as $row) {
        ?>
            <option value="<?php echo $row["id"]; ?>" <?php if(isset($_POST) && isset($_POST['il']) && $row["id"] == $_POST['il']) echo "selected";?>><?php echo $row["il_adi"]; ?></option>
        <?php 
            }
        ?>
    </select>
<?php
    if(isset($_POST["il"])){
        $sorgu   = $db->prepare('SELECT * FROM ilceler WHERE il_id=:ilId');
        $res     = $sorgu->execute(['ilId' => $_POST["il"]]);
        $ilceler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<select name="ilce" id="ilce">
<?php 

    foreach($ilceler as $row) {
?>
  <option value="<?php echo $row["id"] ?>" <?php if(isset($_POST) && isset($_POST['ilce']) && $row["id"] == $_POST['ilce']) echo "selected";?>><?php echo $row["ilce_adi"] ?></option>

<?php 
    }
?>
</select>

<?php 
    }
?>

<input type="submit" name="addAdres"value="Adres Ekle">
</form>
<?php 

    $sorgu=$db->prepare('SELECT adres.adres_isim,adres.acik_adres,adres.id,iller.il_adi,ilceler.ilce_adi ilce_adi FROM adres,iller,ilceler WHERE k_id=:kid AND sehir_id = iller.id AND ilce_id = ilceler.id');
    $res = $sorgu->execute(['kid' => $_SESSION['user']['id']]);
    $adresler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    
?>
<div> <h1>Adresler</h1>

<?php 

    foreach($adresler as $row) {
?>
<hr>
<div class="list">
    <h3> Adres İsmi : <?php echo $row["adres_isim"];?></h3>
    <h3>Adres : <?php echo $row["acik_adres"];?></h3>
    <h4> Şehir : <?php echo $row["il_adi"];?></h4>
    <h4> İlçe : <?php echo $row["ilce_adi"];?></h4>
    <a href="adres.php?id=<?php echo $_SESSION['user']['id'];?>&adresSil=<?php echo $row["id"]; ?>" style="color:red">Sil</a>
</div>
<hr>

<?php
    }
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>



 <?php include "bottom.php";?>