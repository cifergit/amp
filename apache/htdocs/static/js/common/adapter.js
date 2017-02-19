/**
 * Created by cifer on 2016/10/31.
 */
(function () {
    // 添加禁止功能 2015-04-17
    if(!window.VIEWPORT_FLAG){
        var w, scale, text;
        w = window.screen.width;
        scale = w / 750;
        var userAgt = navigator.userAgent;
        if(window.navigator.appVersion.match(/iphone/gi)) {
            text = '<meta name="viewport" content="width=device-width, initial-scale='+scale+', maximum-scale='+scale+', minimum-scale='+scale+', user-scalable=no" />';
            if (navigator.userAgent.indexOf("iPhone OS 4_") > -1 || navigator.userAgent.indexOf("iPhone OS 5_") > -1 || navigator.userAgent.indexOf("iPhone OS 6_") > -1) {
                text = '<meta name="viewport" content="width=750, initial-scale=1, maximum-scale=0.5, minimum-scale=0.5, user-scalable=yes" />';
            }
        } else if ( /Android (\d+\.\d+)/.test( userAgt ) ) {
            var version = parseFloat( RegExp.$1 );
            if(version > 2.3){
                text = '<meta name="viewport" content="width=750, minimum-scale = ' + scale + ", maximum-scale = " + scale + ', target-densitydpi=device-dpi">';
            }
            else {
                text = '<meta name="viewport" content="width=750, target-densitydpi=device-dpi">';
            }
        } else {
            text = '<meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi">';
        }
        /* else if (userAgt.match(/Firefox/gi) || (userAgt.match(/Chrome/gi) && !userAgt.match(/MicroMessenger/gi))) {
         text = '<meta name="viewport" content="width=750,initial-scale=' + (w / 750) + ', maximum-scale=' + (w / 750) + ', minimum-scale=' + (w / 750) + ', user-scalable=no"/>';
         } else {
         text = '<meta name="viewport" content="width=750,initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=' + dpi + ', user-scalable=no"/>';
         }*/
        document.write(text);
        if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement("style");
            msViewportStyle.appendChild(
                document.createTextNode("@-ms-viewport{width:auto!important}")
            );
            document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
        }
    }
})();
