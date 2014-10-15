<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>管理面板</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body class="skin-blue">
<header class="header">
    <a href="?v=admin" class="logo">管理面板</a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">收起导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i>
                        <span>
                            <?php echo $wxdo->session('user');?> <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header bg-light-blue">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $wxdo->session('user');?> - 管理员
                                <small>上海[***]</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="?v=home" class="btn btn-default btn-flat">首页</a>
                            </div>
                            <div class="pull-right">
                                <a href="?v=logout" class="btn btn-default btn-flat">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>您好, <?php echo $wxdo->session('user');?></p>
                    <a href="#">
                        <i class="fa fa-circle text-success"></i>
                        在线
                    </a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li<?php echo menu_active($m,''); ?>>
                    <a href="?v=admin">
                        <i class="fa fa-dashboard"></i>
                        <span>管理首页</span>
                    </a>
                </li>
                <li<?php echo menu_active($m,'reply'); ?>>
                    <a href="?v=admin&amp;m=reply">
                        <i class="fa fa-reply"></i>
                        <span>回复设置</span>
                    </a>
                </li>
                <!--<li<?php echo menu_active($m,'comment'); ?>>
                    <a href="?v=admin&amp;m=comment">
                        <i class="fa fa-comment"></i>
                        <span>消息记录</span>
                    </a>
                </li>-->
            </ul>
        </section>
    </aside>
