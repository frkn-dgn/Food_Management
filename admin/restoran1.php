<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['user']['derece']) || $_SESSION['user']['derece'] < 1){
    header("Location:index.php");
    exit();
}
include "db.php";
?>
<?php 
if(isset($_GET["page"]) && $_GET["page"] == "ekle"){
    if(isset($_POST["kaydet"]) && 
        !empty($_POST["isim"]) && 
        !empty($_POST["adres"]) && 
        !empty($_POST["slogan"])&& 
        !empty($_POST["minTutar"])){

        $kaydet=$db->prepare('INSERT INTO restoran SET 
            k_id='.$_SESSION['user']['id'].',
            isim="'.$_POST['isim'].'",
            adres_ID='.$_POST['adres'].',
            aciklama="'.$_POST['aciklama'].'",
            slogan="'.$_POST['slogan'].'",
            min_siparis='.$_POST['minTutar']);
        $insert = $kaydet->execute();
        if($insert){
            header("Location:restoran.php?id=".$_SESSION['user']['id']);
            exit();
        }else
            echo "kaydedilmedi";

    }


    $sorgu=$db->prepare('SELECT adres.adres_isim,adres.acik_adres,adres.id,iller.il_adi,ilceler.ilce_adi ilce_adi FROM adres,iller,ilceler WHERE k_id=:kid AND sehir_id = iller.id AND ilce_id = ilceler.id');
    $res = $sorgu->execute(['kid' => $_SESSION['user']['id']]);
    $adresler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    if(count($adresler) > 0){
?>
<form action="restoran1.php?id=<?php echo $_GET['id']."&page=ekle";?>" method="post">

    <div> 
    Restoran İsmini Giriniz : <input type="text" name="isim"><br>
    Minimum Sipariş Tutarı Belirleyin : <input type="number" name="minTutar" style="width:100px"><br>  
    Bir Slogan Belirleyin : <input type="text" name="slogan" style="width:100px"><br>
    Bir Açıklama Yazın : <input type="text" name="aciklama" style="width:100px"><br>


        <h3>Adres Seçin</h3>
    <table style="border: 1px solid black;">
<?php 
        $count = 1;
        foreach($adresler as $row) {
        
?>
    <div class="list">
        
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"><h3><?php echo $row["adres_isim"];?></h3></td>
                <td style="border: 1px solid black;"><?php $row["adres_isim"];?><input type="radio" id="javascript" name="adres" value="<?php echo $row["id"];?>" <?php echo ($count == 1) ? "checked" : ""; ?> ></td>
            </tr>
    </div>
<?php
        $count++;
        }

    ?>
</table>
<?php
    }else{
        ?>
            Bir Adres Belirleyin
        <?php
    }
?>
<input type="submit" name="kaydet" value="Restoran Oluştur">
</div></form>
<?php

}else if(isset($_GET["page"]) && $_GET["page"] == "guncelle" && isset($_GET["rID"]) && !empty($_GET["rID"]) && is_numeric($_GET["rID"])){

            $kaydet=$db->prepare("UPDATE kullanici SET

                mail=:mail,
                sifre=:sifre,
                telefon=:telefon,
                ad=:ad,
                soyad=:soyad,
                dtarih=:dtarih WHERE id=:uID");

    if(isset($_POST["up"]) && 
        !empty($_POST["isim"]) && 
        !empty($_POST["adres"]) && 
        !empty($_POST["slogan"])&& 
        !empty($_POST["minTutar"])){

        $kaydet=$db->prepare('UPDATE restoran SET 
            isim="'.$_POST["isim"].'",
            adres_ID='.$_POST["adres"].',
            aciklama="'.$_POST["aciklama"].'",
            slogan="'.$_POST["slogan"].'",
            min_siparis='.$_POST["minTutar"].' WHERE restoran.id='.$_GET["rID"]);
        $insert = $kaydet->execute();
        if($insert){
            header("Location:restoran.php?id=".$_GET['id']."&rID=".$_GET["rID"]);
            exit("kaydedildi");
            echo "kaydedildi";
        }else
            echo "kaydedilmedi";
    }


// restoran güncelle

 $sorgu=$db ->prepare("SELECT restoran.id,restoran.isim,restoran.min_siparis,restoran.slogan,restoran.aciklama,iller.il_adi,ilceler.ilce_adi,restoran.adres_ID FROM restoran,iller,ilceler,adres WHERE restoran.k_id=:kID AND iller.id = adres.sehir_id AND ilceler.id = adres.ilce_id AND adres.id=restoran.adres_ID AND restoran.id=:rID");
  
 $sorgu->execute(array('kID' => $_SESSION['user']['id'],'rID' => $_GET["rID"]));
 $restoran= $sorgu-> fetch(PDO::FETCH_ASSOC);
    ?>
    <form action="restoran1.php?id=<?php echo $_GET['id']."&page=guncelle&rID=".$_GET["rID"];?>" method="post">

        <div> 
        Restoran İsmi: <input type="text" name="isim" value="<?php echo $restoran['isim'];?>"><br>
        Minimum Sipariş Tutarı : <input type="number" name="minTutar" style="width:100px" value="<?php echo $restoran['min_siparis'];?>"><br>  
        Slogan : <input type="text" name="slogan" style="width:100px" value="<?php echo $restoran['slogan'];?>"><br>
        Açıklama : <input type="text" name="aciklama" style="width:100px" value="<?php echo $restoran['aciklama'];?>"><br>


            <h3>Adres</h3>
        <table style="border: 1px solid black;">
    <?php 
    $sorgu=$db->prepare('SELECT adres.adres_isim,adres.acik_adres,adres.id,iller.il_adi,ilceler.ilce_adi ilce_adi FROM adres,iller,ilceler WHERE k_id=:kid AND sehir_id = iller.id AND ilce_id = ilceler.id');
    $res = $sorgu->execute(['kid' => $_SESSION['user']['id']]);
    $adresler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    if(count($adresler) > 0){
            foreach($adresler as $row) {
            
    ?>
        <div class="list">
            
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;"><h3><?php echo $row["adres_isim"];?></h3></td>
                    <td style="border: 1px solid black;"><?php $row["adres_isim"];?><input type="radio" id="javascript" name="adres" value="<?php echo $row["id"];?>" <?php echo ($row["id"] == $restoran['adres_ID']) ? "checked" : ""; ?> ></td>
                </tr>
        </div>
    <?php
            }

        ?>
    </table>
    <?php
        }else{
            ?>
                Bir Adres Belirleyin
            <?php
        }
    ?>
    <input type="submit" name="up" value="Restoranı Güncelle">
    </div></form>
<?php
}
?>