<?php echo $header; ?>
<section id="yt_breadcrumb">
    <div class="container">
        <div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
        </div>
    </div> 
</section>
<div class="container">
</div>

  <div class="<?php echo ($column_left || $column_right ? 'row' : ''); ?>">
      <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-4 col-xs-12'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-lg-9 col-sm-8 col-xs-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
		
        <div class="<?php echo ($column_left || $column_right ? '' : 'container'); ?>">
			
			<?php echo $content_top; ?>
			<?php echo $description; ?>
        </div>
        <?php echo $content_bottom; ?>
    </div>
    <?php //echo $column_right; ?>
  </div>

<?php echo $footer; ?>
