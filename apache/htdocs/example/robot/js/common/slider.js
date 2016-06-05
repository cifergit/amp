define('slider', function (require, exports, module) {

    function $slider(obj){
        var opt={
            titleId:"",        		//tab标题的id
            titleTag:"",    		//tab的元素类型
            contentId:"",    		//内容的id
            contentTag:"",    		//内容元素类型
            prevId:"",				//前一页,多个id以逗号分隔
            nextId:"",				//下一页,多个id以逗号分隔
            perView:1,				//每页显示个数
            className:"current",	//title选中的样式
            eventType:"mouseover",	//mouseover && click
            initIndex:NaN,			//初始化定位
            timeLag:300,			//启动延时，防止用户滑来滑去的情况
            funcInit:$empty(),		//初始化循环内容时候执行的函数
            funcTabInit:$empty(),	//初始化循环title时候执行的函数
            func:$empty(),			//当前元素显示时候执行的函数
            onPage:$empty(),	    //分页时执行的函数（当perView==1时，此函数和fun执行的逻辑完全一致，通常在perView!=1时使用此函数，分页时使用）
            nodeWalker : null,      //遍历元素的方法,此函数需要做以下几件事情:1.遍历  2.筛选(可选) 3.返回结果集,另外此函数需要处理title和content两种情况
            auto:false,				//是否自动轮播
            autoKeep:true,			//鼠标移开后继续轮播
            autoTimes:100,			//轮播次数
            autoLag:5000,			//自动轮播延时
            fadeLag:50,				//效果延时
            fadeTimes:500,			//效果要求执行时间，比如0.5s切换完成，而效果延时是0.1s，那么就是说五个步骤之后就执行完毕了
            initSpeed:100,			//初速度加成
            effect:'none',          //播放效果 'none','scrollx', 'scrolly', 'fade'
            width:0,				//内容区宽度
            height:0,				//内容区高度
            backAttr:"back_src",	//存储图片地址的属性
            isLoadInit:true	,		//初始化的时候是否载入图片，当切换在屏幕不可见范围内进行的时候有用
            focusIndex:setEffect,	//提供给外部定位的接口
            clearAuto:function(){clearInterval(autoIntr)},//提供给外部的接口，清空轮播
            cont:null,				//内容列表
            tabs:null,			//菜单列表
            funcTabChange:$empty()  //tab切换回调 cur, opt
        };

        for(var i in obj){opt[i]=obj[i]};

        //自动获取的宽高不太准确，需要传入
        ((opt.width==0 && opt.effect=="scrollx") || (opt.height==0 && opt.effect=="scrolly")) && (opt.effect="none");

        //if(!opt.titleId) debugger;
        //遍历所有的标题和内容，并绑定事件
        var	total=0,		//统计数字
            autoCount=0,	//当前已播次数
            isInit=true,	//是否初始化进入;
            intr=null,		//tab切换的interval
            autoIntr=null,	//自动切换的interval
            _imgs=[];		//图片是否已经载入


        if(opt.contentId){
            //支持只有tab切换然后做别的事情的情况
            var oContent=$id(opt.contentId),
                _cont=(opt.nodeWalker||$child)(oContent,opt.contentTag,function(dom){
                    //给内容的状态初始化
                    switch(opt.effect){
                        case "none":
                            dom.style.display="none";
                            break;
                        case "scrollx":
                            //考虑到动态加载图片的情况，区域的大小要限定
                            dom.style.width=opt.width+"px";
                            //如果效果为scrollx和fade，则全部向右漂移
                            dom.style.styleFloat = dom.style.cssFloat = "left";
                            dom.style.visibility = "hidden";
                            break;
                        case "scrolly":
                            //考虑到动态加载图片的情况，区域的大小要限定
                            dom.style.height=opt.height+"px";
                            dom.style.visibility = "hidden";
                            break;
                        case "fade":
                            dom.style.display="none";
                            dom.style.position="absolute";
                            dom.style.left=0;
                            dom.style.top=0;
                            break;
                    };
                    //执行初始化函数
                    opt.funcInit(total++,dom);
                });

            if(opt.auto){
                //循环播放进入和离开content的操作
                $addEvent(oContent,"mouseover",function(){
                    clearInterval(autoIntr);
                });
                opt.autoKeep && $addEvent(oContent,"mouseout",function(){
                    setAuto();
                });
            };
            opt.cont=_cont;
        }

        //如果没有定义initIndex则随机
        var len=opt.perView,//下面多次用到，所以存储一下
            now=0;			//临时变量，当前显示的元素

        if(opt.titleId){
            //支持无titile切换
            var oTitle=$id(opt.titleId),
                _tabs=(opt.nodeWalker||$child)(oTitle,opt.titleTag,function(dom){
                    opt.funcTabInit(now,dom);
                    dom.setAttribute("index",now++);
                });

            $addEvent(oTitle,opt.eventType,function(e){
                var tar=$getTarget(e,oTitle,opt.titleTag);
                if(tar && $inArray(tar,_tabs)!=-1){
                    //放置current还没有设置为cur，然后鼠标又触发的状况
                    //setClass在current=cur之前
                    var cur=tar.getAttribute("index")*1;
                    clearInterval(autoIntr);
                    if(cur!=current){
                        intr=setTimeout(function(){
                            //tab切换回调
                            opt.funcTabChange(cur, opt);
                            setEffect(cur);
                        },opt.timeLag);
                    }
                }
            });

            $addEvent(oTitle,"mouseout",function(e){
                var tar=$getTarget(e,oTitle,opt.titleTag);
                if(tar){
                    //clearInterval(autoIntr);
                    clearTimeout(intr);
                    opt.auto && opt.autoKeep && setAuto();
                }
            });
            opt.tabs=_tabs;
            total=now;
        };

        var	pageTotal=Math.ceil(total/len),	//分页
            current=isNaN(opt.initIndex)?$randomInt(pageTotal):opt.initIndex,
            autoTotal=opt.autoTimes * total - 1; //总共轮播次数;


        //默认展示配置项目
        setEffect(current);

        //判断是否自动切换
        opt.auto && setAuto();

        //绑定上一个、下一个的点击
        if(opt.prevId){
            if (opt.prevId.indexOf(",")>-1) {
                var prevs = opt.prevId.split(",");
                for(var i=0,j=prevs.length;i<j;i++){
                    $addEvent($id(prevs[i]),"click",showPrev);
                    //.onclick = showPrev;
                }
            }else{
                $addEvent($id(opt.prevId),"click",showPrev);
                //$id(opt.prevId).onclick = showPrev;
            }
        }

        if(opt.nextId){
            if (opt.nextId.indexOf(",")>-1) {
                var nexts = opt.nextId.split(",");
                for(var i=0,j=nexts.length;i<j;i++){
                    $addEvent($id(nexts[i]),"click",showNext);
                    //$id(nexts[i]).onclick = showNext;
                }
            }else{
                $addEvent($id(opt.nextId),"click",showNext);
                //$id(opt.prevId).onclick = showNext;
            }
        }

        //初始化结束
        isInit=false;

        return opt;

        //自动切换设置
        function setAuto(){
            autoIntr && clearInterval(autoIntr);
            autoIntr=setInterval(function(){
                if(autoCount>=autoTotal){
                    clearInterval(autoIntr);
                }else{
                    setEffect((now=current+1)>=pageTotal?0:now);
                    autoCount++;
                }
            },opt.autoLag);
        }

        //设置特效
        function setEffect(cur){
            //if(opt.isLoadInit==false) debugger;
            if (cur >= _cont.length) return;
            if(!opt.contentId){
                //如果没有contentId，简单解决
                showItem(cur);
                current=cur;
                return;
            };
            if(isInit){
                //初始化动态效果
                switch(opt.effect){
                    case "scrollx":
                        oContent.style.position="relative";
                        oContent.style.width=(total+1) * opt.width +"px";
                        oContent.style.left=-current*opt.width+"px";
                        break;
                    case "scrolly":
                        oContent.style.position="relative";
                        oContent.style.top=-current*opt.height+"px";
                        break;
                    case "fade":
                        oContent.style.position="relative";
                        break;
                };
                for(var i=0;i<len;i++){
                    (now = cur+i) < total && showItem(now);
                };
                opt.onPage(cur);
                current=cur;
            }else{
                //传入来之前应确保cur!=curren，否则会被当作是初始化
                var fadeStep=Math.floor(opt.fadeTimes/opt.fadeLag),	//计算效果步骤
                    fadeIntr=null,
                    fadeCount=0;
                //全局的特效定时器，表示一个组件一个活动周期中只能出现一个特效，如果已经存在了，那边必须先结束这个特效才能继续执行
                if(opt.globeFadeIntr){
                    switch(opt.effect){
                        case "fade":
                            //oContent.style.top=-endTop+"px";
                            //如果不加zIndex问题，某些情况下会有问题，例如title提示
                            _cont[current].style.zIndex=0;
                            _cont[cur].style.zIndex=1;
                            //当连续触发多个淡出计算的过程中，会出现重影，这段代码在完成时对透明度做最后的调整
                            _cont[current].style.filter="alpha(opacity=0)";
                            _cont[current].style.opacity=0;
                            _cont[cur].style.filter="alpha(opacity=1)";
                            _cont[cur].style.opacity=1;
                            current=cur;
                            break;
                    }
                    clearInterval(opt.globeFadeIntr);
                }
                //全局的特效定时器，清空，开始下一个特性
                opt.globeFadeIntr=null;
                switch(opt.effect){
                    case "none":
                        //if(len>1) debugger;
                        for(var i=0;i<len;i++){
                            (now = current*len+i) < total && (_cont[now].style.display="none");
                            (now = cur*len+i) < total && showItem(now);
                        };
                        opt.onPage(cur);
                        current=cur;
                        break;
                    case "scrollx":
                        var left=getSpeed(opt.width);
                        showItem(cur);
                        opt.globeFadeIntr=fadeIntr=setInterval(function(){
                            //debugger;
                            if(fadeCount++>=fadeStep){
                                clearInterval(fadeIntr);
                                opt.globeFadeIntr=null;
                                oContent.style.left=-left.end+"px";
                                current=cur;
                            }else{
                                oContent.style.left=-getMove(left)+"px";
                                left.t = left.t<opt.fadeTimes?(left.t+opt.fadeLag):opt.fadeTimes;
                            };
                        },opt.fadeLag);
                        break;
                    case "scrolly":
                        //debugger;
                        var top=getSpeed(opt.height);
                        showItem(cur);
                        opt.globeFadeIntr=fadeIntr=setInterval(function(){
                            //debugger;
                            if(fadeCount++>=fadeStep){
                                clearInterval(fadeIntr);
                                opt.globeFadeIntr=null;
                                oContent.style.top=-top.end+"px";
                                current=cur;
                            }else{
                                oContent.style.top=-getMove(top)+"px";
                                top.t = top.t<opt.fadeTimes?(top.t+opt.fadeLag):opt.fadeTimes;
                            };
                        },opt.fadeLag);
                        break;
                    case "fade":
                        showItem(cur);
                        opt.globeFadeIntr=fadeIntr=setInterval(function(){
                            //if(!opt.titleId) debugger;
                            if(fadeCount++>=fadeStep){
                                clearInterval(fadeIntr);
                                opt.globeFadeIntr=null;
                                //oContent.style.top=-endTop+"px";
                                //如果不加zIndex问题，某些情况下会有问题，例如title提示
                                _cont[current].style.zIndex=0;
                                _cont[cur].style.zIndex=1;
                                current=cur;
                            }else{
                                var per=fadeCount/fadeStep;

                                _cont[current].style.filter="alpha(opacity="+(1-per)*100+")";
                                //_cont[current].style.MozOpacity=1-per;
                                _cont[current].style.opacity=1-per;

                                _cont[cur].style.filter="alpha(opacity="+(per*100)+")";
                                //_cont[cur].style.MozOpacity=per;
                                _cont[cur].style.opacity=per;
                            };
                        },opt.fadeLag);
                        break;
                };
            }

            function getSpeed(s){
                var flag=(cur - current)<0?-1:1,
                    end=cur*s,
                    here=(cur - flag)*s,//直接定位到它的前一个
                    oFirst=_cont[0];
                current == 0 && (oFirst.style.position="static");
                if(current + 1 == total && cur == 0){
                    //如果是最后一个到第一个情况，仍然保持向左侧滑动
                    flag = 1;
                    end=(current+1)*s;
                    here=current*s;
                    oFirst.style.position="relative";
                    opt.effect=="scrollx"?oFirst.style.left=end + "px":oFirst.style.top=end + "px";
                };
                return {
                    t:0,
                    distance:flag*s,
                    end:end,
                    here:here
                }
            }

            function getMove(obj){
                //举一个简单的例子，一个div要向右缓动，left初始值是50，那么b就是50，要向右移动100，那c就是100，如果知道的是目标值，例如要向右移动到150，那就把目标值150减初始值b就是变化量c了。
                //至于d的设置就比较灵活，只要符合t是从0向d递增（或递减）就可以了。
                //d跟步长配合使用来设置持续时间，例如d设置为100，如果设置步长是10，那么从0到100就有10步，即分10次来完成这个过程，步数越多那么持续时间就越长。
                //至于t的变化相当于时间的变化，一般是均匀变化的，每次变化都增加一个步长，当t从0递增（或递减）到d时，缓动就结束了。
                //要注意的是t是从0开始的，设置步长时必须确定t确实能到达d，如果上面的步长是3，那么t就永远都到不了d了。更好的处理是当t等于或超过d之后，就停止定时器并设置当前值为目标值。
                var b=obj.here,
                    c=obj.distance,
                    d=opt.fadeTimes,
                    t=obj.t/d-1;
                return parseInt(-c * (t*t*t*t - 1) + b,10);
            }

            function showItem(cur){
                //设定当前元素的状态
                //if(opt.effect=="none") debugger;
                if (cur >= _cont.length) return;
                //设置title的样式，并将滚动到的地方设置为当前
                //如果当前是隐藏的，先显示出来
                if(opt.contentId && !_imgs[cur] && (isInit==false || (isInit==true && opt.isLoadInit==true))){
                    //并不能确保分页的最后一页数量为len && 如果图片未载入，并且不是初始化或是初始化且需要加载
                    $loadImg(_cont[cur],opt.backAttr);
                    _imgs[cur]=true;
                };
                if(opt.contentId){
                    _cont[cur].style.display=="none" && (_cont[cur].style.display="block");
                    _cont[cur].style.visibility=="hidden" && (_cont[cur].style.visibility="visible");
                };
                if(opt.titleId){
                    //_tabs[current].className="";
                    //var titleCur=Math.floor(cur/opt.perView);
                    for(var i=0,len=_tabs.length;i<len;i++){
                        i!=cur&& $delClass(_tabs[i],opt.className);
                    }
                    $addClass(_tabs[cur],opt.className);
                    _tabs[cur].style.display=="none" && (_tabs[cur].style.display="block");
                };
                opt.func(cur);
            }
        }
        //展示前一个，分页
        function showPrev(e){
            $preventDefault(e);
            clearInterval(autoIntr);
            setEffect((now=current-1)<0?(pageTotal-1):now);
        }
        //展示后一个，分页
        function showNext(e){
            $preventDefault(e);
            clearInterval(autoIntr);
            setEffect((now=current+1)>=pageTotal?0:now);
        }
    }
    function $addClass(ids,cName){
        $setClass(ids,cName,"add");
    };
    function $addEvent(obj, type, handle) {
        if(!obj || !type || !handle) {
            return;
        }
        if( obj instanceof Array) {
            for(var i = 0, l = obj.length; i < l; i++) {
                $addEvent(obj[i], type, handle);
            }
            return;
        }
        if( type instanceof Array) {
            for(var i = 0, l = type.length; i < l; i++) {
                $addEvent(obj, type[i], handle);
            }
            return;
        }
        window.__allHandlers = window.__allHandlers || {};
        window.__Hcounter = window.__Hcounter || 1;
        function setHandler(obj, type, handler, wrapper) {
            obj.__hids = obj.__hids || [];
            var hid = 'h' + window.__Hcounter++;
            obj.__hids.push(hid);
            window.__allHandlers[hid] = {
                type : type,
                handler : handler,
                wrapper : wrapper
            }
        }
        function createDelegate(handle, context) {
            return function() {
                return handle.apply(context, arguments);
            };
        }
        if(window.addEventListener) {
            var wrapper = createDelegate(handle, obj);
            setHandler(obj, type, handle, wrapper)
            obj.addEventListener(type, wrapper, false);
        }
        else if(window.attachEvent) {
            var wrapper = createDelegate(handle, obj);
            setHandler(obj, type, handle, wrapper)
            obj.attachEvent("on" + type, wrapper);
        }
        else {
            obj["on" + type] = handle;
        }
    };
    function $child(node,val,fn,filter){
        var results=[], filter = filter||$empty();
        if(!node) return results;

        walk(node.firstChild,function(n){
            if(!n){return ;}
            var actual=n.nodeType===1&&n.nodeName.toLowerCase();
            if(typeof actual === 'string' && (actual === val || typeof val !== 'string') && filter(n)){
                results.push(n);
                fn&&fn(n,results.length-1);
            }
        });

        return results;

        function walk(n,func){
            func(n);
            while(n&&(n=n.nextSibling)){
                func(n,func);
            }
        }
    };
    function $delClass(ids,cName){
        $setClass(ids,cName,"remove");
    };
    function $empty(){
        //返回全局空函数，不做任何事情，返回true；
        return function(){return true;}
    };
    function $getTarget(e,parent,tag) {
        var	e=window.event||e,
            tar=e.srcElement||e.target;
        if(parent && tag && tar.nodeName.toLowerCase()!=tag){
            while(tar = tar.parentNode){
                //对下拉框的点击会回溯到document，其它最多回溯到document.body即可
                if(tar==parent || tar==document.body || tar==document){
                    return null;
                }else if(tar.nodeName.toLowerCase()==tag){
                    break;
                }
            }
        };
        return tar;
    };
    function $hasClass(old,cur){
        if(!old||!cur) return null;
        var arr = (typeof old == 'object' ? old.className : old).split(' ');
        for(var i=0,len=arr.length;i<len;i++){
            if(cur==arr[i]){
                return cur;
            }
        };
        return null;
    };
    function $id(id){
        return typeof(id)=="string"?document.getElementById(id):id;
    };
    function $inArray(t,arr){
        if(arr.indexOf){
            return arr.indexOf(t);
        }
        for(var i=arr.length;i--;){
            if(arr[i]===t){
                return i*1;
            }
        };
        return -1;
    };
    function $loadImg(obj,attr){
        //载入隐藏的图片
        if(!obj) return;
        var attr=attr || "back_src",
            images = obj.getElementsByTagName("IMG");
        for(var i=0,len=images.length;i<len;i++){
            var oImg=images[i],
                src=oImg.getAttribute(attr);
            ''==oImg.src && src && (oImg.src=src);
        }
    };
    function $preventDefault(e){
        if(e && e.preventDefault){
            e.preventDefault();
        }else{
            window.event.returnValue=false;
        };
        return false;
    };
    function $randomInt(num1,num2){
        //生成从num1到num2(不包括num2)之间的随机数,若只传递一个参数，则生成0到该数之间的随机数
        if(num2==undefined){
            num2=num1;
            num1=0;
        }
        return Math.floor(Math.random()*(num2-num1)+num1);
    };
    function $setClass(ids, cName, kind) {
        if(!ids) {
            return;
        }
        var set = function(obj, cName, kind) {
            if(!obj) {
                return;
            }
            var oldName = obj.className, arrName = oldName ? oldName.split(' ') : [];
            if(kind == "add") {
                if(!$hasClass(oldName, cName)) {
                    arrName.push(cName);
                    obj.className = arrName.join(' ');
                }
            }
            else if(kind == "remove") {
                var newName = [];
                for(var i = 0, l = arrName.length; i < l; i++) {
                    if(cName != arrName[i] && ' ' != arrName[i]) {
                        newName.push(arrName[i]);
                    }
                }
                obj.className = newName.join(' ');
            }
        };
        if( typeof (ids) == "string") {
            var arrDom = ids.split(",");
            for(var i = 0, l = arrDom.length; i < l; i++) {
                if(arrDom[i]) {
                    set($id(arrDom[i]), cName, kind);
                }
            }
        }
        else if( ids instanceof Array) {//DOM对象集合  array
            for(var i = 0, l = ids.length; i < l; i++) {
                if(ids[i]) {
                    set(ids[i], cName, kind);
                }
            }
        }
        else {
            set(ids, cName, kind);
        }
    }

    exports.init = function (obj) {
        $slider(obj);
    }
});