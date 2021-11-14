/* JS/GLOBAL */

var Boxeon = Boxeon || {}; // Functions
var Account = Account || {};
var Shipping = Shipping || {};
var Subscriptions = Subscriptions || {};

Boxeon = {

  sendAjax: function (data, back) {
    var xhttp = new XMLHttpRequest();
    xhttp.open(data.method, data.action, true);
    xhttp.setRequestHeader('Content-type', data.contentType);
    xhttp.setRequestHeader(data.customHeader, data.payload, false);
    xhttp.send();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 0) {
        Boxeon.progressBar(25);
      } else if (this.readyState == 2) {

        Boxeon.progressBar(50);
      } else if (this.readyState == 3) {
        Boxeon.progressBar(75);
      } else if (this.readyState == 4 && this.status == 200) {
        back(this.responseText);
        Boxeon.progressBar(101);

      } else {

        alert("Sorry! An error occured. Please try again.");
      }
    }

  },

  progressBar: function (completed) {
    var wrapper = document.getElementById("progress");
    var bar = document.getElementById("bar");
    var width = 0;
    for (width < completed; width++;) {
      wrapper.style.visibility = "visible";
      wrapper.style.width = width + "%";
      bar.style.width = width + "%";
    }
  },
  playVideo: function (id) {
    //document.getElementById('m-window').remove();
    var msg = {
      heading: "",
      para: "",
      action: ""
    }
    Boxeon.createModalWindow(msg);
    var mbody = document.getElementById("m-body");
    mbody.innerHTML = Boxeon.createVideoHTML(id);
    var mbodyNode = mbody.childNodes[0].parentNode;
    mbodyNode.appendChild(Boxeon.createPlanOptions());
    mbodyNode.appendChild(Boxeon.createSubsButton());
  },
  createVideoHTML: function (id) {
    return "<iframe src=https://www.youtube.com/embed/" + id + "?rel=0&autoplay=1&frameborder=0></iframe>";
  },
  createPlanOptions: function () {

    var form = document.createElement("form");
    var label1 = document.createElement("label");
    var label2 = document.createElement("label");
    var label3 = document.createElement("label");
    var txt1 = document.createTextNode("Every month");
    var txt2 = document.createTextNode("Every 2 months");
    var txt3 = document.createTextNode("Every 3 months");
    var radio1 = document.createElement("input");
    var radio2 = document.createElement("input");
    var radio3 = document.createElement("input");

    radio1.setAttribute("type", "radio");
    radio1.setAttribute("checked", "checked");
    radio2.setAttribute("type", "radio");
    radio3.setAttribute("type", "radio");
    radio1.setAttribute("name", "freq");
    radio2.setAttribute("name", "freq");
    radio3.setAttribute("name", "freq");
    radio1.className = "switch-plan";
    radio2.className = "switch-plan";
    radio3.className = "switch-plan";
    radio1.value = 1;
    radio2.value = 2;
    radio3.value = 3;

    label1.appendChild(txt1);
    label2.appendChild(txt2);
    label3.appendChild(txt3);

    form.className = "price-options-grid";

    label1.appendChild(txt1);
    label1.appendChild(radio1);
    form.appendChild(label1);

    label2.appendChild(txt2);
    label2.appendChild(radio2);
    form.appendChild(label2);

    label3.appendChild(txt3);
    label3.appendChild(radio3);
    form.appendChild(label3);
    return form;
  },
  /************ INCOMPLETE **********/
  createSubsButton: function () {
    // Note: APPLY sellers UID
    var wrapper = document.createElement("div");
    wrapper.id = "subs-btns";
    var btn = document.createElement("button");
    btn.id = 'exe-sub';
    btn.setAttribute("data-id", "UID");
    btn.setAttribute("data-url", "URL");
    btn.setAttribute("data-plan-id", "ID");
    btn.innerText = "Subscribe";
    wrapper.appendChild(btn);
    wrapper.appendChild(Boxeon.createSecureTransactionNotice());
    // NOTE: Add event listener
    return wrapper;
  },
  createSecureTransactionNotice: function () {
    var wrapper = document.createElement("div");
    var img = document.createElement("img");
    var p = document.createElement("p");
    var txt = document.createTextNode("Secure transaction");
    p.appendChild(txt);
    img.src = "../images/lock.svg";
    wrapper.appendChild(img);
    wrapper.appendChild(p);
    return wrapper;

  },
  closeModal: function () {

    try {

      var m = document.getElementById("m-window");
      m.remove();

    } catch (e) {

      //console.log(e);
    }
  },
  createModalWindow: function (message) {

    var m = document.createElement("div");
    var mc = document.createElement("div");
    var mb = document.createElement("div");
    var mch = document.createElement("div");
    var mcf = document.createElement("div");
    var x = document.createElement("span");
    var mch1 = document.createElement("h1");

    m.id = "m-window";
    mc.id = "m-content";
    mc.className = "fadein";
    m.className = "fadein";
    x.id = "m-close";
    mch.id = "mc-header";
    mcf.id = "mc-footer";
    mb.id = "m-body";
    mch1.innerText = message.heading;

    x.addEventListener("click", Boxeon.closeModal);
    mc.appendChild(x);
    m.appendChild(mc);
    mch.appendChild(mch1);
    mc.appendChild(mch);
    mc.appendChild(mb);

    mc.appendChild(mcf);
    x.innerHTML = "&times;";
    document.getElementById("container").appendChild(m);
  },

  loadScript: function (url) {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var x = document.getElementsByTagName('footer')[0];
    x.appendChild(s);
  },


  switchPlan: function (a) {
    var plan_id = a.value;
    document.getElementById('sub').setAttribute('data-plan-id', plan_id);

  },

  disable: function (f) {
    var inputs = f.parentNode.parentNode.parentNode.getElementsByClassName("optional");
    for (var i = 0; i < inputs.length; i++) {

      inputs[i].setAttribute("disabled", 'disabled');

    }
  },


  menu: function () {
    var menu = document.getElementById("menu");
    menu.style.display = "grid";
    menu.style.width = "16%";
    var anchors = menu.getElementsByTagName("a");
    for (var i = 0; i < anchors.length; i++) {
      anchors[i].style.display = "block";

    }
  },
  toggleMenuBlack: function (a) {
    var img = a.getElementsByTagName("img")[0];
    img.src = "../images/menu.svg";
  },
  toggleMenuRed: function (a) {
    var img = a.getElementsByTagName("img")[0];
    img.src = "../images/menu-icon-red.svg";
  },
  signOut: function () {
    sessionStorage.clear();
  },
  toggleArrowBlack: function (img) {
    img.src = "../images/arrow.svg";
  },
  toggleArrowRed: function (img) {
    img.src = "../images/arrow-red.svg";
  },

  closeMenu: function () {
    var menu = document.getElementById("menu");
    menu.style.width = "0";
    var anchors = menu.getElementsByTagName("a");
    for (var i = 0; i < anchors.length; i++) {
      anchors[i].style.display = "none";
    }

  },
  isUser: function (a) {

    let URL = a.getAttribute("data-url");
    if (a.id == 'exe-sub') {
      sessionStorage.setItem('sub', 1);
    } else if (a.id == 'exe-unsub') {
      sessionStorage.setItem('sub', 0);
    }
    Account.isUser();
    if (Account.known == 0) {
      // ask to sign in
      sessionStorage.setItem("last", window.location.href);
      location.assign(URL);
    }
    if (Account.known == 1) {

      sessionStorage.setItem('box', document.getElementById(a.getAttribute('data-id')));
      if (sessionStorage.getItem('sub') == 1) {
        Shipping.collectUserAddress();
      } else if (sessionStorage.getItem('sub') == 0) {
        Subscriptions.removeCheck(a);
      }
    }

  },

  removeDisabled: function (f) {
    var inputs = f.parentNode.parentNode.parentNode.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {

      if (inputs[i].disabled) {

        inputs[i].removeAttribute("disabled");
      }
    }
  }

};

