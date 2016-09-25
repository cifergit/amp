/**
 * @desc
 * @author cifer
 * @date 2016/06/02
 */
define('windowalert', function (require, exports, module) {
    var bodyDom = document.getElementsByTagName('body')[0];
    var browser = navigator.appName;
    var b_version = navigator.appVersion;
    var version = b_version.split(";");
    var trim_Version = '';
    module.exports = {
        //简单对话
        simple: function(obj){
            if(!obj){
                obj = {};
            }
            if(version && version.length > 1 && version[1]){
                trim_Version = version[1].replace(/[ ]/g,"");
            }
            if(browser =="Microsoft Internet Explorer" && trim_Version=="MSIE6.0")
            {
                this.ie6_ie7(obj);
            }
            else if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE7.0")
            {
                this.ie6_ie7(obj);
            }
            else {
                var domWindowAlertCover = document.getElementById('J_WindowAlertCover');
                var domWindowAlert = document.getElementById('J_WindowAlert');
                //如果不是第一次弹窗cover
                if(domWindowAlertCover){
                    this.show(domWindowAlertCover);
                }
                else {
                    this.createWindowAlertCover(bodyDom);
                }
                if(domWindowAlert){
                    bodyDom.removeChild(domWindowAlert);
                    this.createWindowAlert(bodyDom, obj);
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
            if(!obj.errcode){
                if(!obj.msg){
                    obj.msg = '抱歉，服务器繁忙，请稍后再试！'
                }
                alert(obj.msg);
            }
            else if(obj.errcode === 0 ) {
                if(!obj.msg){
                    obj.msg = '恭喜你，提交成功！'
                }
                alert(obj.msg);
                location.href = obj.leftButtionLink;
            }
        },
        //创建蒙层
        createWindowAlertCover: function(bodyDom){
            var windowAlertCover = document.createElement('div');
            windowAlertCover.setAttribute('id','J_WindowAlertCover');
            windowAlertCover.setAttribute('style','position: fixed;top: 0;left: 0;z-index: 3000;width: 100%;height: 100%;background-color: #3c3c3c;filter: alpha(opacity=40);-moz-opacity:0.40;opacity: 0.40;');
            bodyDom.appendChild(windowAlertCover);
        },
        //创建对话框
        createWindowAlert: function(bodyDom, obj){
            obj = this.getInitObj(obj);
            var windowAlert = document.createElement('div');
            windowAlert.setAttribute('id','J_WindowAlert');
            var arrStyle = [];
            arrStyle.push('position: fixed;');
            arrStyle.push('top: 50%;');
            arrStyle.push('left: 50%;');
            arrStyle.push('z-index: 5000;');
            arrStyle.push('width: 400px;');
            arrStyle.push('height: 200px;');
            arrStyle.push('background-color: #fff;');
            arrStyle.push('margin-left: -200px;');
            arrStyle.push('margin-top: -100px;');
            arrStyle.push('border-radius: 8px;');
            arrStyle.push('overflow: hidden;');
            windowAlert.setAttribute('style',arrStyle.join(''));
            var alertHead = document.createElement('p');
            var textAlertHead = document.createTextNode(obj.msg);
            alertHead.appendChild(textAlertHead);
            alertHead.setAttribute('style','height: 93px;margin: 30px 30px 27px 30px;font-size: 16px;text-align: center;overflow: hidden;');

            var alertBottom = document.createElement('div');
            alertBottom.setAttribute('style','*zoom:1;:after{visibility: hidden;display: block;font-size: 0;content:" ";clear: both;height: 0;');

            var buttonEventNum = obj.buttonEvent.length;
            var leftButtonWidth = 50;
            var leftButtonColor = '#999';
            if(buttonEventNum == 1){
                leftButtonWidth = 100;
                leftButtonColor = '#319eea';
            }

            var leftButton = document.createElement('a');
            leftButton.setAttribute('style','float: left;display: block;width: ' + leftButtonWidth + '%;height: 50px;line-height: 50px;background-color: '+ leftButtonColor +';color: #fff;text-align: center;');
            leftButton.setAttribute('id','J_WindowalertLeftButton');
            var leftButtonValue = document.createTextNode(obj.buttonEvent[0].value);
            leftButton.appendChild(leftButtonValue);

            alertBottom.appendChild(leftButton);

            if(buttonEventNum == 2){
                var rightButton = document.createElement('a');
                rightButton.setAttribute('style','float: left;display: block;width: 50%;height: 50px;line-height: 50px;background-color: #319eea;color: #fff;text-align: center;');
                rightButton.setAttribute('id','J_WindowalertRightButton');
                var rightButtonValue = document.createTextNode(obj.buttonEvent[1].value);
                rightButton.appendChild(rightButtonValue);
                alertBottom.appendChild(rightButton);
            }

            windowAlert.appendChild(alertHead);
            windowAlert.appendChild(alertBottom);

            bodyDom.appendChild(windowAlert);

            //左边按钮
            var windowalertLeftButton = document.getElementById('J_WindowalertLeftButton');
            this.listenEvent(windowalertLeftButton,'click',function(e){
                //阻止<a></a>跳转
                if(window.event){
                    window.event.returnValue = false;//如果是IE下执行这个
                }
                else {
                    e.preventDefault();
                }
                obj.buttonEvent[0].callbackEvent();
            });
            if(buttonEventNum == 2){
                //右边边按钮
                var windowalertbuttionRight = document.getElementById('J_WindowalertRightButton');
                this.listenEvent(windowalertbuttionRight,'click',function(e){
                    if(window.event){
                        window.event.returnValue = false;//如果是IE下执行这个
                    }
                    else {
                        e.preventDefault();
                    }
                    obj.buttonEvent[1].callbackEvent();
                });
            }

        },
        //初始化传值
        getInitObj: function(obj){
            if(!obj.msg){
                obj.msg = '抱歉，服务器繁忙，请稍候重试！';
            }
            if(!obj.buttonEvent){
                obj.buttonEvent = [
                    {
                        value : '确定',
                        callbackEvent : function(){
                            module.exports.hideWindowalert();
                        }
                    }
                ];
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
            //大写为了兼容ie8
            if(style.indexOf('display: none;') == -1 || style.indexOf('DISPLAY: none;') == -1){
                if(style.indexOf('display: block;') > -1 || style.indexOf('DISPLAY: block;') > -1){
                    style = style.replace('display: block;','display: none;');
                    style = style.replace('DISPLAY: block;','display: none;');
                }
                else {
                    style = 'display: none;' + style;
                }
                dom.setAttribute('style', style);
            }
        },
        show: function(dom){
            var style = dom.getAttribute('style');
            //IE 8是大写
            if(style.indexOf('display: block;') == -1 || style.indexOf('DISPLAY: block;') == -1){
                if(style.indexOf('display: none;') > -1 || style.indexOf('DISPLAY: none;') > -1){
                    style = style.replace('display: none;','display: block;');
                    style = style.replace('DISPLAY: none;','display: block;');
                }
                else {
                    style = 'display: block;' + style;
                }
                dom.setAttribute('style', style);
            }
        },
        hideWindowalert: function(){
            var domWindowAlertCover = document.getElementById('J_WindowAlertCover');
            var windowAlert = document.getElementById('J_WindowAlert');
            this.hide(domWindowAlertCover);
            this.hide(windowAlert);
        },
        showWindowalert: function(){

        }
    };
});
