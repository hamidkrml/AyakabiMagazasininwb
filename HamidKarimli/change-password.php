<?php
/**
 * Bu sayfa kullanıcının parolasını değiştirdiği sayfadır.
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
                <h1>Parola Değiştir</h1>
                <form action="./connector/Connector.php" method="POST">
                    <div class="form-group">
                        <label for="current-password">Mevcut Parola</label>
                        <input type="password" id="current-password" name="current-password" autocomplete="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Yeni Parola</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Parola Doğrula</label>
                        <input type="password" id="password-confirm" name="password-confirm" autocomplete="new-password" required>
                    </div>
                    <input type="hidden" name="action" value="changePassword">
                    <div class="form-group">
                        <button type="submit">Değiştir</button>
                    </div>
                </form>
            </div>
            <!-- Giriş formu bitti -->
        </div>
    </main>
</div>
<!-- Burada giriş sayfası içeriği bitti -->
</body>
</html>