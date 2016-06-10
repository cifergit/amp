<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="太空船">
    <meta name="description" content="万金油之正则表达式" />
    <meta name="keywords" content="cifer,万金油，正则表达式，js正则表达式，JavaScript正则表达式" />
    <meta name="author" content="cifer" />
    <title>万金油之正则表达式</title>
    <link rel="stylesheet" href="//www.boatsky.com/static/css/common/global.css"/>
    <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/css/blog/blog_html.css"/>
    <style type="text/css">
    article {
        margin-top: 50px;
    }
    p {
        text-indent: 2em;
        word-break:break-all; /*支持IE，chrome，FF不支持*/
        word-wrap:break-word;/*支持IE，chrome，FF*/
    }
    h1 {
        height: 40px;
        line-height: 40px;
    }
    h2 {
        font-size: 18px;
    }
    ul {
        list-style-type: none;
    }
    .syntax code {
        display: inline-block;
        width: 60px;
        word-break:break-all; /*支持IE，chrome，FF不支持*/
        word-wrap:break-word;/*支持IE，chrome，FF*/
    }
    .demo {
        margin-top: 60px;
    }
    .use .demo {
        margin-top: 20px;
    }
    .demo h3 {
        height: 30px;
        line-height: 30px;
    }
    .demo h4 {
        font-weight: normal;
        margin-top: 10px;
    }
    .demo_code {
        display: block;
        padding: 10px;
        margin-top: 5px;
        border-radius: 10px;
        background-color: #eee;
        border: 1px solid #999;
    }
</style>
<script type="text/javascript">
    var regExpElem,checkContentElem,checkResultElem,passwordElem,passwordResultElem;
    //增加监听事件
    function listenEvent(target, type, handler) {
        if(target.addEventListener){//w3c
            target.addEventListener(type,handler,false);
        }
        else if(target.attachEvent){//IE6-8
            target.attachEvent("on"+type,function(e){
                return handler.call(target,e);
            });
        }
    }

    window.onload = function () {
        regExpElem = document.getElementById("checkRegExp");
        checkContentElem = document.getElementById("checkContent");
        checkResultElem = document.getElementById("checkResult");
        passwordElem = document.getElementById("password");
        passwordResultElem = document.getElementById("passwordResult");
        listenEvent(regExpElem,"keyup",checkRegExp);
        listenEvent(checkContentElem,"keyup",checkRegExp);
        listenEvent(passwordElem,"keyup",checkPassword);
    };

    function checkPassword() {
        var password = passwordElem.value;
        var passwordResult = "";
        var grade = {
            1: "弱",
            2: "中等",
            3: "强",
            4: "非常强"
        };
        if(password && password.length >= 8 && password.length <= 32){
            var currentGrade = 0;
            //加分正则
            var number = /\d/;
            var upper = /[A-Z]/;
            var lower = /[a-z]/;
            var other = /[^A-Za-z0-9]/;

            //减分正则
            var easyNumber = /(?:(?:0(?=1)|1(?=2)|2(?=3)|3(?=4)|4(?=5)|5(?=6)|6(?=7)|7(?=8)|8(?=9)){5}|(?:9(?=8)|8(?=7)|7(?=6)|6(?=5)|5(?=4)|4(?=3)|3(?=2)|2(?=1)|1(?=0)){5})/;
            var phoneNumber = /(13|14|15|17|18)[0-9]{9}/;
            if(number.test(password)){
                console.log("number+1");
                currentGrade++;
            }
            if(upper.test(password)){
                console.log("upper+1");
                currentGrade++;
            }
            if(lower.test(password)){
                console.log("lower+1");
                currentGrade++;
            }
            if(other.test(password)){
                console.log("other+1");
                currentGrade++;
            }
            if(easyNumber.test(password)){
                console.log("easyNumber-1");
                currentGrade--;
            }
            if(phoneNumber.test(password)){
                console.log("phoneNumber-1");
                currentGrade--;
            }
            console.log(currentGrade);
            if(currentGrade < 1){
                currentGrade = 1;
            }
            passwordResult = grade[currentGrade];
        }
        else {
            passwordResult = "密码长度必须8-32位";
        }
        passwordResultElem.innerHTML = passwordResult;
    }

    function checkRegExp(){
        var e = e || window.event;
        var target = e.target || e.srcElement;
        var regExpValue = regExpElem.value;
        var checkContentValue = checkContentElem.value;
        var regExp;
        var checkResult;
        var printResult = "";
        var seqBr = "";
        //先设不为空
        if(regExpValue && regExpValue.length >= 3 && checkContentValue){
            //验证正则格式是否正确
            var regExpFormat = new RegExp(/^\/\S+\$?\/(i|g|m)?$/);
            var regExpFormatResult = regExpFormat.test(regExpValue);
            //验证正则格式正确
            if(regExpFormatResult){
                //验证是否为全局正则
                var seqRegExp = new RegExp(/^\/\S+\$?\/$/);
                var seqRegExpResult = seqRegExp.test(regExpValue);
                //正则
                var regExpValuePattern;
                //修饰符
                var regExpValueAttributes;
                //普通正则
                if(seqRegExpResult){
                    regExpValuePattern = regExpValue.substring(1,regExpValue.length-1);
                    regExp = new RegExp(regExpValuePattern);
                    checkResult = regExp.exec(checkContentValue);
                    if(checkResult){
                        printResult = "位置：" + checkResult.index + ",字符：" + checkResult[0];
                    }
                    else {
                        printResult = "没有匹配上";
                    }
                }
                //其他正则
                else {
                    regExpValuePattern = regExpValue.substring(1,regExpValue.length-2);
                    regExpValueAttributes = regExpValue.substring(regExpValue.length-1,regExpValue.length);
                    regExp = new RegExp(regExpValuePattern,regExpValueAttributes);
                    var regExpLastWord = regExpValue.substring(regExpValue.length-1,regExpValue.length);
                    //全局
                    if(regExpLastWord == "g"){
                        while((checkResult = regExp.exec(checkContentValue)) != null){
                            printResult = printResult + seqBr + "位置：" + regExp.lastIndex + ",字符：" + checkResult;
                            seqBr = "<br/>";
                        }
                    }
                    //忽视大小写
                    else if(regExpLastWord == "i"){
                        checkResult = regExp.exec(checkContentValue);
                        printResult = "位置：" + checkResult.index + ",字符：" + checkResult[0];
                    }
                }
            }
            else {
                printResult = "正则表达式错误:" + regExpValue;
            }
        }
        else {
            printResult = "正则表达式不能为空，验证内容不能为空";
        }
        checkResultElem.innerHTML = printResult;
    }
