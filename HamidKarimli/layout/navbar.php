<?php
/**
 * Bu sayfa uygulamanın navbar kısmıdır. Bu sayfa tüm sayfalarda kullanılır.
 */
session_start();
if((!isset($_SESSION['login_type']) || $_SESSION['login_type'] != "user") && !str_contains($_SERVER['PHP_SELF'], "index.php"))
    header('Location: ./login.php');
?>

<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php" class = "page-item">Ürünler</a></li>
                <li><a href="#">|</a></li>
                <?php
                    // Eğer kullanıcı giriş yapmışsa ve kullanıcı tipi user ise çıkış linki gösterilir.
                    if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] && $_SESSION['login_type'] == 'user'){
                        echo '<li><a href="profile.php" class = "page-item">Profil</a></li>&nbsp;';
                        echo '<li><a href="orders.php" class = "page-item">Siparişler</a></li>&nbsp;';
                        echo '<li><a href="./connector/Connector.php?action=logout" class = "page-item">Çıkış</a></li>';
                    }else{ // Eğer kullanıcı giriş yapmamışsa giriş ve kayıt linkleri gösterilir.
                        echo '<li><a href="login.php" class = "page-item">Giriş</a></li>&nbsp;';
                        echo '<li><a href="register.php" class = "page-item">Kayıt</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>
