<div class="module  <?php echo $class_suffix?>">
<?php if($disp_title_module){?>
	<h3><?php echo $head_name?></h3>
<?php }?>
<div id="sohomepage-slider<?php echo $module?>" class="sohomepage-slider">
<?php if($list){ ?>
	 <div class="so-homeslider sohomeslider-inner-<?php echo $module?>">
		<?php foreach($list as $item){?>
			<div class="item ">
				<a href="<?php echo $item['url']?>" title="<?php echo $item['title']?>" target="<?php echo $item_link_target?>">
					<img class="responsive" src="<?php echo $item['thumb']?>"  alt="<?php echo $item['title']?>" />
				</a>
				<div class="sohomeslider-description">
					<h1><?php echo $item['title']?></h1>
					<h2><?php echo html_entity_decode($item['caption'])?></h2>
					<p><?php echo html_entity_decode($item['description'])?></p>
					<a href="<?php echo $item['url']?>" title="<?php echo $text_readmore ;?>"><?php echo $text_readmore ;?></a>
				</div>
				
			</div>	
		<?php }?>	
	</div>
	<script type="text/javascript">
		$(".sohomeslider-inner-<?php echo $module?>").owlCarousel2({
				animateOut: '<?php echo $animateOut?>',
				animateIn: '<?php echo $animateIn?>',
				autoplay: <?php echo $autoplay?>,
				autoplayTimeout: <?php echo $autoplayTimeout?>,
				autoplaySpeed:  <?php echo $autoplaySpeed?>,
				smartSpeed: 500,
				autoplayHoverPause: <?php echo $autoplayHoverPause?>,
				startPosition: <?php echo $startPosition?>,
				mouseDrag:  <?php echo $mouseDrag?>,
				touchDrag: <?php echo $touchDrag?>,
				dots: <?php echo $dots?>,
				autoWidth: false,
				dotClass: "owl2-dot",
				dotsClass: "owl2-dots",
				nav: <?php echo $nav?>,
				loop: <?php echo $loop?>,
				navText: ["Next", "Prev"],
				navClass: ["owl2-prev", "owl2-next"],
				responsive:{
					0:{
					  items:1 // In this configuration 1 is enabled from 0px up to 479px screen size 
					},
				}
		});
</script>
</div>
<?php } else{ ?>
	<?php echo $NoItem;?>
<?php }?>
</div>