</script>
</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">

<div class="mod_inner">

<h1 class="title">万金油之正则表达式</h1>
<article>
    <fieldset>
        <legend>JS正则测试工具</legend>
        <section class="tool_item">
            <div class="tit">正则表达式</div>
            <div class="con"><input type="text" value="/a/" placeholder="输入正则表达式" id="checkRegExp"></div>
        </section>
        <section class="tool_item">
            <div class="tit">验证内容</div>
            <div class="con"><input type="text" value="gagbgca" placeholder="输入验证内容" id="checkContent"></div>
        </section>
        <section class="tool_item">
            <div class="tit">验证结果</div>
            <div class="con" id="checkResult"></div>
        </section>
    </fieldset>
</article>
<article>
    <h2>前言</h2>
    <p>正则表达式(regular expression)几乎在所有主流计算机语言中都有涉及，初学者很多时候都是从某些地方copy过来，如果不了解它，那也不知道copy的东西对不对。
    </p>
    <p>它并不是一门语言，而是对字符串操作的一种逻辑公式，常常用regex表示。有趣的是，正则表达式并非计算机首创，而是源于数学科学家Stephen Kleene的《神经网事件的表示法》论文中，
        再被引入Unix工具软件，自此广泛被利用，验证了理论先于实践。虽然不同的语言上会有一些流派的小差异，思想却是相同，为了方便表述，本处多以JavaScript为例。
    </p>
    <p>正则表达式无非是实现两个功能，搜索与替换。</p>

