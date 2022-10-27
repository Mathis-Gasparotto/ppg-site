/*var metaRefresh = document.getElementById('meta-refresh');
function deleteRefresh() {
 metaRefresh.remove();
}*/

function setTimer (end_date, elem) {
  setInterval(function() {
    var countDownDate = new Date(end_date).getTime();

    // Get today's date and time
    var now = new Date().getTime();
  
    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    var minutes = Math.floor(distance / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // var secondsTotal = Math.floor(distance / 1000);
  
    // Display the result in the element with id="demo"
    if (distance <= 0) {
      elem.innerHTML = 'Veuillez rafraichir la page';
    } else {
      elem.innerHTML = minutes + "min " + seconds + "s";
    }
  }, 1000);
};
