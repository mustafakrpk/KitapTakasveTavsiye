<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>Kitap Takas Sitesi & Kitap Paylaşım Platformu | Kitap Ekle</title>
    <meta name="title" content="Kitap Takas Sitesi & Kitap Paylaşım Platformu">
    <meta name="description"
        content="Kitaplar kitap üzerine bir sosyal paylaşım sitesidir. Kitaplarınızı sitemize ekleyerek değerlendirebilir, kitap takas talebi ile kitaplarınızı paylaşabilirsiniz." />
    <meta name="keywords"
        content="kitap takas sitesi, kitap paylaşım, kitap değerlendirme, kitap özetleri, kitap takas sistemi, kitap takas etme, kitap paylaşımı, kitap eleştirileri, okunulan kitapları paylaşma, kitap yorumları, kitap puanları, 2.el kitap" />
    <meta name="viewport" content="width=device-width">
    <link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet" />
    <!--[if IE 7]> <link rel="stylesheet" href="css/ie7.css"> <![endif]-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/style.css" />

    <script type='text/javascript' src='http://anpsthemes.com/move/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script>
    <meta name="google-site-verification" content="bKsEHM1aYj-4YeqVofwXjQpQihAHdzagh7-ZsQw9n8A" />

</head>

<body>
    <header id="header__inner">
        <div class="container">
            <nav class="main-nav">

                <ul class="main-nav__items">
                    <?php

                    session_start();
                    if (!empty($_GET["islem"])) {
                        session_destroy();
                    }
                    if (!isset($_SESSION['id'])) {

                        echo ' <li><a href="login.php">Giriş Yap</a></li>
                        <li><a href="signup.php">Üye Ol</a></li>';
                    }
                    if (isset($_SESSION['id'])) {
                        $kullanici = $_SESSION["name"];
                        echo $kullanici;
                        echo ' 
                        
                        <li><a href="#?islem=mesaj"><?php echo $kullanici; ?> </a></li> ';
                    }

                    if (isset($_SESSION['id'])) {
                        echo ' 
                        <li><a href="index.php?islem=cikis_yap" >Çıkış Yap</a></li>
                    <li><a href="gelen_mesaj.php" class="active">Mesajlar</a></li>';
                    }
                    ?>
                    <li><a href="kitap_ekle.php">Kitap Ekle</a></li>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="about.html">Hakkında</a></li>
                    <li><a href="projects.php">Kitaplar</a></li>

                    <li><a href="contact.html">İletişim</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mesajlasmaalani">
        <?php
        include 'db.php';
        $db = new db();
        if (isset($_POST['gonder'])) {
            $alici_id = $_GET['alici_id'];
            $kitap_id = $_GET['kitap_id'];
            $mesaj = $_POST['mesaj'];
            $gonderen = $_SESSION['id'];

            $insert = $db->query('INSERT INTO mesajlar (alici_id, kitap_id, mesaj, gonderen_id) VALUES (?,?,?,?)', $alici_id, $kitap_id, $mesaj, $gonderen);

        }

        $giden_mesajlar = $db->query('SELECT * FROM mesajlar WHERE alici_id=? AND kitap_id=? ORDER BY id ASC', $_SESSION["id"], $_GET['kitap_id'])->fetchAll();
        $gelen_mesajlar = $db->query('SELECT * FROM mesajlar WHERE gonderen_id=? AND kitap_id=? ORDER BY id ASC', $_SESSION["id"], $_GET['kitap_id'])->fetchAll();
        ?>
        <div style="text-align: -webkit-right;">
            <?php
            foreach ($giden_mesajlar as $giden_mesaj) {
                echo "<p class='gidenmesaj'>$giden_mesaj[mesaj]</p>";
            }
            ?>
        </div>
        <div style="text-align: -webkit-left;">
            <?php
            foreach ($gelen_mesajlar as $gelen_mesaj) {
                if (array_key_exists('mesaj', $gelen_mesaj)) {
                    echo "<p class='gelenmesaj'>$gelen_mesaj[mesaj]</p>";
                }
            }
            ?>
        </div>
        <form action="mesajlas.php?alici_id=<?php echo $_GET["alici_id"] ?>&kitap_id=<?php echo $_GET["kitap_id"] ?>"
            method="post">
            <div class="row">
                <div class="col-11">
                    <input class="mesajyaz" type="text" name="mesaj" placeholder="Mesajını Buraya Yaz">
                </div>
                <div class="col-1">
                    <button style="height: 36px; width: 100%; margin: 10px;" name="gonder" type="submit">
                        Gönder
                    </button>
                </div>
            </div>
        </form>
    </div>




    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>

</html>