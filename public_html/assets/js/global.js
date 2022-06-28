
/* GLOBAL */

var Boxeon = Boxeon || {};
var Shipping = Shipping || {};
var Auth = Auth || {};
var Subscriptions = Subscriptions || {};
var controller = new AbortController();
var signal = controller.signal;


//import instance from './modules/messages.js'



/**
 * Checks user auth status
 */
Auth = {

  check: function (video_id, creator_id) {

    var data = {

      method: "GET",

      action: "/auth/google/status",

      contentType: "application/json; charset=utf-8",

      _token: document.querySelector('meta[name="csrf-token"]').content

    }

    function callback(status) {

      if (status == 0) {

        document.cookie = "box=" + window.location.href;

        location.assign("/auth/google");

      } else if (status == 1) {

        // Play video in UI
        Boxeon.playVideo(video_id, creator_id);
      }
    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);

  }
};

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

          console.log(e);
        }

        back(this.responseText);

      }
    }
  },
  allStorage: function () {

    var archive = [],
      keys = Object.keys(localStorage),
      i = 0, key;

    for (; key = keys[i]; i++) {
      archive.push(key + '=' + localStorage.getItem(key));
    }

    return archive;

  },
  addToFlyout: function () {

    let products = JSON.parse(Boxeon.getCookie("cart"));

    for (var i = 0; i < products.length; i++) {


      let flyOut = document.getElementById("flyout");
      var img = document.createElement("img");
      var div = document.createElement("div");
      var p = document.createElement("p");
      var txt = document.createTextNode("$" + products[i]['price']);
      div.className = "cart-item";
      div.id = products[i]["product"];
      img.src = "../assets/images/" + products[i]['img'];
      img.className = "h70px";
      div.appendChild(img);
      p.appendChild(txt);
      div.appendChild(p);
      flyOut.appendChild(div);
    }

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

  checkUrl: function (input) {

    let json = JSON.stringify({ url: input });
    var data = {
      method: "POST",
      action: "/box/url/?url=" + json + "",
      contentType: "application/json; charset=utf-8",
      customHeader: "X-CSRF-TOKEN",
      payload: document.querySelector('meta[name="csrf-token"]').content
    }

    function callback(re) {
      let msg = JSON.parse(re);
      if (msg.msg == "Available") {
        document.getElementById("box-url").
          style.backgroundColor = '#00800087';
      } else if (msg.msg == "Unavailable") {
        document.getElementById("box-url").
          style.backgroundColor = '#e2042987';
      }

    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
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

      if (Boxeon.CTA) {

        Boxeon.CTA.value = Boxeon.ctaValue;

      }
    }
  },

  working: function (CTA) {

    Boxeon.CTA = CTA;

    Boxeon.ctaValue = CTA.value;

    CTA.value = 'Working...';

  },

  changeImageOnMouseover: function (img, src) {

    img.src = "/assets/images/" + src;

  },

  playVideo: function (video_id, creator_uid) {

    Boxeon.createModalWindow();
    var mbody = document.getElementById("m-body");
    mbody.innerHTML = Boxeon.createVideoHTML(video_id);
    var mbodyNode = mbody.childNodes[0].parentNode;
    var el = "h2";
    var options = {
      msg: "1. Choose subscription schedule",
      className: "primary-color margin-top-2-em"
    }
    mbodyNode.appendChild(Boxeon.createElem(el, options));
    mbodyNode.appendChild(Boxeon.createPlanOptions());
    mbodyNode.appendChild(Boxeon.createSubsButton(creator_uid));
    var header = document.getElementById("mc-header");
    var opts = {
      className: "step step-incomplete",
      label1: "Schedule",
      label2: "Shipping",
      label3: "Checkout",
      length: 3
    }
    header.appendChild(Boxeon.createStepsLeft(opts));
  },

  createVideoHTML: function (id) {
    return "<div id='remove-black-bar'><iframe src=https://www.youtube.com/embed/"
      + id + "?rel=0&autoplay=1&frameborder=0&mute=1></iframe></div>";


  },

  createStepsLeft: function (options) {

    var grid = Boxeon.createElem("div");
    var wrapper = document.createElement("div");
    wrapper.className = "asides width-auto";
    grid.id = "steps-left";

    var label1 = document.createTextNode(options.label1);
    var label2 = document.createTextNode(options.label2);
    var label3 = document.createTextNode(options.label3);

    var p = [];
    p[0] = document.createElement("p");
    p[1] = document.createElement("p");
    p[2] = document.createElement("p");

    p[0].id = "text-step0-label";
    p[1].id = "text-step1-label";
    p[2].id = "text-step2-label";

    p[0].className = "centered";
    p[1].className = "centered";
    p[2].className = "centered";

    p[0].appendChild(label1);
    p[1].appendChild(label2);
    p[2].appendChild(label3);

    for (var i = 0; i < options.length; i++) {
      var span = Boxeon.createElem("p", options);
      if (i == 0) {
        span.className = "step step-current";
        span.id = "span-step" + 0 + "-circle";
      }

      var number = document.createTextNode(i + 1);
      span.appendChild(number);
      grid.appendChild(span);
      grid.append(p[i]);
    }
    var line = document.createElement("div");
    line.id = "steps-line";
    wrapper.appendChild(line);
    wrapper.appendChild(grid);
    return wrapper;

  },

  createElem: function (el, options = false) {

    var elem = document.createElement(el);
    if (options.className) {
      elem.className = options.className;
    }
    if (options.id) {
      elem.id = options.id;
    }
    if (options.msg) {
      var txt = document.createTextNode(options.msg);
      elem.appendChild(txt);
    }
    return elem;
  },

  createPlanOptions: function () {

    var form = document.createElement("form");
    var label1 = document.createElement("label");
    var label2 = document.createElement("label");
    var label3 = document.createElement("label");
    var label4 = document.createElement("label");
    var txt1 = document.createTextNode("Every month");
    var txt2 = document.createTextNode("Every 2 months");
    var txt3 = document.createTextNode("Every 3 months");
    var radio1 = document.createElement("input");
    var radio2 = document.createElement("input");
    var radio3 = document.createElement("input");
    var radio4 = document.createElement("input");
    radio1.setAttribute("type", "radio");
    radio1.setAttribute("checked", "checked");
    radio2.setAttribute("type", "radio");
    radio3.setAttribute("type", "radio");
    radio1.setAttribute("name", "freq");
    radio2.setAttribute("name", "freq");
    radio3.setAttribute("name", "freq");
    radio4.setAttribute("name", "freq");
    radio1.className = "switch-plan";
    radio2.className = "switch-plan";
    radio3.className = "switch-plan";
    radio4.className = "switch-plan";
    radio1.value = 1;
    radio2.value = 2;
    radio3.value = 3;
    radio4.value = 0;
    label1.appendChild(txt1);
    label2.appendChild(txt2);
    label3.appendChild(txt3);
    form.className = "price-options-grid bg-yellow";
    label1.appendChild(txt1);
    label1.appendChild(radio1);
    form.appendChild(label1);
    label2.appendChild(txt2);
    label2.appendChild(radio2);
    form.appendChild(label2);
    label3.appendChild(txt3);
    label3.appendChild(radio3);
    form.appendChild(label3);
    radio1.addEventListener('click', function () {

      Boxeon.switchPlan(this);
    });
    radio2.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    radio3.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    radio4.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    localStorage.setItem("sub-freq", 1);
    return form;
  },


  /* SUBSCRIPTION CHECKOUT FLOW  **********/

  createSubsButton: function (creator_uid) {
    var wrapper = document.createElement("div");
    wrapper.id = "subs-btns";
    var btn = document.createElement("button");
    btn.id = 'exe-sub';
    localStorage.setItem("sub-creator-id", creator_uid);
    // btn.setAttribute("data-url", "URL");
    btn.innerText = "Continue";
    //Event listener
    btn.addEventListener('click', function () {
      // Send to next step(step 2) in checkout flow
      var a = this;
      Shipping.collectUserAddress(creator_uid);
    });
    wrapper.appendChild(btn);
    return wrapper;
  },

  closeModal: function () {
    try {
      var m = document.getElementById("m-window");
      m.remove();
      //document.getElementsByTagName("header")[0].style.display = "grid";
    } catch (e) {
      //console.log(e);
    }
  },

  dialog: function (txt) {

    if (document.getElementsByTagName('dialog')[0]) {
      document.getElementsByTagName('dialog')[0].remove();
    }
    var d = document.createElement('dialog');
    var c = document.getElementById('container');
    var h3 = document.createElement("h3");
    var text = document.createTextNode(txt);
    h3.appendChild(text)

    var anchor = document.createElement("a");
    anchor.href = "#/";
    var span = document.createElement("span");
    span.className = "material-icons";
    span.innerText = "close";
    span.style.float = "right";
    anchor.appendChild(span);

    anchor.addEventListener('click', function () {
      d.remove();
    });
    d.appendChild(anchor);
    d.appendChild(h3);
    c.appendChild(d);
    d.showModal();

  },

  createModalWindow: function () {

    var m = document.createElement("div");
    var mc = document.createElement("div");
    var mb = document.createElement("div");
    var mch = document.createElement("div");
    var x = document.createElement("span");
    m.id = "m-window";
    mc.id = "m-content";
    mc.className = "fadein";
    m.className = "fadein";
    x.id = "m-close";
    x.className = "material-icons";
    x.innerText = 'close';
    mch.id = "mc-header";
    mb.id = "m-body";
    x.addEventListener("click", Boxeon.closeModal);
    mc.appendChild(x);
    m.appendChild(mc);
    mc.appendChild(mch);
    mc.appendChild(mb);
    x.innerHTML = "&times;";

    if (document.getElementById('m-window')) {

      var m_window = document.getElementById("m-window");

      var m_content = document.getElementById("m-window").firstChild;

      m_content.remove();

      m_window.appendChild(mc);

    } else {

      document.getElementById("container").appendChild(m);

    }
    Boxeon.scrollToTop();
  },

  loadScript: function (url) {

    var s = document.createElement('script');

    s.type = 'text/javascript';

    s.async = true;

    s.src = url;

    var x = document.getElementsByTagName('head')[0];

    x.appendChild(s);

  },

  switchPlan: function (a) {

    var frequency = a.value;

    localStorage.setItem("sub-freq", frequency);

  },

  showDisabled: function () {

    var fieldset = document.getElementById("curation1");

    fieldset.style.display = "block";

    var elems = fieldset.getElementsByTagName("*");

    for (var i = 0; i < elems.length; i++) {

      elems[i].removeAttribute("disabled");

    }

    var fieldset = document.getElementById("curation2");

    fieldset.style.display = "block";

    var elems = fieldset.getElementsByTagName("*");

    for (var i = 0; i < elems.length; i++) {

      elems[i].removeAttribute("disabled");

    }

    var hiden = document.getElementsByClassName('hiden');

    for (var i = 0; i < hiden.length; i++) {

      hiden[i].style.display = "block";

      let optional = hiden[i].getElementsByClassName('optional');

      let count = optional.length;

      for (let e = 0; e < count; e++) {

        optional[e].removeAttribute("disabled");

      }
    }

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

      "price": a.getAttribute("data-price"),
      "product": a.getAttribute("data-id"),
      "plan": a.getAttribute("data-plan"),
      "img": a.getAttribute("data-img")

    });

    document.cookie = "cart=" + JSON.stringify(cookie);

  }else{

    let cookie = [];
    cookie.push({

      "price": a.getAttribute("data-price"),
      "product": a.getAttribute("data-id"),
      "plan": a.getAttribute("data-plan"),
      "img": a.getAttribute("data-img")

    });
    document.cookie = "cart=" + JSON.stringify(cookie);

  }

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
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  },

  disable: function () {

    var fieldset = document.getElementById("curation1");

    fieldset.style.display = "none";

    var elems = fieldset.getElementsByTagName("*");

    for (var i = 0; i < elems.length; i++) {

      elems[i].setAttribute("disabled", "disabled");

    }
    var fieldset = document.getElementById("curation2");

    fieldset.style.display = "none";

    var elems = fieldset.getElementsByTagName("*");

    for (var i = 0; i < elems.length; i++) {

      elems[i].setAttribute("disabled", "disabled");

    }
    var hiden = document.getElementsByClassName('hiden');

    for (var i = 0; i < hiden.length; i++) {

      hiden[i].style.display = "none";

      let optional = hiden[i].getElementsByClassName('optional');

      let count = optional.length;

      for (let e = 0; e < count; e++) {

        optional[e].setAttribute("disabled", "disabled");

      }
    }

  },
};

