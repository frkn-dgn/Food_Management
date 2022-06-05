<?php
session_start();
include "top.php";
?>
    <section class="" style="background-color: rgb(234, 231, 235)">

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

        <div class="clear"></div>

        <div class="container">
            <form class="col">
                <h2>Yemek Ara</h2>
                <div class="row">

                    <div class="col">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Şehirler</option>
                            <option value="1">Ankara</option>
                            <option value="2">İstanbul</option>
                            <option value="3">izmir</option>
                            <option value="3">Kayseri</option>
                            <option value="3">Konya</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Ara</button>
                    </div>
                </div>
            </form>
            <div class="clear"></div>
            <div class="col">

                <hr>
                <div class="clear"></div>
                <div class="card mb-3">
                    <img src="./images/tavuk_d_ner2.jpg" class="card-img-top kartlar" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tavuk Döner</h5>
                        <h6>İçindekiler:</h6> 
                        <p class="card-text">Tam Ekmek Arası Tavuk Döner + Patates Kızartması + Coca Cola</p>
                        <p class="card-text"><small class="">65 TL</small></p>
                        <button type="submit" class="btn btn-primary">Sepete Ekle</button>
                        <?php include "sepet.php";?>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="card mb-3">
                    <img style="width:40%;" src="./images/Hamburger.jpg" class="card-img-top kartlar" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Hot Burger</h5>
                        <h6>içindekiler</h6>
                        <p class="card-text">Whopper Jr. + Patates Kızartması + Soğan Halkası + Coca Cola</p>
                        <p class="card-text"><small class="">70 TL </small></p>
                        <button type="submit" class="btn btn-primary">Sepete Ekle</button>
                        <?php include "sepet.php";?>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="card mb-3">
                    <img style="width:40%; justify-content: center; padding-top: 10px; padding-left: 30px;" src="./images/Pizza.jpg" class="card-img-top kartlar" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Orta Boy Pizza</h5>
                        <h6>içindekiler</h6>
                        <p class="card-text">Domates sosu, extra mozzerella peyniri, jambon, mantar, siyah zeytin</p>
                        <p class="card-text"><small class="">90 TL </small></p>
                        <button type="submit" class="btn btn-primary">Sepete Ekle</button>
                        <?php include "sepet.php";?>
                    </div>
                </div>



            </div>
        </div>

        <div class="fixed-bottom">
            <input type="checkbox" id="check"> <label class="chat-btn" for="check"> <i
                    class="fa fa-commenting-o comment"></i> <i class="fa fa-close close"></i> </label>
            <div class="wrapper">
                <div class="header">
                    <h6>Let's Chat - Online</h6>
                </div>
                <div class="text-center p-2"> <span>Please fill out the form to start chat!</span> </div>
                <div class="chat-form"> <input type="text" class="form-control" placeholder="Name"> <input type="text"
                        class="form-control" placeholder="Email"> <textarea class="form-control"
                        placeholder="Your Text Message"></textarea> <button
                        class="btn btn-success btn-block">Submit</button> </div>

            </div>
        </div>
    </section>
    <div class="clear"></div>
    <div class="clear"></div>
<?php include "bottom.php";?>