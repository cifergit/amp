<?php
/**
 * Created by IntelliJ IDEA.
 * User: cifer
 * Date: 2016/6/7
 * Time: 0:29
 */
?>
    <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/component/syntaxHighlighter/styles/shCoreDefault.css"/>
    <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/css/blog/blog_html.css"/>
    <script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="http://www.boatsky.com/static/component/syntaxHighlighter/scripts/shBrushXml.js"></script>
    <script type="text/javascript">
        SyntaxHighlighter.defaults['quick-code'] = false;
        SyntaxHighlighter.defaults['toolbar'] = false;
        //SyntaxHighlighter.defaults['html-script'] = true;
        SyntaxHighlighter.all();
    </script>

</head>
<body>

<?php $this->load->view('common/header');?>

<section class="main_wrap">
    <div class="mod_inner">
        <h1 class="title">如何用正确的姿势写HTML</h1>

        <article class="article">
            <h2 class="article_title">前言</h2>
            <p>
小编接触大一才接触一些像C、HTML（HyperText Markup Language）等基础的语言，当时初学HTML就花了几天时间写了一个20多个静态页面的“家乡网”，当时还是用的frame,table布局。
                之后HTML也没怎么用它。直到大四实习，真正开始写生产环境的HTML，并接触像jQuery,BooStrap等前端框架，此刻否定大一的写法。
                更后来，小编毕业后从事前端2年，回头看，大四的姿势也是不对。所以，小编无法保证什么是正确的姿势，但知道自己在成长，可以分享一点成长的经历。
            </p>
        </article>

        <article class="article">
            <h2 class="article_title">1.HTML的开端——head</h2>
            <p>我们先看这么一个常见的简单的html-demo</p>
            <!--<!DOCTYPE html>
            <html>
            <head lang="en">
                <meta charset="UTF-8">
                <meta name="renderer" content="webkit">
                <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
                <title>如何用正确的姿势写HTML</title>
                <meta name="description" content="介绍HTML的正确写法">
                <meta name="keywords" content="怎么编写HTML，HTML该怎么写，正确的HTML写法">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
                <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/css/common/global.css"/>
                <link type="text/css" rel="stylesheet" href="html_write.css"/>
            </head>
            <body>
