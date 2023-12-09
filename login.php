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
    <!-- header -->
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
                        echo ' <li><a href="login.php" class="active"></a></li>
                        <li><a href="signup.php">Üye Ol</a></li>';
                    }
                    // if (isset($_SESSION['id'])) {
                    //     echo ' 
                    //     <li><a href="index.php?islem=mesaj" >Hoş Geldin</a></li>
                    // <li><a href="gelen_mesaj.php" class="active">Mesajlar</a></li> ';
                    // }
                    if (isset($_SESSION['id'])) {
                        echo ' 
                        <li><a href="index.php?islem=cikis_yap" >Çıkış Yap</a></li>
                    <li><a href="gelen_mesaj.php" class="active">Mesajlar</a></li> ';
                    }

                    ?>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="contact.html">İletişim</a></li>



                </ul>
            </nav>
        </div>
    </header>

    <section id="contact-a" class="text-center py-3">
        <div class="container">
            <h2 class="section-title">Gİriş Yapınız</h2>
            <?php
            include 'db.php';
            $db = new db();

            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $psw = $_POST['psw'];
                $insert = $db->query('SELECT * FROM user where email = ? and password = ?', $email, $psw);
                if ($insert->numRows() == 1) {
                    echo '<div class="alert alert-success">Giriş Yapıldı.</div>';
                    echo $session_kullanici["name"];
                    session_start();
                    $db->query('SELECT * FROM user where email = ? and password = ?', $email, $psw)->fetchAll(
                        function ($session_kullanici) {
                            $_SESSION["email"] = $session_kullanici["email"];
                            $_SESSION["name"] = $session_kullanici["name"];
                            $_SESSION["id"] = $session_kullanici["id"]; ?>


                        <script>
                            window.location.href = "index.php";

                        </script>
                        <?php

                        }

                    );


                } else {
                    echo '<div class="alert alert-danger">Kullanıcı adı ve şifre hatalı</div>';
                }
            }
            ?>
            <div class="border-bottom"></div>
            <p class="lead">Bir hesabınız varsa lütfen bu formu doldurun.</p>
            <form action="login.php" method="post">
                <div class="form-fields">

                    <input type="email" class="email input" name="email" id="email" placeholder="Email" required />

                    <input class="password input" type="password" placeholder="Enter Password" name="psw" id="psw"
                        required />



                    <button type="submit" class="btn-dark">Giriş Yap</button>
                </div>
            </form>
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
</body>

</html>