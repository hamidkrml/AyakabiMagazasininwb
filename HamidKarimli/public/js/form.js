/**
 * Bu dosya, form işlemleri için yazılmış fonksiyonları içerir.
 */

/**
 * Formu aç ve inputları doldur.
 * @param {string} form_id
 * @param input_values
 * @returns {void}
 */
function openForm(form_id, ...input_values) {
    let form = document.getElementById(form_id)
    form.style.display = "block";

    if (input_values.length > 0) {
        let allFillableInputs = form.getElementsByClassName("fillable-input");

        for (let i = 0; i < input_values.length; i++) {
            if(allFillableInputs[i].classList.contains("fillable-img"))
                allFillableInputs[i].setAttribute("src", "../public/img/products/" + input_values[i]);
            else
                allFillableInputs[i].value = input_values[i];
        }
    }
}
