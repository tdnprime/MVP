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


    if (document.getElementById("main-wrapper")) {

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
  colledShippingAddress:function(){

    var fieldset = document.getElementById("fieldset-billing-address");
    fieldset.style.display = "block";

    var elems = fieldset.getElementsByTagName("*");

    for (var i = 0; i < elems.length; i++) {

      elems[i].removeAttribute("disabled");

    }
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
      "<h2>2. Your shipping address</h2><form id='checkout-address-form' onsubmit='return'>"
      + "<div class='row'><div class='col-75 centered'> <input type='text' name='given_name' placeHolder='Given name' required value=''></input>"
      + "<input type='text' name='family_name' placeHolder='Family name' required value=''></input>"
      + "<input type='text' name='address_line_1' placeHolder='Street address' required value=''></input>"
      + "<input type='text' name='address_line_2' placeHolder='Street address line 2 (optional)' value=''></input>"
      + "<input type='text' name='admin_area_2' required placeHolder='City' value=''></input>"
      + "<input type='text' name='admin_area_1' required placeHolder='State/Province' value=''></input>"
      + "<select required name='country_code' class='form-control' id='country'>"
      + "<option value='' invalid>Select your country </option>"
      + "<optgroup id='country-optgroup-Africa' label='Africa'>"
      + "<option value='DZ' label='Algeria'>Algeria</option>"
      + "<option value='AO' label='Angola'>Angola</option>"
      + "<option value='BJ' label='Benin'>Benin</option>"
      + "<option value='BW' label='Botswana'>Botswana</option>"
      + "<option value='BF' label='Burkina Faso'>Burkina Faso</option>"
      + "<option value='BI' label='Burundi'>Burundi</option>"
      + "<option value='CM' label='Cameroon'>Cameroon</option>"
      + "<option value='CV' label='Cape Verde'>Cape Verde</option>"
      + "<option value='CF' label='Central African Republic'>Central African Republic</option>"
      + "<option value='TD' label='Chad'>Chad</option>"
      + "<option value='KM' label='Comoros'>Comoros</option>"
      + "<option value='CG' label='Congo - Brazzaville'>Congo - Brazzaville</option>"
      + "<option value='CD' label='Congo - Kinshasa'>Congo - Kinshasa</option>"
      + "<option value='CI' label='Côte d’Ivoire'>Côte d’Ivoire</option>"
      + "<option value='DJ' label='Djibouti'>Djibouti</option>"
      + "<option value='EG' label='Egypt'>Egypt</option>"
      + "<option value='GQ' label='Equatorial Guinea'>Equatorial Guinea</option>"
      + "<option value='ER' label='Eritrea'>Eritrea</option>"
      + "<option value='ET' label='Ethiopia'>Ethiopia</option>"
      + "<option value='GA' label='Gabon'>Gabon</option>"
      + "<option value='GM' label='Gambia'>Gambia</option>"
      + "<option value='GH' label='Ghana'>Ghana</option>"
      + "<option value='GN' label='Guinea'>Guinea</option>"
      + "<option value='GW' label='Guinea-Bissau'>Guinea-Bissau</option>"
      + "<option value='KE' label='Kenya'>Kenya</option>"
      + "<option value='LS' label='Lesotho'>Lesotho</option>"
      + "<option value='LR' label='Liberia'>Liberia</option>"
      + "<option value='LY' label='Libya'>Libya</option>"
      + "<option value='MG' label='Madagascar'>Madagascar</option>"
      + "<option value='MW' label='Malawi'>Malawi</option>"
      + "<option value='ML' label='Mali'>Mali</option>"
      + "<option value='MR' label='Mauritania'>Mauritania</option>"
      + "<option value='MU' label='Mauritius'>Mauritius</option>"
      + "<option value='YT' label='Mayotte'>Mayotte</option>"
      + "<option value='MA' label='Morocco'>Morocco</option>"
      + "<option value='MZ' label='Mozambique'>Mozambique</option>"
      + "<option value='NA' label='Namibia'>Namibia</option>"
      + "<option value='NE' label='Niger'>Niger</option>"
      + "<option value='NG' label='Nigeria'>Nigeria</option>"
      + "<option value='RW' label='Rwanda'>Rwanda</option>"
      + "<option value='RE' label='Réunion'>Réunion</option>"
      + "<option value='SH' label='Saint Helena'>Saint Helena</option>"
      + "<option value='SN' label='Senegal'>Senegal</option>"
      + "<option value='SC' label='Seychelles'>Seychelles</option>"
      + "<option value='SL' label='Sierra Leone'>Sierra Leone</option>"
      + "<option value='SO' label='Somalia'>Somalia</option>"
      + "<option value='ZA' label='South Africa'>South Africa</option>"
      + "<option value='SD' label='Sudan'>Sudan</option>"
      + "<option value='SZ' label='Swaziland'>Swaziland</option>"
      + "<option value='ST' label='São Tomé and Príncipe'>São Tomé and Príncipe</option>"
      + "<option value='TZ' label='Tanzania'>Tanzania</option>"
      + "<option value='TG' label='Togo'>Togo</option>"
      + "<option value='TN' label='Tunisia'>Tunisia</option>"
      + "<option value='UG' label='Uganda'>Uganda</option>"
      + "<option value='EH' label='Western Sahara'>Western Sahara</option>"
      + "<option value='ZM' label='Zambia'>Zambia</option>"
      + "<option value='ZW' label='Zimbabwe'>Zimbabwe</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Americas' label='Americas'>"
      + "<option value='AI' label='Anguilla'>Anguilla</option>"
      + "<option value='AG' label='Antigua and Barbuda'>Antigua and Barbuda</option>"
      + "<option value='AR' label='Argentina'>Argentina</option>"
      + "<option value='AW' label='Aruba'>Aruba</option>"
      + "<option value='BS' label='Bahamas'>Bahamas</option>"
      + "<option value='BB' label='Barbados'>Barbados</option>"
      + "<option value='BZ' label='Belize'>Belize</option>"
      + "<option value='BM' label='Bermuda'>Bermuda</option>"
      + "<option value='BO' label='Bolivia'>Bolivia</option>"
      + "<option value='BR' label='Brazil'>Brazil</option>"
      + "<option value='VG' label='British Virgin Islands'>British Virgin Islands</option>"
      + "<option value='CA' label='Canada'>Canada</option>"
      + "<option value='KY' label='Cayman Islands'>Cayman Islands</option>"
      + "<option value='CL' label='Chile'>Chile</option>"
      + "<option value='CO' label='Colombia'>Colombia</option>"
      + "<option value='CR' label='Costa Rica'>Costa Rica</option>"
      + "<option value='CU' label='Cuba'>Cuba</option>"
      + "<option value='DM' label='Dominica'>Dominica</option>"
      + "<option value='DO' label='Dominican Republic'>Dominican Republic</option>"
      + "<option value='EC' label='Ecuador'>Ecuador</option>"
      + "<option value='SV' label='El Salvador'>El Salvador</option>"
      + "<option value='FK' label='Falkland Islands'>Falkland Islands</option>"
      + "<option value='GF' label='French Guiana'>French Guiana</option>"
      + "<option value='GL' label='Greenland'>Greenland</option>"
      + "<option value='GD' label='Grenada'>Grenada</option>"
      + "<option value='GP' label='Guadeloupe'>Guadeloupe</option>"
      + "<option value='GT' label='Guatemala'>Guatemala</option>"
      + "<option value='GY' label='Guyana'>Guyana</option>"
      + "<option value='HT' label='Haiti'>Haiti</option>"
      + "<option value='HN' label='Honduras'>Honduras</option>"
      + "<option value='JM' label='Jamaica'>Jamaica</option>"
      + "<option value='MQ' label='Martinique'>Martinique</option>"
      + "<option value='MX' label='Mexico'>Mexico</option>"
      + "<option value='MS' label='Montserrat'>Montserrat</option>"
      + "<option value='AN' label='Netherlands Antilles'>Netherlands Antilles</option>"
      + "<option value='NI' label='Nicaragua'>Nicaragua</option>"
      + "<option value='PA' label='Panama'>Panama</option>"
      + "<option value='PY' label='Paraguay'>Paraguay</option>"
      + "<option value='PE' label='Peru'>Peru</option>"
      + "<option value='PR' label='Puerto Rico'>Puerto Rico</option>"
      + "<option value='BL' label='Saint Barthélemy'>Saint Barthélemy</option>"
      + "<option value='KN' label='Saint Kitts and Nevis'>Saint Kitts and Nevis</option>"
      + "<option value='LC' label='Saint Lucia'>Saint Lucia</option>"
      + "<option value='MF' label='Saint Martin'>Saint Martin</option>"
      + "<option value='PM' label='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option>"
      + "<option value='VC' label='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option>"
      + "<option value='SR' label='Suriname'>Suriname</option>"
      + "<option value='TT' label='Trinidad and Tobago'>Trinidad and Tobago</option>"
      + "<option value='TC' label='Turks and Caicos Islands'>Turks and Caicos Islands</option>"
      + "<option value='VI' label='U.S. Virgin Islands'>U.S. Virgin Islands</option>"
      + "<option value='US' label='United States'>United States</option>"
      + "<option value='UY' label='Uruguay'>Uruguay</option>"
      + "<option value='VE' label='Venezuela'>Venezuela</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Asia' label='Asia'>"
      + "<option value='AF' label='Afghanistan'>Afghanistan</option>"
      + "<option value='AM' label='Armenia'>Armenia</option>"
      + "<option value='AZ' label='Azerbaijan'>Azerbaijan</option>"
      + "<option value='BH' label='Bahrain'>Bahrain</option>"
      + "<option value='BD' label='Bangladesh'>Bangladesh</option>"
      + "<option value='BT' label='Bhutan'>Bhutan</option>"
      + "<option value='BN' label='Brunei'>Brunei</option>"
      + "<option value='KH' label='Cambodia'>Cambodia</option>"
      + "<option value='CN' label='China'>China</option>"
      + "<option value='CY' label='Cyprus'>Cyprus</option>"
      + "<option value='GE' label='Georgia'>Georgia</option>"
      + "<option value='HK' label='Hong Kong SAR China'>Hong Kong SAR China</option>"
      + "<option value='IN' label='India'>India</option>"
      + "<option value='ID' label='Indonesia'>Indonesia</option>"
      + "<option value='IR' label='Iran'>Iran</option>"
      + "<option value='IQ' label='Iraq'>Iraq</option>"
      + "<option value='IL' label='Israel'>Israel</option>"
      + "<option value='JP' label='Japan'>Japan</option>"
      + "<option value='JO' label='Jordan'>Jordan</option>"
      + "<option value='KZ' label='Kazakhstan'>Kazakhstan</option>"
      + "<option value='KW' label='Kuwait'>Kuwait</option>"
      + "<option value='KG' label='Kyrgyzstan'>Kyrgyzstan</option>"
      + "<option value='LA' label='Laos'>Laos</option>"
      + "<option value='LB' label='Lebanon'>Lebanon</option>"
      + "<option value='MO' label='Macau SAR China'>Macau SAR China</option>"
      + "<option value='MY' label='Malaysia'>Malaysia</option>"
      + "<option value='MV' label='Maldives'>Maldives</option>"
      + "<option value='MN' label='Mongolia'>Mongolia</option>"
      + "<option value='MM' label='Myanmar [Burma]'>Myanmar [Burma]</option>"
      + "<option value='NP' label='Nepal'>Nepal</option>"
      + "<option value='NT' label='Neutral Zone'>Neutral Zone</option>"
      + "<option value='KP' label='North Korea'>North Korea</option>"
      + "<option value='OM' label='Oman'>Oman</option>"
      + "<option value='PK' label='Pakistan'>Pakistan</option>"
      + "<option value='PS' label='Palestinian Territories'>Palestinian Territories</option>"
      + "<option value='YD' label='People's Democratic Republic of Yemen'>People's Democratic Republic of Yemen</option>"
      + "<option value='PH' label='Philippines'>Philippines</option>"
      + "<option value='QA' label='Qatar'>Qatar</option>"
      + "<option value='SA' label='Saudi Arabia'>Saudi Arabia</option>"
      + "<option value='SG' label='Singapore'>Singapore</option>"
      + "<option value='KR' label='South Korea'>South Korea</option>"
      + "<option value='LK' label='Sri Lanka'>Sri Lanka</option>"
      + "<option value='SY' label='Syria'>Syria</option>"
      + "<option value='TW' label='Taiwan'>Taiwan</option>"
      + "<option value='TJ' label='Tajikistan'>Tajikistan</option>"
      + "<option value='TH' label='Thailand'>Thailand</option>"
      + "<option value='TL' label='Timor-Leste'>Timor-Leste</option>"
      + "<option value='TR' label='Turkey'>Turkey</option>"
      + "<option value='TM' label='Turkmenistan'>Turkmenistan</option>"
      + "<option value='AE' label='United Arab Emirates'>United Arab Emirates</option>"
      + "<option value='UZ' label='Uzbekistan'>Uzbekistan</option>"
      + "<option value='VN' label='Vietnam'>Vietnam</option>"
      + "<option value='YE' label='Yemen'>Yemen</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Europe' label='Europe'>"
      + "<option value='AL' label='Albania'>Albania</option>"
      + "<option value='AD' label='Andorra'>Andorra</option>"
      + "<option value='AT' label='Austria'>Austria</option>"
      + "<option value='BY' label='Belarus'>Belarus</option>"
      + "<option value='BE' label='Belgium'>Belgium</option>"
      + "<option value='BA' label='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>"
      + "<option value='BG' label='Bulgaria'>Bulgaria</option>"
      + "<option value='HR' label='Croatia'>Croatia</option>"
      + "<option value='CY' label='Cyprus'>Cyprus</option>"
      + "<option value='CZ' label='Czech Republic'>Czech Republic</option>"
      + "<option value='DK' label='Denmark'>Denmark</option>"
      + "<option value='DD' label='East Germany'>East Germany</option>"
      + "<option value='EE' label='Estonia'>Estonia</option>"
      + "<option value='FO' label='Faroe Islands'>Faroe Islands</option>"
      + "<option value='FI' label='Finland'>Finland</option>"
      + "<option value='FR' label='France'>France</option>"
      + "<option value='DE' label='Germany'>Germany</option>"
      + "<option value='GI' label='Gibraltar'>Gibraltar</option>"
      + "<option value='GR' label='Greece'>Greece</option>"
      + "<option value='GG' label='Guernsey'>Guernsey</option>"
      + "<option value='HU' label='Hungary'>Hungary</option>"
      + "<option value='IS' label='Iceland'>Iceland</option>"
      + "<option value='IE' label='Ireland'>Ireland</option>"
      + "<option value='IM' label='Isle of Man'>Isle of Man</option>"
      + "<option value='IT' label='Italy'>Italy</option>"
      + "<option value='JE' label='Jersey'>Jersey</option>"
      + "<option value='LV' label='Latvia'>Latvia</option>"
      + "<option value='LI' label='Liechtenstein'>Liechtenstein</option>"
      + "<option value='LT' label='Lithuania'>Lithuania</option>"
      + "<option value='LU' label='Luxembourg'>Luxembourg</option>"
      + "<option value='MK' label='Macedonia'>Macedonia</option>"
      + "<option value='MT' label='Malta'>Malta</option>"
      + "<option value='FX' label='Metropolitan France'>Metropolitan France</option>"
      + "<option value='MD' label='Moldova'>Moldova</option>"
      + "<option value='MC' label='Monaco'>Monaco</option>"
      + "<option value='ME' label='Montenegro'>Montenegro</option>"
      + "<option value='NL' label='Netherlands'>Netherlands</option>"
      + "<option value='NO' label='Norway'>Norway</option>"
      + "<option value='PL' label='Poland'>Poland</option>"
      + "<option value='PT' label='Portugal'>Portugal</option>"
      + "<option value='RO' label='Romania'>Romania</option>"
      + "<option value='RU' label='Russia'>Russia</option>"
      + "<option value='SM' label='San Marino'>San Marino</option>"
      + "<option value='RS' label='Serbia'>Serbia</option>"
      + "<option value='CS' label='Serbia and Montenegro'>Serbia and Montenegro</option>"
      + "<option value='SK' label='Slovakia'>Slovakia</option>"
      + "<option value='SI' label='Slovenia'>Slovenia</option>"
      + "<option value='ES' label='Spain'>Spain</option>"
      + "<option value='SJ' label='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option>"
      + "<option value='SE' label='Sweden'>Sweden</option>"
      + "<option value='CH' label='Switzerland'>Switzerland</option>"
      + "<option value='UA' label='Ukraine'>Ukraine</option>"
      + "<option value='SU' label='Union of Soviet Socialist Republics'>Union of Soviet Socialist Republics</option>"
      + "<option value='GB' label='United Kingdom'>United Kingdom</option>"
      + "<option value='VA' label='Vatican City'>Vatican City</option>"
      + "<option value='AX' label='Åland Islands'>Åland Islands</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Oceania' label='Oceania'>"
      + "<option value='AS' label='American Samoa'>American Samoa</option>"
      + "<option value='AQ' label='Antarctica'>Antarctica</option>"
      + "<option value='AU' label='Australia'>Australia</option>"
      + "<option value='BV' label='Bouvet Island'>Bouvet Island</option>"
      + "<option value='IO' label='British Indian Ocean Territory'>British Indian Ocean Territory</option>"
      + "<option value='CX' label='Christmas Island'>Christmas Island</option>"
      + "<option value='CC' label='Cocos [Keeling] Islands'>Cocos [Keeling] Islands</option>"
      + "<option value='CK' label='Cook Islands'>Cook Islands</option>"
      + "<option value='FJ' label='Fiji'>Fiji</option>"
      + "<option value='PF' label='French Polynesia'>French Polynesia</option>"
      + "<option value='TF' label='French Southern Territories'>French Southern Territories</option>"
      + "<option value='GU' label='Guam'>Guam</option>"
      + "<option value='HM' label='Heard Island and McDonald Islands'>Heard Island and McDonald Islands</option>"
      + "<option value='KI' label='Kiribati'>Kiribati</option>"
      + "<option value='MH' label='Marshall Islands'>Marshall Islands</option>"
      + "<option value='FM' label='Micronesia'>Micronesia</option>"
      + "<option value='NR' label='Nauru'>Nauru</option>"
      + "<option value='NC' label='New Caledonia'>New Caledonia</option>"
      + "<option value='NZ' label='New Zealand'>New Zealand</option>"
      + "<option value='NU' label='Niue'>Niue</option>"
      + "<option value='NF' label='Norfolk Island'>Norfolk Island</option>"
      + "<option value='MP' label='Northern Mariana Islands'>Northern Mariana Islands</option>"
      + "<option value='PW' label='Palau'>Palau</option>"
      + "<option value='PG' label='Papua New Guinea'>Papua New Guinea</option>"
      + "<option value='PN' label='Pitcairn Islands'>Pitcairn Islands</option>"
      + "<option value='WS' label='Samoa'>Samoa</option>"
      + "<option value='SB' label='Solomon Islands'>Solomon Islands</option>"
      + "<option value='GS' label='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option>"
      + "<option value='TK' label='Tokelau'>Tokelau</option>"
      + "<option value='TO' label='Tonga'>Tonga</option>"
      + "<option value='TV' label='Tuvalu'>Tuvalu</option>"
      + "<option value='UM' label='U.S. Minor Outlying Islands'>U.S. Minor Outlying Islands</option>"
      + "<option value='VU' label='Vanuatu'>Vanuatu</option>"
      + "<option value='WF' label='Wallis and Futuna'>Wallis and Futuna</option>"
      + "</optgroup>"
      + "</select>"
      + "<input type='text' name='postal_code' required placeHolder='Postal code' value=''></input>"
      + "<input type='text' maxlength='11' name='cpf' placeHolder='Brazil CPF (optional)' value=''></input>"
      + "<fieldset class='no-float'><br><label class='centered'>Is your shipping and billing address the same?</label><label>Yes"
      + "<input class='centered' type='radio' name='billing' value='1'></input></label>"
      + "<label>No <input id='show' class='centered' type='radio' name='billing' value='0'></input></label></fieldset>"
      + "<fieldset>"
    
      +"<fieldset id='fieldset-billing-address'>"
      +"<h2>Provide billing details</h2>"
      +"<p class='centered'>Enter the billing info associated with the card you'll use in Checkout.</p>"
      +"<input disabled type='text' name='billing_given_name' placeHolder='Given name'   value=''></input>"
      + "<input  disabled type='text' name='billing_family_name' placeHolder='Family name'   value=''></input>"
      + "<input  disabled type='text' name='billing_address_line_1' placeHolder='Street address'   value=''></input>"
      + "<input  disabled type='text' name='billing_address_line_2' placeHolder='Street address line 2 (optional)' value=''></input>"
      + "<input  disabled type='text' name='billing_admin_area_2'   placeHolder='City' value=''></input>"
      + "<input  disabled type='text' name='billing_admin_area_1'   placeHolder='State/Province' value=''></input>"
      + "<select  disabled   name='billing_country_code' class='form-control' id='country'>"
      + "<option  disabled value='' invalid>Select your country </option>"
      + "<optgroup  id='country-optgroup-Africa' label='Africa'>"
      + "<option value='DZ' label='Algeria'>Algeria</option>"
      + "<option value='AO' label='Angola'>Angola</option>"
      + "<option value='BJ' label='Benin'>Benin</option>"
      + "<option value='BW' label='Botswana'>Botswana</option>"
      + "<option value='BF' label='Burkina Faso'>Burkina Faso</option>"
      + "<option value='BI' label='Burundi'>Burundi</option>"
      + "<option value='CM' label='Cameroon'>Cameroon</option>"
      + "<option value='CV' label='Cape Verde'>Cape Verde</option>"
      + "<option value='CF' label='Central African Republic'>Central African Republic</option>"
      + "<option value='TD' label='Chad'>Chad</option>"
      + "<option value='KM' label='Comoros'>Comoros</option>"
      + "<option value='CG' label='Congo - Brazzaville'>Congo - Brazzaville</option>"
      + "<option value='CD' label='Congo - Kinshasa'>Congo - Kinshasa</option>"
      + "<option value='CI' label='Côte d’Ivoire'>Côte d’Ivoire</option>"
      + "<option value='DJ' label='Djibouti'>Djibouti</option>"
      + "<option value='EG' label='Egypt'>Egypt</option>"
      + "<option value='GQ' label='Equatorial Guinea'>Equatorial Guinea</option>"
      + "<option value='ER' label='Eritrea'>Eritrea</option>"
      + "<option value='ET' label='Ethiopia'>Ethiopia</option>"
      + "<option value='GA' label='Gabon'>Gabon</option>"
      + "<option value='GM' label='Gambia'>Gambia</option>"
      + "<option value='GH' label='Ghana'>Ghana</option>"
      + "<option value='GN' label='Guinea'>Guinea</option>"
      + "<option value='GW' label='Guinea-Bissau'>Guinea-Bissau</option>"
      + "<option value='KE' label='Kenya'>Kenya</option>"
      + "<option value='LS' label='Lesotho'>Lesotho</option>"
      + "<option value='LR' label='Liberia'>Liberia</option>"
      + "<option value='LY' label='Libya'>Libya</option>"
      + "<option value='MG' label='Madagascar'>Madagascar</option>"
      + "<option value='MW' label='Malawi'>Malawi</option>"
      + "<option value='ML' label='Mali'>Mali</option>"
      + "<option value='MR' label='Mauritania'>Mauritania</option>"
      + "<option value='MU' label='Mauritius'>Mauritius</option>"
      + "<option value='YT' label='Mayotte'>Mayotte</option>"
      + "<option value='MA' label='Morocco'>Morocco</option>"
      + "<option value='MZ' label='Mozambique'>Mozambique</option>"
      + "<option value='NA' label='Namibia'>Namibia</option>"
      + "<option value='NE' label='Niger'>Niger</option>"
      + "<option value='NG' label='Nigeria'>Nigeria</option>"
      + "<option value='RW' label='Rwanda'>Rwanda</option>"
      + "<option value='RE' label='Réunion'>Réunion</option>"
      + "<option value='SH' label='Saint Helena'>Saint Helena</option>"
      + "<option value='SN' label='Senegal'>Senegal</option>"
      + "<option value='SC' label='Seychelles'>Seychelles</option>"
      + "<option value='SL' label='Sierra Leone'>Sierra Leone</option>"
      + "<option value='SO' label='Somalia'>Somalia</option>"
      + "<option value='ZA' label='South Africa'>South Africa</option>"
      + "<option value='SD' label='Sudan'>Sudan</option>"
      + "<option value='SZ' label='Swaziland'>Swaziland</option>"
      + "<option value='ST' label='São Tomé and Príncipe'>São Tomé and Príncipe</option>"
      + "<option value='TZ' label='Tanzania'>Tanzania</option>"
      + "<option value='TG' label='Togo'>Togo</option>"
      + "<option value='TN' label='Tunisia'>Tunisia</option>"
      + "<option value='UG' label='Uganda'>Uganda</option>"
      + "<option value='EH' label='Western Sahara'>Western Sahara</option>"
      + "<option value='ZM' label='Zambia'>Zambia</option>"
      + "<option value='ZW' label='Zimbabwe'>Zimbabwe</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Americas' label='Americas'>"
      + "<option value='AI' label='Anguilla'>Anguilla</option>"
      + "<option value='AG' label='Antigua and Barbuda'>Antigua and Barbuda</option>"
      + "<option value='AR' label='Argentina'>Argentina</option>"
      + "<option value='AW' label='Aruba'>Aruba</option>"
      + "<option value='BS' label='Bahamas'>Bahamas</option>"
      + "<option value='BB' label='Barbados'>Barbados</option>"
      + "<option value='BZ' label='Belize'>Belize</option>"
      + "<option value='BM' label='Bermuda'>Bermuda</option>"
      + "<option value='BO' label='Bolivia'>Bolivia</option>"
      + "<option value='BR' label='Brazil'>Brazil</option>"
      + "<option value='VG' label='British Virgin Islands'>British Virgin Islands</option>"
      + "<option value='CA' label='Canada'>Canada</option>"
      + "<option value='KY' label='Cayman Islands'>Cayman Islands</option>"
      + "<option value='CL' label='Chile'>Chile</option>"
      + "<option value='CO' label='Colombia'>Colombia</option>"
      + "<option value='CR' label='Costa Rica'>Costa Rica</option>"
      + "<option value='CU' label='Cuba'>Cuba</option>"
      + "<option value='DM' label='Dominica'>Dominica</option>"
      + "<option value='DO' label='Dominican Republic'>Dominican Republic</option>"
      + "<option value='EC' label='Ecuador'>Ecuador</option>"
      + "<option value='SV' label='El Salvador'>El Salvador</option>"
      + "<option value='FK' label='Falkland Islands'>Falkland Islands</option>"
      + "<option value='GF' label='French Guiana'>French Guiana</option>"
      + "<option value='GL' label='Greenland'>Greenland</option>"
      + "<option value='GD' label='Grenada'>Grenada</option>"
      + "<option value='GP' label='Guadeloupe'>Guadeloupe</option>"
      + "<option value='GT' label='Guatemala'>Guatemala</option>"
      + "<option value='GY' label='Guyana'>Guyana</option>"
      + "<option value='HT' label='Haiti'>Haiti</option>"
      + "<option value='HN' label='Honduras'>Honduras</option>"
      + "<option value='JM' label='Jamaica'>Jamaica</option>"
      + "<option value='MQ' label='Martinique'>Martinique</option>"
      + "<option value='MX' label='Mexico'>Mexico</option>"
      + "<option value='MS' label='Montserrat'>Montserrat</option>"
      + "<option value='AN' label='Netherlands Antilles'>Netherlands Antilles</option>"
      + "<option value='NI' label='Nicaragua'>Nicaragua</option>"
      + "<option value='PA' label='Panama'>Panama</option>"
      + "<option value='PY' label='Paraguay'>Paraguay</option>"
      + "<option value='PE' label='Peru'>Peru</option>"
      + "<option value='PR' label='Puerto Rico'>Puerto Rico</option>"
      + "<option value='BL' label='Saint Barthélemy'>Saint Barthélemy</option>"
      + "<option value='KN' label='Saint Kitts and Nevis'>Saint Kitts and Nevis</option>"
      + "<option value='LC' label='Saint Lucia'>Saint Lucia</option>"
      + "<option value='MF' label='Saint Martin'>Saint Martin</option>"
      + "<option value='PM' label='Saint Pierre and Miquelon'>Saint Pierre and Miquelon</option>"
      + "<option value='VC' label='Saint Vincent and the Grenadines'>Saint Vincent and the Grenadines</option>"
      + "<option value='SR' label='Suriname'>Suriname</option>"
      + "<option value='TT' label='Trinidad and Tobago'>Trinidad and Tobago</option>"
      + "<option value='TC' label='Turks and Caicos Islands'>Turks and Caicos Islands</option>"
      + "<option value='VI' label='U.S. Virgin Islands'>U.S. Virgin Islands</option>"
      + "<option value='US' label='United States'>United States</option>"
      + "<option value='UY' label='Uruguay'>Uruguay</option>"
      + "<option value='VE' label='Venezuela'>Venezuela</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Asia' label='Asia'>"
      + "<option value='AF' label='Afghanistan'>Afghanistan</option>"
      + "<option value='AM' label='Armenia'>Armenia</option>"
      + "<option value='AZ' label='Azerbaijan'>Azerbaijan</option>"
      + "<option value='BH' label='Bahrain'>Bahrain</option>"
      + "<option value='BD' label='Bangladesh'>Bangladesh</option>"
      + "<option value='BT' label='Bhutan'>Bhutan</option>"
      + "<option value='BN' label='Brunei'>Brunei</option>"
      + "<option value='KH' label='Cambodia'>Cambodia</option>"
      + "<option value='CN' label='China'>China</option>"
      + "<option value='CY' label='Cyprus'>Cyprus</option>"
      + "<option value='GE' label='Georgia'>Georgia</option>"
      + "<option value='HK' label='Hong Kong SAR China'>Hong Kong SAR China</option>"
      + "<option value='IN' label='India'>India</option>"
      + "<option value='ID' label='Indonesia'>Indonesia</option>"
      + "<option value='IR' label='Iran'>Iran</option>"
      + "<option value='IQ' label='Iraq'>Iraq</option>"
      + "<option value='IL' label='Israel'>Israel</option>"
      + "<option value='JP' label='Japan'>Japan</option>"
      + "<option value='JO' label='Jordan'>Jordan</option>"
      + "<option value='KZ' label='Kazakhstan'>Kazakhstan</option>"
      + "<option value='KW' label='Kuwait'>Kuwait</option>"
      + "<option value='KG' label='Kyrgyzstan'>Kyrgyzstan</option>"
      + "<option value='LA' label='Laos'>Laos</option>"
      + "<option value='LB' label='Lebanon'>Lebanon</option>"
      + "<option value='MO' label='Macau SAR China'>Macau SAR China</option>"
      + "<option value='MY' label='Malaysia'>Malaysia</option>"
      + "<option value='MV' label='Maldives'>Maldives</option>"
      + "<option value='MN' label='Mongolia'>Mongolia</option>"
      + "<option value='MM' label='Myanmar [Burma]'>Myanmar [Burma]</option>"
      + "<option value='NP' label='Nepal'>Nepal</option>"
      + "<option value='NT' label='Neutral Zone'>Neutral Zone</option>"
      + "<option value='KP' label='North Korea'>North Korea</option>"
      + "<option value='OM' label='Oman'>Oman</option>"
      + "<option value='PK' label='Pakistan'>Pakistan</option>"
      + "<option value='PS' label='Palestinian Territories'>Palestinian Territories</option>"
      + "<option value='YD' label='People's Democratic Republic of Yemen'>People's Democratic Republic of Yemen</option>"
      + "<option value='PH' label='Philippines'>Philippines</option>"
      + "<option value='QA' label='Qatar'>Qatar</option>"
      + "<option value='SA' label='Saudi Arabia'>Saudi Arabia</option>"
      + "<option value='SG' label='Singapore'>Singapore</option>"
      + "<option value='KR' label='South Korea'>South Korea</option>"
      + "<option value='LK' label='Sri Lanka'>Sri Lanka</option>"
      + "<option value='SY' label='Syria'>Syria</option>"
      + "<option value='TW' label='Taiwan'>Taiwan</option>"
      + "<option value='TJ' label='Tajikistan'>Tajikistan</option>"
      + "<option value='TH' label='Thailand'>Thailand</option>"
      + "<option value='TL' label='Timor-Leste'>Timor-Leste</option>"
      + "<option value='TR' label='Turkey'>Turkey</option>"
      + "<option value='TM' label='Turkmenistan'>Turkmenistan</option>"
      + "<option value='AE' label='United Arab Emirates'>United Arab Emirates</option>"
      + "<option value='UZ' label='Uzbekistan'>Uzbekistan</option>"
      + "<option value='VN' label='Vietnam'>Vietnam</option>"
      + "<option value='YE' label='Yemen'>Yemen</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Europe' label='Europe'>"
      + "<option value='AL' label='Albania'>Albania</option>"
      + "<option value='AD' label='Andorra'>Andorra</option>"
      + "<option value='AT' label='Austria'>Austria</option>"
      + "<option value='BY' label='Belarus'>Belarus</option>"
      + "<option value='BE' label='Belgium'>Belgium</option>"
      + "<option value='BA' label='Bosnia and Herzegovina'>Bosnia and Herzegovina</option>"
      + "<option value='BG' label='Bulgaria'>Bulgaria</option>"
      + "<option value='HR' label='Croatia'>Croatia</option>"
      + "<option value='CY' label='Cyprus'>Cyprus</option>"
      + "<option value='CZ' label='Czech Republic'>Czech Republic</option>"
      + "<option value='DK' label='Denmark'>Denmark</option>"
      + "<option value='DD' label='East Germany'>East Germany</option>"
      + "<option value='EE' label='Estonia'>Estonia</option>"
      + "<option value='FO' label='Faroe Islands'>Faroe Islands</option>"
      + "<option value='FI' label='Finland'>Finland</option>"
      + "<option value='FR' label='France'>France</option>"
      + "<option value='DE' label='Germany'>Germany</option>"
      + "<option value='GI' label='Gibraltar'>Gibraltar</option>"
      + "<option value='GR' label='Greece'>Greece</option>"
      + "<option value='GG' label='Guernsey'>Guernsey</option>"
      + "<option value='HU' label='Hungary'>Hungary</option>"
      + "<option value='IS' label='Iceland'>Iceland</option>"
      + "<option value='IE' label='Ireland'>Ireland</option>"
      + "<option value='IM' label='Isle of Man'>Isle of Man</option>"
      + "<option value='IT' label='Italy'>Italy</option>"
      + "<option value='JE' label='Jersey'>Jersey</option>"
      + "<option value='LV' label='Latvia'>Latvia</option>"
      + "<option value='LI' label='Liechtenstein'>Liechtenstein</option>"
      + "<option value='LT' label='Lithuania'>Lithuania</option>"
      + "<option value='LU' label='Luxembourg'>Luxembourg</option>"
      + "<option value='MK' label='Macedonia'>Macedonia</option>"
      + "<option value='MT' label='Malta'>Malta</option>"
      + "<option value='FX' label='Metropolitan France'>Metropolitan France</option>"
      + "<option value='MD' label='Moldova'>Moldova</option>"
      + "<option value='MC' label='Monaco'>Monaco</option>"
      + "<option value='ME' label='Montenegro'>Montenegro</option>"
      + "<option value='NL' label='Netherlands'>Netherlands</option>"
      + "<option value='NO' label='Norway'>Norway</option>"
      + "<option value='PL' label='Poland'>Poland</option>"
      + "<option value='PT' label='Portugal'>Portugal</option>"
      + "<option value='RO' label='Romania'>Romania</option>"
      + "<option value='RU' label='Russia'>Russia</option>"
      + "<option value='SM' label='San Marino'>San Marino</option>"
      + "<option value='RS' label='Serbia'>Serbia</option>"
      + "<option value='CS' label='Serbia and Montenegro'>Serbia and Montenegro</option>"
      + "<option value='SK' label='Slovakia'>Slovakia</option>"
      + "<option value='SI' label='Slovenia'>Slovenia</option>"
      + "<option value='ES' label='Spain'>Spain</option>"
      + "<option value='SJ' label='Svalbard and Jan Mayen'>Svalbard and Jan Mayen</option>"
      + "<option value='SE' label='Sweden'>Sweden</option>"
      + "<option value='CH' label='Switzerland'>Switzerland</option>"
      + "<option value='UA' label='Ukraine'>Ukraine</option>"
      + "<option value='SU' label='Union of Soviet Socialist Republics'>Union of Soviet Socialist Republics</option>"
      + "<option value='GB' label='United Kingdom'>United Kingdom</option>"
      + "<option value='VA' label='Vatican City'>Vatican City</option>"
      + "<option value='AX' label='Åland Islands'>Åland Islands</option>"
      + "</optgroup>"
      + "<optgroup id='country-optgroup-Oceania' label='Oceania'>"
      + "<option value='AS' label='American Samoa'>American Samoa</option>"
      + "<option value='AQ' label='Antarctica'>Antarctica</option>"
      + "<option value='AU' label='Australia'>Australia</option>"
      + "<option value='BV' label='Bouvet Island'>Bouvet Island</option>"
      + "<option value='IO' label='British Indian Ocean Territory'>British Indian Ocean Territory</option>"
      + "<option value='CX' label='Christmas Island'>Christmas Island</option>"
      + "<option value='CC' label='Cocos [Keeling] Islands'>Cocos [Keeling] Islands</option>"
      + "<option value='CK' label='Cook Islands'>Cook Islands</option>"
      + "<option value='FJ' label='Fiji'>Fiji</option>"
      + "<option value='PF' label='French Polynesia'>French Polynesia</option>"
      + "<option value='TF' label='French Southern Territories'>French Southern Territories</option>"
      + "<option value='GU' label='Guam'>Guam</option>"
      + "<option value='HM' label='Heard Island and McDonald Islands'>Heard Island and McDonald Islands</option>"
      + "<option value='KI' label='Kiribati'>Kiribati</option>"
      + "<option value='MH' label='Marshall Islands'>Marshall Islands</option>"
      + "<option value='FM' label='Micronesia'>Micronesia</option>"
      + "<option value='NR' label='Nauru'>Nauru</option>"
      + "<option value='NC' label='New Caledonia'>New Caledonia</option>"
      + "<option value='NZ' label='New Zealand'>New Zealand</option>"
      + "<option value='NU' label='Niue'>Niue</option>"
      + "<option value='NF' label='Norfolk Island'>Norfolk Island</option>"
      + "<option value='MP' label='Northern Mariana Islands'>Northern Mariana Islands</option>"
      + "<option value='PW' label='Palau'>Palau</option>"
      + "<option value='PG' label='Papua New Guinea'>Papua New Guinea</option>"
      + "<option value='PN' label='Pitcairn Islands'>Pitcairn Islands</option>"
      + "<option value='WS' label='Samoa'>Samoa</option>"
      + "<option value='SB' label='Solomon Islands'>Solomon Islands</option>"
      + "<option value='GS' label='South Georgia and the South Sandwich Islands'>South Georgia and the South Sandwich Islands</option>"
      + "<option value='TK' label='Tokelau'>Tokelau</option>"
      + "<option value='TO' label='Tonga'>Tonga</option>"
      + "<option value='TV' label='Tuvalu'>Tuvalu</option>"
      + "<option value='UM' label='U.S. Minor Outlying Islands'>U.S. Minor Outlying Islands</option>"
      + "<option value='VU' label='Vanuatu'>Vanuatu</option>"
      + "<option value='WF' label='Wallis and Futuna'>Wallis and Futuna</option>"
      + "</optgroup>"
      + "</select>"
      + "<input  disabled type='text' name='billing_postal_code' placeHolder='Postal code' value=''></input>"
      +"</fieldset><br>"
      + "<input id='process-data' data-id='" + creator_uid + "' type='submit' value='Continue'></input></fieldset>"
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

    var radio = document.getElementById("show");
    radio.addEventListener("click", function () {
      Shipping.colledShippingAddress();

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

        }

        if (value == "" && key !== "cpf") {
         // var value = 0;
         // let field = document.getElementsByName(key)[0];
         // field.style.border = "red 1px solid";
         // return;

        } else {

          Shipping.arr[key] = value;
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
        form.scrollIntoView({ behavior: 'smooth' });
      });
    }
  }
  if (document.getElementById('video-place-holder')) {
    var loc = document.getElementById('video-place-holder');
    loc.scrollIntoView({ behavior: 'smooth' });
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
  if (document.getElementById('new-window')) {
    document.getElementById('new-window').addEventListener('click', function () {
      var newwindow = window.open(this.getAttribute('data-type-href'), 'mywin', 'height=200,width=150');
      if (window.focus) { newwindow.focus() }

      return false;
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

