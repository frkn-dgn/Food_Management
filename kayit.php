<?php

include "top.php";
?>

    <section class="" style="background-color: rgb(232, 226, 235)">

        <div id="carouselExampleControls" class="margin-bottom-10px carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/app/dominos.jpg" class="d-block w-100 yuk" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/app/burgerking.jpg" class="d-block w-100 yuk" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/app/hatay-durum_imageycgl.jpg" class="d-block w-100 yuk" alt="100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
        <br>

        
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-3">
                <form class="userform"method="post" enctype="multipart/form-data" action="post.php" >
                    <div class=" mb-3">
                        <label for="exampleInputEmail1" class="form-label">E-posta</label>
                        <input type="email" class="form-control" name="mail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Şifre</label>
                        <input type="password" class="form-control" name="pass">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword2" class="form-label">Şifre Tekrar</label>
                        <input type="password" class="form-control" name="Pass2">
                    </div>
                    <div class=" mb-3">
                        <label for="ad" class="form-label">Telefon</label>
                        <input type="text" class="form-control" name="phone">
                    <div class=" mb-3">
                        <label for="ad" class="form-label">Ad</label>
                        <input type="text" class="form-control" name="ad">
                    </div>
                    <div class=" mb-3">
                        <label for="soyad" class="form-label">Soyad</label>
                        <input type="text" class="form-control" name="soyad">
                    </div>
                    <div class="mb-3">
                        <label for="birthday">Doğum Tarihi</label>
                        <input type="date" id="birthday" name="birthday">
                    </div>
                    <div class="mb-3">
                        <label for="adres" class="form-label">Adres Giriniz</label>
                        <input type="text" class="form-control" name="adres">
                    </div>

                    <button type="submit" class="btn btn-primary" name="kayit">Kaydol</button>
                </form>

            </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</section>

        <?php include "bottom.php";?>