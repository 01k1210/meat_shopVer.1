const btnMinus = document.querySelector('.control-minus');
const btnPlus = document.querySelector('.control-plus'); 
const corzina = document.querySelector('.cart-wrap');
const smallcart = document.querySelector('.small_couneter');

//отрисовка кол-ва эл-в в корзине
window.addEventListener('load' ,function(){
  cartStatus();
  calcDelivery();
})

//Кнопка плюс
window.addEventListener('click', (event) =>{
 if(event.target.dataset.action === 'plus'){
  const wrapBtn = event.target.closest('.cart-item__details-control');
  wrapBtn.querySelector('.control-info').innerText++;
 }
})

//Ф-ция перезаписи кол-ва товара в LS
window.addEventListener('click', (event)=>{
  if(event.target.hasAttribute('data-overwritinglsPlus')){
    const wrapCart = event.target.closest('.cart-item');
    const idCart = wrapCart.getAttribute('data-id');
    const counter = wrapCart.querySelector('.control-info').innerText;
    let out = JSON.parse(localStorage.getItem('cart'));
    for(item of out){
      if(item.id === idCart){
        item.counter = counter;
      }
    }
    localStorage.setItem("cart", JSON.stringify(out));
  }
})

window.addEventListener('click', (event)=>{
  if(event.target.hasAttribute('data-overwritinglsMinus')){
    const wrapCart = event.target.closest('.cart-item');
    const idCart = wrapCart.getAttribute('data-id');
    const counter = wrapCart.querySelector('.control-info').innerText;
    let out = JSON.parse(localStorage.getItem('cart'));
    for(item of out){
      if(item.id == idCart){
        item.counter = counter - 1;
      }
    }
    localStorage.setItem("cart", JSON.stringify(out));
  }
})

//Кнопка добавить
window.addEventListener('click', (event) =>{
 if(event.target.hasAttribute('data-cart')){
  const card = event.target.closest('.card');

  const cardInfo ={
   id: card.dataset.id,
   imgSrc: card.querySelector('.card-img').getAttribute('src'),
   name: card.querySelector('.part').innerText,
   weight: card.querySelector('.price__weight').innerText,
   price: card.querySelector('.price__currency').innerText,
   counter: card.querySelector('.control-info').innerText
  }

  corzinaInwrap = corzina.querySelector(`[data-id="${cardInfo.id}"]`)


  if(corzinaInwrap){
    const couneterElement = corzinaInwrap.querySelector('[data-couneter]');
    couneterElement.innerText = parseInt(couneterElement.innerText) + parseInt(cardInfo.counter);
    const idItem = corzinaInwrap.dataset.id;
    let out = JSON.parse(localStorage.getItem('cart'));
    for(item of out){
      if(idItem == item.id){
        item.counter = couneterElement.innerText
      }
    }
    localStorage.setItem("cart", JSON.stringify(out));
    }else{

      local = localStorage.getItem('cart');
      if(local !== null){
        local = JSON.parse(local);
      } else local = [];
      local.push(cardInfo);
      localStorage.setItem("cart", JSON.stringify(local));

      let outHTML = `
      <div class="cart-item mb-2" data-id="${cardInfo.id}">
            <div class="cart-item__img">
               <img class="card-img img-block" src="${cardInfo.imgSrc}" alt="логотип товара в корзине">
            </div>
            <div class="cart-item__desc">
               <div class="cart-item__title lead mb-1">${cardInfo.name}</div>
               <div class="cart-item__weight mb-1">${cardInfo.weight}</div>
               <div class="cart-item__details small">
                   <div class="cart-item__details-control ">
                       <div data-action="minus" data-overwritinglsMinus class="control-minus">-</div>
                       <div data-couneter class="control-info">${cardInfo.counter}</div>
                       <div data-action="plus" data-overwritingLSPlus class="control-plus">+</div>
                   </div>
                   <div class="cart-item__details-price h6">
                   ${cardInfo.price}
                   </div>
               </div>
           </div>
      `
      corzina.insertAdjacentHTML('beforeend',outHTML );
     }
     cartStatus();
     calcDelivery();
}})

