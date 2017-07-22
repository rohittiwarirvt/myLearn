
<div class="module manufacturer">
<div id="manu" class="owl-carouse">
		
		<?php if ($brands) { ?>
			
			
			
			<?php foreach ($brands as $brand) { ?>
				
					<?php if ($brand['manufacturer']) { ?>
						
							<?php foreach ($brand['manufacturer'] as $manufacturer) { ?>
								<div class="item text-center">
										
									<a href="<?php echo $manufacturer['href']; ?>"><img src="<?php echo $manufacturer['image']; ?>" alt="<?php echo $manufacturer['name']; ?>" class="img-responsive"></a>
									
								</div>
							<?php } ?>
						
					<?php } ?>
			<?php } ?>
		<?php } ?>
</div>
<script type="text/javascript"><!--
$('#manu').owlCarousel2({
	items: 6,
	autoplay: false,
	nav: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	navText: ["", ""],
	dots: false,
	responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        320:{
            items:1,
            nav:true
        },
        568:{
            items:2,
            nav:true,
            loop:false
        },
		768:{
            items:3,
            nav:true,
            loop:false
        },
		992:{
            items:4,
            nav:true,
            loop:false
        },
		1200:{
            items:6,
            nav:true,
            loop:false
        }
    }
	
});
--></script>
</div>