</article>
<article>
    <h2>一、常用语法</h2>

    <ul class="syntax">
        <li><code>^</code>字符串开始位置</li>
        <li><code>$</code>字符串结束位置</li>
        <li><code>\</code>转义字符</li>
        <li><code>\d</code>数字</li>
        <li><code>\D</code>非数字</li>
        <li><code>\w</code>任何单词字符，包括字母数字下划线</li>
        <li><code>\W</code>非单词字符</li>
        <li><code>\s</code>不可见字符</li>
        <li><code>\S</code>可见字符</li>
        <li><code>+</code>匹配表达式1次以上</li>
        <li><code>*</code>匹配表达式任意次，尽量使用*?这种非贪婪的模式</li>
        <li><code>?</code>匹配表达式任意次</li>
        <li><code>{n}</code>匹配表达式n次,n非负</li>
        <li><code>{n,m}</code>匹配表达式n次至m次,n<=m</li>
        <li><code>[abcde]</code>匹配字符集任意一个，等价于[a-e]</li>
        <li><code>[^0-9]</code>匹配不在本字符集任意一个，等价于\D</li>
        <li><code>(x|y|z)</code>匹配字符集任意一个，等价于[xyz]</li>
    </ul>

</article>
<article>
    <h2>二、简单实例</h2>
    <section class="demo">
        <h3>QQ号</h3>
        <h4>分析：</h4>
        <p>QQ号是纯数字，4位至10位，不过也有把11位手机号当QQ的情况</p>
        <h4>正则：</h4>
        <code class="demo_code">
            /^[1-9]\d{3,10}$/
        </code>
    </section>

    <section class="demo">
        <h3>手机号码</h3>
        <h4>分析：</h4>
        <p>移动号19：134,135,136,137,138,139,147,150,151,152,157,158,159,178,182,183,184,187,188</p>
        <p>联通号09：130,131,132,155,156,185,186,145,170,171,176</p>
        <p>电信号06：133,153,177,180,181,189</p>
        <p>综合：</p>
        <p>130,131,132,133,134,135,136,137,138,139</p>
        <p>145,147</p>
        <p>150,151,152,153,155,156,157,158,159</p>
        <p>170,171,176,177,178</p>
        <p>180,181,182,183,184,185,186,187,188,189</p>
        <h4>正则：</h4>
        <code class="demo_code">
            /^(13|14|15|17|18)[0-9]{9}$/
        </code>
    </section>

    <section class="demo">
        <h3>邮箱</h3>
        <h4>分析：</h4>
        <p>邮箱的格式一直是一个有争议的问题，最常见的格式如xx@xx.xx，不过像xx.chen@midea.com.cn,xx_chen-xx@nfs-china.com也不少见。</p>
        <p>不过多数邮箱还是会在做出类似以下的限定：</p>
        <p>1.邮箱只能包含字母数字.-_与一个@，@之前必须有字母或数字，@之后必须要"2级域名"."1级域名"</p>
        <p>2.开头必须是字母或数字，不能有连续的.-_</p>
        <p>3.一级域名一般是只包含字母</p>
        <h4>正则：</h4>
        <code class="demo_code">
            /^[a-zA-Z0-9]+((\.|-|_)?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(-[a-zA-Z0-9])*(\.[a-zA-Z]+){1,3}$/
        </code>
    </section>

    <section class="demo">
        <h3>网址</h3>
        <h4>分析：</h4>
        <p>网址正则几乎随处可见，前缀是传输协议，如http,https,ftp,sftp,rtsp(实时流传输协议)，mms(串流媒体传送协议),magnet(BT种子)等等,接着则是三级域名（有可能省略），二级域名，一级域名，当然也可能只是IP址，最后详细路径</p>
        <p>本处，以美的商城、美的官网为例</p>
        <h4>正则：</h4>
        <code class="demo_code">
            /^http(s?):\/\/((\w)+\.)?boatsky\.com(\.cn)?(\/|$)/i
        </code>
    </section>

    <section class="demo">
        <h3>日期时间</h3>
        <h4>分析：</h4>
        <p>日期时间格式 多样，为了便于表示，以传统日期年月日时分秒，格式xxxx/xx/xx xx:xx:xx为例，其中年份为4位数，所有位数不足都须补0</p>
        <p>首先，我要要验证这个输入是否像一个日期，并不考虑这个日期是否存在</p>
        <h4>日期+时间格式正则：</h4>
        <code class="demo_code">
            /^\d{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])(\x20)(2[0-3]|[0-1][0-9]):([0-5]\d):[0-5]\d$/
        </code>
        <h4>分析：</h4>
        <p>如果加上1，3，5，7，8，10，12月有31天，4，6，9，11有30天,2月有28天（假设都是平年）</p>
        <h4>平年月份的正则：</h4>
        <code class="demo_code">
            /02\/(0[1-9]|1[0-9]|2[0-8])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01])/
        </code>
        <h4>平年的正则：</h4>
        <code class="demo_code">
            /^\d{4}\/((02\/(0[1-9]|1[0-9]|2[0-8])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01])))(\x20)(2[0-3]|[0-1][0-9]):([0-5]\d):[0-5]\d$/
        </code>
        <p>再加上闰年（能被4整除，若能被100整除则需要再被400整除,就是所谓的“4年一闰，100年不闰，400年再闰”），闰年2月29天，平年2月28天</p>
        <p style="display: none;">本处引入闰年故事</p>
        <p>闰年2月有29天也就是两种情况：</p>
        <h4>1.能被4整除且不能被100整除。什么样的数能被4整除？因为100能被4整除，所以只要保证后两位数能被4整除就行了,即“个位为048，十位为偶数”或“个位为26，十位为奇数”，加上个位与十位不能同时为0，如下：</h4>
        <code class="demo_code">
            /\d{2}([2468][048]|[13579][26]|0[48])/
        </code>
        <h4>2.能被400整除。千位与百位需要被4整除,(没有公元0年，只有公元前1年与公元1年)</h4>
        <code class="demo_code">
            /([2468][048]|[13579][26]|0[48])00/
        </code>
        <h4>闰年的正则：</h4>
        <code class="demo_code">
            /\d{2}([2468][048]|[13579][26]|0[48])|([2468][048]|[13579][26]|0[48])00/
        </code>
        <h4>综上，为了好看，这里像代码一样缩进（只是为了展示，实际上不能这么写）：</h4>
        <code class="demo_code">
            /  <br/>
            ^(<br/>
            &nbsp;(<br/>
            &nbsp;&nbsp;\d{4}\/((02\/(0[1-9]|1[0-9]|2[0-8])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01])))<br/>
            &nbsp;)<br/>
            &nbsp;|<br/>
            &nbsp;(<br/>
            &nbsp;&nbsp;(  \d{2}([2468][048]|[13579][26]|0[48])    |    ([2468][048]|[13579][26]|0[48])00   )<br/>\/
            &nbsp;&nbsp;(  02\/(0[1-9]|1[0-9]|2[0-9])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01]) )<br/>
            &nbsp;)<br/>

            )<br/>
            (\x20)(2[0-3]|[0-1][0-9]):([0-5]\d):[0-5]\d$ <br/>
            /
        </code>
        <h4>去除空格后正确的写法：</h4>
        <code class="demo_code">
            /^((\d{4}\/((02\/(0[1-9]|1[0-9]|2[0-8])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01]))))|((\d{2}([2468][048]|[13579][26]|0[48])|([2468][048]|[13579][26]|0[48])00)\/(02\/(0[1-9]|1[0-9]|2[0-9])|(0[469]|11)\/(0[1-9]|[12][0-9]|30)|(0[13578]|1[02])\/(0[1-9]|[12][0-9]|3[01]))))(\x20)(2[0-3]|[0-1][0-9]):([0-5]\d):[0-5]\d$/
        </code>
    </section>

    <section class="demo">
        <h3>密码复杂度</h3>
        <h4>分析：</h4>
        <p>现在很多网站都流行对用户的密码进行安全等级评定，提醒用户设置更复杂的密码，更大可能的保护账户安全。</p>
        <p>其实所谓的复杂度，无非就是用多个正则进行配置，匹配上越多的正则，则复杂度越高</p>
        <p>本处对密码设以下规则，长度8-32，建议包括大写字母，建议包括小写字母，建议包括数字，建议包括特殊字符，不建议包括三个连续字符，不</p>
        <fieldset>
            <legend>密码安全等级测试</legend>
            <section class="tool_item">
                <div class="tit">输入密码：</div>
                <div class="con"><input type="text" value="" placeholder="输入密码" id="password"></div>
            </section>
            <section class="tool_item">
                <div class="tit">验证结果：</div>
                <div class="con" id="passwordResult"></div>
            </section>
        </fieldset>
    </section>


