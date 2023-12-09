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
        content="Kitaplar.in kitap üzerine bir sosyal paylaşım sitesidir. Kitaplarınızı sitemize ekleyerek değerlendirebilir, kitap takas talebi ile kitaplarınızı paylaşabilirsiniz." />
    <meta name="keywords"
        content="kitap takas sitesi, kitap paylaşım, kitap değerlendirme, kitap özetleri, kitap takas sistemi, kitap takas etme, kitap paylaşımı, kitap eleştirileri, okunulan kitapları paylaşma, kitap yorumları, kitap puanları, 2.el kitap" />
    <meta name="viewport" content="width=device-width">
    <link href='http://fonts.googleapis.com/css?family=Signika:400,300,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
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
                        echo ' 
                        <li><a href="index.php?islem=cikis_yap" >Çıkış Yap</a></li>
                    <li><a href="gelen_mesaj.php">Mesajlar</a></li>';
                    }
                    ?>
                    <li><a href="kitap_ekle.php" class="active">Kitap Ekle</a></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">Hakkında</a></li>
                    <li><a href="projects.php">Kitaplar</a></li>
                    <li><a href="contact.html">İletişim</a></li>
                    <li><a href="http://localhost:8501">ÖNERİ</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <!-- ========= END HEADER =========== -->
    <div class="container icerikler">

        <div class=" home__a" role="main">
            <div class="contact">

                <div class="">&nbsp;</div>
                <!-- clear -->

                <section class="" style="">
                    <div class="kitap_ekle">
                        <?php
                        include 'db.php';
                        $db = new db();
                        if (!isset($_SESSION['id'])) {
                            echo '<div class="alert alert-warning">Kitap eklemek için üye olmanız veya giriş yapmanız gerekmektedir.</div>';
                        } else {
                            if (isset($_POST['kitap_adi']) && isset($_POST['yayin_evi'])) {
                                $kitap_adi = $_POST['kitap_adi'];
                                $yayin_evi = $_POST['yayin_evi'];

                                // Diğer form verilerini almak için gerekli kodları buraya ekleyebilirsiniz
                        
                                if (empty($kitap_adi) || empty($yayin_evi)) {
                                    echo '<div class="alert alert-warning">Lütfen aşağıdaki boş alanları doldurunuz.</div>';
                                } else {
                                    $yazar_adi = $_POST['yazar_adi'];
                                    $alim_yer = $_POST['alim_yer'];
                                    $kitap_kategori = $_POST['kitap_kategori'];
                                    $durum = $_POST['durum'];
                                    $kitap_ozet = $_POST['kitap_ozet'];

                                    $insert = $db->query('INSERT INTO kitaplar (kitap_adi, yayinevi, yazar, yer, kategori, durum, ozet, ekleyenID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', $kitap_adi, $yayin_evi, $yazar_adi, $alim_yer, $kitap_kategori, $durum, $kitap_ozet, $_SESSION['id']);

                                    if ($insert->affectedRows() == 1) {
                                        echo '<div class="alert alert-success">Kitap Eklendi.</div>';
                                    } else {
                                        echo '<div class="alert alert-danger">Kitap Eklenirken Hata Oluştu</div>';
                                    }
                                }
                            }
                        }
                        // if (isset($_POST['kitap_adi'])) {
                        //     $kitap_adi = $_POST['kitap_adi'];
                        //     $yayin_evi = $_POST['yayin_evi'];
                        //     $yazar_adi = $_POST['yazar_adi'];
                        //     $alim_yer = $_POST['alim_yer'];
                        //     $kitap_kategori = $_POST['kitap_kategori'];
                        //     $durum = $_POST['durum'];
                        //     $kitap_ozet = $_POST['kitap_ozet'];
                        //     $insert = $db->query('INSERT INTO kitaplar (kitap_adi,yayinevi,yazar,yer,kategori,durum,ozet,ekleyenID) VALUES (?,?,?,?,?,?,?,?)', $kitap_adi, $yayin_evi, $yazar_adi, $alim_yer, $kitap_kategori, $durum, $kitap_ozet, $_SESSION['id']);
                        //     if ($insert->affectedRows() == 1) {
                        //         echo '<div class="alert alert-success">Kitap Eklendi.</div>';
                        //     } else {
                        //         echo '<div class="alert alert-danger">Kitap Eklenirken Hata Oluştu</div>';
                        //     }
                        // }
                        ?>
                        <form class="icerikform" method="post" action="kitap_ekle.php">

                            <p>Kitap Adı<i>*</i></p>
                            <p><input placeholder="Lütfen doğru kitap adi giriniz" type="text" name="kitap_adi"></p>

                            <p>Yayin Evi<i>*</i></p>
                            <p><input placeholder="Lütfen doğru yayinevi adi giriniz" type="text" name="yayin_evi"></p>

                            <p>Yazar Adı<i>*</i></p>
                            <p><input placeholder="Lütfen doğru yayinevi adi giriniz" type="text" name="yazar_adi"></p>

                            <p>Alinabilecek Yerler<i>*</i></p>
                            <p>

                            <p><input type="text" name="alim_yer" placeholder="Yer Adi yada Site Adi"></p>
                            </p>

                            <!-- <p>Etiketler <span>(Etiketleri " , " ile ayırabilirsiniz)</span><i>*</i></p>
            <p><input type="text" name="kitap_etiket"><div class="input_etiketler"></div></p> -->

                            <p style="margin-top: 30px;">Kategori<i>*</i></p>
                            <p><select name="kitap_kategori">
                                    <option value="242">Popüler Bilim</option>
                                    <option value="240">Biyografi</option>
                                    <option value="238">Aile ve Çocuk</option>
                                    <option value="237">Deneme</option>
                                    <option value="236">Söyleşi-Biyografi-Anı</option>
                                    <option value="231">Eğitim</option>
                                    <option value="225">Internet</option>
                                    <option value="222">Doğa&#252;st&#252;-Gizem</option>
                                    <option value="221">R&#252;ya-Fal-Tarot</option>
                                    <option value="220">Bur&#231;lar</option>
                                    <option value="219">Astroloji, Fal</option>
                                    <option value="204">&#214;zel İlgiler - Hobi</option>
                                    <option value="193">Bilgisayar</option>
                                    <option value="182">Şifalı Bitkiler</option>
                                    <option value="176">Sağlık</option>
                                    <option value="172">Kişisel Gelişim</option>
                                    <option value="166">İş D&#252;nyası</option>
                                    <option value="143">Sanat Tarihi</option>
                                    <option value="135">Politika - T&#252;rkiye</option>
                                    <option value="117">Sosyoloji</option>
                                    <option value="116">Psikanaliz</option>
                                    <option value="114">Psikoloji</option>
                                    <option value="106">Felsefe</option>
                                    <option value="102">Hukuk</option>
                                    <option value="99">Dil /Yabancı Dil</option>
                                    <option value="93">Din / Mitoloji</option>
                                    <option value="92">Tasavvuf</option>
                                    <option value="75">Tarih</option>
                                    <option value="58">Şiir</option>
                                    <option value="55">Aşk Romanları</option>
                                    <option value="54">Macera</option>
                                    <option value="53">Bilimkurgu</option>
                                    <option value="51">Savaş</option>
                                    <option value="50">Fantastik</option>
                                    <option value="49">Mizah</option>
                                    <option value="48">Tarihsel Roman</option>
                                    <option value="47">Korku</option>
                                    <option value="46">Polisiye</option>
                                    <option value="45">Roman &#214;yk&#252;</option>
                                    <option value="23">Sınavlara Hazırlık</option>
                                    <option value="8">Beslenme-Diyet</option>
                                    <option value="3">Çocuk</option>
                                    <option value="2">Çizgi Roman</option>
                                </select></p>
                            <p>Durum <span>(Takas yada bağışlamak istiyorsanız seçim yapınız)</span><i>*</i></p>
                            <p><select name="durum">
                                    <option value="1">Sadece Eklemek İstiyorum</option>
                                    <option value="2">Bağışlalamak İstiyorum</option>
                                    <option value="3">Takas Etmek İstiyorum</option>
                                </select></p>


                            <p>Kitap Özeti <span>(Okuduktan sonra aklınızda kalanlar)</span><i>*</i></p>
                            <p><textarea name="kitap_ozet"></textarea></p>


                            <p><button type="submit" class="button">Kitap Ekle</button></p>
                        </form>

                    </div>
                </section>

                <div class="">&nbsp;</div>
                <!-- clear -->
            </div>
            <!-- container -->
        </div>

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-3 text-center">
                    <div class="icerikler1">
                        <h2>Öne Çıkanlar</h2>

                        <ul class="">
                            <li><a href="http://kitaplar.in/kategori/roman-214-yk-252.html">Roman &#214;yk&#252;</a>
                            </li>
                            <li><a href="#">Kişisel Gelişim</a></li>
                            <li><a href="#">Tarih</a></li>
                            <li><a href="#">Şiir</a></li>
                            <li><a href="#">Deneme</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-3 ">
                    <div class="icerikler2">
                        <h2>Kitaplar Keşfet</h2>

                        <ul class="">
                            <li><a href="index.php">Anasayfa</a></li>
                            <li><a href="#" Rel=”external”>Hakkımızda</a></li>
                            <li><a href="#" Rel=”external”>SSS</a></li>
                            <li><a href="#" Rel=”external”>Takas Sistemi</a></li>
                            <li><a href="contact.html">İletişim</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-3 ">
                    <div class="icerikler3">
                        <h2>Kitaplar Oku</h2>

                        <ul class="">
                            <li><a href="#">Kitaplar</a></li>
                            <li><a href="#">Takastakiler</a></li>
                            <li><a href="#" Rel=”external”>Kargo Gönderimi</a>
                            </li>
                            <li><a href="#">Üyeler</a></li>
                            <li><a href="">Grup Kurma</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-3 ">
                    <div class="icerikler4">
                        <h2>Kitaplar.in Paylaş</h2>

                        <ul class="">
                            <li><a href="">Gizlilik Sözleşmesi</a></li>
                            <li><a href="#" Rel=”external”>Kullanım
                                    Sözleşmesi</a></li>
                            <li><a href="#" Rel=”external”>Üyelik
                                    Sözleşmesi</a></li>
                            <li><a href="#" Rel=”external”>Yardım</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <article class="">
            <br>
            <ul class="">
                <li class="facebook">
                    <a href="http://www.facebook.com/kitaplarin" Rel=”external”></a>
                </li>
                <li class="twitter">
                    <a href="https://twitter.com/Kitaplarin" Rel=”external”></a>
                </li>
                <li class="pinterest">
                    <a href="http://www.pinterest.com/kitaplar/" Rel=”external”></a>
                </li>
            </ul>
        </article>

        <div class="">&nbsp;</div>

        </ul>

        </div>

        </div>

    </footer>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

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