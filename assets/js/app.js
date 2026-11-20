// Permite adicionar/remover linhas de produtos no formulário de frete.
document.addEventListener('DOMContentLoaded', () => {
 const add = document.querySelector('#adicionar-produto');
 const area = document.querySelector('#lista-produtos');
 if (add && area) {
  add.addEventListener('click', () => {
   const original = area.querySelector('.linha-produto');
   const clone = original.cloneNode(true);
   clone.querySelector('select').value = '';
   area.appendChild(clone);
  });
  area.addEventListener('click', e => {
   if (e.target.classList.contains('remover-produto') && area.querySelectorAll('.linha-produto').length > 1) {
    e.target.closest('.linha-produto').remove();
   }
  });
 }
});
