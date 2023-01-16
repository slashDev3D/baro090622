<div id="kboard-pure-gallery-list"<?php if(kboard_pure_gallery_list($board)):?> class="<?php echo kboard_pure_gallery_list($board)?>"<?php endif?>>
	
	<div class="kboard-control">
		<div class="kboard-control-search">
			<a href="#" onclick="kboard_pure_gallery_search_toggle();return false;" title="<?php echo __('Search', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-search.png" alt="<?php echo __('Search', 'kboard')?>"></a>
		</div>
		<?php if($board->isWriter()):?>
		<div class="kboard-control-write">
			<a href="<?php echo $url->getContentEditor()?>" title="<?php echo __('New', 'kboard')?>"><img src="<?php echo $skin_path?>/images/icon-write.png" alt="<?php echo __('New', 'kboard')?>"></a>
		</div>
		<?php endif?>
	</div>
	
	<!-- 검색폼 시작 -->
	<div class="kboard-pure-gallery-search<?php if(!$board->meta->fadein):?> active-fadein<?php endif?>">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>" placeholder="<?php echo __('Search', 'kboard')?>...">
			<button type="submit" class="kboard-pure-gallery-button-small"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
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
	
	<!-- 리스트 시작 -->
	<ul class="kboard-pure-gallery-list">
		<?php while($content = $list->hasNextNotice()):?>
		<li class="kboard-list-item kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
			<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
				<div class="kboard-list-thumbnail">
					<?php if($content->getThumbnail(500, 500)):?>
					<div class="kboard-list-thumbnail-child" style="background-image:url(<?php echo $content->getThumbnail(500, 500)?>)"></div>
					<?php endif?>
					<?php if(isset($content->attach->over_image)):?>
					<div class="kboard-list-thumbnail-over-background"></div>
					<div class="kboard-list-thumbnail-over-image"><img src="<?php echo site_url($content->attach->over_image[0])?>" alt=""></div>
					<?php endif?>
				</div>
				<div class="kboard-list-notice"><span class="kboard-pure-gallery-new-notify"><?php echo __('Notice', 'kboard')?></span></div>
				<div class="kboard-list-title<?php if(kboard_pure_gallery_title_line($board)):?> <?php echo kboard_pure_gallery_title_line($board)?><?php endif?>"><div class="kboard-pure-gallery-cut-strings">
					<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
					<?php echo $content->title?>
				</div></div>
				<div class="kboard-list-user"><?php echo $content->getUserDisplay()?></div>
			</a>
		</li>
		<?php endwhile?>
		<?php while($content = $list->hasNext()):?>
		<li class="kboard-list-item<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
			<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>#kboard-document">
				<div class="kboard-list-thumbnail">
					<?php if($content->getThumbnail(500, 500)):?>
					<div class="kboard-list-thumbnail-child" style="background-image:url(<?php echo $content->getThumbnail(500, 500)?>)"></div>
					<?php endif?>
					<?php if(isset($content->attach->over_image)):?>
					<div class="kboard-list-thumbnail-over-background"></div>
					<div class="kboard-list-thumbnail-over-image"><img src="<?php echo site_url($content->attach->over_image[0])?>" alt=""></div>
					<?php endif?>
				</div>
				<div class="kboard-list-new"><?php if($content->isNew()):?><span class="kboard-pure-gallery-new-notify">New</span><?php endif?></div>
				<div class="kboard-list-title<?php if(kboard_pure_gallery_title_line($board)):?> <?php echo kboard_pure_gallery_title_line($board)?><?php endif?>"><div class="kboard-pure-gallery-cut-strings">
					<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" class="kboard-icon-lock" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
					<?php echo $content->title?>
				</div></div>
				<div class="kboard-list-user"><?php echo $content->getUserDisplay()?></div>
			</a>
		</li>
		<?php endwhile?>
	</ul>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->
	
	<?php if($board->contribution()):?>
	<div class="kboard-pure-gallery-poweredby">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>

<?php wp_enqueue_script('pure-gallery-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true)?>