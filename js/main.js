//Auto Session Timeout
function checkTime() {
  $.ajax({
    url:"checkSession.php",
    method:'POST',
    success:function(response){ 
      if(response == 'logout') {
        window.location.href="index.php?logout=1";
        // alert('Session has been Expired!');
      }
    }
  });
}
setInterval(function() {
  checkTime();
}, 2000); // 2000= 2seconds