Account = {

  isUser: function () {

    var data = {
      method: "POST",
      action: "../account/index.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "AUTH",
      payload: "1"
    }

    function callback(re) {
      Account.known = re;
    }
    Boxeon.sendAjax(data, callback);

  }
};

Shipping = {

  collectUserAddress: function () {
    var msg = {
      heading: "Shipping cost calculator",
      para: "",
      action: ""
    }
    Boxeon.createModalWindow(msg);
    Shipping.buildUI();
  },
  buildUI: function () {
    var data = {
      method: "POST",
      action: "../account/index.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "ADDR"
    }

    function callback(re) {
      Shipping.buildAddressInputForm(JSON.parse(re));
    }
    Boxeon.sendAjax(data, callback);

  },
  buildAddressInputForm: function (addr) {
    document.getElementById("m-body").innerHTML =
      "<P>Let's start by calculating the price of shipping to you.</P><form onsubmit='return Shipping.processFormData(this);'>"
      + "<fieldset><input type='text' name='name' required value='" + addr.fullname + "'></input>"
      + "<input type='text' name='address_line_1' required value='" + addr.address_line_1 + "'></input>"
      + "<input type='text' name='address_line_2' value='" + addr.address_line_2 + "'></input>"
      + "<input type='text' name='admin_area_2' required value='" + addr.admin_area_2 + "'></input>"
      + "<input type='text' name='admin_area_1' required value='" + addr.admin_area_1 + "'></input>"
      + addr.country_code
      + "<input type='text' name='postal_code' required value='" + addr.postal_code + "'></input></fieldset>"
      + "<input type='submit' value='Continue'></input>"
      + "</form>";
  },
  processFormData: function (f) {
    event.returnValue = false;
    var nl = f.getElementsByTagName("input");
    Shipping.arr = {};
    for (var i = 0; i < nl.length; i++) {
      if (nl[i].getAttribute('name')) {
        var key = nl[i].getAttribute('name');
        var value = nl[i].value;
        Shipping.arr[key] = value;
      }
    }
    var n = f.getElementsByTagName("select");
    for (var e = 0; e < n.length; e++) {
      if (n[e].getAttribute('name')) {
        var k = n[e].getAttribute('name');
        var v = n[e].value;
        Shipping.arr[k] = v;
      }
    }
    Shipping.arr['creator_id'] = document.getElementById('sub').getAttribute('data-id');
    Shipping.getRates();
    return false;
  },
  getRates: function () {

    var json = JSON.stringify(Shipping.arr);
    var manifest = {
      method: "POST",
      action: "../shipping/validateAddress.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "CALC",
      payload: json
    }

    function callback(re) {

      Shipping.buildRateCard(JSON.parse(re));
    }
    Boxeon.sendAjax(manifest, callback);

  },
  buildRateCard: function (rates) {
    Shipping.rate_card = "";
    var num = rates.results.length;
    for (var i = 0; i < num; i++) {
      var rate = parseInt(rates.results[i].amount) + 3;
      Shipping.rate_card += "<div class='four-col-grid'><p><img src='" + rates.results[i].provider_image_200
        + "' width='75px' alt='Carrier'/></p><p>" + rates.results[i].servicelevel.name + '</p><p><b>$'
        + rate + "</b></p>"
        + "<button data-carrier='" + rates.results[i].provider + "'  data-shipment='" + rates.results[i].shipment + "' data-rate='" + rate + "' data-rate-id='" + rates.results[i].object_id + "' id='exe-sub'>Choose</button></div>";

    }
    Shipping.showRates();

  },
  showRates: function () {
    document.getElementById('m-window').remove();
    var msg = {
      heading: "Shipping cost",
      para: "<p>We found the cheapest rate.</p>",
      action: "Continue"
    }

    Boxeon.createModalWindow(msg);
    document.getElementById("m-body").
    innerHTML = Shipping.rate_card;
  },
  printLabels: function (b) {
    var arr = {};
    arr['one'] = b.getAttribute('class');
    var json = JSON.stringify(arr);
    var data = {
      method: "POST",
      action: "../home/s.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "LABELS",
      payload: json
    }

    function callback() {}
    Boxeon.sendAjax(data, callback);
  }


};

