<?php
session_start();

if(!isset($_SESSION) || !isset($_SESSION['user']['derece']) || $_SESSION['user']['derece'] < 1){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";
?>

<?php 

    if(isset($_POST["status"]) && isset($_POST["sipNum"]) && is_numeric($_POST["status"]) && is_numeric($_POST["sipNum"])){
        $sorgu = $db->prepare("UPDATE siparis SET durum=".$_POST["status"]. " WHERE id=".$_POST["sipNum"]);
        $lastId = $sorgu->execute();
        
    }

 
    $sorgu=$db->prepare('SELECT siparis.id,siparis_detay.siparis_id,siparis.aciklama as sip_aciklama,siparis.durum,yemekler.isim as yemek_isim,siparis_detay.sip_det_fiyat as fiyat,iller.il_adi,ilceler.ilce_adi,adres.acik_adres,restoran.isim as res_isim  FROM siparis,adres,yemekler,iller,ilceler,restoran,siparis_detay WHERE 
        restoran.id = siparis.restoran_id AND 
        iller.id=adres.sehir_id AND 
        ilceler.id = adres.ilce_id AND 
        adres.id=siparis.adres_id AND 
        siparis.restoran_id=:rID AND 
        siparis_detay.siparis_id = siparis.id AND
        siparis_detay.sip_det_yemek = yemekler.id
        ORDER BY dtarih DESC');

    $res = $sorgu->execute(['rID' => $_GET['restoran']]);
    $siparisler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div> <h1>Siparisler (<?php echo count($siparisler) ?>)</h1>
<?php 
    foreach($siparisler as $row) {
?>
<hr>
<div class="list">
    <h3> id : <?php echo $row["id"];?></h3>
    <h3> Sipariş Açıklama : <?php echo $row["sip_aciklama"];?></h3>
    <h3> Restoran : <?php echo $row["res_isim"];?></h3>
    <h4> Adres : <?php echo $row["acik_adres"];?> |  <?php echo $row["ilce_adi"];?>/<?php echo $row["il_adi"];?></h4>
    <h4> Yemek : <?php echo $row["yemek_isim"];?></h4>
    <h4> Fiyat : <?php echo $row["fiyat"];?></h4>
    <h4> Durum : 
    <form method="post" action="restoranSiparis.php?restoran=<?php echo $_GET['restoran'];?>">
        <input type="hidden" name="sipNum" value="<?= $row["id"]?>">
       <select name="status"  onchange="this.form.submit()">
            <option value="0" <?php echo $row["durum"] ==0 ? "selected" : ""?> >Onay Bekliyor</option>
            <option value="1" <?php echo $row["durum"] ==1 ? "selected" : ""?> >Hazırlanıyor</option>
            <option value="2" <?php echo $row["durum"] ==2 ? "selected" : ""?> >Yolda</option>
            <option value="3" <?php echo $row["durum"] ==3 ? "selected" : ""?> >Teslim Edildi</option>
            <option value="4" <?php echo $row["durum"] ==4 ? "selected" : ""?> >İptal</option>
        </select>
    </form>
    </h4>
    <a href="siparis.php?id=<?php echo $_SESSION['user']['id'];?>&siparisSil=<?php echo $row["id"];?>" style="color:red">Sil</a>
</div>
<hr>
<?php
    }
?>