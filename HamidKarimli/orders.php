<?php
/**
 * Bu sayfa projenin anasayfasıdır ve ürünler burada listelenir. Kullanıcılar satın alma işlemlerini bu sayfadan yaparlar.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once 'layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
<?php require_once 'layout/navbar.php' ?> <!-- Burada navbar.php dosyasını çağırdık. -->

<!-- Burası anasayfa içeriği -->
<div class="container">
    <main>
        <!-- Ürün Listesi -->

        <!-- Ürün Listesi bitti -->
    </main>
</div>
<!-- Burada anasayfa içeriği bitti -->

<script>
    getAllOrders();

    /* Burada ürün detayını modalda göstermek için ürün id sine göre ürünü çekiyoruz */
    async function getDetail(detail_id){
        try {
            const response = await fetch("./connector/Connector.php?action=getProduct&id=" + detail_id);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error(error);
            throw error;
        }
    }

    async function getAllOrders(){
        // Burada fetch ile connector'a istek atıyoruz ve gelen verileri json formatına çeviriyoruz
        const response = await fetch('./connector/Connector.php?action=getOrdersOfUser');
        const data = await response.json();

        // Burada gelen verileri döngü ile dönüyoruz ve ürün bilgilerini ekrana yazdırıyoruz.
        const main = document.querySelector('main');
        main.innerHTML = '';
        for(let product of data){
            // Ürün bilgilerini çekiyoruz
            let productDetail = await getDetail(product.product_id);
            let formatted_date = product.created_date.toString().replace(/-/g, "/").substring(0, 16);
            main.innerHTML += `
                       <div class="product-card">
                        <img src="public/img/products/${productDetail.photo}" alt="${productDetail.name} Photo">
                        <div class="product-info">
                            <div class = "product-name">
                                <h3>${productDetail.name}</h3>
                            </div>
                            <p class="price">$ ${product.price}</p>
                        </div>
                        <div class="product-footer">
                            ${formatted_date}
                        </div>
                    </div>
                   `;
        }
    }
</script>
</body>
</html>
