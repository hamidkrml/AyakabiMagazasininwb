/**
 * Bu dosya da alertler ile ilgili işlemler yapılır.
 */

/**
 * Ekran açık olan alerti bulur ve kapatır.
 */
function closeAlert(){
    let alert = document.querySelector('.alert');
    if(alert){
        alert.remove();
    }
}