<?php
    echo $header;
    global $config;
	$template = $config->get('config_template');
	
	$str = strip_tags($content_block1);
	$str = preg_replace('/\s(?=\s)/', '', $str);
	$str = preg_replace('/[\n\r\t]/', '', $str);
	$str = str_replace(' ', '', $str);
	$str = trim($str, "\xC2\xA0\n");
			
?>
<?php $str = trim($content_top); ?>
<?php 
if (trim($content_top)) : ?>
<section id="yt_spotlight1">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-3 col-lg-9 col-xs-12 fix-padding">
			<?php echo $content_top; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<div class="container">
	<div class="row">
		<?php echo $column_left; ?>
		<?php if ($column_left && $column_right) { ?>
		<?php $class = 'col-sm-6'; ?>
		<?php } elseif ($column_left || $column_right) { ?>
		<?php $class = 'col-lg-9 col-sm-8 col-xs-12'; ?>
		<?php } else { ?>
		<?php $class = 'col-sm-12'; ?>
		<?php } ?>
		<div id="content" class="<?php echo $class; ?>">
			<?php if (trim($content_top)) : ?>
				<?php echo $content_block2 ?>
			<?php endif; ?>
			<?php if (trim($content_block3) || trim($content_block4)) : ?>
			<div class="row">
				<?php if (trim($content_block3)) : ?>
				<div class="col-sm-6 col-xs-12">
					 <?php echo $content_block3 ?>
				</div>
				<?php endif; ?>
				
				<?php if (trim($content_block4)) : ?>
				<div class="col-sm-6 col-xs-12">
					 <?php echo $content_block4 ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php echo $column_right; ?>
	</div>
</div>
<?php 
if (trim($content_block5)) : ?>
<section id="yt_spotlight2">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
			<?php echo $content_block5; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php 
if (trim($content_block6)) : ?>
<section id="yt_spotlight3">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
			<?php echo $content_block6; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php echo $footer; ?>