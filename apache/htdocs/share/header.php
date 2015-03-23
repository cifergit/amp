<!DOCTYPE html>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>头部</title>
    <link rel="shortcut icon" href="favicon.ico">

    <link href="../module/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../module/bootstrap-3.3.4/css/bootstrap-theme.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../module/jquery/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../module/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <script src="static/js/common/header.js"></script>
</head>

<body>
<div class="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">技术分享</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="headerNav">
                   <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                    <li role="presentation" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">常见技巧<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">居中技巧</a></li>
                            <li><a href="#">雪碧</a></li>
                            <li><a href="#">文字溢出</a></li>
                            <li><a href="#">清除浮动</a></li>
                            <li><a href="#">文字图片替换</a></li>
                        </ul>
                    </li>
                    <li role="presentation" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">浏览器兼容<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"></a></li>
                        </ul>
                    </li>
                    <li role="presentation" class="header_li"><a href="#">邮件页面</a></li>

                </ul>

                <!--<form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>-->

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">GIT版本控制</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
 </div>
</body>
</html>