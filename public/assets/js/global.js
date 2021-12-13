/* GLOBAL


NOTE: 
+ At the very bottom of this file
  are event listeners that are added upon page load.

TO DO:
+ Get Progress Bar to work accurately
+ Fix the subscription flow UX
+ Fix the unsubscribe flow UX
+ Proper error handling
+ Refactor with abstraction in mind

https://stackoverflow.com/questions/43954836/disabling-blackbars-on-youtube-embed-iframe
*/

// TABLE OF CONTENTS:

var Boxeon = Boxeon || {}; // A collection of functions
var Account = Account || {}; // Gets user account info
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
        // We will not use modal windows for 
        // error, success, or warning messages
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
  changeImageOnMouseover: function (img, src) {
    img.src = "../images/" + src;

  },
  playVideo: function (video_id, creator_uid) {

    Boxeon.createModalWindow();
    var mbody = document.getElementById("m-body");
    mbody.innerHTML = Boxeon.createVideoHTML(video_id);
    var mbodyNode = mbody.childNodes[0].parentNode;
    var el = "h2";
    var options = {
      msg: "1. Choose subscription schedule",
      className: "primary-color"
    }
    mbodyNode.appendChild(Boxeon.createElem(el, options));
    mbodyNode.appendChild(Boxeon.createPlanOptions());
    mbodyNode.appendChild(Boxeon.createSubsButton(creator_uid));
    var header = document.getElementById("mc-header");
    var opts = {
      className: "step step-incomplete",
      length: 3
    }
    header.appendChild(Boxeon.createStepsLeft(opts));
  },
  createVideoHTML: function (id) {
    return "<div id='remove-black-bar'><iframe src=https://www.youtube.com/embed/" + id + "?rel=0&autoplay=1&frameborder=0&mute=1></iframe></div>";

  },
  createStepsLeft: function (options) {
    var wrapper = Boxeon.createElem("div");
    wrapper.id = "steps-left";
    for (var i = 0; i < options.length; i++) {
      var span = Boxeon.createElem("p", options);
      if (i == 0) {
        span.className = "step step-current";
      }
      var number = document.createTextNode(i + 1);
      span.appendChild(number);
      wrapper.appendChild(span);
    }
    var line = document.createElement("div");
    line.id = "steps-line";
    var header = document.getElementById("mc-header");
    header.appendChild(line);
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
    var txt4 = document.createTextNode("Once");
    var radio1 = document.createElement("input");
    var radio2 = document.createElement("input");
    var radio3 = document.createElement("input");
    var radio4 = document.createElement("input");
    radio1.setAttribute("type", "radio");
    radio1.setAttribute("checked", "checked");
    radio2.setAttribute("type", "radio");
    radio3.setAttribute("type", "radio");
    radio4.setAttribute("type", "radio");
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
    radio3.value = 0;
    label1.appendChild(txt1);
    label2.appendChild(txt2);
    label3.appendChild(txt3);
    label4.appendChild(txt4);
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
    label4.appendChild(radio4);
    form.appendChild(label4);
    radio1.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    radio2.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    radio3.addEventListener('click', function () {
      Boxeon.switchPlan(this);
    });
    return form;
  },


  /* SUBSCRIPTION CHECKOUT FLOW  **********/

  createSubsButton: function (creator_uid) {
    var wrapper = document.createElement("div");
    wrapper.id = "subs-btns";
    var btn = document.createElement("button");
    btn.id = 'exe-sub';
    sessionStorage.setItem("sub-creator-id", creator_uid);
    btn.setAttribute("data-url", "URL");
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
    } catch (e) {
      //console.log(e);
    }
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
		  var m_window = document.getElementById("m-window")
      var m_content = document.getElementById("m-window").firstChild;
      m_content.remove();
      m_window.appendChild(mc);
    } else {
      document.getElementById("container").appendChild(m);
    }
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
    var frequency = a.value;
    sessionStorage.setItem("sub-frequency", frequency);

  },

  disable: function (f) {
    var inputs = f.parentNode.parentNode.parentNode.getElementsByClassName("optional");
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].setAttribute("disabled", 'disabled');
    }
  },

  menu: function () {
    /* When side navigation slides out, 
	set the width of the side navigation and 
	the left margin of MAIN + FOOTER */
    document.getElementById("menu").style.width = "300px";
    document.getElementsByTagName("main")[0].style.marginLeft = "300px";
    document.getElementsByTagName("footer")[0].style.marginLeft = "300px";
    document.getElementsByTagName("header")[0].style.marginLeft = "300px";
    document.getElementById("masthead").style.marginLeft = "300px";

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
    /* Return page to normal upon side navigation close */
    document.getElementById("menu").style.width = "0";
    document.getElementsByTagName("main")[0].style.marginLeft = "0";
    document.getElementsByTagName("footer")[0].style.marginLeft = "0";
    document.getElementsByTagName("header")[0].style.marginLeft = "0";
    document.getElementById("masthead").style.marginLeft = "0";
  },
  router: function (a) {

    let URL = a.getAttribute("data-url");
    if (a.id == 'exe-sub' || a.id == 'exe-sub-alt' || a.id == 'play-video') {
      // In case of page reload
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
        var video_id = a.getAttribute("data-video-id");
        var creator_id = a.getAttribute("data-id");
        // Save for later
        sessionStorage.setItem("sub-carrier", a.getAttribute("carrier"));
        sessionStorage.setItem("sub-rate", a.getAttribute("rate"));
        sessionStorage.setItem("sub-rate-id", a.getAttribute("rate-id"));
        sessionStorage.setItem("sub-shipment", a.getAttribute("shipment"));
        // Play video in UI
        Boxeon.playVideo(video_id, creator_id);
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

  collectUserAddress: function (creator_uid) {
    Boxeon.createModalWindow();
    Shipping.buildUI(creator_uid);
  },
  buildUI: function (creator_uid) {
    var data = {
      method: "POST",
      action: "../account/index.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "ADDR"
    }

    function callback(re) {
      Shipping.buildAddressInputForm(JSON.parse(re), creator_uid);
    }
    Boxeon.sendAjax(data, callback);

  },
  buildAddressInputForm: function (addr, creator_uid) {
    document.getElementById("mc-header").innerHTML =
      '<div id="steps-line"></div><div id="steps-left"><p class="step step-completed">L</p><p class="step step-current">2</p><p class="step step-incomplete">3</p></div>';
    document.getElementById("m-body").innerHTML =
      "<h2>2. Check if you qualify for a shipping  discount</h2><p>Please provide your address to continue.</p><form onsubmit='return'>"
      + "<fieldset><input type='text' name='name' placeHolder='Full name' required value='" + addr.fullname + "'></input>"
      + "<input type='text' name='address_line_1' placeHolder='Street address' required value='" + addr.address_line_1 + "'></input>"
      + "<input type='text' name='address_line_2' placeHolder='Street address line 2 (optional)' value='" + addr.address_line_2 + "'></input>"
      + "<input type='text' name='admin_area_2' required placeHolder='City' value='" + addr.admin_area_2 + "'></input>"
      + "<input type='text' name='admin_area_1' required placeHolder='State/Province' value='" + addr.admin_area_1 + "'></input>"
      + addr.country_code
      + "<input type='text' name='postal_code' required placeHolder='Postal code' value='" + addr.postal_code + "'></input></fieldset>"
      + "<input id='process-data' data-id='" + creator_uid + "' type='submit' value='Continue'></input>"
      + "</form>";
    var btn = document.getElementById("process-data");
    btn.addEventListener("click", function () {
      var f = this.parentNode;
      Shipping.processFormData(f);
      return;
    });

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
    Shipping.arr['creator_id'] = document.getElementById('process-data').getAttribute('data-id');
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
      Shipping.rate_card += "<div class='four-col-grid margin-bottom-4-em'><p><img src='" + rates.results[i].provider_image_200
        + "' width='75px' alt='Carrier'/></p><p>" + rates.results[i].servicelevel.name + '</p><p><b>$'
        + rate + "</b></p>"
        + "<button data-carrier='" + rates.results[i].provider + "'  data-shipment='" + rates.results[i].shipment + "' data-rate='" + rate + "' data-rate-id='" + rates.results[i].object_id + "' id='exe-sub'>Select</button></div>";

    }
    Shipping.showRates();

  },
  showRates: function () {
    document.getElementById('m-window').remove();
    Boxeon.createModalWindow();
    document.getElementById("mc-header").innerHTML =
      '<div id="steps-line"></div><div id="steps-left"><p class="step step-completed">L</p><p class="step step-completed">L</p><p class="step step-current">3</p></div>';
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
    Boxeon.createModalWindow();
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
      Boxeon.createModalWindow();
    }
    Boxeon.sendAjax(data, callback);
  },

  createBillingPlan: function (b) {
    var arr = {};
    arr['rate'] = sessionStorage.getItem('sub-rate');
    arr['shipment'] = sessionStorage.getItem('sub-shipment');
    arr['rate_id'] = sessionStorage.getItem('sub-rate-id');
    arr['carrier'] = sessionStorage.getItem('sub-carrier');
    arr['creator_id'] = sessionStorage.getItem('sub-creator-id');
    arr['frequency'] = sessionStorage.getItem('sub-frequency');

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
    Boxeon.createModalWindow();
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
    document.querySelector('meta[name="viewport"]').setAttribute("content", "width=500");
  }
  // Redirects users to previous location
  // after Google signin
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


  //LISTENERS

  /*if (document.getElementById('image-next-arrow')) {
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
  }*/
  if (document.getElementById('exe-sub')) {
    document.getElementById('exe-sub').addEventListener('click', function () {
      var a = this;
      Boxeon.router(a);
    });
  }
  if (document.getElementById('exe-sub-alt')) {
    document.getElementById('exe-sub-alt').addEventListener('click', function () {
      var a = this;
      Boxeon.router(a);
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
      /*   var id = this.getAttribute("data-video-id");
         Boxeon.playVideo(id);*/
      var a = this;
      Boxeon.router(a);
    });
  }
  document.getElementById('menu-icon').addEventListener('click', function () {
    Boxeon.menu();

  });
  document.getElementById('signout').addEventListener('click', function () {
    Boxeon.signOut();
  });
  document.getElementById('menu-close').addEventListener('click', function () {
    Boxeon.closeMenu();

  });
  /*  if (document.getElementsByClassName('switch-plan')) {
      var radios = document.getElementsByClassName('switch-plan');
      for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('click', function () {
          Boxeon.switchPlan(this);
        });
      }
    }*/
  if (document.getElementById('disable')) {

    document.getElementById('disable').addEventListener('click', function () {
      var a = this;
      Boxeon.disable(a);
    });
  }
  if (document.getElementById('play-video')) {

    document.getElementById('play-video').getElementsByClassName('playbtn')[0].addEventListener('mouseover', function () {
      var a = this;
      Boxeon.changeImageOnMouseover(a, 'playbtn-red.png');
    });
  }
  if (document.getElementById('play-video')) {

    document.getElementById('play-video').getElementsByClassName('playbtn')[0].addEventListener('mouseout', function () {
      var a = this;
      Boxeon.changeImageOnMouseover(a, 'playbtn.png');
    });
  }
  if (document.getElementById('removeDisabled')) {

    document.getElementById('removeDisabled').addEventListener('click', function () {
      var a = this;
      Boxeon.removeDisabled(a);
    });
  }
});
