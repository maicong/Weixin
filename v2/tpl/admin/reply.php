<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}?>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                回复设置
            </h1>
            <ol class="breadcrumb">
                <li><a href="?v=admin"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active">回复设置</li>
            </ol>
        </section>
        <section class="content">
        <div class="box-body">
            <form role="form" action="<?php echo $wxdo->join2url(array('e'=>'save')); ?>" method="post">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <div class="input-group-addon">
                                字段
                            </div>
                            <input type="text" class="form-control" name="add-key" placeholder="用户提交的 ...">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <div class="input-group-addon">
                                回复
                            </div>
                            <input type="text" class="form-control" name="add-note" placeholder="我将回复的 ...">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <input type="hidden" name="add-type" value="text">
                        <input type="hidden" name="<?php echo $wxdo->get_csrf_token_name();?>" value="<?php echo $wxdo->get_csrf_hash();?>" />
                        <button class="btn btn-primary" id="daterange-btn"><i class="fa fa-fw fa-pencil-square-o"></i> 快速添加</button>
                        <a href="?v=admin&amp;m=reply&amp;e=add" class="btn btn-default"><i class="fa fa-fw fa-plus-square-o"></i> 高级模式</a>
                    </div>
                </div>
            </form>
        </div>
        <p>&nbsp;</p>
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <form role="form" action="<?php echo $wxdo->join2url(array('e'=>'delete')); ?>" method="post">
                <table class="table table-hover">
                    <tr>
                        <th width="5%">选择</th>
                        <th width="5%">ID</th>
                        <th width="5%">类型</th>
                        <th width="25%">字段</th>
                        <th width="55%">回复</th>
                        <th width="5%">编辑</th>
                    </tr>
                    <?php
                    if ($wx_count > 0) {
                        foreach ($wx_chat as $chat) {
                            $type = ($chat['type'] == 'text')?'文本':(($chat['type'] == 'news')?'图文':'其他');
                            echo '<tr>';
                            echo '<td><input type="checkbox" class="del-id" name="del-id['.$chat['id'].']" value="'.$chat['id'].'"></td>';
                            echo '<td>'.$chat['id'].'</td>';
                            echo '<td>'.$type.'</td>';
                            echo '<td>'.$chat['key'].'</td>';
                            echo '<td>'.$chat['note'].'</td>';
                            echo '<td><a href="'.$wxdo->join2url(array('e'=>'edit','id'=>$chat['id'])).'" class="btn btn-default btn-sm">编辑</a></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">还没有数据哦，你可以<a href="'.$wxdo->join2url(array('e'=>'add')).'">添加自动回复</a></td></tr>';
                    }
                    ?>
                    <tr>
                    <td>
                        <input type="checkbox" id="check-all">
                        <label for="check-all"><button class="btn btn-default btn-sm" id="check-all-btn"><i class="fa fa-fw fa-check-square-o"></i> 全选</button></label>
                    </td>
                    <td>
                        <input type="hidden" name="<?php echo $wxdo->get_csrf_token_name();?>" value="<?php echo $wxdo->get_csrf_hash();?>" />
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i> 删除 (此操作不可逆，请谨慎选择)</button>
                    </td>
                    <td colspan="4">
                        <?php $wxdo->page_nav($wx_countAll,$psize,$page); ?></td>
                    </td>
                    </tr>
                </table>
                </form>
            </div>
            <div class="box-footer clearfix"></div>
        </div>
        </section>
    </aside>