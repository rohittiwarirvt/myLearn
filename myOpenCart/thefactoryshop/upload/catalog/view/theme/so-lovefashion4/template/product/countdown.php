<?php

global $config;
$lang = $config->get('config_language_id');
$store_id = $config->get('config_store_id');

if ($store_id == 0) {
    $soconfig_pages = $config->get('soconfig_pages');
    $soconfig_lang = $config->get('soconfig_lang');

    if (isset($soconfig_pages["countdown_status"])) {$countdown_status = $soconfig_pages["countdown_status"];}
    if (isset($soconfig_lang[$lang]["countdown_title"])) {$countdown_title = $soconfig_lang[$lang]["countdown_title"];}
    if (isset($soconfig_lang[$lang]["countdown_title_day"])) {$countdown_title_day = $soconfig_lang[$lang]["countdown_title_day"];}
    if (isset($soconfig_lang[$lang]["countdown_title_hour"])) {$countdown_title_hour = $soconfig_lang[$lang]["countdown_title_hour"];}
    if (isset($soconfig_lang[$lang]["countdown_title_minute"])) {$countdown_title_minute = $soconfig_lang[$lang]["countdown_title_minute"];}
    if (isset($soconfig_lang[$lang]["countdown_title_second"])) {$countdown_title_second = $soconfig_lang[$lang]["countdown_title_second"];}
} else {
    $soconfig_pages = $config->get('soconfig_pages_store');
    $soconfig_lang = $config->get('soconfig_lang_store');
	$text_product = array(
		'product_catalog_refine',
		'product_catalog_refine_col_lg',
		'product_catalog_refine_col_sm',
		'product_catalog_refine_col_xs',
		'lsttitle_cate_status',
		'lstimg_cate_status',
		'lstcompare_status',
		'product_catalog_mode',
		'product_catalog_column_lg',
		'product_catalog_column_sm',
		'product_catalog_column_xs',
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
	
    if (isset($soconfig_pages[$store_id]["countdown_status"])) {$countdown_status = $soconfig_pages[$store_id]["countdown_status"];}
    if (isset($soconfig_lang[$lang][$store_id]["countdown_title"])) {$countdown_title = $soconfig_lang[$lang][$store_id]["countdown_title"];}
    if (isset($soconfig_lang[$lang][$store_id]["countdown_title_day"])) {$countdown_title_day = $soconfig_lang[$lang][$store_id]["countdown_title_day"];}
    if (isset($soconfig_lang[$lang][$store_id]["countdown_title_hour"])) {$countdown_title_hour = $soconfig_lang[$lang][$store_id]["countdown_title_hour"];}
    if (isset($soconfig_lang[$lang][$store_id]["countdown_title_minute"])) {$countdown_title_minute = $soconfig_lang[$lang][$store_id]["countdown_title_minute"];}
    if (isset($soconfig_lang[$lang][$store_id]["countdown_title_second"])) {$countdown_title_second = $soconfig_lang[$lang][$store_id]["countdown_title_second"];}
}


if (!isset($countdown_status) || ($countdown_status != 0)) :
		
    if (isset($product['special']) && $product['special']) :
		
        if ($special_end_date) :
			
            $full_date = explode("-", $special_end_date);
            $year_end = $full_date[0];
			
            if($full_date[1] < 10) {
                $month_end = (int)$full_date[1];
            } else {
                $month_end = $full_date[1];
            }
            $day_end = $full_date[2];
            if ($day_end !== 0 && $year_end !==0 && $month_end !== 0) :


                if (isset($countdown_title_day) && $countdown_title_day != ''){
                    $label_day = $countdown_title_day;
                } else {
                    $label_day = 'Days';
                }

                if (isset($countdown_title_hour) && $countdown_title_hour != ''){
                    $label_hour = $countdown_title_hour;
                } else {
                    $label_hour = 'Hours';
                }
                if (isset($countdown_title_minute) && $countdown_title_minute != ''){
                    $label_minute = $countdown_title_minute;
                } else {
                    $label_minute = 'Mins';
                }
                if (isset($countdown_title_second) && $countdown_title_second != ''){
                    $label_second = $countdown_title_second;
                } else {
                    $label_second = 'Secs';
                }
				
                ?>
				<div class="item-time">
					<?php //echo (isset($countdown_title) && $countdown_title != '' ? $countdown_title : 'This limited  offer ends in:'); ?>
					<script type="text/javascript"><!--
						 $(function () {
							var austDay = new Date(<?php echo $year_end; ?>, <?php echo $month_end; ?>- 1 , <?php echo $day_end; ?>);
							$('.defaultCountdown-<?php echo $product['product_id']; ?>').countdown(austDay, function(event) {
								var $this = $(this).html(event.strftime(''
								   + '<div class="time-item time-day"><div class="num-time">%d</div><div class="name-time"><?php echo $label_day; ?> </div></div>'
								   + '<div class="time-item time-hour"><div class="num-time">%H</div><div class="name-time"><?php echo $label_hour; ?> </div></div>'
								   + '<div class="time-item time-min"><div class="num-time">%M</div><div class="name-time"><?php echo $label_minute; ?> </div></div>'
								   + '<div class="time-item time-sec"><div class="num-time">%S</div><div class="name-time"><?php echo $label_second; ?> </div></div>'));
							});
						});
						//--></script>
					<div class="item-timer defaultCountdown-<?php echo $product['product_id']; ?>"></div>
				</div>
            <?php
            endif;
        endif;
    endif;
endif;
?>


