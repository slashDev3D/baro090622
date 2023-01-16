<?php
/*
 * inside-ask
 */
$inside_ask_skin_dir_name = basename(dirname(__FILE__));

if(!function_exists('inside_ask_status')){
	function inside_ask_status(){
		$status = array('답변대기', '답변완료');
		return $status;
	}
}

if(!function_exists('inside_ask_kboard_document_insert')){
	add_action('kboard_document_insert', 'inside_ask_kboard_document_insert', 10, 4);
	function inside_ask_kboard_document_insert($content_uid, $board_id, $content, $board){
		if($board->skin == basename(dirname(__FILE__))){
			$nonmember_email = isset($_POST['kboard_option_email']) ? sanitize_text_field($_POST['kboard_option_email']) : '';
			$nonmember_password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
			
			if($nonmember_email && $nonmember_password){
				$_SESSION['nonmember_list_search'][$board_id]['email'] = $nonmember_email;
				$_SESSION['nonmember_list_search'][$board_id]['password'] = $nonmember_password;
			}
			
			if($content->parent_uid){
				$parent = new KBContent();
				$parent->initWithUID($content->parent_uid);
				
				if($parent->option->inside_ask_notify && $parent->option->email){
					if(!class_exists('KBMail')){
						include_once KBOARD_DIR_PATH . '/class/KBMail.class.php';
					}
					$url = new KBUrl();
					$mail = new KBMail();
					$mail->to = $parent->option->email;
					$mail->title = apply_filters('inside_ask_kboard_latest_alerts_subject', '문의사항에 답변이 달렸습니다.', $content);
					$mail->content = apply_filters('inside_ask_kboard_latest_alerts_message', $content->content, $content);
					$mail->url = $url->getDocumentRedirect($parent->uid);
					$mail->url_name = apply_filters('inside_ask_kboard_latest_alerts_button', '문의사항 확인하기', $content);
					$mail->send();
				}
			}
		}
	}
}

if(!function_exists('inside_ask_kboard_list_where')){
	add_filter('kboard_list_where', 'inside_ask_kboard_list_where', 10, 3);
	function inside_ask_kboard_list_where($where, $board_id, $content_list){
		global $wpdb;
		
		$board = new KBoard($board_id);
		
		if($board->skin == basename(dirname(__FILE__)) && !$board->isAdmin()){
			$list_mod = isset($_GET['list_mod']) ? $_GET['list_mod'] : '';
			
			if($list_mod == 'nonmember_list'){
				if(isset($_POST['kboard-kboard-inside-ask-nonmember-nonce']) && wp_verify_nonce($_POST['kboard-kboard-inside-ask-nonmember-nonce'], 'kboard-kboard-inside-ask-nonmember')){
					$nonmember_form_email = isset($_POST['nonmember_form_email']) ? sanitize_text_field($_POST['nonmember_form_email']) : '';
					$nonmember_form_password = isset($_POST['nonmember_form_password']) ? sanitize_text_field($_POST['nonmember_form_password']) : '';
				}
				else{
					$nonmember_form_email = isset($_SESSION['nonmember_list_search'][$board_id]['email']) ? sanitize_text_field($_SESSION['nonmember_list_search'][$board_id]['email']) : '';
					$nonmember_form_password = isset($_SESSION['nonmember_list_search'][$board_id]['password']) ? sanitize_text_field($_SESSION['nonmember_list_search'][$board_id]['password']) : '';
				}
				
				if($nonmember_form_email && $nonmember_form_password){
					$_SESSION['nonmember_list_search'][$board_id]['email'] = $nonmember_form_email;
					$_SESSION['nonmember_list_search'][$board_id]['password'] = $nonmember_form_password;
					
					$email = esc_sql($nonmember_form_email);
					$password = esc_sql($nonmember_form_password);
					$where = $where . " AND `uid` IN (SELECT `content_uid` FROM `{$wpdb->prefix}kboard_board_option` WHERE `option_key`='email' AND `option_value`='$email') AND `password`='$password'";
				}
				else{
					$_SESSION['nonmember_list_search'][$board_id]['email'] = '';
					$_SESSION['nonmember_list_search'][$board_id]['password'] = '';
					
					$where = '1=0';
				}
			}
			else if(is_user_logged_in()){
				$user_id = get_current_user_id();
				$where = $where . " AND `member_uid`='$user_id'";
			}
			else{
				$where = '1=0';
			}
		}
		
		return $where;
	}
}

if(!function_exists('inside_ask_has_answered')){
	function inside_ask_has_answered($parent_uid){
		global $wpdb;
		$parent_uid = intval($parent_uid);
		return $wpdb->get_var("SELECT `uid` FROM `{$wpdb->prefix}kboard_board_content` WHERE `parent_uid`='$parent_uid' ORDER BY `uid` DESC LIMIT 1");
	}
}

