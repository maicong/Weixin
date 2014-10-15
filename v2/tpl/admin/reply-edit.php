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
        <form role="form" action="<?php echo $wxdo->join2url(array('e'=>'update')); ?>" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label>类型</label>
                    <div class="radio" id="select-type">
                        <label>
                            <input type="radio" name="edit-type" id="rtype1" value="text"<?php if ($info['type'] == 'text') {echo ' checked';}?>>
                            文本
                        </label>
                        <label>
                            <input type="radio" name="edit-type" id="rtype2" value="news"<?php if ($info['type'] == 'news') {echo ' checked';}?>>
                            图文
                        </label>
                        <label>
                            <input type="radio" name="edit-type" id="rtype3" value="link"<?php if ($info['type'] == 'link') {echo ' checked';}?>>
                            链接
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>字段</label>
                    <input type="text" class="form-control" name="edit-key" value="<?php echo $info['key']?>" placeholder="用户提交的 ..."/>
                </div>
            <?php if ($info['type'] == 'text') {?>
                <div class="form-group for-rtype" id="for-rtype1">
                    <label>内容[文本]</label>
                    <textarea class="form-control" rows="3" name="edit-note" placeholder="我将回复的 ..."><?php echo $info['note']?></textarea>
                </div>
            <?php } elseif ($info['type'] == 'news') {?>
                <div class="form-group for-rtype hide" id="for-rtype2">
                    <?php foreach ($info['note'] as $key => $value) {
                    # code...
                    }?>
                    <p><input type="text" class="form-control" name="edit-note-tit" value="" placeholder="标题 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-des" value="" placeholder="摘要 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-img" value="" placeholder="图片地址 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-url" value="" placeholder="链接地址 ..."/></p>
                </div>
            <?php } elseif ($info['type'] == 'link') {?>
                <div class="form-group for-rtype hide" id="for-rtype3">
                    <label>内容[链接]</label>
                    <?php foreach ($info['note'] as $key => $value) {
                    # code...
                    }?>
                    <p><input type="text" class="form-control" name="edit-note-tit" value="" placeholder="标题 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-des" value="" placeholder="摘要 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-img" value="" placeholder="图片地址 ..."/></p>
                    <p><input type="text" class="form-control" name="edit-note-url" value="" placeholder="链接地址 ..."/></p>
                </div>
            <?php }?>
            </div>
            <div class="box-footer">
                <input type="hidden" name="edit-id" value="<?php echo $info['id'];?>" />
                <input type="hidden" name="<?php echo $wxdo->get_csrf_token_name();?>" value="<?php echo $wxdo->get_csrf_hash();?>" />
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </form>
        </div>
        </section>
    </aside>
