<?php
/**
 * Bu sayfada alert mesajları gösterilir.
 */

$alert_msg = "";
if(isset($_GET['error'])){
    if($_GET['error'] == "1")
        $alert_msg = "Girilen şifreler uyuşmuyor.";
    else if($_GET['error'] == "2")
        $alert_msg = "Bu e-posta adresini zaten kullanılıyor.";
    else if($_GET['error'] == "3")
        $alert_msg = "Girilen e-posta adresi veya parola hatalı.";
    else if($_GET['error'] == "4")
        $alert_msg = "Eski şifreniz ile yeni şifreniz aynı olamaz.";
}
?>

<!-- Eğer bir hata varsa bu div içerisinde gösterilir. -->
<?php if($alert_msg != ""){ ?>
    <div class="alert alert-danger" style="width:950px" id ="alert">
        <?php echo $alert_msg; ?>
    </div>
<?php } ?>