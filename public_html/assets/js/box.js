// For boxes only

/*When an un-identified user interacts with a box, they will be redirected
to Google Sign-In. Google Sign-In redirects them to the home page and the home page will
redirect to the box in question.  When the box loads in their browser then
this code will figure out what the user hand intended to do before being
redirected to Google Sign-In and start them where they left off.*/
$(document).ready(function () {
  //Tracks user intent prior to sign in
  if (sessionStorage.getItem('sub') == 1) { // intended to subscribe
    sessionStorage.removeItem('sub');
    var btn = document.getElementById("play-video");
    var id = btn.getAttribute("data-video-id");
    Boxeon.playVideo(id); // Shows STEP 1

  }
  if (sessionStorage.getItem('sub') == 0) { // intended to un-subscribe
    sessionStorage.removeItem('sub');
    Subscriptions.removeCheck();

  }
});
