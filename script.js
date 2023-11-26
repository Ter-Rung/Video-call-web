"use strict"
const pencil = document.querySelector('.ti-pencil');
const inputs = document.querySelectorAll('.input');
const span2 = document.querySelectorAll('.span2');

const hidespan2 = function () {
    span2.forEach(span => span.classList.toggle('hide'))
}
const updatespan = function () {
    inputs.forEach((input, i) => span2[i].textContent = input.value)
}
const showinput = function () {
    inputs.forEach(input => input.classList.toggle('hide'))
}
pencil.addEventListener('click', (e) => {
    e.preventDefault();
    hidespan2();
    showinput();

})


