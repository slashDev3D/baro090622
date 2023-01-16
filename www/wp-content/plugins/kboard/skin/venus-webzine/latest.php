<div id="kboard-venus-webzine-latest">
	<?php while($content = $list->hasNext()):?>
		<div class="kboard-venus-webzine-latest-item">
			<div class="kboard-venus-webzine-latest-thumbnail">
				<?php if($content->getThumbnail(109, 64)):?>
				<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
					<img src="<?php echo $content->getThumbnail(109, 64)?>" style="width:100%;height:100%" alt=""></a>
				<?php else:?>
				<div class="kboard-no-image">
					<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><i class="icon-picture"></i></a>
				</div>
				<?php endif?>
			</div>
			<div class="kboard-venus-webzine-latest-title kboard-venus-webzine-cut-strings"><a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><?php echo $content->title?></a></div>
		</div>
	<?php endwhile?>
</div>