if(!function_exists('inside_ask_get_answer')){
	function inside_ask_get_answer($parent_uid){
		global $wpdb;
		$parent_uid = intval($parent_uid);
		$answer_uid = $wpdb->get_var("SELECT `uid` FROM `{$wpdb->prefix}kboard_board_content` WHERE `parent_uid`='$parent_uid' ORDER BY `uid` DESC LIMIT 1");
		$answer = new KBContent();
		$answer->initWithUID($answer_uid);
		return $answer;
	}
}

if(!function_exists('inside_ask_kboard_extends_setting')){
	add_filter('kboard_'.$inside_ask_skin_dir_name.'_extends_setting', 'inside_ask_kboard_extends_setting', 10, 3);
	function inside_ask_kboard_extends_setting($html, $meta, $board_id){
		$board = new KBoard($board_id);
		
		echo '<table class="form-table"><tbody>';
		
		$inside_ask_contact = $board->meta->inside_ask_contact ? $board->meta->inside_ask_contact : '<h3 class="kboard-inside-header-title">1:1 문의하기</h3>
		<p>• 문의글은 이메일로 답변드리며, 회원으로 문의한 경우 마이페이지 &gt; 1:1문의내역에서도 조회 가능합니다.</p>
		<p>• 서비스 운영시간: 오전 9시 ~ 오후 6시 월 ~ 금 (토, 일, 공휴일 제외)</p>';
		$inside_ask_member = $board->meta->inside_ask_member ? $board->meta->inside_ask_member : '<h4 class="main-contents-title">회원으로 1:1 문의하기</h4>
		<p>회원으로 1:1 문의를 이용하시면 마이페이지에서 현재 문의 중인 내용은 물론 지난 처리 결과도 조회 가능합니다.</p>';
		$inside_ask_non_member = $board->meta->inside_ask_non_member ? $board->meta->inside_ask_non_member : '<h4 class="main-contents-title">비회원으로 1:1 문의하기</h4>
		<p>1:1 문의는 비회원도 동일하게 이용 가능하며, 이메일은 물론 비회원 1:1 문의 답변확인하기 메뉴를 통해 처리 결과를 확인하실 수 있습니다.</p>';
		$inside_ask_privacy = $board->meta->inside_ask_privacy ? $board->meta->inside_ask_privacy : '<p>1. 수집항목: 이메일, 비밀번호, 문의내용 및 기타 고객이 직접 입력한 내용</p>
		<p>2. 수집목적: 고객문의 ,접수, 처리결과 안내</p>
		<p>3. 보유 및 이용기간: 상담 문의 접수 시점 및 상담 완료 후 6개월이며, 세부사항은 ‘개인정보처리방침’을 확인</p>
		<p>(단, 관련 법령에 의거 보존할 필요성이 있는 경우에는 관련 법령에 따라 보존 가능)</p>';
		$inside_ask_content = $board->meta->inside_ask_content ? $board->meta->inside_ask_content : '최대 2,000자 까지 입력 가능합니다.
교환을 원하는 상품에 대한 코드, 상품명, 색상, 수량을 입력해 주시면 신속한 처리가 가능합니다.
현금으로 결제(입금)하여 환불받으실 경우 은행명/계좌번호/예금주를 입력해 주시면 신속한 처리가 가능합니다.';
		
		echo '<tr valign="top">';
		echo '<th scope="row">페이지 상단</th><td>';
		wp_editor($inside_ask_contact, 'inside_ask_contact', array('editor_height'=>200));
		echo '<p class="description">페이지의 상단에 표시할 문구를 입력해주세요.</p>';
		echo '</td></tr>';
		
		echo '<tr valign="top">';
		echo '<th scope="row">회원으로 문의하기</th><td>';
		wp_editor($inside_ask_member, 'inside_ask_member', array('editor_height'=>200));
		echo '</td></tr>';
		
		echo '<tr valign="top">';
		echo '<th scope="row">비회원으로 문의하기</th><td>';
		wp_editor($inside_ask_non_member, 'inside_ask_non_member', array('editor_height'=>200));
		echo '</td></tr>';
		
		echo '<tr valign="top">';
		echo '<th scope="row">개인정보처리방침</th><td>';
		wp_editor($inside_ask_privacy, 'inside_ask_privacy', array('editor_height'=>200));
		echo '<p class="description">비회원으로 글 작성 시 개인정보처리방침에 대한 내용을 입력해주세요.</p>';
		echo '</td></tr>';
		
		echo '<tr valign="top">';
		echo '<th scope="row">문의내용 (placeholder)</th><td>';
		echo '<textarea id="inside_ask_content" name="inside_ask_content" rows="6" style="width: 100%;">'.$inside_ask_content.'</textarea>';
		echo '<p class="description">글 작성 에디터를 textarea로 사용할 때 표시할 문구(placeholder)를 입력해주세요.</p>';
		echo '<p class="description">워드프레스 내장 에디터에서는 표시되지 않습니다.</p>';
		echo '</td></tr>';
		
		echo '</tbody></table>';
		
		return $html;
	}
}

