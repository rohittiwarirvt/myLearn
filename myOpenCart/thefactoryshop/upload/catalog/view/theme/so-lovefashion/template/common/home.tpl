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
    <?php echo $content_top; ?>
</section>
<?php endif; ?>
<section id="yt_spotlight2">
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
			<?php if (trim($content_block1)) : ?>
			<div id="content" class="<?php echo $class; ?>">
				<?php echo $content_block1 ?>
			</div>
			<?php endif; ?>
			<?php echo $column_right; ?>
		</div>
	</div>
</section>
<section id="yt_spotlight3">
	<?php if (trim($content_block2)) : ?>
		<?php echo $content_block2 ?>
	<?php endif; ?>
</section>
<section id="yt_spotlight4">
    <div class="container">
        <div class="row">
			<?php if (trim($content_block3)) : ?>
			<div class="col-sm-12">
             <?php echo $content_block3 ?>
			</div>
			<?php endif; ?>
        </div>
    </div> 
</section>
<section id="yt_spotlight5" >
		<?php if (trim($content_block4)) : ?>
		<div class="main-module" data-anijs="if: scroll, on: window, do: fadeInUp animated  , before: $scrollReveal ">
		 <?php echo $content_block4 ?>
		</div>
		<?php endif; ?>
</section>
<section id="yt_spotlight6">
    <div class="container">
        <div class="row">
			<?php if (trim($content_block5)) : ?>
			<div class="col-sm-12">
             <?php echo $content_block5 ?>
			</div>
			<?php endif; ?>
        </div>
    </div> 
</section>
<section id="yt_spotlight7">
    <div class="container">
        <div class="row">
			<?php if (trim($content_block6)) : ?>
			<div class="col-sm-12">
             <?php echo $content_block6 ?>
			</div>
			<?php endif; ?>
        </div>
    </div> 
</section>
<section id="yt_spotlight8">
    <div class="container">
        <div class="row">
			<?php if (trim($content_block7)) : ?>
			<div class="col-sm-12">
             <?php echo $content_block7 ?>
			</div>
			<?php endif; ?>
        </div>
    </div> 
</section>
<section id="yt_spotlight9" data-anijs="if: scroll, on: window, do: fadeInUp animated  , before: $scrollReveal ">
    <div class="container">
        <div class="row">
			<?php if (trim($content_block8)) : ?>
			<div class="col-sm-12">
             <?php echo $content_block8 ?>
			</div>
			<?php endif; ?>
        </div>
    </div> 
</section>
<?php echo $footer; ?>