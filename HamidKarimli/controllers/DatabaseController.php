<?php
/**
 * Bu sayfa veritabanı işlemlerini yapabilen Database sınıfını içerir.
 */

require_once '../config/Config.php'; // Veritabanı ayarlarını içeren dosyayı çağırır.

class DatabaseController
{
    private static $instance;
    private $connection;
    private $statement;

    /**
     * Constructor/Olusturucu
     */
    private function __construct()
    {
        $dsn = "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        try {
            $this->connection = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'), $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * @public
     * Singleton tasarım deseni
     * @return DatabaseController
     */
    public static function getInstance(): DatabaseController
    {

        if (self::$instance === null) {
            self::$instance = new DatabaseController();
        }
        return self::$instance;
    }

    /**
     * Yeni kullanıcı ekler
     */
    public function insertUser($name, $surname, $phone, $email, $password): void
    {
        $this->statement = $this->connection->prepare("CALL insertUser(:name, :surname, :phone, :email, :password)");
        $this->statement->bindParam(':name', $name);
        $this->statement->bindParam(':surname', $surname);
        $this->statement->bindParam(':phone', $phone);
        $this->statement->bindParam(':email', $email);
        $this->statement->bindParam(':password', $password);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Mail adresine göre kullanıcı bilgilerini getirir
     */
    public function getUserByEmail($email): array|bool
    {
        $this->statement = $this->connection->prepare("CALL getUserByEmail(:userEmail)");
        $this->statement->bindParam(':userEmail', $email);
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Kullanıcı idsine göre kullanıcı bilgilerini getirir
     */
    public function getUserById($id): array|bool
    {
        $this->statement = $this->connection->prepare("CALL getUserById(:userId)");
        $this->statement->bindParam(':userId', $id);
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Tüm kullanıcıları getirir
     */
    public function getAllUsers(): array
    {
        $this->statement = $this->connection->prepare("CALL getAllUsers()");
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Kullanıcı adına göre yönetici bilgilerini getirir
     */
    public function getAdminByUsername($username): array|bool
    {
        $this->statement = $this->connection->prepare("CALL getAdminByUsername(:username)");
        $this->statement->bindParam(':username', $username);
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Kullanıcı profilini günceller
     */
    public function updateProfile($name, $surname, $phone, $email): void
    {
        // Kullanıcı bilgilerini alır
        $user = $this->getUserById($_SESSION['user_id']);

        // Kullanıcı bilgilerini günceller
        $this->statement = $this->connection->prepare("CALL updateProfile(:id, :name, :surname, :phone, :email)");
        $this->statement->bindValue(':id', $_SESSION['user_id']);
        $this->statement->bindValue(':name', $name ?: $user['name']);
        $this->statement->bindValue(':surname', $surname ?: $user['surname']);
        $this->statement->bindValue(':phone', $phone ?: $user['phone']);
        $this->statement->bindValue(':email', $email ?: $user['email']);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Kullanıcı şifresini günceller
     */
    public function updatePassword($password): void
    {
        // Kullanıcı şifresini günceller
        $this->statement = $this->connection->prepare("CALL updatePassword(:id, :password)");
        $this->statement->bindValue(':id', $_SESSION['user_id']);
        $this->statement->bindValue(':password', $password);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Kullanıcıyı siler
     */
    public function deleteUser($id): void
    {
        $this->statement = $this->connection->prepare("CALL deleteUser(:id)");
        $this->statement->bindParam(':id', $id);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Tüm ürünleri çeker
     */
    public function getAllProducts(): array
    {
        $this->statement = $this->connection->prepare("CALL getAllProducts()");
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Ürün ekle
     */
    public function insertProduct($name, $price, $quantity, $image): void
    {
        $this->statement = $this->connection->prepare("CALL insertProduct(:name, :price, :quantity, :photo)");
        $this->statement->bindValue(':name', $name);
        $this->statement->bindValue(':price', $price);
        $this->statement->bindValue(':quantity', $quantity);
        $this->statement->bindValue(':photo', $image);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Ürün idsine göre ürün bilgilerini getirir
     */
    public function getProductById($id): array|bool
    {
        $this->statement = $this->connection->prepare("CALL getProductById(:productId)");
        $this->statement->bindParam(':productId', $id);
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Ürün güncelle
     */
    public function updateProduct($id, $name, $price, $quantity, $image): void
    {
        // Kullanıcı bilgilerini alır
        $product = $this->getProductById($id);

        // Kullanıcı bilgilerini günceller
        $this->statement = $this->connection->prepare("CALL updateProduct(:id, :name, :price, :quantity, :photo)");
        $this->statement->bindValue(':id', $id);
        $this->statement->bindValue(':name', $name ?: $product['name']);
        $this->statement->bindValue(':price', $price == null ? $price : $product['price']);
        $this->statement->bindValue(':quantity', $quantity == null ? $quantity : $product['quantity']);
        $this->statement->bindValue(':photo', $image ?: $product['photo']);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Ürünü siler
     */
    public function deleteProduct($id): void
    {
        $this->statement = $this->connection->prepare("CALL deleteProduct(:id)");
        $this->statement->bindParam(':id', $id);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Stoktaki ürünleri çeker
     */
    public function getAllProductsInStock(): array
    {
        $this->statement = $this->connection->prepare("CALL getAllProductsInStock()");
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Satış ekler
     */
    public function insertSale($user_id, $product_id, $price, $quantity, $payment_method, $city, $district, $address): void
    {
        $this->statement = $this->connection->prepare("CALL insertSale(:user_id, :product_id, :price, :quantity, :payment_method, :city, :district, :address)");
        $this->statement->bindValue(':user_id', $user_id);
        $this->statement->bindValue(':product_id', $product_id);
        $this->statement->bindValue(':price', $price);
        $this->statement->bindValue(':quantity', $quantity);
        $this->statement->bindValue(':payment_method', $payment_method);
        $this->statement->bindValue(':city', $city);
        $this->statement->bindValue(':district', $district);
        $this->statement->bindValue(':address', $address);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Satışları çeker
     */
    public function getAllSales(): array
    {
        $this->statement = $this->connection->prepare("CALL getAllSales()");
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Satış siler
     */
    public function deleteSale($id): void
    {
        $this->statement = $this->connection->prepare("CALL deleteSale(:id)");
        $this->statement->bindParam(':id', $id);
        $this->statement->execute();
        $this->statement->closeCursor();
    }

    /**
     * Kullanıcının bilgilerini parola olmadan getir.
     */
    public function getUserWithoutPasswordById($id): array|bool
    {
        $this->statement = $this->connection->prepare("CALL getUserWithoutPasswordById(:id)");
        $this->statement->bindParam(':id', $id);
        $this->statement->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }

    /**
     * Kullanıcı siparişlerini çeker
     */
    public function getOrdersOfUser($id): array
    {
        $this->statement = $this->connection->prepare("CALL getOrdersOfUser(:id)");
        $this->statement->bindParam(':id', $id);
        $this->statement->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        $this->statement->closeCursor();
        return $result;
    }
}
?>
