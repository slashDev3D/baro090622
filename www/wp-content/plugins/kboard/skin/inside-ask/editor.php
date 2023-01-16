<div class="kboard-inside-header">
	<?php if($board->meta->inside_ask_contact):?>
	<?php echo wpautop($board->meta->inside_ask_contact)?>
	<?php else:?>
	<h3 class="kboard-inside-header-title">1:1 문의하기</h3>
	<p>• 문의글은 이메일로 답변드리며, 회원으로 문의한 경우 마이페이지 &gt; 1:1문의내역에서도 조회 가능합니다.</p>
	<p>• 서비스 운영시간: 오전 9시 ~ 오후 6시 월 ~ 금 (토, 일, 공휴일 제외)</p>
	<?php endif?>
</div>

<div id="kboard-inside-ask-editor">
	<form class="kboard-form" method="post" action="<?php echo $url->getContentEditorExecute()?>" enctype="multipart/form-data" onsubmit="return kboard_editor_execute(this);">
		<?php wp_nonce_field('kboard-editor-execute', 'kboard-editor-execute-nonce')?>
		<input type="hidden" name="action" value="kboard_editor_execute">
		<input type="hidden" name="mod" value="editor">
		<input type="hidden" name="uid" value="<?php echo $content->uid?>">
		<input type="hidden" name="board_id" value="<?php echo $content->board_id?>">
		<input type="hidden" name="parent_uid" value="<?php echo $content->parent_uid?>">
		<input type="hidden" name="member_uid" value="<?php echo $content->member_uid?>">
		<input type="hidden" name="member_display" value="<?php echo $content->member_display?>">
		<input type="hidden" name="date" value="<?php echo $content->date?>">
		<input type="hidden" name="user_id" value="<?php echo get_current_user_id()?>">
		<input type="hidden" name="wordpress_search" value="3">
		<input type="hidden" name="title" value="<?php echo $content->title?$content->title:'1:1 문의'?>">
		<input type="hidden" name="secret" value="true">
		
		<?php if(!is_user_logged_in()):?>
		<div class="kboard-attr-row">
			<div class="privacy">
				<div class="privacy-scroll">
					<?php if($board->meta->inside_ask_privacy):?>
					<?php echo wpautop($board->meta->inside_ask_privacy)?>
					<?php else:?>
						<p>1. 수집항목: 이메일, 비밀번호, 문의내용 및 기타 고객이 직접 입력한 내용</p>
						<p>2. 수집목적: 고객문의 ,접수, 처리결과 안내</p>
						<p>3. 보유 및 이용기간: 상담 문의 접수 시점 및 상담 완료 후 6개월이며, 세부사항은 ‘개인정보처리방침’을 확인</p>
						<p>(단, 관련 법령에 의거 보존할 필요성이 있는 경우에는 관련 법령에 따라 보존 가능)</p>
					<?php endif?>
				</div>
				<hr>
				<label><input type="checkbox" name="agree" value="1"<?php if($content->uid):?> checked<?php endif?>> (필수) 위 내용에 동의합니다.</label>
			</div>
		</div>
		<?php endif?>
		
		<?php
		ob_start();
		do_action('kboard_skin_editor_option', $content, $board, $boardBuilder);
		$editor_option = ob_get_clean();
		if($editor_option):?>
		<div class="kboard-attr-row">
			<div class="attr-name"><?php echo __('Options', 'kboard')?></div>
			<div class="attr-value">
				<?php echo $editor_option?>
			</div>
		</div>
		<?php endif?>
		
		<?php if(!$content->parent_uid):?>
			<?php $user = wp_get_current_user()?>
			<div class="kboard-attr-row">
				<label class="attr-name" for="kboard_option_email">이메일<span class="required">*</span></label>
				<div class="attr-value"><input type="email" id="kboard_option_email" name="kboard_option_email" value="<?php echo $content->option->email ? $content->option->email : $user->user_email?>" placeholder=""></div>
			</div>
		<?php endif?>
		
		<?php if(!is_user_logged_in()):?>
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard-input-password">비밀번호<span class="required">*</span></label>
			<div class="attr-value">
				<input type="password" id="kboard-input-password" name="password" value="<?php echo $content->password?>" placeholder="">
				<div class="description">8-16자 이내의 영문, 숫자, 특수문자의 조합으로 구성</div>
			</div>
		</div>
		
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard-input-password2">비밀번호 확인<span class="required">*</span></label>
			<div class="attr-value"><input type="password" id="kboard-input-password2" name="password2" value="<?php echo $content->password?>" placeholder=""></div>
		</div>
		<?php endif?>
		
		<?php if(!$content->parent_uid):?>
			<?php $user = wp_get_current_user()?>
			<div class="kboard-attr-row">
				<label class="attr-name" for="kboard-input-member-display">이름<span class="required">*</span></label>
				<div class="attr-value"><input type="text" id="kboard-input-member-display" name="member_display" value="<?php echo $content->member_display ? $content->member_display : $user->display_name?>" placeholder=""></div>
			</div>
		<?php endif?>
		
		<?php if(!$content->parent_uid):?>
			<?php if($board->use_category):?>
				<?php if($board->isTreeCategoryActive()):?>
					<div class="kboard-attr-row">
						<label class="attr-name" for="kboard-tree-category"><?php echo __('Category', 'kboard')?><span class="required">*</span></label>
						<div class="attr-value">
							<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
							<input type="hidden" id="tree-category-check-<?php echo $i?>" value="<?php echo $content->option->{'tree_category_'.$i}?>">
							<input type="hidden" name="kboard_option_tree_category_<?php echo $i?>" value="">
							<?php endfor?>
							<div class="kboard-tree-category-wrap"></div>
						</div>
					</div>
				<?php else:?>
					<?php if($board->initCategory1()):?>
					<div class="kboard-attr-row">
						<label class="attr-name" for="kboard-select-category1"><?php echo __('Category', 'kboard')?><span class="required">*</span></label>
						<div class="attr-value">
							<select id="kboard-select-category1" name="category1">
								<option value=""><?php echo __('Category', 'kboard')?> <?php echo __('Select', 'kboard')?></option>
								<?php while($board->hasNextCategory()):?>
								<option value="<?php echo $board->currentCategory()?>"<?php if($content->category1 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
								<?php endwhile?>
							</select>
						</div>
					</div>
					<?php endif?>
				<?php endif?>
			<?php endif?>
		<?php endif?>
		
		<?php if(!$content->parent_uid):?>
			<?php if(!$board->initCategory2()) $board->category = inside_ask_status()?>
			<input type="hidden" name="category2" value="<?php echo $content->category2?$content->category2:$board->category[0]?>">
		<?php endif?>
		
		<?php if($board->useCAPTCHA() && !$content->uid):?>
			<?php if(kboard_use_recaptcha()):?>
				<div class="kboard-attr-row">
					<label class="attr-name"></label>
					<div class="attr-value"><div class="g-recaptcha" data-sitekey="<?php echo kboard_recaptcha_site_key()?>"></div></div>
				</div>
			<?php else:?>
				<div class="kboard-attr-row">
					<label class="attr-name" for="kboard-input-captcha"><img src="<?php echo kboard_captcha()?>" alt=""></label>
					<div class="attr-value"><input type="text" id="kboard-input-captcha" name="captcha" value="" placeholder="<?php echo __('CAPTCHA', 'kboard')?>..."></div>
				</div>
			<?php endif?>
		<?php endif?>

		<?php if(!$content->parent_uid):?>		
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard_content">문의내용<span class="required">*</span></label>
			<div class="attr-value">
				<?php if($board->use_editor):?>
					<?php wp_editor($content->content, 'kboard_content', array('media_buttons'=>$board->isAdmin(), 'editor_height'=>400))?>
				<?php else:?>
					<textarea name="kboard_content" id="kboard_content" placeholder="<?php if($board->meta->inside_ask_content):echo $board->meta->inside_ask_content; else:?>최대 2,000자 까지 입력 가능합니다.
교환을 원하는 상품에 대한 코드, 상품명, 색상, 수량을 입력해 주시면 신속한 처리가 가능합니다.
현금으로 결제(입금)하여 환불받으실 경우 은행명/계좌번호/예금주를 입력해 주시면 신속한 처리가 가능합니다.<?php endif?>"><?php echo $content->content?></textarea>
				<?php endif?>
			</div>
		</div>
		<?php else:?>
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard_content">답변내용<span class="required">*</span></label>
			<div class="attr-value">
				<?php if($board->use_editor):?>
					<?php wp_editor($content->content, 'kboard_content', array('media_buttons'=>$board->isAdmin(), 'editor_height'=>400))?>
				<?php else:?>
					<textarea name="kboard_content" id="kboard_content"><?php echo $content->content?></textarea>
				<?php endif?>
			</div>
		</div>
		<?php endif?>
		
		<div class="kboard-attr-row">
			<label class="attr-name" for="kboard-input-thumbnail">사진첨부</label>
			<div class="attr-value">
				<?php if($content->thumbnail_file):?><?php echo $content->thumbnail_name?> - <a href="<?php echo $url->getDeleteURLWithAttach($content->uid);?>" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete file', 'kboard')?></a><?php endif?>
				<input type="file" id="kboard-input-thumbnail" name="thumbnail" accept="image/*">
				<div class="description">jpg, gif, png 파일만 첨부 가능합니다.</div>
			</div>
		</div>
		
		<?php if($board->meta->max_attached_count > 0):?>
			<!-- 첨부파일 시작 -->
			<?php for($attached_index=1; $attached_index<=$board->meta->max_attached_count; $attached_index++):?>
			<div class="kboard-attr-row">
				<label class="attr-name" for="kboard-input-file<?php echo $attached_index?>"><?php echo __('Attachment', 'kboard')?><?php echo $attached_index?></label>
				<div class="attr-value">
					<?php if(isset($content->attach->{"file{$attached_index}"})):?><?php echo $content->attach->{"file{$attached_index}"}[1]?> - <a href="<?php echo $url->getDeleteURLWithAttach($content->uid, "file{$attached_index}")?>" onclick="return confirm('<?php echo __('Are you sure you want to delete?', 'kboard')?>');"><?php echo __('Delete file', 'kboard')?></a><?php endif?>
					<input type="file" id="kboard-input-file<?php echo $attached_index?>" name="kboard_attach_file<?php echo $attached_index?>">
				</div>
			</div>
			<?php endfor?>
			<!-- 첨부파일 끝 -->
		<?php endif?>
		
		<div class="kboard-inside-message">
			<div class="message privacy"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 개인정보처리방침에 동의해주세요.</div>
			<div class="message email"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 이메일을 입력해 주세요.</div>
			<div class="message password"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 비밀번호를 입력해 주세요.</div>
			<div class="message password2"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 비밀번호가 일치하지 않습니다. 다시 입력해 주세요.</div>
			<div class="message password3"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 비밀번호는 8-16자 이내의 영문, 숫자, 특수문자의 조합으로 입력해주세요.</div>
			<div class="message name"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 이름을 입력해 주세요.</div>
			<div class="message category1"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 카테고리를 선택해 주세요.</div>
			<div class="message tree_category"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 카테고리를 선택해 주세요.</div>
			<div class="message captcha"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 보안코드를 입력해 주세요.</div>
			<div class="message content"><img src="<?php echo $skin_path?>/images/icon-error.png" alt="error" class="message-icon"> 문의내용을 입력해 주세요.</div>
			<div class="message"><img src="<?php echo $skin_path?>/images/icon-success.png" alt="success" class="message-icon"> 1:1 문의가 접수되었습니다. 빠른 시일 내에 이메일로 답변 드리겠습니다.</div>
		</div>
		
		<?php if(!$content->parent_uid):?>
		<div class="kboard-control">
			<?php if($board->isWriter()):?>
			<button type="submit" class="kboard-inside-ask-button-black">문의하기</button>
			<?php endif?>
		</div>
		<?php else:?>
		<div class="kboard-control">
			<?php if($board->isWriter()):?>
			<button type="submit" class="kboard-inside-ask-button-black">답변하기</button>
			<?php endif?>
		</div>
		<?php endif?>
	</form>
</div>

<?php wp_enqueue_script('inside-ask-script', "{$skin_path}/script.js", array(), KBOARD_VERSION, true)?>