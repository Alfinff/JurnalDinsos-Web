/*
==========================
Vertical Responsive Menu
==========================
*/

'use strict';


var tid = setInterval( function () {
  if ( document.readyState !== 'complete' ) return;
  clearInterval( tid );


  var querySelector = document.querySelector.bind(document);

  var nav = document.querySelector('.shad');
  var wrapper = document.querySelector('.wrapper');
  var side1 = document.querySelector('.side1')

  var menu = document.getElementById("js-menu");
  var subnavs = menu.querySelectorAll('.menu--item__has_sub_menu');    

  // Toggle menu click
  document.getElementById('toggle_menu').onclick = function () {

    nav.classList.toggle('vertical_nav__opened');

    // wrapper.classList.toggle('toggle-content');

  };


  // Minify menu on menu_minifier click
  // document.getElementById('collapse_menu').onclick = function () {

  //   nav.classList.toggle('vertical_nav__minify');

  //   side1.classList.toggle('d-none')

  //   for (var j = 0; j < subnavs.length; j++) {
  //     subnavs[j].classList.remove('menu--subitens__opened');
  //   }

  // };


  // Open Sub Menu
  
  for (var i = 0; i < subnavs.length; i++) {
    
    if (subnavs[i].classList.contains('menu--item__has_sub_menu') ) {
      
      subnavs[i].querySelector('.menu--link').addEventListener('click', function (e) {

          for (var j = 0; j < subnavs.length; j++) {

            if(e.target.offsetParent != subnavs[j])
              subnavs[j].classList.remove('menu--subitens__opened');          

          }

          e.target.offsetParent.classList.toggle('menu--subitens__opened');

      }, false);

    }
  }


}, 100 );

