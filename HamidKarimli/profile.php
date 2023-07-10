<?php
/**
 * Bu sayfa kullanıcının profilini düzenlediği sayfadır.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once 'layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
<?php require_once 'layout/navbar.php' ?> <!-- Burada navbar.php dosyasını çağırdık. -->

<!-- Burası giriş sayfası içeriği -->
<div class="container">
    <main class = "form-main">
        <!-- Hata mesajı varsa göster -->
        <?php include 'layout/error.php'; ?>

        <div class="form-container" style="width:auto;height:auto;padding:40px 0px 20px 0px">
            <!-- Giriş formu -->
            <div class="form" style="width:100%">
                <h1>Profil Düzenle</h1>
                <form action="./connector/Connector.php" method="POST">
                    <div class="form-group form-inline">
                        <div class = "form-normal">
                            <label for="name">İsim</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div class = "form-normal">
                            <label for="surname">Soyisim</label>
                            <input type="text" id="surname" name="surname">
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-Posta</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <input type="hidden" name="action" value="updateProfile">
                    <div class="form-group">
                        <button type="submit">Güncelle</button>
                    </div>
                    <div class = "form-text">
                        <span><a href="change-password.php" class = "register-link">Parola değiştir</a></span>
                    </div>
                </form>
            </div>
            <!-- Giriş formu bitti -->
        </div>
    </main>
</div>
<!-- Burada giriş sayfası içeriği bitti -->

<script>
    // Burada fetch ile connector/Connector.php dosyasına istek atıyoruz ve dönen veriyi json olarak alıyoruz.
    // Daha sonra gelen veri ile profil sayfasındaki bilgileri dolduruyoruz.
    fetch('./connector/Connector.php?action=getProfile')
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('surname').value = data.surname;
            document.getElementById('phone').value = data.phone;
            document.getElementById('email').value = data.email;
        });
</script>
</body>
</html>