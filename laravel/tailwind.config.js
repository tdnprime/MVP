const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  mode: 'jit',
  purge: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
    },
    screens: {
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
             => @media(min - width: 1024px) {

  main{
    margin - top: 25em;

  }
  main, #masthead{
    width: 80 %;
    margin - left: auto;
    margin - right: auto;
  }
                  #about main{
    margin - top: 4em!important;
  }
                  .overide{
    margin - top: 0;
  }


  main{
    margin - top: 25em;

  }
  main, #masthead{
    width: 80 %;
    margin - left: auto;
    margin - right: auto;
  }
      #about main{
    margin - top: 4em!important;
  }
      .overide{
    margin - top: 0;
  }
}
@media only screen and(max - width: 1024px) {
  
  
    #m - content h2 {
    width: 89 %;
  }
  header{
    padding - left: 0;
  }
    #headline {
    padding - left: 7em;

  }
  #partner - masthead - image {
    width: 95 %;
    height: 100 %;
    background: url(../images/fly -with-bg.svg) 50 % 5em no - repeat;
    display: block;
  }
  #partner.two - col - grid{
    background: none;
  }
  #how - it - works{
    width: 90 %;
  }
  
  #module{
    width: min - content;
    padding: 0;
  }
      #form - partner - apply - wrapper{
    display: none;
  }
  
  
      .two - col - grid{
    display: block;
  }
      #headline{
    max - width: 90 %;
    margin: auto;
    top: 14em;
  }
      #masthead - video - wrapper{
    width: 70 %;
    margin: auto;
  }
    .hack - br - 2 {
    display: none!important;
  }
    #box - masthead - inner - wrapper {
    display: block;
    background - image: url(../images/alt - blue - bg.svg);
    padding: 0!important;
    width: 60 %;
  }
    #box - headline {
    width: 100 %;
    text - align: center;

  }
    
    #box #masthead {
    display: block;

  }
    #box main{
    margin - top: 4em;
  }
   
    #create - box {
    left: -7em;
  }
    #box - masthead - inner - wrapper {
    width: fit - content;
    display: grid;
    grid - template - rows: auto auto auto;
    grid - template - columns: none;
  }
    #box - headline {
    display: grid;
    grid - template - rows: auto auto;
    text - align: left;
    width: 100 %;
  }
    #box.break {
    display: inline;
  }
   #page - name {
    font - size: inherit!important;
  }
    .ginormous{
    font - size: 4em!important;
  }
    #box - headline h1 {
    grid - row - start: 1;
    font - size: 4em;
    margin - bottom: 0.2em;
    text - align: center;
    width: auto!important;
    margin - top: 0!important;
  }
    #box - headline p {
    display: inline - block;
    margin - right: 4em;
    margin - bottom: 2em;
    text - align: center;
  }
    #main {
    padding - left: 3em;
  }
    #box - headline div {
    grid - row - start: 3;
    margin: auto;
    padding: 2em;
  }
    #box - headline.sub - btns {
    width: 50 %;
    margin: auto;
  }
    #video - place - holder {
    width: 100 %;
    padding: 0;
    margin - top: 4em;
  }
   
    .pointer {
    display: inline - block;
    font - size: inherit;
    height: 4em;
    position: relative;
    background - color: transparent;
    text - align: left;
    vertical - align: middle;
    margin: 0.6em;
  }
    .pointer: after {
    display: none;
  }
    .pointer: before {
    display: none;
  }
  
    .for-creators - only {
    display: none;
  }
    .padding - bottom - none {
      padding- bottom: 0!important;
}
    .answers {
  padding - top: 0!important;
}
  
  
    #guide {
  display: block;
}
    #home #mobile - signin {
  display: none;
}
    .section img {
  margin - bottom: 0;
}
   
  
    .section {
  width: 60 %;
}
    #container {
  padding: 1em;

}
  
    #headline h1, #pitch {
  width: auto;
}
    #headline {
  /*  top: 8em !important;
   
    grid-row-start: 3;
    grid-row-end: 3;
  */
  padding-left: 0!important;
  position: static!important;
  text-align: center;
}
    #testimonials {
  display: block;
  width: auto;
}
    #testimonials img {
  height: 100px;
}
    .section img {
  height: 300px;
}
   /*#box #masthead {
      display: block;
      overflow-y: hidden;
    }*/
    #box #masthead {
  display: block;
  height: fit - content;
}
    /*  #headline {
      grid-column-start: 1;
      grid-column-end: 1;
      grid-row-start: 1;
      grid-row-end: 1;
    }*/
    #masthead - image {
  width: 95 %;
  height: 100 %;
  background: url("../images/marilyn.svg") no - repeat 50 % 5em;
  background - size: contain;
}
  
    #masthead - image - construction{
  width: 95 %;
  height: 100 %;
  background: url("../images/alt-makeitrain.svg") no - repeat right 5em!important;
}
    #partner #masthead{
  height: 35em;
}
   
    #create - box fieldset {
  width: fit - content;

}
  
  
              }

'xl': '1280px',
  // => @media (min-width: 1280px) { ... }

  '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        }
    },

plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
