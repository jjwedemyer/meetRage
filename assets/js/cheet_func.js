/* cheet.js functions */

function dancer(dancevid) {
  alert("lol");
  if (dancevid == undefined) {
    document.getElementById('bgvid').style.display = (document.getElementById('bgvid').style.display == 'block' ? 'none' : 'block');
  }
  if (dancevid == true) {
    document.getElementById('bgvid').style.display = 'block';
  } else if (dancevid == false) {
    document.getElementById('bgvid').style.display = 'none';
  }
}
/*function pulse() {
  var children = document.getElementById('pulser').children;
  for (var i = 0; i < children.length; i++) {
    children[i].firstElementChild.classList.add('fa-pulse');
  }
  document.
  setTimeout(function() {
    for (var i = 0; i < children.length; i++) {
      children[i].firstElementChild.classList.remove('fa-pulse');
    }
  }, 5000);
}*/
