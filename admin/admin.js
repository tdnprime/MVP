// ADMIN JavaScript

var Functions = Functions || {}; 
Functions = {
  sendAjax: function (data, back) {
    var xhttp = new XMLHttpRequest();
    xhttp.open(data.method, data.action, true);
    xhttp.setRequestHeader('Content-type', data.contentType);
    xhttp.setRequestHeader(data.customHeader, data.payload, false);
    xhttp.send();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 0) {
       // Boxeon.progressBar(25);
      } else if (this.readyState == 2) {

       // Boxeon.progressBar(50);
      } else if (this.readyState == 3) {
       // Boxeon.progressBar(75);
      } else if (this.readyState == 4 && this.status == 200) {
        back(this.responseText);
        //Boxeon.progressBar(101);

      } else {

        alert("Sorry! An error occured. Please try again.");
      }
    }

  },
  bulkValidate: function () {
    var data = {
      method: "POST",
      action: "../admin/validate-emails.php",
      contentType: "application/json; charset=utf-8",
      customHeader: "VAL",
      payload: "1"
    }

    function callback() {

      alert("Validation completed.");
    }
    Functions.sendAjax(data, callback);
  }
};

// Signin
function onSuccess(googleUser) {
  var email = googleUser.getBasicProfile().getEmail();
  // TO DO: Record user login in a table, somewhere.
	location.assign("http://localhost/admin/dashboard.php");
}
function onFailure(e){
	//alert(e);
}
function renderButton() {
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 240,
    'height': 50,
    'longtitle': true,
    'theme': 'dark',
    'onsuccess': onSuccess,
    'onfailure': onFailure
  });
}

//Email validation
if (document.getElementById('bulk-validate')) {
  document.getElementById('bulk-validate').addEventListener('click', function () {

    Functions.bulkValidate();
  });
}
