<?php if (!defined('WX_CORE')) {header('HTTP/1.1 403 Forbidden');exit('<h1>403 - Forbidden</h1>');}
/**
 * 管理处理
 * @authors MaiCong (sb@yxx.me)
 * @date    2014-07-23 09:37:47
 * @version v1.0
 */

if (!$wxdo->session('user')) {
	header('location:?v=login');
	exit();
}

function menu_active($method, $string){
	return ($method == $string)?' class="active"':'';
}

$m  = preg_replace('/[^a-z]+/', '', $wxdo->get('m'));
$e  = preg_replace('/[^a-z0-9\-]+/', '', $wxdo->get('e'));
$id = preg_replace('/[^0-9]+/', '', $wxdo->get('id'));

($m != 'showmsg') && $_SESSION['method'] = $m;

include_once (WX_PATH.'/tpl/admin/head.php');

switch ($m) {
	case 'reply':
		switch ($e) {
		case 'add':
				include_once (WX_PATH.'/tpl/admin/reply-add.php');
				break;
		case 'edit':
				$info = $wxdb->where('id', $id)->getOne('chat');
				if (empty($info)) {
					$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'错误！','msg'=>"ID '{$id}' 不存在");
					$wxdo->redirect('?v=admin&m=showmsg');
				} else {
					include_once (WX_PATH.'/tpl/admin/reply-edit.php');
				}
				break;
		case 'update':
				$e_type = preg_replace('/[^a-z]+/', '', $wxdo->post('edit-type'));
				$e_key  = $wxdo->post('edit-key');
				$e_note = $wxdo->post('edit-note');
				$e_id   = preg_replace('/[^0-9]+/', '', $wxdo->post('edit-id'));

				if (empty($e_type) || empty($e_key) || empty($e_note) || empty($e_id)) {
					$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'错误！','msg'=>'参数不能为空');
				} else {
					$info = $wxdb->where('id', $e_id)->getOne('chat');
					if (empty($info)) {
						$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'错误！','msg'=>"ID '{$e_id}' 不存在");
					} elseif ($e_type == $info['type'] && $e_key == $info['key'] && $e_note == $info['note']) {
						$_SESSION['showmsg'] = array('type'=>'info','tip'=>'未更新！','msg'=>"检测到数据一致，系统不做更新处理");
					} else {
						$data = array(
							'type' => $e_type,
							'key'  => $e_key,
							'note' => $e_note
						);
						if ($wxdb->where('id', $e_id)->update('chat', $data)) {
							$_SESSION['showmsg'] = array('type'=>'success','tip'=>'恭喜！','msg'=>'更新成功');
						} else {
							$_SESSION['showmsg'] = array('type'=>'warning','tip'=>'系统错误！','msg'=>'更新失败');
						}
					}
				}

				$wxdo->redirect('?v=admin&m=showmsg');
				break;
		case 'save':
				$a_type = preg_replace('/[^a-z]+/', '', $wxdo->post('add-type'));
				$a_key  = $wxdo->post('add-key');
				$a_note = $wxdo->post('add-note');

				if (empty($a_type) || empty($a_key) || empty($a_note)) {
					$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'错误！','msg'=>'参数不能为空');
				} else {
					$info = $wxdb->where("`key` = '$a_key'")->getOne('chat');
					if (!empty($info)) {
						$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'添加失败！','msg'=>"字段 '{$a_key}' 已存在");
					} else {
						$data = array(
							'type' => $a_type,
							'key'  => $a_key,
							'note' => $a_note
						);
						if ($wxdb->insert('chat', $data)) {
							$_SESSION['showmsg'] = array('type'=>'success','tip'=>'恭喜！','msg'=>'添加成功');
						} else {
							$_SESSION['showmsg'] = array('type'=>'warning','tip'=>'系统错误！','msg'=>'添加失败');
						}
					}
				}
				$wxdo->redirect('?v=admin&m=showmsg');
				break;
		case 'delete':
				$idArr = $wxdo->post('del-id');
				$delid = array();

				if(empty($idArr)){
					$_SESSION['showmsg'] = array('type'=>'danger','tip'=>'错误！','msg'=>'请选择需要删除的 ID');
				} else {
					foreach ($idArr as $id=>$val) {
						$id = preg_replace('/[^0-9]+/', '', $id);
					    $get[$id] = $wxdb->where('id', $id)->get('chat');
					    if(empty($get[$id])){
					        $delid['ID: '.$id] = '没有找到此数据或已被删除';
					    }else{
					    	$delete = $wxdb->where('id', $id)->delete('chat');
					    	if ($delete) {
								$delid['ID: '.$id] = '删除成功';
							} else {
								$delid['ID: '.$id] = '删除失败';
							}
					    }
					}
					$_SESSION['showmsg'] = array('type'=>'info','tip'=>'','msg'=>$delid);
				}

				$wxdo->redirect('?v=admin&m=showmsg');
				break;
		default:
				$psize = 15;
				$page = (int) $wxdo->get('page');
				$page = ($page < 1) ? 1 : $page;
				$jnum = $psize*($page-1);
				$wxdb->orderBy("id","desc");
				$wx_chat = $wxdb->get('chat',array($jnum,$psize));
				$wx_count = count($wx_chat);
				$wx_countAll = count($wxdb->get('chat'));
				include_once (WX_PATH.'/tpl/admin/reply.php');
		}
		break;
	case 'comment':
		include_once (WX_PATH.'/tpl/admin/comment.php');
		break;
	case 'showmsg':
		$showmsg = $wxdo->session('showmsg');
		(!$showmsg) && $showmsg = array('method'=>'index','type'=>'info','tip'=>'呃...','msg'=>'暂时还没有提示消息');
		$method = $wxdo->session('method');
		$showmsg['method'] = (!$method)?'index':$method;
		include_once (WX_PATH.'/tpl/showmsg.php');
		break;
	default:
		include_once (WX_PATH.'/tpl/admin/home.php');
}

include_once (WX_PATH.'/tpl/admin/foot.php');

/*********************** end code ***/