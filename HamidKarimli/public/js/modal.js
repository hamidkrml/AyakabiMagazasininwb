/**
 * Bu sayfada modal işlemleri yapılır.
 */

/**
 * Modal Kapat
 * @param {string} modal_id Modal ID
 * @returns {void}
 */
function closeModal(modal_id){
    document.getElementById(modal_id).style.display = "none";
}

/**
 * Modal Aç
 * @param {string} modal_id Modal ID
 * @param {string} confirm_href Onaylandığında yönlendirilecek adres
 * @param {string} confirm_button_id Onay butonunun ID'si
 * @returns {void}
 */
function openModal(modal_id, confirm_href, confirm_button_id="confirmButton"){
    document.getElementById(modal_id).style.display = "block";

    let confirm_button = document.getElementById(confirm_button_id);

    if(confirm_button_id === "product-photo")
        confirm_button.setAttribute("src", confirm_href);
    else
        confirm_button.setAttribute("href", confirm_href);
}


function openFormModal(modal_id, ...args) {
    let modal = document.getElementById(modal_id);
    modal.style.display = "block";

    openForm(modal_id, ...args);
}