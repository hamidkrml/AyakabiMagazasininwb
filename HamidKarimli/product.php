<?php
/**
 * Bu sayfa ürün detay sayfasıdır ve kullanıcılar bu sayfadan ürünü satın alırlar.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once 'layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
<?php require_once 'layout/navbar.php' ?> <!-- Burada navbar.php dosyasını çağırdık. -->

<!-- Burası ürün detay sayfası içeriği -->
<div class="container">
    <main class = "product-main">
        <!-- Ürün bilgileri -->
        <div class="product-card">
            <img src="" id="productPhoto" alt="">
            <div class="product-info">
                <div class = "product-name">
                    <h3 id="productName"></h3>
                </div>
                <p class="price" id="productPrice"></p>
            </div>
        </div>
        <!-- Ürün bilgileri bitti -->

        <!-- Ödeme bilgileri -->
        <div class="buy-now">
            <!-- Ödeme şeklini belirten radio butonlar -->
            <div class="payment">
                <h2>Ödeme Şekli</h2>
                <div class="payment-method">
                    <div>
                        <input type="radio" id="credit-card" name="payment-method" onclick="toggleForm('credit-card-form')" value="credit-card" checked>
                        <label for="credit-card">Kredi Kartı</label>
                    </div>
                    <div>
                        <input type="radio" id="cash" name="payment-method" value="cash" onclick="toggleForm('cash-form')">
                        <label for="cash">Nakit</label>
                    </div>
                </div>
            </div>
            <!-- Ödeme şekline göre gösterilecek formlar -->
            <div class="address form-container">
                <form action="./connector/Connector.php" method="POST">
                    <input type="hidden" name="productId" id="productId">
                    <input type="hidden" name="action" value="buyProduct">
                    <input type="hidden" name="payment_method" id="paymentMethod">
                    <!-- Nakit formu -->
                    <div class="form payment-form" id = "credit-card-form">
                        <h2>Kredi Kart</h2>
                        <div class = "form-group">
                            <label for="card-number">Kart Numarası</label>
                            <input type="text" minlength="16" maxlength="20" placeholder="1234567891234567" id="card-number" name="card-number" required>
                        </div>
                        <div class="form-group form-inline">
                            <div class = "form-group">
                                <label for="cvv">CVV</label>
                                <input type="number" minlength="3" maxlength="3" id="cvv" name="cvv" placeholder="123" required>
                            </div>
                            <div class = "form-group form-inline">
                                <div class="form-group">
                                    <label for="card-month">Ay</label>
                                    <input type="number" min="1" max="12" id="card-month" name="card-month" placeholder="12" required>
                                </div>
                                <div class="form-group">
                                    <label for="card-year">Yıl</label>
                                    <input type="number" min="23" id="card-year" name="card-year" placeholder="22" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nakit formu bitti -->
                    <div class="hr" id="hr"></div>
                    <!-- Adres formu -->
                    <div class="form">
                        <h2>Adres</h2>
                        <div class="form-group">
                            <label for="city">İl</label>
                            <select name="city" id="city" required></select>
                        </div>
                        <div class="form-group">
                            <label for="district">İlçe</label>
                            <select name="district" id="district" required></select>
                        </div>
                        <div class="form-group">
                            <label for="address">Açık Adres</label>
                            <textarea name="address" cols="30" rows="10" id="address" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="buyButton">Satın Al</button>
                        </div>
                    </div>
                    <!-- Adres formu bitti -->
                </form>
            </div>
        </div>
        <!-- Ödeme bilgileri bitti -->
    </main>
</div>
<!-- Burada ürün detay sayfasının içeriği bitti -->

<script>
    // Satın al butonun en başta devre dışı bırakıyoruz
    var buyButton = document.getElementById('buyButton');
    buyButton.style.opacity = '0.7';
    buyButton.disabled = true;

    // Burada ürünün detaylarını yazdırmak için url'den gelen id parametresini php ile çekip fetch kullanarak connectordan ürün bilgilerini çekiyoruz.
    let productId = <?php echo $_GET['id']; ?>;
    fetch('./connector/Connector.php?action=getProduct&id=' + productId)
        .then(response => response.json())
        .then(data => {
            // Ürün bilgilerini yazdırıyoruz.
            document.getElementById('productName').innerHTML = data.name;
            document.getElementById('productPrice').innerHTML = '$' + data.price + '(KDV Dahil)';
            document.getElementById('productPhoto').src = "public/img/products/" + data.photo;
            document.getElementById('productId').value = data.id;
        });

    // Sayfa yüklendiğinde seçili olan ödeme yöntemini bul ve ona göre formu göster
    let allPaymentMethods = document.getElementsByName('payment-method');
    for (let i = 0; i < allPaymentMethods.length; i++) {
        if(allPaymentMethods[i].checked)
            toggleForm(allPaymentMethods[i].id + '-form');
    }

    // Ödeme yöntemi değiştiğinde formu değiştir
    function toggleForm(formId) {
        // Tüm formları gizle
        let allForms = document.getElementsByClassName('payment-form');
        for (let i = 0; i < allForms.length; i++) {
            allForms[i].style.display = 'none';
        }

        if(formId !== "cash-form")
            document.getElementById("hr").style.display = "block";
        else
            document.getElementById("hr").style.display = "none";

        try{
            // Ödeme yöntemini gizli inputa yaz
            document.getElementById('paymentMethod').value = formId === "cash-form" ? "cash" : "credit-card";

            // Seçilen formu göster
            document.getElementById(formId).style.display = 'block';
        }catch(e){} // Eğer formId bulunamazsa, hata vermesini engelliyoruz.

        // Eğer kredi kartı ile ödenecek ise
        if(document.getElementById('credit-card').checked) {
            // Kredi kartı bilgilerini zorunlu hale getir
            document.getElementById('card-number').setAttribute("required", "");
            document.getElementById('card-month').setAttribute("required", "");
            document.getElementById('card-year').setAttribute("required", "");
            document.getElementById('cvv').setAttribute("required", "");

            // Ay ve yıl inputlarının minimum limitlerini belirliyoruz.
            let today = new Date();
            let month = today.getMonth() + 1;
            let year = today.getFullYear().toString().substr(-2);

            document.getElementById('card-month').setAttribute('min', month.toString());
            document.getElementById('card-year').setAttribute('min', year);

            // Kredi Kart numarasını kontrol et.
            document.getElementById('card-number').addEventListener('keyup', function () {
                // Kredi kart numarasını alıyoruz. Boşlukları siliyoruz.
                let cardNumber = document.getElementById('card-number').value.replace(/\s/g, '');

                if(cardNumber.length !== 16){
                    // Eğer kart numarası 16 haneli değilse, kart numarası geçersizdir.
                    buyButton.style.opacity = '0.7';
                    buyButton.disabled = true;
                }else{
                    // Eğer kart numarası 16 haneli ise, kart numarası geçerlidir.
                    buyButton.style.opacity = '1';
                    buyButton.disabled = false;
                }
            });
        }else{
            // Eğer nakit ile ödenecek ise
            buyButton.style.opacity = '1';
            buyButton.disabled = false;
            document.getElementById('card-number').removeAttribute("required");
            document.getElementById('card-month').removeAttribute("required");
            document.getElementById('card-year').removeAttribute("required");
            document.getElementById('cvv').removeAttribute("required");
        }
    }

    /**
     * Burada il ve ilçe bilgilerini(seçilen il'e göre) çekiyoruz.
     */

    // cities.json dosyasından il ve ilçe bilgilerini çekiyoruz.
    let cities = [];
    let districts = [];
    fetch('./public/json/cities.json')
        .then(response => response.json())
        .then(data => {
            cities = data["city"];
            // İl listesini doldur
            let citySelect = document.getElementById('city');
            for (let i = 0; i < cities.length; i++) {
                let option = document.createElement('option');
                option.value = cities[i].name;
                option.innerText = cities[i].name;
                citySelect.appendChild(option);
            }
            // İlçe listesini doldur
            let districtSelect = document.getElementById('district');
            for (let i = 0; i < cities[0].city.length; i++) {
                let option = document.createElement('option');
                option.value = cities[0].city[i];
                option.innerText = cities[0].city[i];
                districtSelect.appendChild(option);
            }
        });

    // İl değiştiğinde ilçe listesini güncelle
    document.getElementById('city').addEventListener('change', function() {
        let selectedCity = this.value;
        let districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '';
        for (let i = 0; i < cities.length; i++) {
            if(cities[i].name === selectedCity){
                for (let j = 0; j < cities[i].city.length; j++) {
                    let option = document.createElement('option');
                    option.value = cities[i].city[j];
                    option.innerText = cities[i].city[j];
                    districtSelect.appendChild(option);
                }
                break;
            }
        }
    });
</script>

</body>
</html>