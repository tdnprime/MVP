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
    sessionStorage.setItem("sub-freq", 1);
    return form;
  },


  /* SUBSCRIPTION CHECKOUT FLOW  **********/

  createSubsButton: function (creator_uid) {
    var wrapper = document.createElement("div");
    wrapper.id = "subs-btns";
    var btn = document.createElement("button");
    btn.id = 'exe-sub';
    sessionStorage.setItem("sub-creator-id", creator_uid);
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

    sessionStorage.setItem("sub-freq", frequency);

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

  menu: function () {

    if (screen.width <= 600) {

      document.getElementById("menu").style.width = "100%";

    } else {

      document.getElementById("menu").style.width = "300px";

    }


    if ( document.getElementById("main-wrapper")) {

      document.getElementById("main-wrapper").style.marginLeft = "300px";

    }
    if (document.getElementById("masthead")) {

      document.getElementById("masthead").style.marginLeft = "300px";

    }

    document.getElementsByTagName("header")[0].style.marginLeft = "300px";


  },

  signOut: function () {

    sessionStorage.clear();

  },

  closeMenu: function () {

    /* Return page to normal upon side navigation close */
    document.getElementById("menu").style.width = "0";

    if (document.getElementById("main-wrapper")) {

      document.getElementById("main-wrapper").style.marginLeft = null;
    }

    document.getElementsByTagName("footer")[0].style.marginLeft = null;

    document.getElementsByTagName("header")[0].style.marginLeft = null;

    if (document.getElementById("masthead")) {

      document.getElementById("masthead").style.marginLeft = null;

    }
  },

  router: function (a) {

    let URL = a.getAttribute("data-url");

    if (a.id == 'exe-sub' || a.id == 'exe-sub-alt' || a.id == 'play-video') {

      // In case of page reload
      if (a.id == 'exe-sub') {

        sessionStorage.setItem('sub', 1);

      } else if (a.className == 'exe-unsub clearbtn') {


        sessionStorage.setItem('sub', 0);

      }

      //  sessionStorage.setItem('sub', 1);

      var video_id = a.getAttribute("data-video-id");

      sessionStorage.setItem('sub-vid', video_id);

      var creator_id = a.getAttribute("data-id");

      sessionStorage.setItem('sub-cid', creator_id);

      // sub-creator-id is already set in sessionStorage
      sessionStorage.setItem("sub-total", a.getAttribute("data-total"));

      sessionStorage.setItem("sub-product", a.getAttribute("data-product"));

      sessionStorage.setItem("sub-in-stock", a.getAttribute("data-in-stock"));

      sessionStorage.setItem('sub-shipping', a.getAttribute("data-shipping"));

      sessionStorage.setItem('sub-version', a.getAttribute("data-version"));

      Auth.check(video_id, creator_id);

    } else if (a.className == 'exe-unsub clearbtn') {

      sessionStorage.setItem('sub', 0); // in case of page reload

      Subscriptions.unsubCheck(a);

    }

    if (sessionStorage.getItem('sub') == 1) {
      // Save for later
      sessionStorage.setItem("sub-carrier", a.getAttribute("data-carrier"));

      sessionStorage.setItem("sub-rate", a.getAttribute("data-rate"));

      sessionStorage.setItem("sub-rate-id", a.getAttribute("data-rate-id"));

      sessionStorage.setItem("sub-shipment", a.getAttribute("data-shipment"));
    }

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

  collectUserAddress: function (creator_uid) {

    Boxeon.createModalWindow();

    Shipping.buildAddressInputForm(creator_uid);

  },

  buildAddressInputForm: function (creator_uid) {

    document.getElementById("mc-header").innerHTML =
      '<div class="asides width-auto"><div id="steps-line"></div><div id="steps-left">'
      + '<p class="step step-completed">L</p>'
      + '<p id="text-step0-label" class="centered">Schedule</p>'
      + '<p class="step step-current">2</p>'
      + '<p id="text-step1-label" class="centered">Shipping</p>'
      + '<p class="step step-incomplete">3</p>'
      + '<p id="text-step2-label" class="centered">Checkout</p>'
      + '</div></div>';

    document.getElementById("m-body").innerHTML =
      "<h2>2. Provide your address</h2><form id='checkout-address-form' onsubmit='return'>"
      + "<div class='row'><div class='col-75 centered'> <input type='text' name='given_name' placeHolder='Given name on your credit / debit card' required value=''></input>"
      + "<input type='text' name='family_name' placeHolder='Family name on your credit / debit card' required value=''></input>"

      + "<input type='text' name='address_line_1' placeHolder='Street address' required value=''></input>"
      + "<input type='text' name='address_line_2' placeHolder='Street address line 2 (optional)' value=''></input>"
      + "<input type='text' name='admin_area_2' required placeHolder='City' value=''></input>"
      + "<input type='text' name='admin_area_1' required placeHolder='State/Province' value=''></input>"
      + "<select required name='country_code' class='form-control' id='country'>"
      + "<option value='' invalid>Select your country </option>"
      + "<option value='US' label='United States'>United States</option>"
      + "<option value='GB' label='United Kingdom'>United Kingdom</option>"
      + "<option value='CA' label='Canada'>Canada</option>"
      + "<option value='BR' label='Brazil'>Brazil</option>"
      + "</select>"
      + "<input type='text' name='postal_code' required placeHolder='Postal code' value=''></input>"
      + "<input type='hidden' name='cpf' placeHolder='Cadastro de Pessoas Físicas' value='0'></input>"
      + "</fieldset><fieldset><br>"
      + "<input id='process-data' data-id='" + creator_uid + "' type='submit' value='Continue'></input>"
      + "</div></div>"
      + "</form>";

    var btn = document.getElementById("process-data");

    btn.addEventListener("click", function () {

      var f = this.parentNode.parentNode; // BAD

      var a = this;
      a.disabled = "true";

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

        if (value == "" && key !== "address_line_2") {

          let field = document.getElementsByName(key)[0];

          field.style.border = "red 1px solid";

          return;

        } else {

          Shipping.arr[key] = value;
        }
      }
    }

    var n = f.getElementsByTagName("select");

    for (var e = 0; e < n.length; e++) {

      if (n[e].getAttribute('name')) {

        var k = n[e].getAttribute('name');

        var v = n[e].value;

        if (v == "") {

          let field = document.getElementsByName(k)[0];

          field.style.border = "red 1px solid";

          return;

        } else {

          Shipping.arr[k] = v;

        }
      }
    }

    Shipping.arr['creator_id'] = sessionStorage.getItem('sub-creator-id');

    if (sessionStorage.getItem("sub-shipping") == 0) {

      Subscriptions.createBillingPlan();

    } else if (sessionStorage.getItem("sub-shipping") == 1) {


      Shipping.getRates();
    }

    return false;
  },

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

  buildRateCard: function (rates) {

    var wrapper = document.createElement("div");

    var num = rates.results.length;

    for (var i = 0; i < num; i++) {

      var div = document.createElement("div");

      var rate_plus = parseInt(rates.results[i].amount);

      var rate = document.createTextNode("$" + rate_plus);

      var p1 = document.createElement("h3");
      var p2 = document.createElement("h3");
      var p3 = document.createElement("h3");
      var img = document.createElement("img");
      img.className = "img-carrier";
      var button = document.createElement("button");
      var serviceLevelName = document.createTextNode(rates.results[i].servicelevel.name);
      var cta = document.createTextNode("Choose");

      div.className = "four-rows-grid margin-bottom-4-em";
      div.style.padding = "2em";
      div.style.backgroundColor = "#fff";

      img.src = rates.results[i].provider_image_200;
      button.setAttribute("sub-carrier", rates.results[i].provider);
      button.setAttribute("sub-rate", rate_plus);
      button.setAttribute("sub-shipment", rates.results[i].shipment);
      button.setAttribute("sub-rate-id", rates.results[i].object_id);
      button.appendChild(cta);

      div.appendChild(p1);
      p1.appendChild(img);
      div.appendChild(p2);
      p2.appendChild(serviceLevelName);
      div.appendChild(p3);
      p3.appendChild(rate);
      div.appendChild(button);

      button.addEventListener("click", function () {

        Shipping.rateSelected = this;

        Subscriptions.createBillingPlan();

      });
      wrapper.appendChild(div);
    }
    Shipping.showRates(wrapper);

  },
  showRates: function (div) {

    Boxeon.createModalWindow();

    document.getElementById("mc-header").innerHTML =
      '<div class="asides width-auto"><div id="steps-line"></div><div id="steps-left">'
      + '<p class="step step-completed">L</p>'
      + '<p id="text-step0-label" class="centered">Schedule</p>'
      + '<p class="step step-current">2</p>'
      + '<p id="text-step1-label" class="centered">Shipping</p>'
      + '<p class="step step-incomplete">3</p>'
      + '<p id="text-step2-label" class="centered">Checkout</p>'
      + '</div></div>'
      + "<h2>2. Choose a shipping rate</h2><br>";

    document.getElementById("m-body").appendChild(div);

    Boxeon.scrollToTop();

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
    button.addEventListener("click", function(){

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
        sessionStorage.clear();
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
    Shipping.arr['version'] = sessionStorage.getItem('sub-version');
    Shipping.arr['total'] = sessionStorage.getItem('sub-total');
    Shipping.arr['creator_id'] = sessionStorage.getItem('sub-creator-id');
    Shipping.arr['frequency'] = sessionStorage.getItem('sub-freq');
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
          sessionStorage.setItem("sub-plan_id", json['plan_id']);
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

    Boxeon.createModalWindow();

    document.getElementById("mc-header").innerHTML =

      '<div class="asides width-auto"><div id="steps-line"></div><div id="steps-left">'
      + '<p class="step step-completed">L</p>'
      + '<p id="text-step0-label" class="centered">Schedule</p>'
      + '<p class="step step-completed">L</p>'
      + '<p id="text-step1-label" class="centered">Shipping</p>'
      + '<p class="step step-current">3</p>'
      + '<p id="text-step2-label" class="centered">Checkout</p>'
      + '</div></div>'
      + "<h2>3. Checkout</h2><br>";


    var iframe = document.createElement('iframe');
    iframe.id = 'iframe-checkout';
    iframe.src = '/checkout/subscription';
    document.getElementById("m-body").appendChild(iframe);


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

  // Handles redirected users to a subscription box after they have signed in from a box page
  if (document.getElementById("box")) {
    //Tracks user intent prior to sign in
    if (sessionStorage.getItem('sub') == 1) { // intended to subscribe
      var vid = sessionStorage.getItem("sub-vid");
      var cid = sessionStorage.getItem("sub-cid");
      Boxeon.playVideo(vid, cid);
      sessionStorage.removeItem('sub-vid');
      sessionStorage.removeItem('sub-cid');
      sessionStorage.removeItem('last');
      sessionStorage.removeItem('sub');
    }
  }

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
  if (document.getElementById('menu-icon')) {
    document.getElementById('menu-icon').addEventListener('click', function () {
      Boxeon.menu();

    });
  }
  if (document.getElementById('signout')) {
    document.getElementById('signout').addEventListener('click', function () {
      Boxeon.signOut();
    });
  }
  if (document.getElementById('menu-close')) {

    document.getElementById('menu-close').addEventListener('click', function () {
      Boxeon.closeMenu();

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
  if (document.getElementsByClassName('play-video')) {
    let btns = document.getElementsByClassName('play-video');
    for (let i = 0; i < btns.length; i++) {
      btns[i].addEventListener('click', function () {
        let id = this.getAttribute('data-video-id');
        let video = Boxeon.createVideoHTML(id);
        this.parentNode.innerHTML = video;

      });
    }

  }
  if (document.getElementById('play-video')) {
    var btns = document.getElementsByClassName('playbtn');
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener('mouseover', function () {
        var a = this;
        Boxeon.changeImageOnMouseover(a, 'playbtn-red.png');

      });
    }
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
       form.scrollIntoView({behavior: 'smooth'});
      });
    }
  }
  if (document.getElementById('video-place-holder')) {
    var loc = document.getElementById('video-place-holder');
    loc.scrollIntoView({behavior: 'smooth'});
  }



  if (document.getElementById('play-video')) {
    var btns = document.getElementsByClassName('playbtn');
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener('mouseout', function () {
        var a = this;
        Boxeon.changeImageOnMouseover(a, 'playbtn.png');

      });
    }
  }

  if (document.getElementById('signin')) {
    document.getElementById('signin').addEventListener('click', function () {
      if (location.href == "https://boxeon.com/partner") {
        sessionStorage.setItem("last", "https://boxeon.com/partner");
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
        sessionStorage.setItem('recipient', id);
      });
    }
  }
  if (document.getElementById('form-message-store')) {
    let id = sessionStorage.getItem('recipient');
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

  if (document.getElementById('create-box')) {
    var opts = {
      className: "step step-incomplete",
      length: 3,
      label1: "Details",
      label2: "Embed video",
      label3: "Publish"
    }
    document.getElementById("prepend").prepend(Boxeon.createStepsLeft(opts));

    var el = "h2";
    var options = {
      msg: "1. Details",
      className: "primary-color centered"
    }
    document.getElementById("create-box").prepend(Boxeon.createElem(el, options));
    // create box form
    var preOrder = document.getElementById("pre-order");
    preOrder.addEventListener("change", function () {
      if (this.value == 1) {
        var specialOffer = document.getElementById("special-offer");
        specialOffer.style.display = "grid";
        var specialOffer = document.getElementsByClassName("special-offer");
        specialOffer[0].style.display = "block";
        // specialOffer[1].style.display = "block";
        specialOffer[0].removeAttribute("disabled");
      } else if (this.value == 0) {
        var specialOffer = document.getElementById("special-offer");
        specialOffer.style.display = "none";
        var specialOffer = document.getElementsByClassName("special-offer");
        specialOffer[0].style.display = "none";
        //specialOffer[1].style.display = "none";
        specialOffer[0].setAttribute("disabled", "disabled");
      }

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


//import instance from './modules/messages.js'
}

