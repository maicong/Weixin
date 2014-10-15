<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                添加自动回复
            </h1>
            <ol class="breadcrumb">
                <li><a href="?v=admin"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">添加自动回复</li>
            </ol>
        </section>
        <section class="content">
        <div class="box">
        <form role="form" action="<?php echo $wxdo->join2url(array('e'=>'save')); ?>" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label>类型</label>
                    <div class="radio" id="select-type">
                        <label>
                            <input type="radio" name="add-type" id="rtype1" value="text" checked>
                            文本
                        </label>
                        <!--
                        <label>
                            <input type="radio" name="add-type" id="rtype2" value="news">
                            图文
                        </label>
                        <label>
                            <input type="radio" name="add-type" id="rtype3" value="link">
                            链接
                        </label>
                        -->
                    </div>
                </div>
                <div class="form-group">
                    <label>字段</label>
                    <input type="text" class="form-control" name="add-key" placeholder="用户提交的 ..."/>
                </div>
                <div class="form-group for-rtype" id="for-rtype1">
                    <label>内容[文本]</label>
                    <textarea class="form-control" rows="3" name="add-note" placeholder="我将回复的 ..."></textarea>
                </div>
                <!--
                <div class="form-group for-rtype hide" id="for-rtype2">
                    <label>内容[图文] <a class="btn btn-default btn-sm" id="newline">增加</a></label>
                    <p><input type="text" class="form-control" name="add-note-tit" placeholder="标题 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-des" placeholder="摘要 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-img" placeholder="图片地址 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-url" placeholder="链接地址 ..."/></p>
                </div>
                <div class="form-group for-rtype hide" id="for-rtype3">
                    <label>内容[链接]</label>
                    <p><input type="text" class="form-control" name="add-note-tit" placeholder="标题 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-des" placeholder="摘要 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-img" placeholder="图片地址 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-url" placeholder="链接地址 ..."/></p>
                </div>
                -->
            </div>
            <div class="box-footer">
                <input type="hidden" name="<?php echo $wxdo->get_csrf_token_name();?>" value="<?php echo $wxdo->get_csrf_hash();?>" />
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
            <!--
            <div id="new-type-line" class="hide">
                <div class="form-group has-success for-rtype">
                    <p><input type="text" class="form-control" name="add-note-tit" placeholder="标题 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-des" placeholder="摘要 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-img" placeholder="图片地址 ..."/></p>
                    <p><input type="text" class="form-control" name="add-note-url" placeholder="链接地址 ..."/></p>
                </div>
            </div>
            -->
        </form>
        </div>
        </section>
    </aside>