Subscriptions = {

  removeCheck: function (b) {
    var ownerID = b.getAttribute("data-id");
    var msg = {
      heading: "Do you want to unsubscribe from this box?",
      para: "",
      action: ""
    }

    Boxeon.createModalWindow(msg);
    document.
    getElementById("m-body").
    innerHTML = '<div id="subs-btns"><button id="close-modal">No</button><button class="clearbtn" data-id="' + ownerID + '" id="exe-unsub">Yes</button></div>';

  },

  remove: function (b) {
    let owner = b.getAttribute("data-id");
    var data = {
      method: "POST",
      action: "../subs/index.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "UNSUB",
      payload: owner
    }

    function callback(re) {
      if (re == 1) {
        // to do.  m.setAttribute("class", "fadein");
      }
    }
    Boxeon.sendAjax(data, callback);
  },
  add: function (json) {
    var data = {
      method: "POST",
      action: "../subs/index.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "SUB",
      payload: json
    }

    function callback() {
      var msg = {
        heading: "Thank you!",
        para: "<p>Your subscription was created sucessfully. Please check your Gmail for your receipt.</p>",
        action: ""
      }

      Boxeon.createModalWindow(msg);
    }
    Boxeon.sendAjax(data, callback);
  },

  createBillingPlan: function (b) {
    var arr = {};
    arr['rate'] = b.getAttribute('data-rate');
    arr['shipment'] = b.getAttribute('data-shipment');
    arr['rate_id'] = b.getAttribute('data-rate-id');
    arr['carrier'] = b.getAttribute('data-carrier');
    arr['creator_id'] = document.getElementById('exe-sub').getAttribute('data-id');
    arr['frequency'] = document.getElementById('exe-sub').getAttribute('data-plan-id');
    var json = JSON.stringify(arr);
    var data = {
      method: "POST",
      action: "../home/create-plan.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "PLAN",
      payload: json
    }

    function callback(r) {
      var json = JSON.parse(r);
      document.getElementById('sub').setAttribute("data-plan-id", json['plan_id']);
      document.getElementById("m-window").remove();
      Subscriptions.showPaymentOptions();
    }
    Boxeon.sendAjax(data, callback);
  },
  showPaymentOptions: function () {

    var msg = {
      heading: "Choose a payment method to continue",
      para: "<p>You don't need a Paypal account to continue.</p>",
      action: ""
    }

    Boxeon.createModalWindow(msg);
    document.
    getElementById("m-body").
    innerHTML = "<div id='paypal-button-container'></div>";
    Boxeon.loadScript("../js/subs.js");
    var buttons = document.getElementById("paypal-button-container");
    buttons.style.display = "block";

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
    Boxeon.sendAjax(data, callback);
  }

};


