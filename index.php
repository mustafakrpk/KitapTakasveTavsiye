<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <title>kitap</title>
</head>

<body>

    <!-- header -->
    <header id="header__home">
        <div class="container">
            <nav class="main-nav">

                <ul class="main-nav__items">

                    <?php
                    session_start();

                    if (!empty($_GET["islem"])) {
                        session_destroy();
                    }
                    if (!isset($_SESSION['id'])) {
                        echo ' 
                        <li><a href="signup.php">Üye Ol</a></li>
                        <li><a href="login.php">Giriş Yap</a></li>';
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
                    <li><a href="gelen_mesaj.php"> Mesajlar</a></li>';
                    }
                    ?>
                    <!-- <li><a href="kitap_ekle.php">Kitap Ekle</a></li> -->
                    <li><a href="index.php" class="active">anasayfa</a></li>
                    <li><a href="about.html">hakkında</a></li>

                    <li><a href="projects.php">Kitaplar</a></li>
                    <!-- <li><a href="mesajlas.php">mesajlar</a></li> -->
                    <li><a href="http://localhost:8501">ÖNERİ</a></li>
                    <li><a href="contact.html">İletişim</a></li>

                </ul>
            </nav>
            <div class="header-content">
                <h1>
                    KİTAP TAKAS ve ÖNERİ SİTESİ
                    <span class="typewrite" data-period="1000" data-type='["Oku","Paylaş",""]'></span>
                </h1>
                <a href="#home__a" class="btn-light animate__animated animate__swing my-2">
                    Biz Ne Yapıyoruz
                </a>
                <!-- <div class="arama">
                    <form action="" method="get">
                        <input type="hidden" name="par" value="kitaplar" />
                        <input type="text" value="" id="ara" placeholder="Bir şeyler ara.." />
                    </form>
                </div> -->
            </div>
        </div>
    </header>
    <!-- section a -->
    <section id="home__a" class="text-center py-2">
        <!-- <form name="update2" method="post">
            <button name="update2" type="submit"> Update charts </button> 
        </form> -->
        <div class="container">
            <h2 class="section-title">Bİz Ne Yapıyoruz ?</h2>
            <div class="border-bottom"></div>
            <p class="lead">
                Kitap severlerin bir araya geldiği bir topluluk oluşturuyoruz.

                Okuduğunuz kitapları takas ederek hem kütüphanenizi genişletin hem de diğer okurların farklı kitapları
                keşfetmelerine yardımcı olun.
                Kitap öneri sistemi sayesinde size uygun kitapları öneriyoruz ve bu sayede okuma deneyiminizi
                zenginleştiriyoruz.
                Herkesin birbirine saygılı ve anlayışlı bir şekilde davranması için kurallarımız bulunuyor ve bu
                kurallara uyulmasını sağlıyoruz.
                Kitap severler arasında iletişimi artırmak için etkinlikler düzenliyoruz ve bu etkinliklere katılımınızı
                bekliyoruz.
                Sitemizde yer alan kitaplar, okurlar tarafından oylanıyor ve yorumlanıyor. Bu sayede daha fazla okurun
                fikirlerini öğrenebiliyor ve okuma listenizi oluştururken daha doğru kararlar verebiliyorsunuz.
            </p>

    </section>

    <!-- section b -->
    <section id="home__b" class="text-center py-2">
        <div class="container">
            <h2 class="section-title">İstatistikler</h2>
            <div class="border-bottom"></div>
            <p class="lead">

            </p>
        </div>
        <?php
        // Veritabanı bağlantısı yapılacak bilgiler
        $servername = "localhost";
        $username = "kullanici_adi";
        $password = "sifre";
        $dbname = "kitap";

        // Veritabanı bağlantısı oluşturma
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Hata kontrolü
        if ($conn->connect_error) {
            die("Veritabanına bağlanılamadı: " . $conn->connect_error);
        }

        // Kullanıcı sayısını almak için SQL sorgusu
        $sql = "SELECT COUNT(*) AS userCount FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userCount = $row["userCount"];
        } else {
            $userCount = 0;
        }
        // Kitap sayısını almak için SQL sorgusu
        $bookCountSql = "SELECT COUNT(*) AS bookCount FROM kitaplar";
        $bookCountResult = $conn->query($bookCountSql);

        if ($bookCountResult->num_rows > 0) {
            $bookCountRow = $bookCountResult->fetch_assoc();
            $bookCount = $bookCountRow["bookCount"];
        } else {
            $bookCount = 0;
        }

        $conn->close();
        ?>

        <div class="profile">
            <div>
                <ul>
                    <li><i class="fas fa-users fa-3x"></i></li>
                    <li class="title">Üyelerimiz</li>
                    <li class="number">
                        <?php echo $userCount; ?>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><i class="fa-duotone fa-books"></i></li>
                    <li class="title">Kitap Sayısı</li>
                    <li class="number">
                        <?php echo $bookCount; ?>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><i class="fa-solid fa-rotate fa-3x"></i></li>
                    <li class="title">Takastakiler</li>
                    <li class="number">4</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li><i class="fa-light fa-books fa-3x"></i></li>
                    <li class="title">Bağışlanan Kitaplar</li>
                    <li class="number">2</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- section c -->
    <section id="home__c" class="text-center py-2">
        <div class="container">
            <h2 class="section-title">Nasıl Çalışır</h2>
            <div class="border-bottom"></div>
            <p class="lead"></p>
            <div class="process">
                <div>
                    <i class="fa-solid fa-user fa-4x process__icon my-2">
                        <div class="process__step">1</div>
                    </i>
                    <h3>Adım 1</h3>
                    <p>Basit bir şekilde üye olun ve giriş yapın.</p>
                </div>
                <div>
                    <i class="fa-solid fa-eye fa-4x process__icon my-2">
                        <div class="process__step">2</div>
                    </i>
                    <h3>Adım 2</h3>
                    <p>
                        "Kitap ekle" bölümünden kendi kitaplarınızı ekleyebilirsiniz.
                    </p>
                </div>
                <div>
                    <i class="fas fa-object-ungroup fa-4x process__icon my-2">
                        <div class="process__step">3</div>
                    </i>
                    <h3>Adım 3</h3>
                    <p>
                        Eklediğiniz kitaplar, diğer
                        üyelerimiz tarafından görüntülenebilir ve size teklifler sunabilirler.Sizde farklı kitaplara
                        teklif yapabilirsiniz.
                    </p>
                </div>
                <div>
                    <i class="fas fa-file-alt fa-4x process__icon my-2">
                        <div class="process__step">4</div>
                    </i>
                    <h3>Adım 4</h3>
                    <p>
                        Öneri bölümünden okuduğunuz ya da merak ettiğiniz bir kitabı girip öneri alabilirsiniz.
                    </p>
                </div>
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
    <script src="js/type-writer.js"></script>
</body>

</html>