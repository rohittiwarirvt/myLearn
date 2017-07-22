<div class="item">
	<div class="media-body">
		<?php if ($display_title){ ?>
			<h4 class="media-heading">
				<a href="<?php echo $blog['link'];?>" title="<?php echo $blog['title'];?>" target="<?php echo $item_link_target?>"><?php echo $blog['title_maxlength'];?></a>
			</h4>
		<?php }?>
		<?php if($display_date_added){ ?>
				<div class="media-date-added"><?php echo date('F jS, Y', strtotime($blog['date_modified'])) ?></div>
			<?php }?>
		<?php if($display_description){ ?>
				<div class="description">
						<?php $blog['description'] = strip_tags($blog['description']); ?>
						<?php echo utf8_substr( $blog['description'],0, 200 );?>...
				</div>
		<?php }?>
	</div>
</div>