$(document).ready(function () {
  // Resize viewport for mobile
  if (screen.width < 599) {
    document.querySelector('meta[name="viewport"]').setAttribute("content", "width=600");
  }
  // Redirects users to previous location
  var url = sessionStorage.getItem("last");
  if (url) {
    location.assign(url);
    sessionStorage.removeItem("last");
  }
  // Presentation: fades in pages on load
  if (document.getElementsByTagName("main")[0]) {
    document.getElementsByTagName("main")[0].setAttribute("class", "fadein");
  }
  if (document.getElementById("masthead")) {
    document.getElementById("masthead").setAttribute("class", "fadein");
  }
  //Tracks user intent prior to sign in
  if (sessionStorage.getItem('sub') == 1) { // intended to subscribe
    Shipping.collectUserAddress();
    sessionStorage.removeItem('sub');
  }
  if (sessionStorage.getItem('sub') == 0) { // intended to un-subscribe
    Subscriptions.removeCheck();
    sessionStorage.removeItem('sub');
  }
  //LISTENERS
  if (document.getElementById('menu-icon')) {
    document.getElementById('menu-icon').addEventListener('mouseover', function () {
      var a = this;
      Boxeon.toggleMenuRed(a);
    });
  }
  if (document.getElementById('menu-icon')) {
    document.getElementById('menu-icon').addEventListener('mouseout', function () {
      var a = this;
      Boxeon.toggleMenuBlack(a);
    });
  }
  if (document.getElementById('image-next-arrow')) {
    document.getElementById('image-next-arrow').addEventListener('mouseover', function () {
      var a = this;
      Boxeon.toggleArrowRed(a);
    });
  }
  if (document.getElementById('image-next-arrow')) {
    document.getElementById('image-next-arrow').addEventListener('mouseout', function () {
      var a = this;
      Boxeon.toggleArrowBlack(a);
    });
  }
  if (document.getElementById('image-previous-arrow')) {
    document.getElementById('image-previous-arrow').addEventListener('mouseover', function () {
      var a = this;
      Boxeon.toggleArrowRed(a);
    });
  }
  if (document.getElementById('image-previous-arrow')) {
    document.getElementById('image-previous-arrow').addEventListener('mouseout', function () {
      var a = this;
      Boxeon.toggleArrowBlack(a);
    });
  }

  if (document.getElementById('show-recommended')) {
    document.getElementById('show-subscriptions').addEventListener('click', function () {
      Subscriptions.showSubscriptions();
    });
    document.getElementById('show-recommended').addEventListener('click', function () {
      Subscriptions.showRecommended();
    });
    document.getElementById('show-subscriptions').addEventListener('click', function () {
      Subscriptions.showSubscriptions();
    });
  }
  if (document.getElementById('play-video')) {
    document.getElementById('play-video').addEventListener('click', function () {
      var id = this.getAttribute("data-video-id");
      Boxeon.playVideo(id);
    });
  }
  document.getElementById('menu-icon').addEventListener('click', function () {
    Boxeon.menu();
    var a = this;
    Boxeon.toggleMenuBlack(a);
  });
  document.getElementById('signout').addEventListener('click', function () {
    Boxeon.signOut();
  });
  document.getElementsByClassName('menu-close')[0].addEventListener('click', function () {
    Boxeon.closeMenu();

  });
  if (document.getElementsByClassName('switch-plan')) {
    var radios = document.getElementsByClassName('switch-plan');
    for (var i = 0; i < radios.length; i++) {
      radios[i].addEventListener('click', function () {
        Boxeon.switchPlan(this);
      });
    }
  }


  // Google Analytics
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-211880503-1');

  // LiveChat
  window.__lc = window.__lc || {};
  window.__lc.license = 13262328;;
  (function (n, t, c) {
    function i(n) {
      return e._h ? e._h.apply(null, n) : e._q.push(n)
    }
    var e = {
      _q: [],
      _h: null,
      _v: "2.0",
      on: function () {
        i(["on", c.call(arguments)])
      },
      once: function () {
        i(["once", c.call(arguments)])
      },
      off: function () {
        i(["off", c.call(arguments)])
      },
      get: function () {
        if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
        return i(["get", c.call(arguments)])
      },
      call: function () {
        i(["call", c.call(arguments)])
      },
      init: function () {
        var n = t.createElement("script");
        n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head.appendChild(n)
      }
    };
    !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
  }(window, document, [].slice))

});
