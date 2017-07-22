<div class="box so-popular-tag <?php echo $class_suffix; ?>">
	<?php if($disp_title_module){?>
	<div class="box-heading">
		<span><?php echo $head_name; ?></span>
	</div>
	<?php }?>
	<div class="box-content">
		<?php if($data) { ?>
			<?php echo $data; ?>
		<?php } else { ?>
			<?php echo $text_notags; ?>
		<?php } ?>
	</div>
</div>