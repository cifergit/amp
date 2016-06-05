/**
 * @desc
 * @author cifer
 * @date 2016/06/02
 */
define('windowalert', function (require, exports, module) {
    var bodyDom = document.getElementsByTagName('body')[0];
    module.exports = {
        //简单对话
        simple: function(obj){
            if(!obj){
                obj = {};
            }
            var browser=navigator.appName;
            var b_version=navigator.appVersion;
            var version=b_version.split(";");
            var trim_Version=version[1].replace(/[ ]/g,"");
            if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE6.0")
            {
                this.ie6_ie7(obj);
            }
            else if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE7.0")
            {
                this.ie6_ie7(obj);
            }
            else {
                var domWindowAlertCover = document.getElementById('windowAlertCover');
                var domWindowAlert = document.getElementById('windowAlert');
                if(domWindowAlertCover){
                    this.show(domWindowAlertCover);
                }
                else {
                    this.createWindowAlertCover(bodyDom);
                }
                if(domWindowAlert){
                    this.show(domWindowAlert);
                }
                else {
                    this.createWindowAlert(bodyDom, obj);
                }
            }
        },
        ie6_ie7: function(obj){
            if(!obj.leftButtionLink){
                obj.leftButtionLink = '/';
            }
            if(!obj.errcode || obj.errcode === 0 ){
                if(!obj.errmsg){
                    obj.errmsg = '恭喜你，提交成功！'
                }
                alert(obj.errmsg);
            }
            else {
                if(!obj.errmsg){
                    obj.errmsg = '抱歉，服务器繁忙，请稍后再试！'
                }
                alert(obj.errmsg);
            }
            location.href = obj.leftButtionLink;
        },
        //创建蒙层
        createWindowAlertCover: function(bodyDom){
            var windowAlertCover = document.createElement('div');
            windowAlertCover.setAttribute('id','windowAlertCover');
            windowAlertCover.setAttribute('style','position: fixed;top: 0;left: 0;z-index: 900;width: 100%;height: 100%;background-color: #3c3c3c;filter: alpha(opacity=40);-moz-opacity:0.40;opacity: 0.40;');
            bodyDom.appendChild(windowAlertCover);
        },
        //创建对话框
        createWindowAlert: function(bodyDom, obj){
            obj = this.getInitObj(obj);
            var windowAlert = document.createElement('div');
            windowAlert.setAttribute('id','windowAlert');
            var arrStyle = [];
            arrStyle.push('position: fixed;');
            arrStyle.push('top: 50%;');
            arrStyle.push('left: 50%;');
            arrStyle.push('z-index: 1000;');
            arrStyle.push('width: 400px;');
            arrStyle.push('height: 200px;');
            arrStyle.push('background-color: #fff;');
            arrStyle.push('-webkit-transform: translate(-50%, -50%);');
            arrStyle.push('-ms-transform: translate(-50%,-50%);');
            arrStyle.push('transform: translate(-50%,-50%);');
            arrStyle.push('*margin-top: -200px;');
            arrStyle.push('*margin-left: -100px;');
            arrStyle.push('border-radius: 8px;');
            arrStyle.push('overflow: hidden;');
            windowAlert.setAttribute('id','windowAlert');
            windowAlert.setAttribute('style',arrStyle.join(''));
            var alertHead = document.createElement('p');
            var textAlertHead = document.createTextNode(obj.errmsg);
            alertHead.appendChild(textAlertHead);
            alertHead.setAttribute('style','height: 93px;margin: 30px 30px 27px 30px;font-size: 16px;text-indent: 2em;overflow: hidden;');

            var alertBottom = document.createElement('div');
            alertBottom.setAttribute('style','*zoom:1;:after{visibility: hidden;display: block;font-size: 0;content:" ";clear: both;height: 0;');

            var leftButton = document.createElement('a');
            leftButton.setAttribute('style','float: left;display: block;width: 50%;height: 50px;line-height: 50px;background-color: #999;color: #fff;text-align: center;');


            leftButton.setAttribute('id','windowalertLeftButton');
            var leftButtonValue = document.createTextNode(obj.buttionLeftValue);
            leftButton.appendChild(leftButtonValue);

            var rightButton = document.createElement('a');
            rightButton.setAttribute('style','float: left;display: block;width: 50%;height: 50px;line-height: 50px;background-color: #0399e5;color: #fff;text-align: center;');
            rightButton.setAttribute('id','windowalertRightButton');
            var rightButtonValue = document.createTextNode(obj.buttionRightValue);
            rightButton.appendChild(rightButtonValue);

            alertBottom.appendChild(leftButton);
            alertBottom.appendChild(rightButton);

            windowAlert.appendChild(alertHead);
            windowAlert.appendChild(alertBottom);

            bodyDom.appendChild(windowAlert);

            //左边按钮
            var windowalertLeftButton = document.getElementById('windowalertLeftButton');
            this.listenEvent(windowalertLeftButton,'click',function(event){
                event.preventDefault();
                obj.leftButtionCallback();
            });
            //右边边按钮
            var windowalertbuttionRight = document.getElementById('windowalertRightButton');
            this.listenEvent(windowalertbuttionRight,'click',function(event){
                event.preventDefault();
                obj.rightButtionCallback();
            });

        },
        //初始化传值
        getInitObj: function(obj){
            if(!obj.errmsg){
                obj.errmsg = '抱歉，服务器繁忙，请稍候重试！';
            }
            if(!obj.buttionLeftValue){
                obj.buttionLeftValue = '返回首页';
            }
            if(!obj.buttionRightValue){
                obj.buttionRightValue = '继续提交';
            }
            return obj;
        },
        //监听事件
        listenEvent: function(target, type, handler) {
            if(target.addEventListener){//w3c
                target.addEventListener(type, handler,false);
            }
            else if(target.attachEvent){//IE6-8
                target.attachEvent("on"+type, function(e){
                    return handler.call(target,e);
                });
            }
        },
        hide: function(dom){
            var style = dom.getAttribute('style');
            if(style.indexOf('display: none;') == -1){
                if(style.indexOf('display: block;') > -1){
                    style = style.replace('display: block;','display: none;');
                }
                else {
                    style = 'display: none;' + style;
                }
                dom.setAttribute('style', style);
            }
        },
        show: function(dom){
            var style = dom.getAttribute('style');
            if(style.indexOf('display: block;') == -1){
                if(style.indexOf('display: none;') > -1){
                    style = style.replace('display: none;','display: block;');
                }
                else {
                    style = 'display: block;' + style;
                }
                dom.setAttribute('style', style);
            }
        },
        hideWindowalert: function(){
            var domWindowAlertCover = document.getElementById('windowAlertCover');
            var windowAlert = document.getElementById('windowAlert');
            this.hide(domWindowAlertCover);
            this.hide(windowAlert);
        },
        showWindowalert: function(){

        }
    };
});
