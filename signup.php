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
    <link rel="stylesheet" href="css/main.css" />
    <title>Kayıt Ol</title>
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
                        echo ' <li><a href="login.php">Giriş Yap</a></li>
                        <li><a href="signup.php" class="active">Üye Ol</a></li>';
                    }
                    if (isset($_SESSION['id'])) {
                        echo ' 
                        <li><a href="index.php?islem=cikis_yap" >Çıkış Yap</a></li>
                    <li><a href="gelen_mesaj.php" class="active">Mesajlar</a></li>';
                    }
                    ?>


                    <li><a href="contact.html">İletişim</a></li>
                    <li><a href="index.php">Ana Sayfa</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="contact-a" class="text-center py-3">
        <div class="container">
            <h2 class="section-title">Üye Ol</h2>
            <?php
            include 'db.php';
            $db = new db();

            if (isset($_POST['fullname'])) {
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $psw = $_POST['psw'];
                $insert = $db->query('INSERT INTO user (name,email,password) VALUES (?,?,?)', $fullname, $email, $psw);
                if ($insert->affectedRows() == 1) {
                    echo '<div class="alert alert-success">Kayıt Oldunuz.</div>
                   ';
                } else {
                    echo '<div class="alert alert-danger">Kayıt Olurken Hata Oluştu</div>';
                }
            }
            ?>
            <div class="border-bottom"></div>
            <p class="lead">Bir hesap oluşturmak için lütfen bu formu doldurun.</p>
            <form action="signup.php" method="post">
                <div class="form-fields">
                    <input type="text" class="name input" name="fullname" id="fullname" placeholder="Name" required />
                    <input type="email" class="email input" name="email" id="email" placeholder="Email" required />
                    <input class="password input" type="password" placeholder="Enter Password" name="psw" id="psw"
                        required />

                    <input class="password2 input" type="password" placeholder="Repeat Password" name="psw-repeat"
                        id="psw-repeat" required />
                    <button type="submit" class="btn-dark">Üye Ol</button>
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