if(!function_exists('inside_ask_kboard_extends_setting_update')){
	add_filter('kboard_'.$inside_ask_skin_dir_name.'_extends_setting_update', 'inside_ask_kboard_extends_setting_update', 10, 2);
	function inside_ask_kboard_extends_setting_update($board_meta, $board_id){
		$board_meta->inside_ask_contact = isset($_POST['inside_ask_contact'])?$_POST['inside_ask_contact']:'';
		$board_meta->inside_ask_member = isset($_POST['inside_ask_member'])?$_POST['inside_ask_member']:'';
		$board_meta->inside_ask_non_member = isset($_POST['inside_ask_non_member'])?$_POST['inside_ask_non_member']:'';
		$board_meta->inside_ask_privacy = isset($_POST['inside_ask_privacy'])?$_POST['inside_ask_privacy']:'';
		$board_meta->inside_ask_content = isset($_POST['inside_ask_content'])?$_POST['inside_ask_content']:'';
	}
}

if(!function_exists('inside_ask_kboard_after_executing_url')){
	add_filter('kboard_after_executing_url', 'inside_ask_kboard_after_executing_url', 10, 3);
	function inside_ask_kboard_after_executing_url($next_page_url, $execute_uid, $board_id){
		$board = new KBoard($board_id);
		if($board->skin == basename(dirname(__FILE__))){
			$content = new KBContent();
			$content->initWithUID($execute_uid);
			$url = new KBUrl();
			$category2 = array();
			
			if($board->initCategory2()){
				while($board->hasNextCategory()){
					$category2[] = $board->currentCategory();
				}
			}
			else{
				$category2 = inside_ask_status();
			}
			
			if($content->parent_uid){
				$parent_content = new KBContent();
				$parent_content->initWithUID($content->parent_uid);
				
				$next_page_url = $url->set('uid', $content->parent_uid)->set('mod', 'document')->toString();
			}
			
			if(is_user_logged_in()){
				$next_page_url = add_query_arg( array('list_mod'=>'member_list'), $next_page_url);
			}
			else{
				$next_page_url = add_query_arg( array('list_mod'=>'nonmember_list'), $next_page_url);
			}
		}
		return $next_page_url;
	}
}

if(!function_exists('inside_ask_kboard_password_confirm')){
	add_filter('kboard_password_confirm', 'inside_ask_kboard_password_confirm', 10, 6);
	function inside_ask_kboard_password_confirm($confirm, $input_password, $content_password, $content_uid, $reauth, $board){
		if($board->skin == basename(dirname(__FILE__))){
			if(isset($_SESSION['nonmember_list_search'][$board->id]['email']) && $_SESSION['nonmember_list_search'][$board->id]['email'] && isset($_SESSION['nonmember_list_search'][$board->id]['password']) && $_SESSION['nonmember_list_search'][$board->id]['password']){
				if($_SESSION['nonmember_list_search'][$board->id]['password'] == $content_password){
					$confirm = true;
				}
			}
		}
		return $confirm;
	}
}

if(!function_exists('inside_ask_kboard_skin_editor_option')){
	add_action('kboard_skin_editor_option', 'inside_ask_kboard_skin_editor_option', 10, 3);
	function inside_ask_kboard_skin_editor_option($content, $board, $builder){
		if($board->skin == basename(dirname(__FILE__))){
			if(!$content->parent_uid){
				?>
				<label class="attr-value-option">
					<input type="hidden" name="kboard_option_inside_ask_notify" value="">
					<input type="checkbox" name="kboard_option_inside_ask_notify" value="1"<?php if($content->option->inside_ask_notify):?> checked<?php endif?>>
					<?php echo apply_filters('inside_ask_notify_text', '답변 등록시 이메일로 알림 받기', $content)?>
				</label>
				<?php
			}
		}
	}
}

if(!function_exists('inside_ask_cosmosfarm_members_kboard_notify_document_insert')){
	add_filter('cosmosfarm_members_kboard_notify_document_insert', 'inside_ask_cosmosfarm_members_kboard_notify_document_insert', 10, 5);
	function inside_ask_cosmosfarm_members_kboard_notify_document_insert($notification, $content_uid, $board_id, $content, $board){
		if($board->skin == basename(dirname(__FILE__))){
			if($content->parent_uid){
				$url = new KBUrl();
				$notification['meta_input']['url'] = $url->getDocumentRedirect($content->parent_uid);
			}
		}
		return $notification;
	}
}