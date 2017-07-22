
<div id="so_vertical_menu" class="so-vertical-menu clearfix">
	<?php if(!empty($heading_title)):?><div class="cat-title"> 
	<i class="fa fa-th-list"></i> <span class="modtitle"><?php echo $heading_title; ?></span> <i class="fa fa-chevron-circle-down pull-right arrow-circle"></i> 
	</div><?php endif; ?>
	<ul class="vf-menu clearfix menu-content">
		<?php foreach ($categories as $category) { ?>
			
			<?php if ($category['image']) { ?>
				<li><a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['image']; ?>"><span><?php echo $category['name']; ?></span></a>
			<?php }else{ ?>
				<li class="<?php if ($category['children']){ echo"sovm-havechild";} ?>"><a href="<?php echo $category['href']; ?>"><span><?php echo $category['name']; ?></span></a>
			<?php } ?>
			<?php if ($category['children']) { echo '<span class="vf-button icon-close"></span>'; ?>
				<ul class="sovm-menu">
				<?php for ($i = 0; $i < count($category['children']);) { ?>
					
					<?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
					
					<?php for (; $i < $j; $i++) { ?>
						<?php if (isset($category['children'][$i])) { ?>
							<?php if ($category['children'][$i]['image']) { ?>
								<li><a href="<?php echo $category['children'][$i]['href']; ?>"><img src="<?php echo $category['children'][$i]['image']; ?>"><span><?php echo $category['children'][$i]['name']; ?></span></a>
							<?php }else{ ?>
								<li><a href="<?php echo $category['children'][$i]['href']; ?>"><span><?php echo $category['children'][$i]['name']; ?></span></a>
							<?php } ?>

							<?php if ($category['children'][$i]['subchildren']) { ?>
								<div class="submenu">
								<?php for ($l = 0; $l < count($category['children'][$i]['subchildren']);) { ?>
									<ul>
									<?php $m = $l + ceil(count($category['children'][$i]['subchildren']) / $category['children'][$i]['column']); ?>
									<?php for (; $l < $m; $l++) { ?>
										<?php if (isset($category['children'][$i]['subchildren'][$l])) { ?>
											<?php if ($category['children'][$i]['subchildren'][$l]['image']) { ?>
												<li><a href="<?php echo $category['children'][$i]['subchildren'][$l]['href']; ?>"><img src="<?php echo $category['children'][$i]['subchildren'][$l]['image']; ?>"><span><?php echo $category['children'][$i]['subchildren'][$l]['name']; ?></span></a>
											<?php }else{ ?>
												<li><a href="<?php echo $category['children'][$i]['subchildren'][$l]['href']; ?>"><span><?php echo $category['children'][$i]['subchildren'][$l]['name']; ?></span></a>
											<?php } ?>
										<?php } ?>
									<?php } ?>
									</ul>
								<?php } ?>
							</div>
							<?php } ?>
								</li>
						<?php } ?>
					<?php } ?>
					
				<?php } ?>
				</ul>
			<?php } ?>
		</li>
		<?php } ?>
	</ul>
</div>


<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($){
	;(function(element){
		var el = $(element), vf_menu = $('.vf-menu',el), 
		level1 = $('.vf-menu >li', el), _li = $('.sovm-havechild', el), vf_button = $('.vf-button',el), nb_hiden = <?php echo isset($limit)? $limit : ''; ?>;
		
		if(level1.length && level1.length > nb_hiden ) {
			for(var i =0 ; i < level1.length ; i++ ){
				if(i > (nb_hiden - 1)) {
					level1.eq(i).addClass('cat-visible');
					level1.eq(i).hide();
				}
			}
			vf_menu.append('<li class="more-wrap"><span class="more-view"><i class="fa fa-plus-square-o"></i>More Categories</span></li>');
			$('.more-view',vf_menu).on('click', function(){
				if(level1.hasClass('cat-visible')) 
				{
					vf_menu.find('.cat-visible').removeClass('cat-visible').addClass('cat-hidden').stop().slideDown(400);
					$(this).html('<i class="fa fa-minus-square-o"></i> Close Menu');
				}else if(level1.hasClass('cat-hidden')){
					vf_menu.find('.cat-hidden').removeClass('cat-hidden').addClass('cat-visible').stop().slideUp(200);
					$(this).html('<i class="fa fa-plus-square-o"></i> More Categories');
				}
			});
			
		}
		
		function _vfResponsive() {
			$('.cat-title').unbind('click touchstart').on('click touchstart', function(e){
				e.preventDefault();
				if (!$(this).parent().hasClass("open")) {
					$(this).parent().addClass("open");
					$(this).find(".fa-chevron-circle-up").removeClass("fa-chevron-circle-up").addClass("fa-chevron-circle-down"); 
					$(this).parent().find('ul.vf-menu').stop(true).slideDown();
					
				}else{
					$(this).parent().removeClass("open");
					$(this).find(".fa-chevron-circle-down").removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-up"); 
					$(this).parent().find('ul.vf-menu').stop(true).slideUp();
					
					if($(window).width() <= 1024) {
						vf_button.parent().find('ul.sovm-menu').stop().slideUp();
						vf_button.removeClass("vf-open").addClass("vf-close");
						vf_button.removeClass('icon-open').addClass('icon-close');
					}
				}
				
			});
			if($(window).width() <= 1024) {
				_li.addClass('vf-close');
				vf_button.unbind('click touchstart').on('click touchstart', function(e){
					e.preventDefault();
					if ($(this).hasClass('vf-open')) {varche = true} else {varche = false};
					if(varche == false){
						$(this).removeClass("vf-close").addClass("vf-open");
						$(this).removeClass('icon-close').addClass('icon-open');
						$(this).parent().find('ul').stop().slideDown();
						varche = true;
					} else {	
						$(this).removeClass("vf-open").addClass("vf-close");
						$(this).removeClass('icon-open').addClass('icon-close');
						$(this).parent().find('ul').stop().slideUp();
						varche = false;
					}
				});
				
			}
			
		}
		_vfResponsive();
		$(window).on('resize', function(){
			_vfResponsive();
		});
	})('#so_vertical_menu');
});
//]]>
</script>	