</article>

<article class="use">
    <h2>三、JavaScript中简单使用</h2>
    <p>1.在JS中，正则表达式用RegExp对象表示，可以用RegExp(pattern,attributes)构造函数来创建RegExp对象，其第一个参数pattern是上述的正则表示式，第二个参数是修饰符，g(全局匹配),i(不区分大小写匹配),m(多行匹配)</p>
    <code class="demo_code">
        var regExp = new RegExp("/^(13|14|15|17|18)[0-9]{9}$/");
    </code>

    <p>也可以特殊的直接量语法创建</p>
    <code class="demo_code">
        var regExp = /^(13|14|15|17|18)[0-9]{9}$/;
    </code>
    <p>RegExp包括三个方法：</p>
    <section class="demo">
        <h4>complie：编译正则，增快速度</h4>

    </section>

    <section class="demo">
        <h4>test:检索字符串指定值</h4>
        <code class="demo_code">
            var regExp = new RegExp(/^(13|14|15|17|18)[0-9]{9}$/);<br/>
            var result = regExp.test("18812345678");    //返回true或false，这里是true
        </code>
    </section>

    <section class="demo">
        <h4>exec:检索字符串指定值，并确定位置，如果搜索修饰符不是g，那么返回值第0个是匹配上的字符串还包括index（匹配文本第一个的位置）与input（当前被匹配的字符串）两个属性</h4>
        <code class="demo_code">
            var regExp = new RegExp(regExpValuePattern);<br/>
            var checkResult = regExp.exec(checkContentValue);<br/>
            if(checkResult){<br/>
            printResult = "位置：" + checkResult.index + ",字符：" + checkResult[0];<br/>
            }
        </code>
        <code class="demo_code">
            var regExp = new RegExp(/a/,g);<br/>
            var result;<br/>
            while((result == regExp.exec("abcdefabdaafg"))){<br/>
            console.log(result);<br/>
            console.log(regExp.lastIndex);<br/>
            }
        </code>
    </section>

    <p>2.String对象有search,match,replace,split是支持正则表达式的</p>

