<?php
session_start();

if(!isset($_SESSION['user']) || !isset($_GET['id']) || $_GET['id'] != $_SESSION['user']['id']){
    header("Location:index.php");
    exit();
}
include "db.php";
include "top.php";



    if(isset($_POST['guncelle'])){
        try{
            $kaydet=$db->prepare("UPDATE kullanici SET

                mail=:mail,
                sifre=:sifre,
                telefon=:telefon,
                ad=:ad,
                soyad=:soyad,
                dtarih=:dtarih WHERE id=:uID");

        $insert = $kaydet->execute(array(
                ':uID'    =>$_SESSION['user']['id'],
                ':mail'   =>$_POST['mail'],
                ':sifre'  =>$_POST['pass'],
                ':telefon'=>$_POST['phone'],
                ':ad'     =>$_POST['ad'],
                ':soyad'  =>$_POST['soyad'],
                ':dtarih' =>$_POST['birthday']));

            //Header("Location:profil.php?id=".$_SESSION['user']['id']);

        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
        

    }
?>

<?php
    
        $sorgu   = $db->prepare('SELECT * FROM kullanici WHERE id=:uID');
        $res     = $sorgu->execute(['uID' => $_SESSION['user']['id']]);
        $uye     = $sorgu->fetchAll(PDO::FETCH_ASSOC);
?>
    <hr>
                  <form style="margin: 20px;" action="profil.php?id=<?php echo $_SESSION['user']['id']; ?>" method="post">  
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

                    <button type="submit" class="btn btn-primary" name="guncelle">Güncelle</button>
</form>