<div id="so-slideshow" >
  <div class="module slideshow">
    <?php foreach ($banners as $banner) { ?>
    <div class="item">
	 <?php if ($banner['link']) { ?>
	 <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" /></a>
	 <?php } else { ?>
	 <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
	 <?php } ?>
    </div>
    <?php } ?>
  </div>
</div>
<script type="text/javascript"><!--
$('.slideshow').owlCarousel({
    items: 1,
	autoPlay: 3000,
	singleItem: true,
	navigation: true,
	pagination: false
});
--></script>
