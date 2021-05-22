window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "fa12e022-056e-45ea-b8fa-cd94fc372997",
    }); 
  });

  OneSignal.push(function() {
  /* These examples are all valid */
  OneSignal.getUserId(function(userId) {
    console.log("OneSignal User ID:", userId);
    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316 

    if(userId!=null)
    {
        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
        var http = new XMLHttpRequest();
        var url = 'session.php';
        var cuid = readCookie('user_id');
        console.log(cuid);
        var params = 'subscriber_id='+userId+'&user_id='+cuid;
        http.open('POST', url, true);

        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                console.log(http.responseText);
            }
        }
        http.send(params);  
    }
    else
    {
      console.log("OneSignal user ID cannot be generated");
    }

  });
});

