<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['user']['derece']) || $_SESSION['user']['derece'] < 1){
    //header("Location:index.php");
    exit("dd");
}
include "db.php";
?>
<?php
// yemeklerim

if(isset($_GET['restoran']) && is_numeric($_GET['restoran'])){
	if(isset($_GET['page'])){
		if($_GET['page'] == "sil" && isset($_GET['yemek'])){

			// delete food
			 $sorgu=$db->prepare('DELETE FROM yemekler WHERE id=?');
	                $sonuc=$sorgu->execute([$_GET['yemek']]);
	                if ($sonuc)
	                    header("Location:yemeklerim.php?restoran=".$_GET['restoran']);
		}

		if($_GET['page'] == "guncelle" && isset($_GET['yemek'])){

			// update food
				if(isset($_POST['guncelle'])){

					// save database

					$sorgu = $db->prepare("UPDATE yemekler SET isim=:isim,fiyat=:fiyat,aciklama=:aciklama,aktif=:aktif,kategori_id=:kategori_id WHERE id=:id");
					$update = $sorgu->execute(array(
						"id" => $_GET["yemek"],	
 						"isim" => $_POST["isim"],
						"fiyat" => $_POST["fiyat"],
						"aktif" => (isset($_POST["aktif"]) ? 1 : 0),
						"aciklama" => $_POST["aciklama"],
						"kategori_id" => $_POST["kategori"]
					));
					if($update)
						echo "update ok";
					else
						echo "update err";

					header("Location:yemeklerim.php?restoran=".$_GET['restoran']);

				}

			$sorgu = $db->prepare("SELECT * FROM kategori");
			$sonuclar = $sorgu->execute();
			$sonuclar = $sorgu->fetchAll(PDO::FETCH_OBJ);

			$query  = $db->prepare('SELECT * FROM yemekler WHERE id=:Y_ID');

	    $result = $query->execute(array("Y_ID" => $_GET['yemek']));
	    $foods  = $query->fetchAll(PDO::FETCH_OBJ);
	    $foods 	= $foods[0];
			?>

				<form action"yemeklerim.php?" method="post">				

					Yemek İsmi : <input type="text" name="isim" value="<?=$foods->isim?>"><br>
					Yemek Kategorisi :
					<select name="kategori">
					<?php
					foreach($sonuclar as $sonuc){
						?>
						<option value="<?= $sonuc->id ?>" <?php echo($sonuc->id == $foods->kategori_id ? "selected" : "")?> ><?= $sonuc->isim ?></option>
						<?php
						}
						?> 
						</select>
						<br>
					Açıklama : <textarea name="aciklama"><?=$foods->aciklama?></textarea> <br>
					Yemek Fiyatı : <input type="number" name="fiyat" value="<?=$foods->fiyat?>">TL <br>
					Aktif : <input type="checkbox" name="aktif" <?php echo $foods->aktif==1 ? "checked" : ""; ?>><br>
					<input type="submit" value="Güncelle" name="guncelle"> <br>

				</form>


			<?php
		}

		if($_GET['page'] == "ekle"){
			// add food
			if(isset($_POST['kaydet'])){

				// save database
				$sorgu = $db->prepare("INSERT INTO yemekler SET 
					isim=:isim,
					fiyat=:fiyat,
					aciklama=:aciklama,
					restoran_id=:restoran_id,
					aktif=:aktif,
					kategori_id=:kategori_id
					");
				$insert = $sorgu->execute(array(
					"isim" => $_POST['isim'],
					"fiyat" => $_POST['fiyat'],
					"aciklama" => $_POST['aciklama'],
					"restoran_id" => $_GET['restoran'],
					"aktif" => isset($_POST["aktif"]) ? true : false,
					"kategori_id" => $_POST["kategori"]
				));

				header("Location:yemeklerim.php?restoran=".$_GET['restoran']);

				$sorgu = $db->prepare("UPDATE yemekler SET isim=:isim,fiyat=:fiyat,aciklama=:aciklama,aktif=:aktif,kategori_id=:kategori_id WHERE id=:id");
					$update = $sorgu->execute(array(
						"id" => $_GET["yemek"],	
 						"isim" => $_POST["isim"],
						"fiyat" => $_POST["fiyat"],
						"aktif" => (isset($_POST["aktif"]) ? 1 : 0),
						"aciklama" => $_POST["aciklama"],
						"kategori_id" => $_POST["kategori"]
					));


			}

			$sorgu = $db->prepare("SELECT * FROM kategori");
			$sonuclar = $sorgu->execute();
			$sonuclar = $sorgu->fetchAll(PDO::FETCH_OBJ);

			?>
			<form action"yemeklerim.php?" method="post">				

					Yemek İsmi : <input type="text" name="isim"><br>
					Yemek Kategorisi :
					<select name="kategori">
					<?php
					foreach($sonuclar as $sonuc){
						?>
						<option value="<?= $sonuc->id?>"><?= $sonuc->isim ?></option>

						<?php
						}
						?> 
						</select>
						<br>
					Açıklama : <textarea name="aciklama"></textarea> <br>
					Yemek Fiyatı : <input type="number" name="fiyat">TL <br>
					Aktif : <input type="checkbox" name="aktif" checked><br>
					<input type="submit" value="Kaydet" name="kaydet"> <br>

				</form>
			<?php

			
		}
	}
    $query  = $db->prepare('SELECT yemekler.isim,yemekler.id,yemekler.fiyat,yemekler.aktif,kategori.isim as kategori_ismi,kategori_id FROM yemekler,kategori WHERE kategori.id=yemekler.kategori_id AND yemekler.restoran_id=:restoran_id');

    $result = $query->execute(array("restoran_id" => $_GET['restoran']));
    if($result > 0){
    	$foods  = $query->fetchAll(PDO::FETCH_OBJ);
?>
        <h4> <a href="yemeklerim.php?page=ekle&restoran=<?php echo $_SESSION['user']['id']?>">Yemek Ekle</a></h4>

		<h2>Yemeklerim(<?php echo (count($foods));?>)</h2>
		<?php 
			}	
			if(count($foods)>0) {
		?>

	<div class="container">
    <div class= "row justify-content-center">
     <div class="col ">
      <table class="table table-border table-striped table-dark">
        <tr>
          <td>ID</td>
          <td>İSİM</td>
          <td>Fiyat</td>
          <td>Aktif</td>
          <td>Kategori</td>
          <td>Sil</td>
          <td>Güncelle</td>
        </tr>
        <?php 
		foreach($foods as $food){
			?>

          <tr>
            <td><?= $food->id ?></td>
            <td><?= $food->isim ?></td>
            <td><?= $food->fiyat ?></td>
            <td><input type="checkbox" name="" <?php echo $food->aktif == 1 ? "checked" : "" ?>/></td>
            <td><?= $food->kategori_ismi ?></td>
            <td><a href="yemeklerim.php?restoran=<?= $_GET['restoran'] ?>&yemek=<?= $food->id?>&page=sil"> Sil </a></td>
            <td><a href="yemeklerim.php?restoran=<?= $_GET['restoran'] ?>&yemek=<?= $food->id?>&page=guncelle">Güncelle</a></td>
          </tr>

        <?php } ?>
        
      </table>
     </div> 
    </div>    
    </div>

<?php
 }	
}else{

	echo "Hatalı İşlem Yaptınız.";
}
?>