<?php if(kboard_mod() != 'document'):?>
<div class="kboard-inside-header">
	<?php if($board->meta->inside_ask_contact):?>
	<?php echo wpautop($board->meta->inside_ask_contact)?>
	<?php else:?>
	<h3 class="kboard-inside-header-title">1:1 문의하기</h3>
	<p>• 문의글은 이메일로 답변드리며, 회원으로 문의한 경우 마이페이지 &gt; 1:1문의내역에서도 조회 가능합니다.</p>
	<p>• 서비스 운영시간: 오전 9시 ~ 오후 6시 월 ~ 금 (토, 일, 공휴일 제외)</p>
	<?php endif?>
</div>
<?php endif?>

<?php if(isset($_GET['list_mod']) && in_array($_GET['list_mod'], array('member_list', 'nonmember_list'))):?>

<div id="kboard-inside-ask-list">
	
	<!-- 카테고리 시작 -->
	<?php
	if($board->use_category && $board->isAdmin()){
		if($board->isTreeCategoryActive()){
			$category_type = 'tree-select';
		}
		else{
			$category_type = 'default';
		}
		$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
		echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
	}
	?>
	<div class="kboard-category">
	<?php if($board->initCategory2() && $board->isAdmin()):?>
		<form id="kboard-category-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<?php if($board->initCategory2()):?>
				<select name="category2" onchange="jQuery('#kboard-category-form-<?php echo $board->id?>').submit();">
					<option value=""><?php echo __('All', 'kboard')?></option>
					<?php while($board->hasNextCategory()):?>
					<option value="<?php echo $board->currentCategory()?>"<?php if(kboard_category2() == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
					<?php endwhile?>
				</select>
			<?php endif?>
		</form>
	<?php endif?>
	</div>
	<!-- 카테고리 끝 -->
	
	<!-- 리스트 시작 -->
	<div class="kboard-list">
		<table>
			<thead>
				<tr>
					<td class="kboard-list-date"><?php echo __('Date', 'kboard')?></td>
					<?php if($board->use_category):?>
						<td class="kboard-list-category"><?php echo __('Category', 'kboard')?></td>
					<?php endif?>
					<td class="kboard-list-title"><?php echo __('Content', 'kboard')?></td>
					<td class="kboard-list-status"><?php echo __('Status', 'kboard')?></td>
				</tr>
			</thead>
			<tbody>
				<?php while($content = $list->hasNextNotice()):?>
				<tr>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<?php if($board->use_category):?>
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
							<?php if($board->use_category):?>
								<div class="mobile-category">
									<?php if($board->isTreeCategoryActive()):?>
									<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
										<div class="category"><?php echo $content->option->{'tree_category_'.$i}?></div>
									<?php endfor?>
									<?php else:?>
										<div class="category"><?php echo $content->category1?></div>
									<?php endif?>
								</div>
							<?php endif?>
							<div class="mobile-icon-open"><img src="<?php echo $skin_path?>/images/icon-open.png" alt=""></div>
						</div>
						<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
							<div class="kboard-inside-ask-cut-strings">
								<?php if($content->isNew()):?><span class="kboard-inside-ask-new-notify">New</span><?php endif?>
								<?php echo wp_strip_all_tags($content->content)?>
							</div>
						</a>
						<div class="kboard-mobile-contents">
							<div class="mobile-status">
									<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
							</div>
						</div>
					</td>
					<td class="kboard-list-status">
						<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
					</td>
				</tr>
				<?php endwhile?>
				<?php while($content = $list->hasNext()):?>
				<tr>
					<td class="kboard-list-date"><?php echo $content->getDate()?></td>
					<?php if($board->use_category):?>
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
							<?php if($board->use_category):?>
								<div class="mobile-category">
									<?php if($board->isTreeCategoryActive()):?>
									<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
										<div class="category"><?php echo $content->option->{'tree_category_'.$i}?></div>
									<?php endfor?>
									<?php else:?>
										<div class="category"><?php echo $content->category1?></div>
									<?php endif?>
								</div>
							<?php endif?>
							<div class="mobile-icon-open"><img src="<?php echo $skin_path?>/images/icon-open.png" alt=""></div>
						</div>
						<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
							<div class="kboard-inside-ask-cut-strings">
								<?php if($content->isNew()):?><span class="kboard-inside-ask-new-notify">New</span><?php endif?>
								<?php echo wp_strip_all_tags($content->content)?>
							</div>
						</a>
						<div class="kboard-mobile-contents">
							<div class="mobile-status">
								<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
							</div>
						</div>
					</td>
					<td class="kboard-list-status">
						<span style="color:<?php if(inside_ask_has_answered($content->uid)):?>#ff0a1e<?php else:?>#808080<?php endif?>"><?php echo $content->category2?></span>
					</td>
				</tr>
				<?php endwhile?>
			</tbody>
		</table>
	</div>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<!-- 검색폼 시작 -->
	<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>">
			<button type="submit" class="kboard-inside-ask-button-black search"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<div class="kboard-control">
		<button type="button" class="kboard-inside-ask-button-black contact" onclick="window.location.href='<?php echo $url->set('mod', 'editor')->toString()?>'">문의하기</button>
	</div>
	
	<?php if($board->contribution()):?>
	<div class="kboard-inside-ask-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>

<?php elseif(isset($_GET['list_mod']) && $_GET['list_mod'] == 'nonmember_form'):?>

<div id="kboard-inside-ask-editor">
	<form method="post" action="<?php echo $url->set('list_mod', 'nonmember_list')->toString()?>">
		<?php wp_nonce_field('kboard-kboard-inside-ask-nonmember', 'kboard-kboard-inside-ask-nonmember-nonce')?>
		<input type="hidden" name="nonmember_list_search" value="<?php echo $board->id?>">
		<div class="kboard-attr-row">
			<label class="attr-name" for="nonmember_form_email">이메일</label>
			<div class="attr-value"><input type="email" id="kboard_option_email" name="nonmember_form_email" value="" placeholder="" autofocus required></div>
		</div>
		<div class="kboard-attr-row">
			<label class="attr-name" for="nonmember_form_password">비밀번호</label>
			<div class="attr-value"><input type="password" id="nonmember_form_password" name="nonmember_form_password" value="" placeholder="" required></div>
		</div>
		<div class="kboard-control">
			<button type="submit" class="kboard-inside-ask-button-black">답변확인하기</button>
		</div>
		<div class="kboard-control signup">
			<a href="<?php echo wp_registration_url()?>">회원가입하기</a>
		</div>
	</form>
</div>

<?php else:?>

<div id="kboard-inside-ask-main">
	<div class="main-contents">
		<div class="main-contents-left">
			<div class="main-contents-left-wrap">
				<div class="main-contents-wrap">
					<?php if($board->meta->inside_ask_member):?>
						<?php echo wpautop($board->meta->inside_ask_member)?>
					<?php else:?>
						<h4 class="main-contents-title">회원으로 1:1 문의하기</h4>
						<p>회원으로 1:1 문의를 이용하시면 마이페이지에서 현재 문의 중인 내용은 물론 지난 처리 결과도 조회 가능합니다.</p>
					<?php endif?>
				</div>
				<?php if(is_user_logged_in()):?>
					<button type="button" class="kboard-inside-ask-button-black" onclick="window.location.href='<?php echo $url->set('mod', 'editor')->toString()?>'">회원으로 1:1 문의하기</button>
					<button type="button" class="kboard-inside-ask-button-white" onclick="window.location.href='<?php echo $url->set('list_mod', 'member_list')->toString()?>'">회원 1:1 문의 답변확인하기</button>
				<?php else:?>
					<button type="button" class="kboard-inside-ask-button-black" onclick="alert('로그인 후 이용하시거나 비회원문의를 이용해주세요.');">회원으로 1:1 문의하기</button>
					<button type="button" class="kboard-inside-ask-button-white" onclick="alert('로그인 후 이용하시거나 비회원문의를 이용해주세요.');">회원 1:1 문의 답변확인하기</button>
				<?php endif?>
			</div>
		</div>
		<div class="main-contents-right">
			<div class="main-contents-right-wrap">
				<div class="main-contents-wrap">
					<?php if($board->meta->inside_ask_non_member):?>
						<?php echo wpautop($board->meta->inside_ask_non_member)?>
					<?php else:?>
						<h4 class="main-contents-title">비회원으로 1:1 문의하기</h4>
						<p>1:1 문의는 비회원도 동일하게 이용 가능하며, 이메일은 물론 비회원 1:1 문의 답변확인하기 메뉴를 통해 처리 결과를 확인하실 수 있습니다.</p>
					<?php endif?>
				</div>
				<?php if(is_user_logged_in()):?>
					<button type="button" class="kboard-inside-ask-button-black" onclick="alert('회원으로 1:1 문의하기를 이용해주세요.');">비회원으로 1:1 문의하기</button>
					<button type="button" class="kboard-inside-ask-button-white" onclick="alert('회원 1:1 문의 답변확인하기를 이용해주세요.');">비회원 1:1 문의 답변확인하기</button>
				<?php else:?>
					<button type="button" class="kboard-inside-ask-button-black" onclick="window.location.href='<?php echo $url->set('mod', 'editor')->toString()?>'">비회원으로 1:1 문의하기</button>
					<button type="button" class="kboard-inside-ask-button-white" onclick="window.location.href='<?php echo $url->set('list_mod', 'nonmember_form')->toString()?>'">비회원 1:1 문의 답변확인하기</button>
				<?php endif?>
			</div>
		</div>
	</div>
	
	<?php if($board->contribution()):?>
	<div class="kboard-inside-ask-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>

<?php endif?>