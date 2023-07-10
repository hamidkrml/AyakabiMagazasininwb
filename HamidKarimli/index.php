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
        /* Burada fetch ile connector dan tüm ürünleri çekip sayfaya ekleyeceğiz */
        fetch("./connector/Connector.php?action=getAllProductsInStock")
            .then(response => response.json())
            .then(data => {
                let main = document.querySelector('main');
                main.innerHTML = '';
                data.forEach(product => {
                    main.innerHTML += `
                       <div class="product-card">
                        <img src="public/img/products/${product.photo}" alt="${product.name} Photo">
                        <div class="product-info">
                            <div class = "product-name">
                                <h3>${product.name}</h3>
                                <p class="price">$ ${product.price}</p>
                            </div>
                            <a class="buy-button" href = "./product.php?id=${product.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                   `;
                });
            });
    </script>
</body>
</html>
