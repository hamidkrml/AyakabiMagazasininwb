<?php
/**
 * Bu sınıf, kullanıcı kayıt işlemlerini gerçekleştirir.
 */

require_once __DIR__.'/DatabaseController.php'; // Veritabanı işlemlerini gerçekleştiren sınıfı çağırır.

class AuthController{
    /**
     * Kullanıcı kayıt işlemini gerçekleştirir.
     */
    static function register($name, $surname, $phone, $email, $password, $password_confirm): never
    {
        $db = DatabaseController::getInstance();

        // Eğer şifreler uyuşmuyorsa kullanıcıyı kayıt sayfasına yönlendirir.
        if($password != $password_confirm){
            header("Location: ../register.php?error=1");
        }

        // Eğer e-posta daha önce alınmışsa kullanıcıyı kayıt sayfasına yönlendirir.
        $result = $db->getUserByEmail($email);
        if($result){
            header("Location: ../register.php?error=2");
            exit;
        }

        // Kullanıcıyı veritabanına kaydeder.
        $db->insertUser($name, $surname, $phone, $email, $password);

        // Kullanıcıyı oturum açmış olarak işaretler.
        $_SESSION['user_id'] = $db->getUserByEmail($email)['id'];
        $_SESSION['is_logged_in'] = true;
        $_SESSION['login_type'] = "user";
        header("Location: ../index.php");
        exit;
    }

    /**
     * Kullanıcı/Yönetici giriş işlemini gerçekleştirir.
     */
    static function login($username, $password, $type = "user"): never
    {
        $db = DatabaseController::getInstance();

        $user = ($type == "user") ? $db->getUserByEmail($username) : $db->getAdminByUsername($username);

        if ($user && $password === $user['password']) {
            // Kullanıcı adı ve şifre doğrulandı
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['login_type'] = $type;

            // Yönlendir
            ($type == "user") ? header("Location: ../index.php") : header("Location: ../admin/index.php");

        } else {
            ($type == "user") ? header("Location: ../login.php?error=3") : header("Location: ../admin/login.php?error=3");
        }
        exit;
    }

    /**
     * Kullanıcıyı oturumdan çıkartır.
     */
    static function logout(): never
    {
        $page = ($_SESSION['login_type'] == "user") ? "../login.php" : "../admin/login.php";
        unset($_SESSION['user_id']);
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['login_type']);
        header("Location: $page");
        exit;
    }

    /**
     * Kullanıcının şifresini değiştirir.
     */
    static function changePassword($current_password, $password, $password_confirm): never
    {
        $db = DatabaseController::getInstance();

        // Eğer şifreler uyuşmuyorsa hata göster.
        if($password != $password_confirm){
            header("Location: ../change-password.php?error=1");
        }

        // Eğer şifre doğru değilse hata göster.
        $user = $db->getUserById($_SESSION['user_id']);
        if($current_password != $user['password']){
            header("Location: ../change-password.php?error=3");
            exit;
        }

        // Eğer mevcut şifre ile yeni şifre aynıysa hata göster.
        if($current_password == $password){
            header("Location: ../change-password.php?error=4");
            exit;
        }

        // Kullanıcının şifresini günceller.
        $db->updatePassword($password);

        // Kullanıcıyı oturumdan çıkartır.
        AuthController::logout();
    }
}

?>