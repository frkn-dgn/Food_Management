<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Hello, world!</title>

    <style>
        .yuk {
            height: 500px;
            width: 50%;
        }

        .clear {

            height: 10px;

        }

        .kartlar {

            height: 200px;
            width: 60%;
            margin-left: 20%;
        }

        .body {
            background-color: #eee
        }

        .chat-btn {
            position: absolute;
            right: 14px;
            bottom: 30px;
            cursor: pointer
        }

        .chat-btn .close {
            display: none
        }

        .chat-btn i {
            transition: all 0.9s ease
        }

        #check:checked~.chat-btn i {
            display: block;
            pointer-events: auto;
            transform: rotate(180deg)
        }

        #check:checked~.chat-btn .comment {
            display: none
        }

        .chat-btn i {
            font-size: 22px;
            color: #fff !important
        }

        .chat-btn {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50px;
            background-color: blue;
            color: #fff;
            font-size: 22px;
            border: none
        }

        .wrapper {
            position: absolute;
            right: 20px;
            bottom: 100px;
            width: 300px;
            background-color: #fff;
            border-radius: 5px;
            opacity: 0;
            transition: all 0.4s
        }

        #check:checked~.wrapper {
            opacity: 1
        }

        .header {
            padding: 13px;
            background-color: blue;
            border-radius: 5px 5px 0px 0px;
            margin-bottom: 10px;
            color: #fff
        }

        .chat-form {
            padding: 15px
        }

        .chat-form input,
        textarea,
        button {
            margin-bottom: 10px
        }

        .chat-form textarea {
            resize: none
        }

        .form-control:focus,
        .btn:focus {
            box-shadow: none
        }

        .btn,
        .btn:focus,
        .btn:hover {
            background-color: blue;
            border: blue
        }

        #check {
            display: none !important
        }
    </style>
</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="images\theme\siteBanner.jpg" width="75px" height="100px" />
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
                </ul>

                <div class="text-end">

                    <?php
                        if(!isset($_SESSION['user'])){
                           
                    ?>
                    <a href="giris.php">
                        <button type="button" class="btn btn-success me-2">Giriş Yap</button>
                    </a>
                    <a href="kayit.php">
                    <button type="button" class="btn btn-warning">Kaydol</button>
                    </a>
                    <?php
                        }else{
                            ?>
                            <a href="admin/profil.php?id=<?php echo $_SESSION['user']['id'] ?>"> Profil</a> | 
                            <a href="cikis.php"> Çıkış Yap</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </header>