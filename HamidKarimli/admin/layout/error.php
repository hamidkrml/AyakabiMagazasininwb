<?php
/**
 * Bu sayfada alert mesajları gösterilir.
 */

$alert_msg = "";
if(isset($_GET['error'])){
    if($_GET['error'] == "3")
        $alert_msg = "Girilen e-posta adresi veya parola hatalı.";
}
?>

<!-- Eğer bir hata varsa bu div içerisinde gösterilir. -->
<?php if($alert_msg != ""){ ?>
    <div class="alert alert-danger" style="width:950px" id ="alert">
        <?php echo $alert_msg; ?>
    </div>
<?php } ?>