如何用正确的姿势写HTML
            </body>
            </html>-->
            <pre class="brush: xml;">
                &lt;!DOCTYPE html&gt;
                &lt;html&gt;
                &lt;head lang=&quot;zh-cmn-Hans&quot;&gt;
                    <meta charset="UTF-8">
                    <meta name="renderer" content="webkit">
                    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
                    <title>如何用正确的姿势写HTML</title>
                    <meta name="description" content="介绍HTML的正确写法">
                    <meta name="keywords" content="怎么编写HTML，HTML该怎么写，正确的HTML写法">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
                    <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/css/common/global.css"/>
                    <link type="text/css" rel="stylesheet" href="http://www.boatsky.com/static/css/blog/blog_list.css"/>
                &lt;/head&gt;
                &lt;body&gt;
                <script type="text/javascript">
                    var baseUrl = 'http://www.boatsky.com/static/';
                </script>
                <header>
                    公共头部
                </header>
                <section class="main_wrap">
                    <div class="mod_inner">
                        如何用正确的姿势写HTML
                    </div>
                </section>
                <script type="text/javascript" src="http://www.boatsky.com/static/js/demo/test.js"></script>
                <footer>
                    公共底部
                </footer>
                <script type="text/javascript">
                    function footer(){}
                </script>
                &lt;/body&gt;
                &lt;/html&gt;
            </pre>
            <h3>1.1 DOCTYPE</h3>
            <p>DOCTYPE虽然不是head，也不是html标签，却是最重要的：告诉浏览器用html5规范。一般我们引入下面这行就行了。</p>
            <pre class="brush: xml;">
                &lt;!DOCTYPE html&gt;
            </pre>
            <p>
                它还有一些兄弟姐妹们(其中声明DTD因为html 4.01基于SGML)</p>
            <pre class="brush: xml;">
                <!-- html 4.01 Transitional，包括展示性的和弃用的元素（比如 font）-->
                &lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Transitional//EN&quot; &quot;http://www.w3.org/TR/html4/loose.dtd&quot;&gt;

                <!-- html 4.01 strict，不包括展示性的和弃用的元素（比如 font）-->
                &lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01//EN&quot; &quot;http://www.w3.org/TR/html4/strict.dtd&quot;&gt;

                <!-- html 4.01 frameset，比上两个多支持一个frameset-->
                &lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Frameset//EN&quot; &quot;http://www.w3.org/TR/html4/frameset.dtd&quot;&gt;

                <!-- xhtml 1.0 Transitional，包括展示性的和弃用的元素（比如 font）-->
                &lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Transitional//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd&quot;&gt;

                <!-- xhtml 1.0 Strict，不包括展示性的和弃用的元素（比如 font）-->
                &lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Strict//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd&quot;&gt;

                <!-- xhtml 1.0 frameset 与Transitional，但允许框架 -->
                &lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.0 Frameset//EN&quot; &quot;http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd&quot;&gt;

                <!-- xhtml 1.1 与strict同，但允许添加模型 -->
                &lt;!DOCTYPE html PUBLIC &quot;-//W3C//DTD XHTML 1.1//EN&quot; &quot;http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd&quot;&gt;
            </pre>
            <p>
                看到这里，是不是有点懵逼？如果我们简单的了解一下它们的关系，就明白是怎么回事了。
            </p>
            <p>
                首先SGML（标准通用标记语言，Standard Generalized Markup language），是1986年国际标准化组织出版发布的一个信息管理方面的国际标准，
                定义电子文档结构和描述其内容的国际标准语言。
            </p>
            <p>
                而HTML（超级文本标记语言，HyperText Markup Language，又名htm）是1993是互联网工程工作小组（IETF）的草案（之后1.0 版本太多，充满争议）。
                历经html 2.0 (1995),html 3.2(1997，w3c标准),html 4.0(1997),html 4.01 (1999)，最后才到万众瞩目的html5（2014-10-28），所以说html只是SGML下的一个应用，
                或说一个专为web显示而设计的特殊的标准，因为万维网被众所周知。
            </p>
            <p>
                因为html 4.01 不区别大小写，高容错率，不符和w3c处女座的习惯，于是2000提出xhtml 1.0，不容错模式（比如标签必须小写，必须有结束标签），不过最后还是类似于ES4，不得而终，
                最后的结果大家都知道了，xhtml 2.0被html5取代。
            </p>
            <p>
                可能大家还用过shtml（Server Side Include，又叫shtm）,其实就是加入服务器的一些包括命令，如<!--#include file="xxx.html"-->，在页面中包含另一个页面，类似php,asp,aspx,jsp等。
            </p>
            <p>
                说到html,当然不得不说xml,xml（可扩展标记语言，Extensible Markup Language）是SGML子集（相当于简化版，只有其规范的十分之一），当时因为SGML过于复杂，而html过于局限，w3c于1998制定，对html进行补充，用来传输与存储数据。
            </p>
            <p>
                不过，后来json（轻量级的数据交换格式，JavaScript Object Notation，1999）横空出世，抢占xml的份额。
            </p>

            <h3>1.2 空间，语言及编码</h3>
            <pre class="brush: xml;">
                &lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
                &lt;head lang=&quot;zh-cmn-Hans&quot;&gt;
                    <meta charset="UTF-8">
                &lt;/head&gt;
                &lt;/html&gt;
            </pre>
            <p>xmlns="http://www.w3.org/1999/xhtml"，xmlns是指xml命名空间（XML Namespaces）,用来处理xml的同名标签不同类型冲突，<a target="_blank" href="http://www.w3.org/1999/xhtml">http://www.w3.org/1999/xhtml</a>指使用这命名空间标签下的内容都遵循xhtml。
            对于xhtml是必须的（不加也会默认加上），而html5则无需加上，加与不加都表现一致。</p>
            <p>lang=&quot;zh-cmn-Hans&quot;指定页面语言，zh-cmn-Hans简体中文，zh-cmn-Hant繁体中文，en泛英语，en-gb英式英语，en-us美式英语，fr-fr法语，de-de德语，it-it意大利语，ja-jp日语</p>
            <p>meta用键值对的方式指定页面元信息，其中charset="UTF-8"指定编码方式为UTF-8。像之前还有gbk bg2312。有兴趣的同学可以了解一下它们的区别：<a target="_blank" href="http://www.cnblogs.com/xiaomia/archive/2010/11/28/1890072.html">http://www.cnblogs.com/xiaomia/archive/2010/11/28/1890072.html</a> </p>
            <pre class="brush: xml;">
                <! -- html5新写法 -->
                <meta charset="UTF-8">
                <! -- 旧写法 -->
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            </pre>

            <h3>1.3 浏览器内核解析</h3>
            <pre class="brush: xml;">
                <meta name="renderer" content="webkit">
                <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
            </pre>
            <p>
                我们知道现在浏览器内核有以下
            </p>
            <table>
                <tr>
                    <td>内核</td>
                    <td>简介</td>
                    <td>相关浏览器</td>
                </tr>
                <tr>
                    <td>webkit</td>
                    <td>WebKit 是一个开源项目，包含的 WebCore 排版引擎<br>和 JSCore 引擎来自于 K Desktop Environment (KDE) 的 KHTML 和 KJS，<br>chrome1 2008开始使用</td>
                    <td>Chrome,Safari,Opera15+</td>
                </tr>
                <tr>
                    <td>Trident</td>
                    <td>MSHTML，是微软开发的一种排版引擎,1997年10月与IE4一起诞生</td>
                    <td>ie4-11</td>
                </tr>
                <tr>
                    <td>Gecko</td>
                    <td>套开放原始码的、以C++编写的网页排版引擎，Netscape 6，2000启用</td>
                    <td>Mozilla Firefox</td>
                </tr>
                <tr>
                    <td>Presto</td>
                    <td>Opera Software开发的浏览器页面渲染引擎，Opera7 2003年启用</td>
                    <td>Opera14-(挪威,1995创立)</td>
                </tr>
            </table>
            <p>显然，现在webkit的天下，而Trident则有很多兼容性问题（比如IE6已经被多数网站放弃，并开始放弃IE7的兼容），gecko依然坚挺，而presto也被Opera放弃。
                为了更好显示HTML效果（其实更多的是CSS），我们会优先用webkit或gecko，不过国内有些浏览器会同时引入以上多个内核，则content="webkit"则会告诉浏览使用webkit内核渲染。
                content="IE=Edge,chrome=1"表示使用最新的Trident版本，如果有用户已经安装了插件Google Chrome Frame(谷歌内嵌浏览器框架GCF)，则在ie上使用webkit内核。
            </p>
        </article>
    </div>
</section>
<script type="text/javascript" data-main="//www.boatsky.com/static/js/blog/blog_html.js" src="//www.boatsky.com/static/module/require/require.js"></script>