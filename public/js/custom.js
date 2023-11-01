

window.addEventListener('scroll', function(){
    const header = document.querySelector('.header');
    const scrollPosition = window.scrollY>100;

    header.classList.toggle('header-change', scrollPosition)
})


window.addEventListener('scroll', function(){
    const totop = document.querySelector('.to-top');

    if(window.scrollY>100){
        totop.classList.add('active');
    }
    else{
        totop.classList.remove('active');
    }
});



const line = document.querySelector('.line div');
const cancel = document.querySelector('.cancel');
const mobile_sidepanel = document.querySelector('.mobile_sidepanel');




line.addEventListener('click',  function(){
    mobile_sidepanel.classList.add('mobile_sidepanel_active');
})

cancel.addEventListener('click',  function(){
    mobile_sidepanel.classList.remove('mobile_sidepanel_active');
})


const mobile_search = document.querySelector('.mobile_search');
const fa_rectangle_xmark = document.querySelector('.fa-rectangle-xmark')
const mobile_search_div = document.querySelector('.mobile_search_div');

mobile_search.addEventListener('click', function(){
    mobile_search_div.classList.add('mobile_search_div_active');
})

fa_rectangle_xmark.addEventListener('click', function(){
    mobile_search_div.classList.remove('mobile_search_div_active');
})


/* const currency = document.querySelector('ul.usd-inr li');
currency.addEventListener('click', function(){
    currency.classList.add('money-change');
    
}); */

///gsap animation starts///

/* mySplitText = new SplitText("h1#main-heading", { type: "words,chars" }); */

gsap.fromTo('#main-heading', 0.5, {opacity:0, y:200, delay:0.4, ease:"power2.out"}, {opacity:1, y:0, delay:0.4, ease:"power2.out"});
gsap.fromTo('#main-para', 0.5, {opacity:0, y:200, delay:0.6, ease:"power2.out"}, {opacity:1, y:0, delay:0.6, ease:"power2.out"});
gsap.fromTo('#mainBTN', 0.5, {opacity:0, y:200, delay:0.8, ease:"power2.out"}, {opacity:1, y:0, delay:0.8, ease:"power2.out"});
gsap.fromTo('.swiper-slide img', 2, {opacity:0, delay:0.7, ease:"power2.out"}, {opacity:1, delay:0.7, ease:"power2.out"});




///gsap animation end///

////gsap scrollmagic starts///

////gsap scrollmagic ends///



/* const pagenation = document.querySelector('.pagination ul li a');


pagenation.addEventListener('click', function(){
    console.log('hellow');
}); */

