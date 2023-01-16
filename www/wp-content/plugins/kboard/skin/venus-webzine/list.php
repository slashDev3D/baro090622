<div id="kboard-venus-webzine-list">
	<div class="kboard-header">
		<!-- 카테고리 시작 -->
    	<?php
    	if($board->use_category == 'yes'){
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
    	<!-- 카테고리 끝 -->
	</div>
	
	<!-- 리스트 시작 -->
	<div class="kboard-list">
	<?php while($content = $list->hasNextNotice()):?>
		<div class="kboard-webzine-item kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
			<div class="kboard-webzine-thumbnail">
				<?php if($content->getThumbnail(150, 105)):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
					<img src="<?php echo $content->getThumbnail(150, 105)?>" style="width:100%;height:100%;" alt="">
				</a>
				<?php else:?>
				<div class="kboard-no-image">
					<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><i class="icon-picture"></i></a>
				</div>
				<?php endif?>
			</div>
			<div class="kboard-webzine-wrap">
				<div class="kboard-webzine-title kboard-venus-webzine-cut-strings"><a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">[<?php echo __('Notice', 'kboard')?>] <?php echo $content->title?></a> <?php echo $content->getCommentsCount()?></div>
				<div class="kboard-webzine-content kboard-venus-webzine-cut-strings"><a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
				<?php if($content->secret):?>
					<?php echo __('Secret', 'kboard')?>
				<?php else:?>
					<?php
					$content->content = str_replace('[', '&#91;', $content->getContent());
					$content->content = str_replace(']', '&#93;', $content->getContent());
					echo wp_trim_words(strip_tags($content->content), 200, '...');
					?>
				<?php endif?>
				</a></div>
				<div class="kboard-webzine-info">
					<?php if($content->category1):?>
					<span class="kboard-info-value kboard-category1"><?php echo $content->category1?></span>
					<span class="kboard-info-separator kboard-category1">ㆍ</span>
					<?php endif?>
					<?php if($content->category2):?>
					<span class="kboard-info-value kboard-category2"><?php echo $content->category2?></span>
					<span class="kboard-info-separator kboard-category2">ㆍ</span>
					<?php endif?>
					<?php if($content->option->tree_category_1):?>
    				<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
    				<span class="kboard-info-value tree-category category<?php echo $i?>"><?php echo $content->option->{'tree_category_'.$i}?></span>
					<span class="kboard-info-separator tree-category category<?php echo $i?>">ㆍ</span>
    				<?php endfor?>
    				<?php endif?>
					<span class="kboard-info-value kboard-user"><?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?></span>
					<span class="kboard-info-separator kboard-date">ㆍ</span>
					<span class="kboard-info-value kboard-date"><?php echo $content->getDate()?></span>
					<span class="kboard-info-separator kboard-vote">ㆍ</span>
					<span class="kboard-info-name kboard-vote"><?php echo __('Votes', 'kboard')?></span>
					<span class="kboard-info-value kboard-vote"><?php echo $content->vote?></span>
					<span class="kboard-info-separator kboard-view">ㆍ</span>
					<span class="kboard-info-name kboard-view"><?php echo __('Views', 'kboard')?></span>
					<span class="kboard-info-value kboard-view"><?php echo $content->view?></span>
				</div>
			</div>
		</div>
	<?php endwhile?>
	<?php while($content = $list->hasNext()):?>
		<div class="kboard-webzine-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
			<div class="kboard-webzine-thumbnail">
				<?php if($content->getThumbnail(150, 105)):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
					<img src="<?php echo $content->getThumbnail(150, 105)?>" style="width:100%;height:100%;" alt="">
				</a>
				<?php else:?>
				<div class="kboard-no-image">
					<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><i class="icon-picture"></i></a>
				</div>
				<?php endif?>
			</div>
			<div class="kboard-webzine-wrap">
				<div class="kboard-webzine-title kboard-venus-webzine-cut-strings"><a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><?php echo $content->title?></a> <?php echo $content->getCommentsCount()?></div>
				<div class="kboard-webzine-content kboard-venus-webzine-cut-strings"><a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
				<?php if($content->secret):?>
					<?php echo __('Secret', 'kboard')?>
				<?php else:?>
					<?php
					$content->content = str_replace('[', '&#91;', $content->getContent());
					$content->content = str_replace(']', '&#93;', $content->getContent());
					echo wp_trim_words(strip_tags($content->content), 200, '...');
					?>
				<?php endif?>
				</a></div>
				<div class="kboard-webzine-info">
					<?php if($content->category1):?>
					<span class="kboard-info-value kboard-category1"><?php echo $content->category1?></span>
					<span class="kboard-info-separator kboard-category1">ㆍ</span>
					<?php endif?>
					<?php if($content->category2):?>
					<span class="kboard-info-value kboard-category2"><?php echo $content->category2?></span>
					<span class="kboard-info-separator kboard-category2">ㆍ</span>
					<?php endif?>
					<?php if($content->option->tree_category_1):?>
    				<?php for($i=1; $i<=$content->getTreeCategoryDepth(); $i++):?>
    				<span class="kboard-info-value tree-category category<?php echo $i?>"><?php echo $content->option->{'tree_category_'.$i}?></span>
					<span class="kboard-info-separator tree-category category<?php echo $i?>">ㆍ</span>
    				<?php endfor?>
    				<?php endif?>
					<span class="kboard-info-value kboard-user"><?php echo apply_filters('kboard_user_display', $content->member_display, $content->member_uid, $content->member_display, 'kboard', $boardBuilder)?></span>
					<span class="kboard-info-separator kboard-date">ㆍ</span>
					<span class="kboard-info-value kboard-date"><?php echo $content->getDate()?></span>
					<span class="kboard-info-separator kboard-vote">ㆍ</span>
					<span class="kboard-info-name kboard-vote"><?php echo __('Votes', 'kboard')?></span>
					<span class="kboard-info-value kboard-vote"><?php echo $content->vote?></span>
					<span class="kboard-info-separator kboard-view">ㆍ</span>
					<span class="kboard-info-name kboard-view"><?php echo __('Views', 'kboard')?></span>
					<span class="kboard-info-value kboard-view"><?php echo $content->view?></span>
				</div>
			</div>
		</div>
	<?php endwhile?>
	</div>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<form id="kboard-search-form" method="get" action="<?php echo $url->toString()?>">
		<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
		<div class="kboard-search">
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo kboard_keyword()?>">
			<button type="submit" class="kboard-venus-webzine-button-small"><?php echo __('Search', 'kboard')?></button>
		</div>
	</form>
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control">
		<a href="<?php echo $url->getContentEditor()?>" class="kboard-venus-webzine-button-small"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>
	
	<?php if($board->contribution()):?>
	<div class="kboard-venus-webzine-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>