// Кнопка минус
window.addEventListener('click', (event) =>{
  if(event.target.dataset.action === 'minus'){
   const wrapBtn = event.target.closest('.cart-item__details-control');
   const summ = wrapBtn.querySelector('.control-info');
 
   if(summ.innerText > 0){
    summ.innerText --;
   }
   if(event.target.closest('.cart-wrap') && parseInt(summ.innerText) === 0){
    event.target.closest('.cart-item').remove();
    cartStatus()

    const ElemDel = event.target.closest('.cart-item').dataset.id;
    local = JSON.parse(localStorage.getItem('cart'))
    for(let i = local.length -1; i >= 0; i--){
     if(local[i].id == ElemDel){
       local.splice(i,1);
     }
    }
    localStorage.setItem("cart", JSON.stringify(local));
   }
  }
  calcDelivery()
 });

//вывод товара с LS

 if(localStorage.getItem('cart') !== null){
let out = JSON.parse(localStorage.getItem('cart'));
      for(let item of out){
        const cartHtml = `<div class="cart-item mb-2" data-id="${item.id}">
        <div class="cart-item__img">
           <img class="card-img img-block" src="${item.imgSrc}" alt="логотип товара в корзине">
        </div>
        <div class="cart-item__desc">
           <div class="cart-item__title lead mb-1">${item.name}</div>
           <div class="cart-item__weight mb-1">${item.weight}</div>
           <div class="cart-item__details small">
               <div class="cart-item__details-control ">
                   <div data-action="minus" data-overwritinglsMinus class="control-minus">-</div>
                   <div data-couneter class="control-info">${item.counter}</div>
                   <div data-action="plus" data-overwritingLSPlus class="control-plus">+</div>
               </div>
               <div class="cart-item__details-price h6">
               ${item.price}
               </div>
           </div>
       </div>
       `
  
       corzina.insertAdjacentHTML('beforeend',cartHtml );
      }
 }


 function cartStatus() {
 const cartAlert = document.querySelector('.alert');
 const formBye = document.querySelector('.form-Bue');
 smallcart.innerText = corzina.children.length;
 if(corzina.children.length > 0){
  cartAlert.classList.add('dNone');
  formBye.classList.remove('dNone');
 }else{
  cartAlert.classList.remove('dNone');
  formBye.classList.add('dNone');
 }
}

function calcDelivery(){
   const allCarts = document.querySelectorAll('.cart-item');
   console.log();
   const totalPrice = document.querySelector('.total-prise');
   const delivery = document.querySelector('.delivery');
   const deliveryWrap = document.querySelector('[data-cart-delivery]');
   const smallText = document.querySelector('.smallText');
   let finishsumm = 0;
   allCarts.forEach(function(item){
    const count = item.querySelector('[data-couneter]').innerText;
    const price = item.querySelector('.cart-item__details-price').innerText;
    const totalPrice = parseInt(count) * parseInt(price);
    finishsumm = totalPrice + finishsumm;
   })

   totalPrice.innerText = `${finishsumm}₽` ;
   if(finishsumm > 0){
    deliveryWrap.classList.remove('dNone');
   }else{
    deliveryWrap.classList.add('dNone');
   }

   if(finishsumm > 600){
    smallText.classList.add('dNone');
    delivery.innerText = 'Бесплатно';
    delivery.classList.add('text-success');
   }else{
    smallText.classList.remove('dNone');
    delivery.innerText = `600₽`;
    delivery.classList.remove('text-success');
   }
}

// Фильтрация товара по категориям 
allCard = document.querySelectorAll('.to_filter');

window.addEventListener('click', navItem);
function navItem(event){
   if(event.target.classList.contains('navi')){
      const filterClass = event.target.dataset.action;
      allCard.forEach(function(item){
         item.classList.remove('dNone');
         if(item.dataset.action !== filterClass && filterClass !== 'all'){
            item.classList.add('dNone');
         }
      })
   }
}

//Отправка заказа пользователя fetch

document.querySelector('#tel').onclick = (event) => {
  event.preventDefault();
  const formData = new FormData();
  const tel = document.querySelector('[name="telephone"]');
  let delivery = document.querySelector('.delivery').innerText;
  formData.append('delivery' , delivery);
  formData.append('corzina' , localStorage.getItem('cart'));
  formData.append('tel' , tel.value);
  if(tel.value.length < 1) return;
  fetch("zakaz.php",{
    method: 'post',
    body: formData,
})
.then(response => response.text()) 
.then(data =>{
const tel = document.querySelector('[name="telephone"]').value = "";
window.localStorage.clear();
corzina.innerHTML = "";
cartStatus()
const modal = new bootstrap.Modal(document.querySelector('#modal'));
modal.show();
});
}


//маска для ввода номера
$(function(){
  $('input[name="telephone"]').mask("8(999) 999-9999");
});
