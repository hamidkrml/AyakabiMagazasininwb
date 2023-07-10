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
            <!-- Satış Giriş -->
            <h1>Satışlar</h1>
            <div class="hr"></div>
            <div class="alert">
                <p class = "icon-p">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Bu sayfadan tüm satışları ayrıntılı bir şekilde görüntüleyebilir ve silebilirsiniz.
                    <span id="closeModal" class="close" onclick="closeAlert()">&times;</span>
                </p>
            </div>
            <!-- Satış Giriş bitti -->

            <div class="content">
                <!-- Satış Tablo -->
                <table>
                    <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Müşteri</th>
                        <th>Fiyat</th>
                        <th>Miktar</th>
                        <th>Ödeme Şekli</th>
                        <th>İl</th>
                        <th>İlçe</th>
                        <th>Adres</th>
                        <th>Satış Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- Satış Tablo bitti -->

                <!-- Satış Sil Modal -->
                <div class="modal" id="delete-sale" style="display:none">
                    <div class="modal-content">
                        <h3>Satışı Silmek İstediğinize Emin Misiniz?</h3>
                        <p>Bu işlem geri alınamaz</p>
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('delete-sale')">Kapat</button>
                            <a href = "#" id="confirmButton" class = "button-danger">Evet</a>
                        </div>
                    </div>
                </div>
                <!-- Satış Sil Modal bitti -->

                <!-- Ürün Modal -->
                <div class="modal" id="show-product" style="display:none">
                    <div class="modal-content">
                        <h3>Ürün Detay</h3>
                        <div style="margin-top:25px;">
                            <div class="form">
                                <form>
                                    <div class = "form-group">
                                        <label for="id">Ürün ID</label>
                                        <input type="text" id="id" name="id" class = "fillable-input" readonly>
                                    </div>
                                    <div class = "form-group">
                                        <label for="name">Ürün Adı</label>
                                        <input type="text" id="name" name="name" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Fiyat</label>
                                        <input type="number" id="price" min="1" name="price" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Adet</label>
                                        <input type="number" id="quantity" min="1" name="quantity" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Oluşturulma Tarihi</label>
                                        <input type="text" id="created_at" name="created_at" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Ürün Fotoğraf</label>
                                        <img src="" alt="" id="product-photo" width="100%" class="fillable-input fillable-img">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('show-product')">Kapat</button>
                        </div>
                    </div>
                </div>
                <!-- Ürün Modal bitti -->

                <!-- Müşteri Modal -->
                <div class="modal" id="show-customer" style="display:none">
                    <div class="modal-content">
                        <h3>Müşteri Detay</h3>
                        <div style="margin-top:25px;">
                            <div class="form">
                                <form>
                                    <div class="form-group">
                                        <label for="id">Müşteri ID</label>
                                        <input type="text" id="id" name="id" class = "fillable-input" readonly>
                                    </div>
                                    <div class = "form-group form-inline">
                                        <div class="form-group">
                                            <label for="name">Müşteri Adı</label>
                                            <input type="text" id="name" name="name" class = "fillable-input" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Müşteri Soyadı</label>
                                            <input type="text" id="surname" name="surname" class = "fillable-input" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Telefon</label>
                                        <input type="text" id="phone" name="phone" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-Posta</label>
                                        <input type="text" id="email" name="email" class = "fillable-input" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Kayıt Tarihi</label>
                                        <input type="text" id="created_at" name="created_at" class = "fillable-input" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('show-customer')">Kapat</button>
                        </div>
                    </div>
                </div>
                <!-- Müşteri Modal bitti -->
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
    getAllSales();

    /* Burada ürün/müşterini detayını modalda göstermek için ürün/müşteri id sine göre ürünü/müşteriyi çekiyoruz */
     async function getDetail(detail_id, func){
         try {
             const response = await fetch("../connector/Connector.php?action=" + func + "&id=" + detail_id);
             const data = await response.json();
             return data;
         } catch (error) {
             console.error(error);
             throw error;
         }
    }

    /* Burada tüm ürünleri connector dan fetch ile çekip tabloya ekliyoruz */
    async function getAllSales(){
        const response = await fetch('../connector/Connector.php?action=getAllSales');
        const data = await response.json();
        let table = document.querySelector('table tbody');
        table.innerHTML = '';
        for(const sale of data){
            // Ürün ve müşteri bilgilerini çekiyoruz
            let product_data = await getDetail(sale.product_id, "getProduct");
            let customer_data = await getDetail(sale.user_id, "getUserWithoutPasswordById");

            // Arraye dönüştürüyoruz
            product_data = Object.values(product_data);
            customer_data = Object.values(customer_data);

            // Son elemanla, sondan bir önceki elemanını değiştiriyoruz(tarih ve fotoğrafın yerleri)
            let temp = product_data[product_data.length - 1];
            product_data[product_data.length - 1] = product_data[product_data.length - 2];
            product_data[product_data.length - 2] = temp;

            // Modal için parametreleri oluşturuyoruz
            let showProductParam = product_data.map(value => `'${value}'`).join(",");
            let showCustomerParam = customer_data.map(value => `'${value}'`).join(",");

            table.innerHTML += `
                           <tr>
                                <td>
                                    <button class = "icon-button" onclick="openFormModal('show-product', ${showProductParam})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                                        </svg>
                                        Göster
                                    </button>
                               </td>
                                <td>
                                    <button class = "icon-button" onclick="openFormModal('show-customer', ${showCustomerParam})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                        </svg>
                                        Göster
                                    </button>
                               </td>
                               <td>${sale.price}</td>
                               <td>${sale.quantity}</td>
                               <td>${sale.payment_method}</td>
                               <td>${sale.city}</td>
                               <td>${sale.district}</td>
                               <td>${sale.address}</td>
                               <td>${sale.created_date}</td>
                               <td>
                                   <button class = "icon-button icon-delete" type="button" onclick="openModal('delete-sale', '../connector/Connector.php?action=deleteSale&id=${sale.id}')">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                           <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                       </svg>
                                       Sil
                                   </button>
                               </td>
                           </tr>
                       `;
        }
    }
</script>

</body>
</html>
