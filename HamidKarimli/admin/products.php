<?php
/**
 * Bu sayfa yönetici ürünler sayfasıdır ve yönetici ürünleri buradan kontrol eder.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once './layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
<!-- Burası yönetici anasayfa içeriği -->
<main class = "admin">
    <div class="left">
        <?php require_once './layout/sidebar.php' ?> <!-- Burada sidebar.php dosyasını çağırdık. -->
    </div>

    <!-- Ürünler -->
    <div class="right">
        <div class="container">
            <!-- Ürün Giriş -->
            <h1>Ürünler</h1>
            <div class="hr"></div>
            <div class="alert">
                <p class = "icon-p">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Bu sayfadan tüm ürünleri ayrıntılı bir şekilde görüntüleyebilir, düzenleyebilir, silebilir ve yenisini ekleyebilirsiniz.
                    <span id="closeModal" class="close" onclick="closeAlert()">&times;</span>
                </p>
            </div>
            <!-- Ürün Giriş bitti -->

            <!-- Ürün Ekle Butonu -->
            <button class = "icon-button icon-button-left" onclick="openForm('add-product')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                Ekle
            </button>
            <!-- Ürün Ekle Butonu bitti -->

            <div class="content">
                <!-- Ürün Tablo -->
                <table>
                    <thead>
                        <tr>
                            <th>Ürün</th>
                            <th>Birim Fiyat ($)</th>
                            <th>Stok Miktarı</th>
                            <th>Eklenme Tarihi</th>
                            <th>Ürün Fotoğraf</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- Ürün Tablo bitti -->

                <!-- Ürün Ekleme Form -->
                <div class="form-container" id="add-product" style="display:none">
                    <div class="form">
                        <h2 style="margin-bottom:10px">Ürün Ekle</h2>
                        <div class="hr"></div>
                        <form action="../connector/Connector.php" method="POST" enctype="multipart/form-data">
                            <div class = "form-group">
                                <label for="name">Ürün Adı</label>
                                <input type="text" id="name" name="name" placeholder="Nike Air Max 1" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Fiyat</label>
                                <input type="number" min="1" id="price" name="price" placeholder="250" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Adet</label>
                                <input type="number" min="1" id="quantity" name="quantity" placeholder="25" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Ürün Fotoğraf</label>
                                <input type="file" id="photo" name="photo" required>
                            </div>
                            <input type="hidden" name="action" value="addProduct">
                            <div class="form-group">
                                <button type="submit">Oluştur</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Ürün Ekleme Form bitti -->

                <!-- Ürün Düzenle Form -->
                <div class="form-container" id="edit-product" style="display:none">
                    <div class="form">
                        <h2 style="margin-bottom:10px">Ürün Düzenle</h2>
                        <div class="hr"></div>
                        <form action="../connector/Connector.php" method="POST" enctype="multipart/form-data">
                            <div class = "form-group">
                                <label for="name">Ürün Adı</label>
                                <input type="text" id="name" name="name" class = "fillable-input" placeholder="Nike Air Max 1">
                            </div>
                            <div class="form-group">
                                <label for="price">Fiyat</label>
                                <input type="number" id="price" min="1" name="price" class = "fillable-input" placeholder="250">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Adet</label>
                                <input type="number" id="quantity" min="1" name="quantity" class = "fillable-input" placeholder="25">
                            </div>
                            <div class="form-group">
                                <label for="photo">Ürün Fotoğraf</label>
                                <input type="file" id="photo" name="photo">
                            </div>
                            <input type="hidden" name="action" value="updateProduct">
                            <input type="hidden" name="id" class = "fillable-input" value="">
                            <div class="form-group">
                                <button type="submit">Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Ürün Düzenle Form bitti -->

                <!-- Ürün Sil Modal -->
                <div class="modal" id="delete-product" style="display:none">
                    <div class="modal-content">
                        <h3>Ürünü Silmek İstediğinize Emin Misiniz?</h3>
                        <p>Bu işlem geri alınamaz</p>
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('delete-product')">Kapat</button>
                            <a href = "#" id="confirmButton" class = "button-danger">Evet</a>
                        </div>
                    </div>
                </div>
                <!-- Ürün Sil Modal bitti -->

                <!-- Ürün Fotoğraf Modal -->
                <div class="modal" id="show-photo" style="display:none">
                    <div class="modal-content">
                        <h3>Ürün Fotoğrafı</h3>
                        <img src="" alt="" id="product-photo" width="100%">
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('show-photo')">Kapat</button>
                        </div>
                    </div>
                </div>
                <!-- Ürün Fotoğraf Modal bitti -->
            </div>
        </div>
    </div>
    <!-- Ürün bitti -->
</main>
<!-- Burada yönetici anasayfa içeriği bitti -->

<!-- JS -->
<script src="../public/js/modal.js"></script>
<script src="../public/js/form.js"></script>
<script src="../public/js/alert.js"></script>

<script>
    /* Burada tüm ürünleri connector dan fetch ile çekip tabloya ekliyoruz */
    fetch('../connector/Connector.php?action=getAllProducts')
        .then(response => response.json())
        .then(data => {
            let table = document.querySelector('table tbody');
            table.innerHTML = '';
            data.forEach(product => {
                table.innerHTML += `
                       <tr>
                           <td>${product.name}</td>
                           <td>${product.price}</td>
                           <td>${product.quantity}</td>
                           <td>${product.created_date}</td>
                           <td>
                                <button class = "icon-button" onclick="openModal('show-photo', '../public/img/products/${product.photo}', 'product-photo')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                      <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                      <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                    </svg>
                                    Göster
                                </button>
                           </td>
                           <td class = "button-td">
                                <button class = "icon-button icon-edit" type="button" onclick="openForm('edit-product', '${product.name}', '${product.price}', '${product.quantity}', '${product.id}')">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                   </svg>
                                   Düzenle
                               </button>
                               <button class = "icon-button icon-delete" type="button" onclick="openModal('delete-product', '../connector/Connector.php?action=deleteProduct&id=${product.id}')">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                       <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                   </svg>
                                   Sil
                               </button>
                           </td>
                       </tr>
                   `;
            });
        });
</script>

</body>
</html>
