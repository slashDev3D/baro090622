<div class="kboard-category">
	<form id="kboard-category-form-<?php echo $board->id?>" method="get" action="<?php echo $url->toString()?>">
		<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
		
		<?php if($board->initCategory1()):?>
			<select name="category1" onchange="jQuery('#kboard-category-form-<?php echo $board->id?>').submit();">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<?php while($board->hasNextCategory()):?>
				<option value="<?php echo $board->currentCategory()?>"<?php if(kboard_category1() == $board->currentCategory()):?> selected<?php endif?>><?php echo $board->currentCategory()?></option>
				<?php endwhile?>
			</select>
		<?php endif?>
	</form>
</div>