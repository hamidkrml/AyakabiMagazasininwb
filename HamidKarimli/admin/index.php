<?php
/**
 * Bu sayfa yönetici anasayfasıdır ve yönetici web siteyi buradan kontrol eder.
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

    <!-- Müşteriler -->
    <div class="right">
        <div class="container">
            <!-- Müşteri Giriş -->
            <h1>Müşteriler</h1>
            <div class="hr"></div>
            <div class="alert">
                <p class = "icon-p">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Bu sayfadan tüm müşterileri ayrıntılı bir şekilde görüntüleyebilir ve silebilirsiniz.
                    <span id="closeModal" class="close" onclick="closeAlert()">&times;</span>
                </p>
            </div>
            <!-- Müşteri Giriş bitti -->

            <div class="content">
                <!-- Müşteri Tablo -->
                <table>
                    <thead>
                        <tr>
                            <th>İsim</th>
                            <th>Soyisim</th>
                            <th>Telefon</th>
                            <th>E-posta</th>
                            <th>Kayıt Tarihi</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- Müşteri Tablo bitti -->

                <!-- Müşteri Sil Modal -->
                <div class="modal" id="delete-customer" style="display:none">
                    <div class="modal-content">
                        <h3>Müşteriyi Silmek İstediğinize Emin Misiniz?</h3>
                        <p>Bu işlem geri alınamaz</p>
                        <div class="modal-buttons">
                            <button id="cancelButton" onclick="closeModal('delete-customer')">Kapat</button>
                            <a href = "#" id="confirmButton" class = "button-danger">Evet</a>
                        </div>
                    </div>
                </div>
                <!-- Müşteril Sil Modal bitti -->
            </div>
        </div>
    </div>
    <!-- Müşteriler bitti -->
</main>
<!-- Burada yönetici anasayfa içeriği bitti -->

<!-- JS -->
<script src="../public/js/modal.js"></script>
<script src="../public/js/form.js"></script>
<script src="../public/js/alert.js"></script>

<script>
    /* Burada tüm müşterleri connector dan fetch ile çekip tabloya ekliyoruz */
    fetch('../connector/Connector.php?action=getAllUsers')
        .then(response => response.json())
        .then(data => {
            let table = document.querySelector('table tbody');
            table.innerHTML = '';
            data.forEach(customer => {
                table.innerHTML += `
                       <tr>
                           <td>${customer.name}</td>
                           <td>${customer.surname}</td>
                           <td>${customer.phone}</td>
                           <td>${customer.email}</td>
                           <td>${customer.created_date}</td>
                           <td>
                               <button class = "icon-button icon-delete" type="button" onclick="openModal('delete-customer', '../connector/Connector.php?action=deleteUser&id=' + ${customer.id})">
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
