//(() => {

//
// Cookie mgmt functions
//
    function setCookie(cname, cvalue, expdays=0) {
        let expires = "";
        //allow for session cookies
        if (expdays !==0) {
            const d = new Date();
            d.setTime(d.getTime() + (expdays * 24 * 60 * 60 * 1000));
            expires = "expires=" + d.toUTCString();
        }
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

//})();

