<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                消息记录
            </h1>
            <ol class="breadcrumb">
                <li><a href="?v=admin"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">消息记录</li>
            </ol>
        </section>
        <section class="content">
            <iframe src="https://mp.weixin.qq.com/cgi-bin/message?t=message/list&amp;count=20&amp;day=7&amp;lang=zh_CN" width="100%" height="100%" frameborder="0" scrolling="no" id="mpwx"></iframe>
        </section>
    </aside>
