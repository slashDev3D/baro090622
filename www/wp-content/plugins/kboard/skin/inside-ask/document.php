<div class="kboard-inside-header">
	<?php if($board->meta->inside_ask_contact):?>
	<?php echo wpautop($board->meta->inside_ask_contact)?>
	<?php else:?>
	<h3 class="kboard-inside-header-title">1:1 문의하기</h3>
	<p>• 문의글은 이메일로 답변드리며, 회원으로 문의한 경우 마이페이지 &gt; 1:1문의내역에서도 조회 가능합니다.</p>
	<p>• 서비스 운영시간: 오전 9시 ~ 오후 6시 월 ~ 금 (토, 일, 공휴일 제외)</p>
	<?php endif?>
</div>

<div id="kboard-document">
	<div id="kboard-inside-ask-list">
		
		<!-- 리스트 시작 -->
		<div class="kboard-list">
			<table>
				<thead>
					<tr>
						<td class="kboard-list-date"><?php echo __('Date', 'kboard')?></td>
						<?php if($board->use_category == 'yes'):?>
							<td class="kboard-list-category"><?php echo __('Category', 'kboard')?></td>
						<?php endif?>
						<td class="kboard-list-title"><?php echo __('Content', 'kboard')?></td>
						<td class="kboard-list-status"><?php echo __('Status', 'kboard')?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="kboard-list-date"><?php echo $content->getDate()?></td>
						<?php if($board->use_category == 'yes'):?>
							<td class="kboard-list-category">
								<?php if($board->isTreeCategoryActive()):?>
								<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
									<div class="category"><?php echo $content->option->{'tree_category_'.$i}?></div>
								<?php endfor?>
								<?php else:?>
									<div class="category"><?php echo $content->category1?></div>
								<?php endif?>
							</td>
						<?php endif?>
						<td class="kboard-list-title">
							<div class="kboard-mobile-contents">
								<div class="mobile-date"><?php echo $content->getDate()?></div>
								<?php if($board->use_category == 'yes'):?>
									<div class="mobile-category">
										<?php 
										if($board->isTreeCategoryActive()){
											for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
											<div class="category"><?php echo $content->option->{'tree_category_'.$i}?></div>
											<?php endfor;
										}
										else{
											echo $content->category1;
										}
										?>
									</div>
								<?php endif?>
							</div>
							<div class="kboard-inside-ask-cut-strings">
								<?php if($content->isNew()):?><span class="kboard-inside-ask-new-notify">New</span><?php endif?>
								<?php echo wp_strip_all_tags($content->content)?>
							</div>
							<div class="kboard-mobile-contents">
								<div class="mobile-status">
									<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
								</div>
							</div>
						</td>
						<td class="kboard-list-status">
							<?php if($board->isAdmin()):?>
								<?php if(!$board->initCategory2()) $board->category = inside_ask_status()?>							
								<select id="kboard-select-category2" name="category2" onchange="kboard_inside_ask_category_update('<?php echo $content->uid?>', this.value)">
								<option value="">상태없음</option>
								<?php while($board->hasNextCategory()):?>
								<option value="<?php echo $board->currentCategory()?>"<?php if($content->category2 == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
								<?php endwhile?>
								</select>
							<?php else:?>
								<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
							<?php endif?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- 리스트 끝 -->
		
		<div class="kboard-document-area-wrap">
			<div class="kboard-document-area question">
				<div class="document-icon">Q</div>
				<div class="document-content">
					<?php
					$question = new KBContent();
					$question->initWithUID($content->uid);
					echo wpautop($question->content);
					?>
				</div>
				<?php if($question->thumbnail_file):?><div class="document-thumbnail"><a href="<?php echo get_site_url() . $question->thumbnail_file?>" target="_blank"><img src="<?php echo get_site_url() . $question->thumbnail_file?>" alt=""></a></div><?php endif?>
				
				<?php if($content->isAttached()):?>
				<div class="kboard-attach">
					<?php foreach($content->getAttachmentList() as $key=>$attach):?>
					<button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($content->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
					<?php endforeach?>
				</div>
				<?php endif?>
				
				<div class="document-info">
					<?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?>
					<?php if($question->option->email):?>
						ㆍ <a href="mailto:<?php echo $question->option->email?>" target="_blank" title="이메일 쓰기"><?php echo $question->option->email?></a>
					<?php endif?>
					<?php if($content->isEditor() || $board->permission_write=='all'):?>
						ㆍ <a href="<?php echo $url->getContentEditor($content->uid)?>">수정</a>
						ㆍ <a href="<?php echo $url->getContentRemove($content->uid)?>">삭제</a>
					<?php endif?>
				</div>
			</div>
			
			<?php
			$answer = inside_ask_get_answer($content->uid);
			if($answer->uid):
			?>
			<div class="kboard-document-area answer">
				<div class="document-icon">A</div>
				<div class="document-content">
					<?php echo wpautop($answer->content)?>
				</div>
				<?php if($answer->thumbnail_file):?><div class="document-thumbnail"><a href="<?php echo get_site_url() . $answer->thumbnail_file?>" target="_blank"><img src="<?php echo get_site_url() . $answer->thumbnail_file?>" alt=""></a></div><?php endif?>
				<?php if($answer->isAttached()):?>
				<div class="kboard-attach">
					<?php foreach($answer->getAttachmentList() as $key=>$attach):?>
					<button type="button" class="kboard-button-action kboard-button-download" onclick="window.location.href='<?php echo $url->getDownloadURLWithAttach($answer->uid, $key)?>'" title="<?php echo sprintf(__('Download %s', 'kboard'), $attach[1])?>"><?php echo $attach[1]?></button>
					<?php endforeach?>
				</div>
				<?php endif?>
				<div class="document-info">
					<?php echo date('Y-m-d H:i', strtotime($answer->date))?>
					<?php if($answer->isEditor()):?>
						ㆍ <a href="<?php echo $url->getContentEditor($answer->uid)?>">수정</a>
						ㆍ <a href="<?php echo $url->getContentRemove($answer->uid)?>">삭제</a>
					<?php endif?>
				</div>
			</div>
			<?php endif?>
		</div>
		
		<?php if(!$answer->uid && $board->isAdmin()):?>
		<div class="kboard-control">
			<button type="button" class="kboard-inside-ask-button-white" onclick="window.location.href='<?php echo $url->set('parent_uid', $content->uid)->set('mod', 'editor')->toString()?>'">답변쓰기</button>
		</div>
		<?php endif?>
		
		<div class="kboard-control">
		<?php if(is_user_logged_in()):?>
			<button type="button" class="kboard-inside-ask-button-black" onclick="window.location.href='<?php echo $url->set('mod', 'list')->set('list_mod', 'member_list')->toString()?>'">목록으로 돌아가기</button>
		<?php elseif(isset($_SESSION['nonmember_list_search'][$board->id]['email']) && $_SESSION['nonmember_list_search'][$board->id]['email'] && isset($_SESSION['nonmember_list_search'][$board->id]['password']) && $_SESSION['nonmember_list_search'][$board->id]['password']):?>
			<button type="button" class="kboard-inside-ask-button-black" onclick="window.location.href='<?php echo $url->set('mod', 'list')->set('list_mod', 'nonmember_list')->toString()?>'">목록으로 돌아가기</button>
		<?php else:?>
			<button type="button" class="kboard-inside-ask-button-black" onclick="window.location.href='<?php echo $url->set('mod', 'list')->set('list_mod', '')->toString()?>'">돌아가기</button>
		<?php endif?>
		</div>
		
		<?php if($board->contribution() && !$board->meta->always_view_list):?>
		<div class="kboard-inside-ask-poweredby">
			<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
		</div>
		<?php endif?>
	</div>
</div>

<?php wp_enqueue_script('inside-ask-document', "{$skin_path}/document.js", array(), KBOARD_VERSION, true)?>