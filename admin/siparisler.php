<?php
session_start();

if(!isset($_SESSION['user']) || !isset($_GET['id']) || $_GET['id'] != $_SESSION['user']['id']){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";
?>

<?php 

    $sorgu=$db->prepare('SELECT siparis.id,siparis.sip_id,siparis.aciklama as sip_aciklama,siparis.durum,yemekler.isim as yemek_isim,yemekler.fiyat,iller.il_adi,ilceler.ilce_adi,adres.acik_adres,restoran.isim as res_isim  FROM siparis,adres,yemekler,iller,ilceler,restoran WHERE 
        restoran.id = siparis.restoran_id AND 
        iller.id=adres.sehir_id AND 
        ilceler.id = adres.ilce_id AND 
        siparis.k_id=:kID AND 
        adres.id=siparis.adres_id AND 
        siparis.yemekler_id=yemekler.id GROUP BY sip_id
        ORDER BY dtarih DESC');

    $res = $sorgu->execute(['kID' => $_SESSION['user']['id']]);
    $siparisler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div> <h1>Siparisler (<?php echo count($siparisler) ?>)</h1>
<?php 
    foreach($siparisler as $row) {
?>
<hr>
<div class="list">
    <h3> id : <?php echo $row["id"];?></h3>
    <h3> Sipariş id : <?php echo $row["sip_id"];?></h3>
    <h3> Sipariş Açıklama : <?php echo $row["sip_aciklama"];?></h3>
    <h3> Restoran : <?php echo $row["res_isim"];?></h3>
    <h3> Sipariş id : <?php echo $row["sip_id"];?></h3>
    <h4> Adres : <?php echo $row["acik_adres"];?> |  <?php echo $row["ilce_adi"];?>/<?php echo $row["il_adi"];?></h4>
    <h4> Yemek : <?php echo $row["yemek_isim"];?></h4>
    <h4> Fiyat : <?php echo $row["fiyat"];?></h4>
    <h4> Durum : 
        <?php 
            switch ($row["durum"]) {
            case 0:
                echo "Teslim Edilmiş";
                break;
            case 1:
                echo "Yolda";
                break;
            case 2:
                echo "Onay Bekliyor";
                break;
            }
        ?>
    </h4>
    <a href="siparis.php?id=<?php echo $_SESSION['user']['id'];?>&siparisSil=<?php echo $row["id"];?>" style="color:red">Sil</a>
</div>
<hr>
<?php
    }
?>