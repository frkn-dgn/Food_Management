<?php
session_start();

if(isset($_SESSION['user'])){
    header("Location:index.php");
    exit();
}

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
        <div class="clear"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <form class="userform" action="post.php" method="post" >
                        <div class=" mb-3">
                            <label for="exampleInputEmail1" class="form-label">E-posta</label>
                            <input type="email" class="form-control" name="mail"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Şifre</label>
                            <input type="password" class="form-control" name="pass">
                        </div>
                       
                        <button type="submit" class="btn btn-primary" name="giris" name="giris">Giriş Yap</button>
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="clear"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
        <footer class="bg-dark py-5">
            <div class="container text-white">
                <div class="row">
                    <div class="col-md-2">
                        <h5><b>SÖYLE GELSİN </b></h5>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-unstryled">
                            <li class="text-muted"><small><b>ŞİRKETİM</b></small></li>
                            <li>Hakkında</li>
                            <li>İşler</li>
                            <li>Basın</li>

                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="list-unstryled">
                            <li class="text-muted"><small><b>TOPLULUKLAR</b></small></li>

                            <li>Geliştirici</li>
                            <li>Markalar</li>
                            <li>Yatırımcılar</li>
                        </ul>
                    </div>

                    <div class="col-md-2">
                        <ul class="list-unstryled">
                            <li class="text-muted"><small><b>YARARLI İŞLER</b></small></li>
                            <li>Yardım</li>
                            <li>Hediye</li>
                            <li>Haberler</li>

                        </ul>
                    </div>
                    <div class="col-md-2">
                        <a href="https://twitter.com/Mehmety40661234"><img src="t.png" width="30"></a>

                        <a href="https://www.instagram.com/mehmet.ygt6795/">
                            <img src="ins.png" width="30px"></a>

                        <a href="https://www.facebook.com/profile.php?id=100026941662321"><img src="f.png"
                                width="30"></a>
                    </div>
                    <div class="col-md-2">
                        <h5><b>SÖYLE GELSİN </b></h5>
                        <p class="mt-5 ml-auto"><small> <br>FURKAN DOĞAN</small></p>
                    </div>
                    <div class="clearfix">
                        <ul class="list-inline mt-5 float-left">
                            <li class="list-inline-item"><a href="#" class="text-white"><small>Yasal</small></a></li>
                            <li class="list-inline-item"><a href="#" class="text-white"><small>Gizlilik</small></a></li>

                            <li class="list-inline-item"><a href="#" class="text-white"><small>Reklamlar
                                        Hakkında<small></small></small></a></li><small><small>

                                </small></small>
                        </ul><small><small>


                            </small></small>
                    </div>
                </div>
            </div><small><small>
                </small></small>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $(".left-first-section").click(function () {
                    $('.main-section').toggleClass("open-more");
                });
            });
            $(document).ready(function () {
                $(".fa-minus").click(function () {
                    $('.main-section').toggleClass("open-more");
                });
            });
        </script>
</body>

</html>