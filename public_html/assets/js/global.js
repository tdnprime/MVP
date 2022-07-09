
/* GLOBAL */

var Boxeon = Boxeon || {};
var Shipping = Shipping || {};
var Cart = Shipping || {};
var Subscriptions = Subscriptions || {};
var controller = new AbortController();
var signal = controller.signal;


//import instance from './modules/messages.js'



/**
 * Utility functions
 */

Boxeon = {

  sendAjax: function (data, back) {

    var xhttp = new XMLHttpRequest();

    xhttp.open(data.method, data.action, true);

    xhttp.setRequestHeader('Content-type', data.contentType);

    xhttp.setRequestHeader(data.customHeader, data.payload, false);

    xhttp.send();

    xhttp.onreadystatechange = function () {

      if (this.readyState == 4 && this.status == 200) {

        try {

          Boxeon.removeLoader();

        } catch (e) {

          //error
        }

        back(this.responseText);

      }
    }
  },



  feedback: function (data) {

    var json = JSON.stringify(data);

    var manifest = {

      method: "POST",

      action: "/feedback/send/?feedback=" + json,

      contentType: "application/json; charset=utf-8",

      customHeader: "X-CSRF-TOKEN",

      payload: document.querySelector('meta[name="csrf-token"]').content

    }

    function callback(re) {

      //
    }

    Boxeon.sendAjax(manifest, callback);

  },


  deleteCookie: function (name) {

    document.cookie = name + "=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT";

  },

  delete: function (product) {

    // Update Cookie
    let newCart = [];

    let cart = JSON.parse(Boxeon.getCookie("cart"));

    for (var i = 0; i < cart.length; i++) {

      if (cart[i]["product"] != product) {

        newCart.push(cart[i]);

      }

    }
    if (cart.length > 1) {

      document.cookie = "cart=" + JSON.stringify(newCart) + ";" + "path=/";

      Boxeon.showCartTotal();
    } else {
      Boxeon.deleteCookie("cart");

    }
    location.reload();

  },

  showCartCount: function () {
    if (Boxeon.getCookie("cart")) {
      let cart = JSON.parse(Boxeon.getCookie("cart"));
      let count = cart.length;
      let span = document.getElementsByClassName("cart-count");
      for (var i = 0; i < span.length; i++) {
        let text = document.createTextNode(count);
        span[i].innerText = count;
      }
    }

  },

  showCartTotal: function () {

    if (Boxeon.getCookie("cart")) {

      const total = [];

      let cart = JSON.parse(Boxeon.getCookie("cart"));

      let count = cart.length;


      for (var i = 0; i < count; i++) {

        var cadence = cart[i]['plan'];

        var basePrice = parseInt(cart[i]['basePrice']);

        if (cadence == 1) {
          var price = basePrice;
        } else if (cadence == 2) {
          var price = basePrice + 1;
        } else if (cadence == 3) {
          var price = basePrice + 2;
        } else if (cadence == 0) {
          var price = basePrice + 3;
        }

        total.push(price * parseInt(cart[i]['quantity']));
      }

      if (total.length == 0) { return; }

      let sum = total.reduce((a, b) => a + b);

      let span = document.getElementsByClassName("cart-total");

      for (var i = 0; i < span.length; i++) {
        span[i].innerText = "$" + sum;

      }

      if (document.getElementsByClassName("checkout-total")) {
        let target = document.getElementsByClassName("checkout-total");
        for (var i = 0; i < target.length; i++) {
          target[i].innerText = "$" + (sum + 17);

        }
      }
    }
  },

  addToFlyout: function () {

    let products = JSON.parse(Boxeon.getCookie("cart"));

    for (var i = 0; i < products.length; i++) {

      if (!document.getElementById(products[i]['product'])) {
        let flyOut = document.getElementById("flyout");
        var img = document.createElement("img");
        var div = document.createElement("div");
        var p = document.createElement("p");
        var quantity = parseInt(products[i]['quantity']);
        var price = products[i]['price'] * quantity; // moved last half to own line?
        var txt = document.createTextNode("$" + price);
        div.className = "cart-item";
        div.id = products[i]["product"];
        img.src = "../assets/images/products/" + products[i]['img'];
        img.className = "h70px";
        div.appendChild(img);
        p.appendChild(txt);
        div.appendChild(p);
        if (flyOut.getElementsByClassName("cart-item")[0]) {
          flyOut.insertBefore(div,
            flyOut.getElementsByClassName("cart-item")[0]
          );
        } else {
          flyOut.appendChild(div);
        }
      }
    }

    Boxeon.showCartCount();
    Boxeon.showCartTotal();



  },

  generateUUID: function () {
    let time = new Date().getTime();
    if (typeof performance !== 'undefined' && typeof performance.now === 'function') {
      time += performance.now();
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      let random = (time + Math.random() * 16) % 16 | 0;
      time = Math.floor(time / 16);
      return (c === 'x' ? random : (random & 0x3 | 0x8)).toString(16);
    });
  },


  disableLink: function (link) {

    link.addEventListener("click", function () {

      controller.abort();

    });
  },


  scrollToTop: function () {

    window.scrollTo({ top: 0, behavior: 'smooth' });

  },

  loader: function () {
    if (!document.getElementsByClassName("loader")[0]) {
      let div = document.createElement("div");
      div.className = "loader";
      if (document.getElementById("container")) {
        let container = document.getElementById("container");
      } else if (document.getElementById("m-window")) {
        let container = document.getElementById("m-window");
      }
      container.prepend(div);
      div.style.position = "absolute";
    }
  },

  removeLoader: function () {
    if (document.getElementsByClassName("loader")[0]) {
      var loader = document.getElementsByClassName("loader")[0];
      loader.remove();
    }
  },


  changeImageOnMouseover: function (img, src) {

    img.src = "/assets/images/" + src;

  },


  loadScript: function (url) {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var x = document.getElementsByTagName('head')[0];
    x.appendChild(s);
  },

  slideOutCart: function () {
    if (screen.width <= 600) {
      document.getElementById("menu").className = "slideOutCart";
      document.getElementById('menu').style.display = "block";
      document.getElementById("cart_overlay").className = "cart_overlay_show";
    } else {
      document.getElementById("menu").className = "slideOutCart";
      document.getElementById('menu').style.display = "block";
      document.getElementById("cart_overlay").className = "cart_overlay_show";

    }
  },

  slideInCart: function () {
    document.getElementById("menu").className = "slideInCart";
    document.getElementById('menu').style.display = "none";
  },


  cartPush: function (a) {


    if (Boxeon.getCookie("cart")) {

      let cookie = JSON.parse(Boxeon.getCookie("cart"));

      cookie.push({
        "name": a.getAttribute("data-name"),
        "quantity": a.getAttribute("data-quantity"),
        "price": a.getAttribute("data-price"),
        "basePrice": a.getAttribute("data-basePrice"),
        "product": a.getAttribute("data-id"),
        "plan": a.getAttribute("data-plan"),
        "img": a.getAttribute("data-img")

      });

      document.cookie = "cart=" + JSON.stringify(cookie) + ";" + "path=/";

    } else {

      let cookie = [];

      cookie.push({
        "name": a.getAttribute("data-name"),
        "quantity": a.getAttribute("data-quantity"),
        "price": a.getAttribute("data-price"),
        "basePrice": a.getAttribute("data-basePrice"),
        "product": a.getAttribute("data-id"),
        "plan": a.getAttribute("data-plan"),
        "img": a.getAttribute("data-img")

      });
      document.cookie = "cart=" + JSON.stringify(cookie) + ";" + "path=/";

    }

  },

  showDetailsPreview: function (elem) {

  },
  getCookie: function (cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {

      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(cname) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return false;
  },


  cartQuantityUpdate: function (quantity, product) {
    // Updates Cookie
    if (!Boxeon.getCookie("cart")) { return; }
    let newCart = [];
    let cart = JSON.parse(Boxeon.getCookie("cart"));

    for (var i = 0; i < cart.length; i++) {
      if (cart[i]["product"] == product) {
        cart[i]["quantity"] = quantity;

      }

      newCart.push(cart[i]);

    }
    document.cookie = "cart=" + JSON.stringify(newCart) + ";" + "path=/";
    Boxeon.showCartTotal();
  },


  cartPlanUpdate: function (cadence, product) {

    // Update Cookie
    let newCart = [];

    let cart = JSON.parse(Boxeon.getCookie("cart"));

    if (cart.length == 0) { return; }

    for (var i = 0; i < cart.length; i++) {

      if (cart[i]["product"] == product) {

        cart[i]["plan"] = cadence;

      }

      newCart.push(cart[i]);

    }

    document.cookie = "cart=" + JSON.stringify(newCart) + ";" + "path=/";
    Boxeon.showCartTotal();


  },

  cartUpdatePrice: function (quantity, product, price) {
    //alert(price);
    // Update in UI
    if (!document.getElementById("itemprice" + product)) { return; }
    var newPrice = price * quantity;
    var h2 = document.getElementById("itemprice" + product);
    h2.innerText = "$" + newPrice;

    // Update Cookie

    let newCart = [];
    let cart = JSON.parse(Boxeon.getCookie("cart"));

    for (var i = 0; i < cart.length; i++) {

      if (cart[i]["product"] == product) {

        cart[i]["price"] = price;

      }

      newCart.push(cart[i]);

    }

    document.cookie = "cart=" + JSON.stringify(newCart) + ";" + "path=/";

    Boxeon.showCartTotal();

  },

};

