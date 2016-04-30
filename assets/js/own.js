/* outsourced js components of the site */

/*general stuff*/

/**
 * Determine the mobile operating system.
 * This function either returns 'iOS', 'Android' or 'unknown'
 *
 * @returns {String}
 */
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;

  if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i)) {
    return 'iOS';

  } else if (userAgent.match(/Android/i)) {

    return 'Android';
  } else {
    return 'unknown';
  }
}

/* switches avatar effects based on OS.
 *  Has no return value.
 */
function snapper() {
  var ele = document.getElementById('avatar_span')
  if (getMobileOperatingSystem == 'iOS' || 'Android') {
    ele.innerHTML = '<a href="snapchat://add/jj_wedemeyer" alt="me on snapchat"><img src="images/avatar.jpg" alt="" id="img" /></a>'
  }
}

function fade(id) {
  document.getElementById(id).classList.toggle('notvisible');
}

/*
 * Will switch out links to launch apps if functional
 *
 */
function mobileLinks() {
  var elements = document.getElementsByClassName('link')
  var services = [github,twitter,facebook,snapchat,spotify,youtube,vimeo,vine,soundcloud,twitch]

  if (getMobileOperatingSystem() == 'iOS' || 'Android') {
    for (ele of elements) {

    }
  }
}
