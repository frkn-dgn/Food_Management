
<?php
session_start();
if(!isset($_SESSION) && !isset($_SESSION['user']['derece'])){
    header("Location:index.php");
    exit("çıkış");
}

if($_POST){
	include("db.php");
	if(isset($_POST["giris"])){

		$sorgu= $db->prepare("SELECT * FROM kullanici WHERE mail=:mail");
		$sorgu->execute(["mail"=>$_POST['mail']]);
		$data = $sorgu ->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			if ($data['sifre']==$_POST['pass']) {
				//giriş doğru
				$_SESSION['user'] = array(
					"id"	=> $data['id'],
					"ad"		=> $data['ad'],
					"soyad"		=> $data['soyad'],
					"mail"		=> $data['mail'],
					"telefon"	=> $data['telefon'],
					"dtarih"	=> $data['dtarih'],
					"derece"	=> $data['derece']
			);
				
				Header('Location:index.php');
			}else{
				echo "şifreniz hatalı ";
			}
		}else{
			//kullanici yoksa
			echo "Böyle Bir Kullanıcı Yok";
		}

	}else if(isset($_POST["kayit"])){

		$email =$_POST['mail'];
		$pass=$_POST['pass'];
		$phone=$_POST['phone'];
		$ad=$_POST['ad'];
		$soyad=$_POST['soyad'];
		$birthday=$_POST['birthday'];
		$pass = $_POST['pass'];
		$Pass2 = $_POST['Pass2'];

		if ($pass==$Pass2)
		{
			$kaydet=$db->prepare("INSERT INTO kullanici SET
				mail=:mail,
				sifre=:sifre,
				telefon=:telefon,
				ad=:ad,
				soyad=:soyad,
				dtarih=:dtarih,
				derece=2");

			$insert = $kaydet->execute(array(
				'mail'   =>$_POST['mail'],
				'sifre'  =>$_POST['pass'],
				'telefon'=>$_POST['phone'],
				'ad'     =>$_POST['ad'],
				'soyad'  =>$_POST['soyad'],
				'dtarih' =>$_POST['birthday']));

			if($insert){
				Header("Location:index.php?durum=ok");
			}else{
				Header("Location:index.php?durum=no");
			}
		}else{
				echo "şifreler uyuşmadı.";	
		}
	}
}else
	echo "Hatalı İşlem Yapıldı";
	
?>