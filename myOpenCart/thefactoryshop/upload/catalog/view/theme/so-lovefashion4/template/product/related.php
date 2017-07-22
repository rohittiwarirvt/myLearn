<?php
if ($products):
global $config, $loader, $registry, $settings,$db;
    $store_id = $config->get('config_store_id');

	if ($store_id == 0) {
        $soconfig_pages = $config->get('soconfig_pages');
    } else {
        $soconfig_pages = $config->get('soconfig_pages_store');
		$text_product = array(
			'secondimg',
			'rating_status',
			'lstdescription_status',
			'sale_status',
			'new_status',
			'days',
			'quick_status',
			'discount_status',
			'countdown_status',
		);
		foreach ($text_product as $text) {
			if (isset($soconfig_pages[$store_id][$text])) 		{$soconfig_pages[$text] = $soconfig_pages[$store_id][$text];}
		}
		if (isset($soconfig_pages[$lang][$store_id]["sale_text"])) 		{$soconfig_pages[$lang]["sale_text"]  = $soconfig_pages[$lang][$store_id]["sale_text"];}
		if (isset($soconfig_pages[$lang][$store_id]["new_text"])) 		{$soconfig_pages[$lang]["new_text"]  = $soconfig_pages[$lang][$store_id]["new_text"];}
		if (isset($soconfig_pages[$lang][$store_id]["quick_view_text"])) 		{$soconfig_pages[$lang]["quick_view_text"]  = $soconfig_pages[$lang][$store_id]["quick_view_text"];}
		
		
	}
/*VARIABLES*/	
	$new_text = $soconfig_pages[$lang]["new_text"];
	$sale_text = $soconfig_pages[$lang]["sale_text"];
	$quick_view_text = $soconfig_pages[$lang]["quick_view_text"];
	$sale_status = $soconfig_pages["sale_status"];
	$new_status = $soconfig_pages["new_status"];
	$quick_status = $soconfig_pages["quick_status"];
	$rating_status = $soconfig_pages["rating_status"];
	$discount_status = $soconfig_pages["discount_status"];
	$soconfig_days = $soconfig_pages["days"];
	$secondimg = $soconfig_pages["secondimg"];	
?>

    <!-- Products widgets desktop-->
    <div class="module related products-list">
            <h3 class="modtitle">
                <span><?php echo $text_related; ?></span>
            </h3>
            <div class="releate-products <?php if(count($products) >4) echo "releate-products-slider";?>">
				<!-- Products list -->
				<?php $j=0; $total_pros = count($products); $k = 0; $nb_row = 4; 
				 
                foreach ($products as $product) :
					$k++;
                    $loader->model('catalog/product');
					$model = $registry->get('model_catalog_product');
					$product_info = $model->getProduct($product['product_id']);
                    $loader->model('tool/image');
                    $model_resize = $registry->get('model_tool_image');
				
				if ($k%$nb_row == 1 || $nb_row == 1) { ?>
				<div class="product-item-container">	
                <?php } ?> 
				
					<div class="product-item">
				      <div class="media">
						 <div class="media-left product-image-container <?php if($secondimg =='2' && isset($product['thumb2'])){ echo "second_img";} ?> ">
							      <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
							      <?php if( $secondimg =='2' && isset($product['thumb2']) && !empty($product['thumb2'])) :?>
							      <img src="<?php echo $product['thumb2']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img_0 img-responsive" />
							      <?php endif;?>
						</div> 
				     
				      
				      <div class="media-body">
					<div class="caption">
					    
						<h4><a class="preview-image" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
						
						<?php if (!isset($product_catalog_mode) || $product_catalog_mode != 1) : ?>
						<div class="price">
						       <?php if ($product['price']) : ?>
							      <?php if (!$product['special']) { ?>
								     <span class="price-new"><?php echo $product['price']; ?></span>
							      <?php } else { ?>
									<span class="price-new"><?php echo $product['special']; ?></span>
								     <span class="price-old"><?php echo $product['price']; ?></span>
								     
							      <?php } ?>
						       <?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if (isset($rating_status) && $rating_status!= 0) : ?>
						<div class="ratings">
							      <div class="rating-box">
							      <?php for ($i = 1; $i <= 5; $i++) { ?>
							      <?php if ($product['rating'] < $i) { ?>
							      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
							      <?php } else { ?>
							      <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
							      <?php } ?>
							      <?php } ?>
							      </div>
						 </div>
						 <?php endif; ?>
					</div>
					
				      </div>
				 </div>
			    </div>
							
                <?php if ($k%$nb_row == 0 || $k == $total_pros) { ?>
			</div>
			<?php } ?>	        
                   
		
             <?php endforeach; ?>

            
                </div>

        </div>

<div class="line-divider"></div>

<!-- end Products widgets desktop-->
<?php endif; ?>


<script>// <![CDATA[
jQuery(document).ready(function($) {
		$('.releate-products-slider').owlCarousel2({
			pagination: false,
			center: false,
			nav: true,
			dots: false,
			loop: false,
			margin: 25,
			navText: [ '', '' ],
			slideBy: 1,
			autoplay: false,
			autoplayTimeout: 2500,
			autoplayHoverPause: true,
			autoplaySpeed: 800,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});	  
	});
// ]]></script>
