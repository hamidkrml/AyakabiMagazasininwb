<?php
/**
 * Bu sayfa da yöneticinin/kullanıcının ön yüzdeki işlemlerini okuyan ve gerekli işlemleri yapan sınıf bulunur.
 */

require_once "../controllers/AuthController.php";
require_once "../controllers/DatabaseController.php";

class Connector
{

    /**
     * Formlardan, butonlardan gelen action parametresine göre işlem yapar.
     */
    static function doAction(string $action, array $values=null, array $files=null): void
    {
        $db = DatabaseController::getInstance();

        switch ($action) {
            case "register": // Kullanıcı Kayıt İşlemi
                AuthController::register($values["name"], $values["surname"], $values["phone"], $values["email"], $values["password"], $values["password-confirm"]);
                break;
            case "login": // Kullanıcı Giriş İşlemi
                AuthController::login($values["email"], $values["password"]);
                break;
            case "logout": // Kullanıcı Çıkış İşlemi
                AuthController::logout();
                break;
            case "admin-login": // Yönetici Giriş İşlemi
                AuthController::login($values["username"], $values["password"], "admin");
                break;
            case "updateProfile": // Kullanıcı Profil Güncelleme İşlemi
                $db->updateProfile($values["name"], $values["surname"], $values["phone"], $values["email"]);

                // Kullanıcı bilgilerini güncelledikten sonra profil sayfasına yönlendirir.
                Header("Location: ../profile.php");
                exit;
                break;
            case "changePassword": // Kullanıcı Şifre Değiştirme İşlemi
                AuthController::changePassword($values["current-password"], $values["password"], $values["password-confirm"]);
                break;
            case "getProfile": // Kullanıcı Profil Bilgilerini Getirme İşlemi
                $result = $db->getUserById($_SESSION['user_id']);
                echo json_encode($result);
                break;
            case "getUserById": // Kullanıcı Bilgilerini ID'ye Göre Getirme İşlemi
                $result = $db->getUserById($values['id']);
                echo json_encode($result);
                break;
            case "getAllUsers": // Tüm Kullanıcıları Getirme İşlemi
                $result = $db->getAllUsers();
                echo json_encode($result);
                break;
            case "deleteUser": // Kullanıcı Silme İşlemi
                $db->deleteUser($values["id"]);

                // Kullanıcı bilgilerini güncelledikten sonra profil sayfasına yönlendirir.
                Header("Location: ../admin/index.php");
                exit;
                break;
            case "getAllProducts": // Tüm Ürünleri Getirme İşlemi
                $result = $db->getAllProducts();
                echo json_encode($result);
                break;
            case "getAllProductsInStock": // Tüm Ürünleri Stok Durumuna Göre Getirme İşlemi
                $result = $db->getAllProductsInStock();
                echo json_encode($result);
                break;
            case "addProduct": // Ürün Ekleme İşlemi
                // Dosya yükleme işlemi
                move_uploaded_file($files["photo"]["tmp_name"], "../public/img/products/" . $files["photo"]["name"]);

                // Ürünü veritabanına ekler
                $db->insertProduct($values["name"], $values["price"], $values["quantity"],  $files["photo"]["name"]);

                // Ürün eklendikten sonra ürünler sayfasına yönlendirir.
                Header("Location: ../admin/products.php");
                exit;
                break;
            case "updateProduct": // Ürün Güncelleme İşlemi
                // Dosya yükleme işlemi
                move_uploaded_file($files["photo"]["tmp_name"], "../public/img/products/" . $files["photo"]["name"]);

                // Ürünü veritabanında günceller
                $db->updateProduct($values["id"], $values["name"], $values["price"], $values["quantity"],  $files["photo"]["name"]);

                // Ürün güncellendikten sonra ürünler sayfasına yönlendirir.
                Header("Location: ../admin/products.php");
                exit;
                break;
            case "deleteProduct": // Ürün Silme İşlemi
                $db->deleteProduct($values["id"]);

                // Ürün silindikten sonra ürünler sayfasına yönlendirir.
                Header("Location: ../admin/products.php");
                exit;
                break;
            case "getProduct": // Ürün Bilgilerini Getirme İşlemi
                $result = $db->getProductById($values["id"]);
                echo json_encode($result);
                break;
            case "buyProduct": // Ürün Satın Alma İşlemi
                // Mevcut ürünü bul
                $product = $db->getProductById($values["productId"]);

                // Ödeme yöntemi
                $payment_method = $values["payment_method"] == "cash" ? "Nakit" : "Kredi Kartı";

                // Satış veritabanına eklenir
                $db->insertSale($_SESSION["user_id"], $values["productId"], $product["price"], 1, $payment_method, $values["city"], $values["district"], $values["address"]);

                $newQuantity = intval($product["quantity"]) - 1;

                // Satış işlemi gerçekleştikten sonra ürünün stok miktarı güncellenir.
                $db->updateProduct($values["productId"], $product["name"], $product["price"], $newQuantity, $product["photo"]);

                // Ürün satın alındıktan sonra siparişler sayfasına yönlendirir.
                Header("Location: ../orders.php");
                exit;
                break;
            case "getAllSales": // Tüm Satışları Getirme İşlemi
                $result = $db->getAllSales();
                echo json_encode($result);
                break;
            case "deleteSale": // Satış Silme İşlemi
                $db->deleteSale($values["id"]);

                // Satış silindikten sonra siparişler sayfasına yönlendirir.
                Header("Location: ../admin/sales.php");
                exit;
                break;
            case "getUserWithoutPasswordById": // Kullanıcı Bilgilerini ID'ye Göre Şifresiz Getirme İşlemi
                $result = $db->getUserWithoutPasswordById($values["id"]);
                echo json_encode($result);
                break;
            case "getOrdersOfUser": // Kullanıcını siparişlerini çekme işlemi
                $result = $db->getOrdersOfUser($_SESSION["user_id"]);
                echo json_encode($result);
                break;
            default: // Eğer action değeri yukarıdaki değerlerden biri değilse hata mesajı gösterir.
                echo "Action not found";
                break;
        }
    }
}

// Connector'a gelen istekleri kontrol eder ve gerekli işlemi gelen operasyon bilgisine ve verilerine göre çalıştırır.
if (isset($_GET['action'])){
    Connector::doAction($_GET['action'], $_GET);
}
else if (isset($_POST['action'])){
    if($_FILES)
        Connector::doAction($_POST['action'], $_POST, $_FILES);
    else
        Connector::doAction($_POST['action'], $_POST);
}

