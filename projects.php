<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="../node_modules/lightbox2/dist/css/lightbox.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <title>Document</title>
</head>

<body>
    <?php
    include 'db.php';
    $db = new db();

    $books = $db->query('SELECT * FROM kitaplar')->fetchAll();
    ?>
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
                    <li><a href="index.php">AnaSayfa</a></li>
                    <li><a href="about.html">Hakkında</a></li>
                    <li><a href="projects.php" class="active">Kitaplar</a></li>
                    <li><a href="http://localhost:8501">ÖNERİ</a></li>
                    <li><a href="contact.html">İletişim</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="projects" class="text-center py-2">
        <div class="container">
            <h2 class="section-title">Kitaplar</h2>
            <div class="border-bottom"></div>
            <div class="lead">Eklenen Kitaplar</div>

            <div class="items">
                <?php
                foreach ($books as $kitap) {
                    echo "  <div class='item'>
                    <div class='item__image'>
                        <a href='mesajlas.php?alici_id=$kitap[ekleyenID]&kitap_id=$kitap[id]' data-lightbox='roadtrip'>
                            <img src='img/kitapekle.jpeg' alt='' />
                        </a>
                    </div>
                    <div class='item__text'>
                        <div class='item__text__wrap'>
                            <p class='item__text__category'>$kitap[kitap_adi]</p>
                            <h2 class='item__text__title'>$kitap[yazar]</h2>
                            <p class='item__text__author'>  </a> </p>
                        </div>
                    </div>
                </div>";
                }
                ?>


            </div>
        </div>
    </section>

    <footer id="main-footer">
        <div class="footer-content container">
            <p>Copyright &copy; 2025. All Rights Reserved.</p>

            <div class="social">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="../node_modules/lightbox2/dist/js/lightbox.min.js"></script>
</body>

</html>