</article>

<article class="use">
    <h2>四、PHP中简单使用</h2>
    <p>如果懒的装PHP，则可以使用在线的PHP编译方式：<a href="http://tool.lu/coderunner/" target="_blank">http://tool.lu/coderunner/</a>或<a href="http://www.shucunwang.com/RunCode/php/" target="_blank">http://www.shucunwang.com/RunCode/php/</a> </p>
    <p></p>
    <p>1.preg_match("$regex",$byMatchStr),其中$regex为正则表达式，$byMatchStr为被匹配的字符串,成功返回true，否则false</p>
    <code class="demo_code">
        if(preg_match("/php/", "php is best language of the world. php is not pai huang pian.", $matches)){<br/>
            echo "php was found:". $matches[0];<br/>
        } else {<br/>
            echo "php was not found:";<br/>
        }
    </code>

    <p>2.preg_match_all("$regex",$byMatchStr),其中$regex为正则表达式，$byMatchStr为被匹配的字符串,成功返回true，否则false</p>
    <code class="demo_code">
        if(preg_match_all("/php/", "php is best language of the world. php is not pai huang pian.", $matches)){<br/>
        echo "php was found:"<br/>
        var_dump($matches);
        } else {<br/>
        echo "php was not found:";<br/>
        }
    </code>

    <p>3.preg_replace("$regex",$str,$byMatchStr),其中$str把$byMatchStr替换掉的字符串</p>
    <code class="demo_code">
        $byMatchStr = "php is best language of the world.";<br/>
        echo $byMatchStr;<br/>
        echo "\n";<br/>
        echo preg_replace("/php/",<br/>"JavaScript",$byMatchStr);<br/>
        echo "\n";<br/>
        echo $byMatchStr;
    </code>

    <p>4.preg_split("$regex",$byMatchStr),使用正则转换数组</p>
    <code class="demo_code">
        $byMatchStr = "php is best language of the world.";<br/>
        $array = preg_split("/ /",$byMatchStr);<br/>
        foreach($array as $a){<br/>
        echo $a."\n";<br/>
        }<br/>
    </code>

    <p>5.preg_grep("$regex",$byMatchArray),使用正则替换数组，生成新数组</p>
    <code class="demo_code">
        $byMatchArray = array("a","b","c","ab","ba","bc");<br/>
        $newArray = preg_grep("/b$/",$byMatchArray);<br/>
        var_dump($newArray);
    </code>

</article>

<article style="display: none;">
    <h2>四、进阶</h2>
</article>

</div>

</section>

<?php $this->load->view('common/footer');?>

<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_list.js" src="//www.boatsky.com/static/module/require/require.js"></script>

</body>
</html>