Shipping = {


  getRates: function () {

    var json = JSON.stringify(Shipping.arr);

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


  generateLabels: function () {

    var data = {
      method: "GET",
      action: "/box/labels",
      contentType: "application/json; charset=utf-8",
      customHeader: "X-CSRF-TOKEN",
      payload: document.querySelector('meta[name="csrf-token"]').content
    }

    function callback(re) {
      let msg = JSON.parse(re);
      alert(msg.msg);

    }
    Boxeon.loader();
    Boxeon.sendAjax(data, callback);
  }


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

  createBillingPlan: function () {
    if (Shipping.rateSelected) {
      Shipping.arr['rate'] = Shipping.rateSelected.getAttribute('sub-rate');
      Shipping.arr['shipment'] = Shipping.rateSelected.getAttribute('sub-shipment');
      Shipping.arr['rate_id'] = Shipping.rateSelected.getAttribute('sub-rate-id');
      Shipping.arr['carrier'] = Shipping.rateSelected.getAttribute('sub-carrier');
    } else {
      Shipping.arr['rate'] = 0;
      Shipping.arr['shipment'] = null;
      Shipping.arr['rate_id'] = null;
      Shipping.arr['carrier'] = null;
    }
    Shipping.arr['version'] = localStorage.getItem('sub-version');
    Shipping.arr['total'] = localStorage.getItem('sub-total');
    Shipping.arr['creator_id'] = localStorage.getItem('sub-creator-id');
    Shipping.arr['frequency'] = localStorage.getItem('sub-freq');
    Shipping.arr['key'] = Boxeon.generateUUID();
    //Shipping.arr["_token"] = document.querySelector('meta[name="csrf-token"]').content;

    var json = JSON.stringify(Shipping.arr);
    var data = {
      method: "POST",
      action: "/plan/create/?plan=" + json + "",
      contentType: "application/json; charset=utf-8",
      customHeader: "X-CSRF-TOKEN",
      payload: document.querySelector('meta[name="csrf-token"]').content
    }
    function callback(r) {
      try {
        var json = JSON.parse(r);
        if (!json.errors) {
          localStorage.setItem("sub-plan_id", json['plan_id']);
          document.getElementById("m-window").remove();
          Subscriptions.showPaymentOptions();

        } else {
          alert("Sorry! Something went wrong on our end. Please try again later.");
        }
      } catch (e) {
        console.log(e);

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


window.onload = function () {


  // Presentation: fades in pages on load
  if (document.getElementsByTagName("main")[0]) {
    document.getElementsByTagName("main")[0].setAttribute("class", "fadein");
  }
  if (document.getElementById("masthead")) {
    document.getElementById("masthead").setAttribute("class", "fadein");
  }

  // LISTENERS


  if (localStorage.getItem('celebrate') == 'true') {

    document.getElementById('container').className = 'celebrate';

    localStorage.removeItem('celebrate');

    setTimeout(function () {

      document.getElementById('container').className = null;

    }, 6000);

  }

  // Close Feedback Dialog
  if (document.getElementById('close-dialog')) {
    document.getElementById('close-dialog').addEventListener('click', function () {
      document.getElementById('dialog-feedback').style.display = 'none';

    })
  }

  if (document.getElementById('alert')) {

    document.getElementById('alert').show();

    if (document.getElementById('close-dialog')) {

      document.getElementById('close-dialog').addEventListener('click', function () {

        document.getElementById('alert').remove();

      })

      // alert ();

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


  if (document.getElementById('play-video')) {
    document.getElementById('play-video').addEventListener('click', function () {
      let URL = document.getElementById("exe-sub").getAttribute("data-url");
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
        var a = this;
        Boxeon.cartPush(a);
        Boxeon.addToFlyout();
        Boxeon.slideOutCart();
        // READ: https://stackoverflow.com/questions/55328748/how-to-store-and-retrieve-shopping-cart-items-in-localstorage


      });
    }
  }

  // Cart
  //Boxeon.addToFlyout();

  // Reviews
  if (document.getElementById('show-review-form')) {
    document.getElementById('show-review-form').addEventListener('click', function () {
      document.getElementById('form-reviews').style.display = "block";

    });
  }

  // Feedback 
  if (document.getElementById('feedback')) {
    document.getElementById('feedback').addEventListener('click', function () {
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


  /*  if (document.getElementsByClassName('switch-plan')) {
      var radios = document.getElementsByClassName('switch-plan');
      for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('click', function () {
          Boxeon.switchPlan(this);
        });
      }
    }
    */

  if (document.getElementById('box-url')) {
    document.getElementById('box-url').addEventListener('keydown', function (e) {
      var key = e.keyCode;
      if (key === 32) {
        event.preventDefault();
      }
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



  if (document.getElementById('form-partner-apply')) {
    var btns = document.getElementsByClassName('partner-apply');
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener('click', function () {
        var form = document.getElementById('form-partner-apply-wrapper');
        form.style.display = "block";
        form.style.margin = "auto";
        var wrapper = document.getElementById("partner-masthead-image");
        wrapper.style.display = "none";
        var main = document.getElementsByTagName("main")[0];
        main.id = "margin-top-45-em";
        form.scrollIntoView({ behavior: 'smooth' });
      });
    }
  }
  if (document.getElementById('video-place-holder')) {
    var loc = document.getElementById('video-place-holder');
    loc.scrollIntoView({ behavior: 'smooth' });
  }


  if (document.getElementById('signin')) {
    document.getElementById('signin').addEventListener('click', function () {
      if (location.href == "https://boxeon.com/partner") {
        localStorage.setItem("last", "https://boxeon.com/partner");
      }
    });
  }

  if (document.getElementById('generate-labels')) {
    document.getElementById('generate-labels').addEventListener('click', function () {
      Boxeon.loader();
      var CTA = this;
      Boxeon.working(CTA);
      Shipping.generateLabels();
    });
  }


  if (document.getElementsByClassName('message-create')) {
    let elem = document.getElementsByClassName('message-create');
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener('click', function () {
        let id = this.getAttribute("data-type-id");
        localStorage.setItem('recipient', id);
      });
    }
  }
  if (document.getElementById('form-message-store')) {
    let id = localStorage.getItem('recipient');
    document.getElementById('recipient').setAttribute("value", id);
  }
  if (document.getElementById('check-url')) {
    document.getElementById('check-url').addEventListener('click', function () {
      Boxeon.loader();
      var CTA = this;
      Boxeon.working(CTA);
      if (document.getElementById("box-url").value) {
        var input = document.getElementById("box-url").value;
        Boxeon.checkUrl(input);
      } else {
        //
      }
    });
  }
  if (document.getElementById('new-window')) {
    document.getElementById('new-window').addEventListener('click', function () {
      var newwindow = window.open(this.getAttribute('data-type-href'), 'mywin', 'height=200,width=150');
      if (window.focus) { newwindow.focus() }

      return false;
    });
  }



  // Google Analytics

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


  //import instance from './modules/messages.js'
}
/*
let slideIndex = 1;
showSlides(slideIndex);


function plusSlides(n) {
  showSlides(slideIndex += n);
}


function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  captionText.innerHTML = dots[slideIndex - 1].alt;
}
*/


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

// document.cookie = "checkout=/checkout/index";
