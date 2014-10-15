<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
<!DOCTYPE html>
<html class="bg-black">
<head>
<meta charset="UTF-8">
<title>管理登录</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body class="bg-black">
<div class="form-box" id="login-box">
    <div class="header">登 录</div>
    <form method="post">
        <div class="body bg-gray">
            <div class="form-group text-center text-red">
                <?php echo $wxdo->session('err');?>
            </div>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="帐号"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="密码"/>
            </div>
        </div>
        <div class="footer">
            <input type="hidden" name="tokenhash" value="<?php echo $hash;?>" />
            <input type="hidden" name="<?php echo $wxdo->get_csrf_token_name();?>" value="<?php echo $wxdo->get_csrf_hash();?>" />
            <button type="submit" class="btn bg-olive btn-block">马上登录</button>
        </div>
    </form>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>