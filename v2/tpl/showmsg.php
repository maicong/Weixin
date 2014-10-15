<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
    <aside class="right-side">
        <section class="content-header">
            <h1>系统消息</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i>
                        首页
                    </a>
                </li>
                <li class="active">系统消息</li>
            </ol>
        </section>
        <section class="content">
             <div class="box-body">
                <div class="alert alert-<?php echo $showmsg['type']; ?> alert-dismissable">
                    <?php switch ($showmsg['type']) {
                        case 'danger':
                            $showmsg['icon'] = 'ban';
                            break;
                        case 'info':
                            $showmsg['icon'] = 'info';
                            break;
                        case 'warning':
                            $showmsg['icon'] = 'warning';
                            break;
                        case 'success':
                            $showmsg['icon'] = 'check';
                            break;                      
                    }?>
                    <i class="fa fa-<?php echo $showmsg['icon']; ?>"></i>
                    <?php if(is_array($showmsg['msg'])) { foreach ($showmsg['msg'] as $key=>$val) { ?>
                    <p><?php echo $key; ?> <?php echo $val; ?>！</p>
                    <?php } } else { ?>
                    <p><strong><?php echo $showmsg['tip']; ?></strong> <?php echo $showmsg['msg']; ?>！</p>
                    <?php } ?>
                    <p><span id="wait">5</span> 秒后 <a id="href" href="?v=admin&amp;m=<?php echo $showmsg['method']; ?>">自动跳转</a></p>
                    <p><a href="javascript:window.history.go(-1);">返回上页</a></p>
                    <p><a href="?v=admin">返回首页</a></p>
                </div>
             </div>
        </section>
    </aside>
    <script type="text/javascript">
    (function(){
    var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time === 0) {
            location.href = href;
            clearInterval(interval);
        }
    }, 1000);
    })();
    </script>
    <?php unset($_SESSION['showmsg']); ?>