Shipping = {


  getRates: function (address) {

    var json = JSON.stringify(address);

    var manifest = {

      method: "POST",

      action: "/rates/fetch/?to=" + json,

      contentType: "application/json; charset=utf-8",

      customHeader: "X-CSRF-TOKEN",

      payload: document.querySelector('meta[name="csrf-token"]').content

    }

    function callback(re) {

      Shipping.buildRateCard(JSON.parse(re));
    }

    Boxeon.loader();

    Boxeon.sendAjax(manifest, callback);

  },
};


Subscriptions = {

  unsubCheck: function (b) {
    var ownerID = b.getAttribute("data-id");
    let h2 = document.createElement("h3");
    h2.className = "centered";
    let h2txt = document.createTextNode("Do you wish to unsubscribe from this box?");
    var div = document.createElement("dialog");
    div.id = "dialog";;
    let button = document.createElement("button");
    button.innerText = "No";
    let button2 = document.createElement("button");
    button2.className = "clearbtn";
    button2.setAttribute("data-id", ownerID);
    let version = b.getAttribute("data-version");
    button2.setAttribute("data-version", version);
    button2.innerText = "Yes";
    h2.appendChild(h2txt)
    div.appendChild(h2);
    div.appendChild(button);
    div.appendChild(button2);
    document.getElementById("container").appendChild(div);
    div.showModal();
    button.addEventListener("click", function (div) {

      document.getElementById("dialog").remove();
    });
    button2.addEventListener("click", function () {
      let b = this;
      Subscriptions.remove(b);
    });

  },
  createUpdateUI: function (button) {
    var div = document.createElement("div");
    var form = document.createElement("form");
    form.method = "post";
    form.action = "/subscription/update";

    var input = document.createElement("input");
    var input1 = document.createElement("input");
    var input2 = document.createElement("input");

    input.type = "hidden";
    input.name = "_token";
    input.value = document.querySelector('meta[name="csrf-token"]').content;

    input1.type = "hidden";
    input1.name = "creator_id";
    input1.value = button.getAttribute("data-id");

    input2.type = "hidden";
    input2.name = "version";
    input2.value = button.getAttribute("data-version");

    form.appendChild(input);
    form.appendChild(input1);
    form.appendChild(input2);


    var button = document.createElement("button");
    button.type = "submit";
    button.innerText = "Update";
    button.addEventListener("click", function () {

      var a = this;

    })

    var select = document.createElement("select");
    select.name = "cadence";
    select.style.marginTop = "0";

    var option1 = document.createElement("option");
    var txt1 = document.createTextNode("Monthly");
    option1.value = "MONTHLY";
    option1.appendChild(txt1);

    var option2 = document.createElement("option");
    var txt2 = document.createTextNode("Every two months");
    option2.value = "EVERY_TWO_MONTHS";
    option2.appendChild(txt2);

    var option3 = document.createElement("option");
    var txt3 = document.createTextNode("Every 90 days");
    option3.value = "NINETY_DAYS";
    option3.appendChild(txt3);

    select.appendChild(option1);
    select.appendChild(option2);
    select.appendChild(option3);


    form.appendChild(select);
    form.appendChild(button);

    div.appendChild(form);
    Boxeon.dialog("Update how often you receive this box.");
    document.getElementsByTagName("dialog")[0].appendChild(div);


  },

  remove: function (b) {
    let box = {
      creator_id: b.getAttribute("data-id"),
      version: b.getAttribute("data-version")
    };
    let json = JSON.stringify(box);
    var data = {
      method: "POST",
      action: "/subscription/remove/" + json + "",
      contentType: "application/json; charset=utf-8",
      customHeader: "X-CSRF-TOKEN",
      payload: document.querySelector('meta[name="csrf-token"]').content
    }

    function callback(re) {

      var result = JSON.parse(re);

      if (result.errors) {

        Boxeon.dialog("Sorry! Something went wrong on our end. Please try again later.");

      } else {
        Boxeon.dialog("You've been unsubscribed.");
      }
    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
  },


  complete: function (json) {
    var data = {
      method: "POST",
      action: "/subscription/complete/" + json + "",
      contentType: "application/json; charset=utf-8",
      customHeader: "X-CSRF-TOKEN",
      payload: document.querySelector('meta[name="csrf-token"]').content
    }

    function callback(re) {
      if (re == 1) {
        //  localStorage.clear();
        location.href = "/home/index";
      }
    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
  },


  showPaymentOptions: function () {

    var iframe = document.createElement('iframe');
    iframe.id = 'iframe-checkout';
    iframe.src = '/checkout/subscription';
    document.getElementById("payment-method").appendChild(iframe);


  },


  showSubscriptions: function () {
    var data = {
      method: "POST",
      action: "../subs/get-subscriptions.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "CURRENT",
      payload: 1
    }

    function callback(r) {
      alert(r);
    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
  },


  showRecommended: function () {
    var data = {
      method: "POST",
      action: "../subs/get-recommended.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "GENERAL",
      payload: 1
    }

    function callback(r) {
      alert(r);
    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
  }

};


// APP
window.onload = function () {


  // Presentation: fades in pages on load
  if (document.getElementsByTagName("main")[0]) {
    document.getElementsByTagName("main")[0].classList.add("fadein");
  }
  if (document.getElementById("masthead")) {
    document.getElementById("masthead").classList.add("fadein");
  }

  // LISTENERS


  if (localStorage.getItem('celebrate') == 'true') {

    document.getElementById('container').className = 'celebrate';

    localStorage.removeItem('celebrate');

    setTimeout(function () {

      document.getElementById('container').className = null;

    }, 6000);

  }

  if (document.getElementsByClassName("delete-icon")) {

    let icons = document.getElementsByClassName("delete-icon");
    for (var i = 0; i < icons.length; i++) {

      let product = parseInt(icons[i].getAttribute("data-product"));

      icons[i].addEventListener("click", function () {

        Boxeon.delete(product);

        icons[i].parentNode.parentNode.parentNode.parentNode.remove();

      });

    }
  }

  if (document.getElementsByClassName("select-plan")) {

    var selects = document.getElementsByClassName("select-plan");

    for (var i = 0; i < selects.length; i++) {

      if (selects[i].getAttribute("name") == "quantity") {

        let product = selects[i].getAttribute("data-product");
        let basePrice = parseInt(selects[i].getAttribute("data-price"));

        selects[i].addEventListener("change", function () {

          var quantity = parseInt(this.value);
          var cadence = parseInt(this.parentNode.getElementsByTagName("select")[1].value);

          if (cadence == 1) {
            var price = basePrice;
          } else if (cadence == 2) {
            var price = basePrice + 1;
          } else if (cadence == 3) {
            var price = basePrice + 2;
          } else if (cadence == 0) {
            var price = basePrice + 3;
          }

          // Update in storage/cookie
          Boxeon.cartQuantityUpdate(quantity, product);
          // Update HTML
          if (this.parentNode.parentNode.getElementsByTagName("button")[0]) {
            this.parentNode.parentNode.getElementsByTagName("button")[0].
              setAttribute("data-quantity", quantity);
          }
          //Update in UI price
          Boxeon.cartUpdatePrice(quantity, product, price);

        })

      }
    }

  }

  if (document.getElementsByClassName("select-plan")) {

    var selects = document.getElementsByClassName("select-plan");

    for (var i = 0; i < selects.length; i++) {

      if (selects[i].getAttribute("name") == "plan") {

        let product = selects[i].getAttribute("data-product");

        selects[i].addEventListener("change", function () {

          var quantity = this.parentNode.getElementsByTagName("select")[0].value;
          var cadence = this.value;
          var basePrice = parseInt(this.getAttribute("data-price"));

          if (cadence == 1) {
            var price = basePrice;
          } else if (cadence == 2) {
            var price = basePrice + 1;
          } else if (cadence == 3) {
            var price = basePrice + 2;
          } else if (cadence == 0) {
            var price = basePrice + 3;
          }
          // Update in storage
          Boxeon.cartPlanUpdate(cadence, product);
          let subButton = this.parentNode.parentNode.getElementsByTagName("button")[0];
          // Update HTML
          if (subButton) {
            this.parentNode.parentNode.getElementsByTagName("button")[0].
              setAttribute("data-plan", cadence);
            this.parentNode.parentNode.getElementsByTagName("button")[0].
              setAttribute("data-price", price);
          }

          //Update price in UI
          Boxeon.cartUpdatePrice(quantity, product, price);

        })

      }
    }

  }

  // Close Dialog
  if (document.getElementsByClassName('close-dialog')) {
    let x = document.getElementsByClassName('close-dialog');
    for (let i = 0; i < x.length; i++) {
      x[i].addEventListener('click', function () {
        this.parentNode.close();
        this.parentNode.style.display = "none";

      })
    }
  }

  if (document.getElementById('alert')) {
    document.getElementById('alert').show();
    if (document.getElementById('close-dialog')) {
      document.getElementById('close-dialog').addEventListener('click', function () {
        document.getElementById('alert').remove();
      })

    }
  }

  if (document.getElementById('exe-sub')) {
    document.getElementById('exe-sub').addEventListener('click', function () {
      Boxeon.loader();
      var a = this;
      a.disabled = "true";
      Boxeon.router(a);
    });
  }

  if (document.getElementById('cart_overlay')) {
    document.getElementById('cart_overlay').addEventListener('click', function () {
      document.getElementById('cart_overlay').className = "cart_overlay_hide";
      document.getElementById('menu').className = "slideInCart";
      document.getElementById('menu').style.display = "none";

    });
  }

  if (document.getElementById('btn-update-subscription')) {
    document.getElementById('btn-update-subscription').addEventListener('click', function () {
      var button = this;
      button.disabled = "true";
      Subscriptions.createUpdateUI(button);

    });
  }

  if (document.getElementsByClassName('exe-unsub')) {
    var btns = document.getElementsByClassName('exe-unsub');
    var num = btns.length;
    for (var i = 0; i < num; i++) {
      btns[i].addEventListener('click', function () {
        var a = this;
        a.disabled = "true";
        Boxeon.router(a);
      });
    }

  }

  if (document.getElementById('exe-sub-alt')) {
    document.getElementById('exe-sub-alt').addEventListener('click', function () {
      var a = this;
      Boxeon.loader();
      a.disabled = "true";
      Boxeon.router(a);
    });
  }



  if (document.getElementsByClassName('cart-add')) {
    let btns = document.getElementsByClassName('cart-add');
    var total = btns.length;
    for (var i = 0; i < total; i++) {
      btns[i].addEventListener('click', function () {
        let a = this;
        Boxeon.cartPush(a);
        Boxeon.slideOutCart();
        Boxeon.addToFlyout();

      });
    }
  }

  // Cart Ready State

  Boxeon.showCartCount();
  Boxeon.showCartTotal();

  // Reviews
  if (document.getElementById('show-review-form')) {
    document.getElementById('show-review-form').addEventListener('click', function () {
      document.getElementById('form-reviews').style.display = "block";

    });
  }

  // Feedback 
  if (document.getElementById('feedback')) {
    let d = document.getElementById('feedback');
    d.addEventListener('click', function () {
      document.getElementById('dialog-feedback').show();
      document.getElementById('dialog-feedback').style.display = "block";

    });
  }
  if (document.getElementById('m-feedback')) {
    let d = document.getElementById('m-feedback');
    d.addEventListener('click', function () {
      document.getElementById('dialog-feedback').show();
      document.getElementById('dialog-feedback').style.display = "block";
    });
  }

  if (document.getElementsByClassName('sentiment')) {
    let choices = document.getElementsByClassName('sentiment');
    var num = choices.length;
    for (let i = 0; i < num; i++) {
      choices[i].addEventListener('click', function () {
        var feedback = choices[i].id;
        document.getElementById('start').style.display = "none";
        if (feedback == "thumb_up") {
          document.getElementById('like').style.display = "block";
        }
        if (feedback == "thumb_down") {
          document.getElementById('dislike').style.display = "block";
        }
        if (feedback == "lightbulb") {
          document.getElementById('suggestion').style.display = "block";
        }
        var array = [];
        Boxeon.feedback(array["sentiment"] = feedback);

      });
    }
  }


  if (document.getElementsByClassName('send-feedback')) {
    let choices = document.getElementsByClassName('send-feedback');
    var num = choices.length;
    for (let i = 0; i < num; i++) {
      choices[i].addEventListener('click', function (event) {
        event.preventDefault();
        var message = this.parentNode.getElementsByTagName("textarea")[0].value;
        this.parentNode.style.display = "none";
        document.getElementById('nps').style.display = "block";
        var array = [];
        Boxeon.feedback(array["message"] = message);
        return false;
      });
    }
  }
  if (document.getElementsByClassName('scale')) {
    let choices = document.getElementsByClassName('scale');
    var num = choices.length;
    for (let i = 0; i < num; i++) {
      choices[i].addEventListener('click', function (event) {
        event.preventDefault();
        var scale = choices[i].getAttribute("data-type-value");
        this.parentNode.parentNode.style.display = "none";
        document.getElementById('feedback-thanks').style.display = "block";
        var array = [];
        Boxeon.feedback(array["scale"] = scale);
      
        return false;
      });
    }
  }


  // Sign Out
  if (document.getElementById('signout')) {
    document.getElementById('signout').addEventListener('click', function () {
      Boxeon.signOut();
    });
  }

  if (document.getElementById('showDropdown')) {
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    document.getElementById('showDropdown').addEventListener('click', function () {

      document.getElementById("myDropdown").style.display = "block";


    });

  }


  if (document.getElementById('show-disabled')) {
    document.getElementById('show-disabled').addEventListener('click', function () {
      Boxeon.showDisabled();
    });
  }
  if (document.getElementById('disable')) {
    document.getElementById('disable').addEventListener('click', function () {
      Boxeon.disable();
    });
  }


  if (document.getElementById('video-place-holder')) {
    var loc = document.getElementById('video-place-holder');
    loc.scrollIntoView({ behavior: 'smooth' });
  }

  // Save shipping address
  if (document.getElementById("shipping-address")) {
    let div = document.getElementById("shipping-address");
    div.addEventListener("submit", function (event) {
      event.preventDefault();
      let array = [];
      var formData = new FormData(this);
      // div.classList.add("fadeout");
      div.style.display = "none";
      for (var [key, value] of formData) {
        array.push([key = value]);
        if (value == 0) {

          document.getElementById("billing-address").style.display = "block";

        } else if (value == 1) {
          var pre = document.getElementsByClassName("preview");
          for (var xe = 0; xe < pre.length; xe++) {
            if (pre[xe].getAttribute("data-type-id") == "billing-address") {
              pre[xe].innerText = array[2] + " ...";
            }
          }
        }

      }
      var p = document.getElementsByClassName("preview");
      for (var x = 0; x < p.length; x++) {
        if (p[x].getAttribute("data-type-id") == div.id) {
          p[x].innerText = array[2] + " ...";
        }
      }
      Boxeon.scrollToTop();
      //Send to server (array);
    });
  }

  // Saves billing address
  if (document.getElementById("billing-address")) {
    let div = document.getElementById("billing-address");
    div.addEventListener("submit", function (event) {
      event.preventDefault();
      let array = [];
      var formData = new FormData(this);
      //  div.classList.add("fadeout");
      div.style.display = "none";
      for (var [key, value] of formData) {
        array.push([key = value]);

      }
      var p = document.getElementsByClassName("preview");
      for (var x = 0; x < p.length; x++) {
        if (p[x].getAttribute("data-type-id") == div.id) {
          p[x].innerText = array[2] + " ...";
        }
      }

      document.getElementById("payment").style.display = "block";
      //Send to server (array);
      Boxeon.scrollToTop();
    });
  }

  //Checkout
  if (document.getElementsByClassName("cartcheckout")) {

    let form = document.getElementsByClassName("cartcheckout");
    for (let i = 0; i < form.length; i++) {
      form[i].addEventListener("submit", function (event) {

        event.preventDefault();
        document.cookie = "checkout=" + "/checkout/index" + ";" + "path=/";

        location.assign("/checkout/index");

      });
    }
  }

  // Place order
  if (document.getElementsByClassName("place-order")) {
    let form = document.getElementsByClassName("place-order");
    for (let i = 0; i < form.length; i++) {
      form[i].addEventListener("submit", function (event) {
        event.preventDefault();

      });
    }
  }

  // Checkout page EDIT buttons
  if (document.getElementById("billing-address")) {

    let btns = document.getElementsByClassName("edit-btn");
    for (let i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function () {
        var id = btns[i].getAttribute("data-type-id");
        document.getElementById(id).style.display = "block";
      });

    }

  }



  // Google Analytics -- SHOULD THIS BE MOVED UP?

  window.dataLayer = window.dataLayer || [];

  function gtag() {

    window.dataLayer.push(arguments);

  }

  gtag('js', new Date());
  gtag('config', 'G-EKYP1LECWS');


  window.addEventListener('onbeforeunload', function () {

    document.getElementBy("container").setAttribute("class", "fadeout");


  });

  // Event snippet for Waiting List Signup conversion page
  function gtag_report_conversion(url) {

    var callback = function () {
      if (typeof (url) != 'undefined') {
        window.location = url;
      }
    };
    gtag('event', 'conversion', {
      'send_to': 'AW-10788250660/CKWeCNWaosUDEKTInpgo',
      'event_callback': callback
    });
    return false;
  }

  if (document.getElementById('survey')) {
    document.getElementById('survey').addEventListener('click', function () {
      gtag_report_conversion("https://boxeon.com/apply/survey");

    });
  }

  // Exit Intent Popup
  document.addEventListener("mouseleave", function () {
    //document.getElementById('popup').open = true;
  });

  //import instance from './modules/messages.js'



  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

  if (document.getElementsByClassName("loader")[0]) {
    Boxeon.removeLoader();
  }

  if (document.getElementById('menu-icon')) {
    document.getElementById('menu-icon').addEventListener("click", function () {
      document.getElementById("m").show();
    });
  }
} // listeners end

if (!document.getElementsByClassName("loader")[0]) {

  let div = document.createElement("div");

  div.className = "loader";

  if (document.getElementById("container")) {

    let container = document.getElementById("container");

  } else if (document.getElementById("m-window")) {

    let container = document.getElementById("m-window");
  }

  container.prepend(div);

  div.style.position = "absolute";
}
