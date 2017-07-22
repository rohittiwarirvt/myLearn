<?php
global $config, $loader, $registry;
$loader->model('custom/general');
$model = $registry->get('model_custom_general');
$layout_id = $model->getCurrentLayout();
$lang = $config->get('config_language_id');
$store_id = $config->get('config_store_id');
$template = $config->get('config_template');

if ($store_id == 0) {
    $soconfig_general = $config->get('soconfig_general');
    $soconfig_social = $config->get('soconfig_social');
} else {
    $soconfig_general = $config->get('soconfig_general_store');
    $soconfig_social = $config->get('soconfig_social_store');
	
/* GENERAL */
	$text_layout = array(
		'cpanel',
		'scroll_animation',
		'backtop',
		'copyright',
		'socials_status',
		'footerpayment_status',
		'footerpayment',
		'customblock_status',
	);
	foreach ($text_layout as $text) {
		if (isset($soconfig_general[$store_id][$text])) {$soconfig_general[$text] = $soconfig_general[$store_id][$text];}
	}
		if (isset($soconfig_general[$lang][$store_id]["footer_socials_title"])) 	{$soconfig_general[$lang]["footer_socials_title"]  = $soconfig_general[$lang][$store_id]["footer_socials_title"];}
	if (isset($soconfig_general[$lang][$store_id]["footer_socials"])) 			{$soconfig_general[$lang]["footer_socials"]  = $soconfig_general[$lang][$store_id]["footer_socials"];}
	if (isset($soconfig_general[$lang][$store_id]["custom_html_title"])) 		{$soconfig_general[$lang]["custom_html_title"]  = $soconfig_general[$lang][$store_id]["custom_html_title"];}
	if (isset($soconfig_general[$lang][$store_id]["customblock_html"])) 		{$soconfig_general[$lang]["customblock_html"]  = $soconfig_general[$lang][$store_id]["customblock_html"];}

/* SOCIAL ACCOUNT */
	$text_Social = array(
		'social_status',
		'facebook',
		'twitter',
		'video_code',
	);
	foreach ($text_Social as $text) {
		if (isset($soconfig_social[$store_id][$text])) 		{$soconfig_social[$text] = $soconfig_social[$store_id][$text];}
	}
}

?>
  
	<footer class="footer-container">
		<section class="footer-top-block ">
			<div class="container content">
				<div class="row">
					<?php if (isset($soconfig_general["footerpayment_status"]) && $soconfig_general["footerpayment_status"] != 0){
						$contact_payment_footer = "col-md-5 col-sm-5 col-xs-12 contact-payment-footer";
						$footer_link_block="col-md-7 col-sm-7 col-xs-12 footer-link-block";
						}
						else{
							$footer_link_block="col-xs-12 footer-link-block";
						}?>
					<?php if (isset($soconfig_general["footerpayment_status"]) && $soconfig_general["footerpayment_status"] != 0) : ?>
					<div class="<?php echo $contact_payment_footer;?>">
						<?php
							if (isset($soconfig_general["footerpayment"]) && $soconfig_general["footerpayment"] != '' && is_string($soconfig_general["footerpayment"])) {
								echo html_entity_decode($soconfig_general["footerpayment"], ENT_QUOTES, 'UTF-8');
							}
						?>
					</div>
					<?php endif; ?>
					<div class="<?php echo $footer_link_block;?>">
						<div class="row">
							<?php if (isset($soconfig_general["socials_status"]) && $soconfig_general["socials_status"] != 0) : ?>
							<div class="col-lg-4 col-md-4 col-xs-6">
								
								<div class="module clearfix">
									<?php if (isset($soconfig_general[$lang]["footer_socials_title"]) && $soconfig_general[$lang]["footer_socials_title"] != '' ) : ?>
									<h3 class="modtitle">
										<?php echo $soconfig_general[$lang]["footer_socials_title"];?>
									</h3>
									<?php endif;?>
									<div  class="modcontent" >
										<?php
										if (isset($soconfig_general[$lang]["footer_socials"]) && $soconfig_general[$lang]["footer_socials"] != '' && is_string($soconfig_general[$lang]["footer_socials"])) :
											echo html_entity_decode($soconfig_general[$lang]["footer_socials"], ENT_QUOTES, 'UTF-8');
										endif;
										?>
									</div>
								</div>
								
							</div>
							<?php endif; ?>
							<?php if ($informations) : ?>
							<div class="col-lg-4 col-md-4 col-xs-6">
								
									<div class="module clearfix">
										<h3 class="modtitle"><?php echo $text_information; ?></h3>
										<div  class="modcontent" >
											<ul class="menu">
												<?php foreach ($informations as $information) { ?>
												<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
												<?php } ?>
											</ul>
										</div>
									</div>
								
							</div>
							<?php endif; ?>
							<div class="col-lg-4 col-md-4 col-xs-6">
								
								<div class="module clearfix">
									<h3 class="modtitle"><?php echo $text_service; ?></h3>
									<div  class="modcontent" >
										<ul class="menu">
											<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
											<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
											<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
											
										</ul>
									</div>
								</div>
							</div>
							
							<div class="col-lg-4 col-md-4 col-xs-6 account-links-ft">
								<div class="module clearfix">
									<h3 class="modtitle"><?php echo $text_account; ?></h3>
									<div  class="modcontent" >
										<ul class="menu">
											<li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
											<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
											<li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
											<li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>

				<?php if(isset($simple_blog_found)) { ?>
					<li><a href="<?php echo $simple_blog; ?>" target="_blank"><?php echo $simple_blog_footer_heading; ?></a></li>
				<?php } ?>
			
										</ul>
									</div>
								</div>
							</div>
							<?php if (isset($soconfig_general["customblock_status"]) && $soconfig_general["customblock_status"] != 0) : ?>
							<div class="col-lg-8 col-md-8 col-xs-12 contact-links-ft">
								
								<div class="module clearfix">
									<h3 class="modtitle">
										<?php
										if (isset($soconfig_general[$lang]["custom_html_title"]) && $soconfig_general[$lang]["custom_html_title"] != '' ) :
											echo $soconfig_general[$lang]["custom_html_title"];
										endif;
										?>
									</h3>
									<div  class="modcontent" >
										<?php
										if (isset($soconfig_general[$lang]["customblock_html"]) && $soconfig_general[$lang]["customblock_html"] != '' && is_string($soconfig_general[$lang]["customblock_html"])) :
										echo html_entity_decode($soconfig_general[$lang]["customblock_html"], ENT_QUOTES, 'UTF-8');
										endif;
										?>
									</div>
								</div>
								
							</div>
							<?php endif; ?>
						</div>
						<div class="copyright-text">
						<?php echo (!isset($soconfig_general["copyright"]) || !is_string($soconfig_general["copyright"]) ? $powered : html_entity_decode($soconfig_general["copyright"], ENT_QUOTES, 'UTF-8'));?>
						</div>
					</div>
				</div>
			</div>
		</section>

              <!-- Begin Cookie  plugin -->
			<script type="text/javascript">!function(){if(!window.hasCookieConsent){window.hasCookieConsent=!0;var e="cookieconsent_options",t="update_cookieconsent_options",n="cookieconsent_dismissed",i="catalog/view/theme/default/stylesheet/cookie/";if(!(document.cookie.indexOf(n)>-1)){"function"!=typeof String.prototype.trim&&(String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")});var o,s={isArray:function(e){var t=Object.prototype.toString.call(e);return"[object Array]"==t},isObject:function(e){return"[object Object]"==Object.prototype.toString.call(e)},each:function(e,t,n,i){if(s.isObject(e)&&!i)for(var o in e)e.hasOwnProperty(o)&&t.call(n,e[o],o,e);else for(var r=0,c=e.length;c>r;r++)t.call(n,e[r],r,e)},merge:function(e,t){e&&s.each(t,function(t,n){s.isObject(t)&&s.isObject(e[n])?s.merge(e[n],t):e[n]=t})},bind:function(e,t){return function(){return e.apply(t,arguments)}},queryObject:function(e,t){var n,i=0,o=e;for(t=t.split(".");(n=t[i++])&&o.hasOwnProperty(n)&&(o=o[n]);)if(i===t.length)return o;return null},setCookie:function(e,t,n){var i=new Date;n=n||365,i.setDate(i.getDate()+n),document.cookie=e+"="+t+"; expires="+i.toUTCString()+"; path=/"},addEventListener:function(e,t,n){e.addEventListener?e.addEventListener(t,n):e.attachEvent("on"+t,n)}},r=function(){var e="data-cc-event",t="data-cc-if",n=function(e,t,i){return s.isArray(t)?s.each(t,function(t){n(e,t,i)}):void(e.addEventListener?e.addEventListener(t,i):e.attachEvent("on"+t,i))},i=function(e,t){return e.replace(/\{\{(.*?)\}\}/g,function(e,n){for(var i,o=n.split("||");token=o.shift();){if(token=token.trim(),'"'===token[0])return token.slice(1,token.length-1);if(i=s.queryObject(t,token))return i}return""})},o=function(e){var t=document.createElement("div");return t.innerHTML=e,t.children[0]},r=function(e,t,n){var i=e.parentNode.querySelectorAll("["+t+"]");s.each(i,function(e){var i=e.getAttribute(t);n(e,i)},window,!0)},c=function(t,i){r(t,e,function(e,t){var o=t.split(":"),r=s.queryObject(i,o[1]);n(e,o[0],s.bind(r,i))})},a=function(e,n){r(e,t,function(e,t){var i=s.queryObject(n,t);i||e.parentNode.removeChild(e)})};return{build:function(e,t){s.isArray(e)&&(e=e.join("")),e=i(e,t);var n=o(e);return c(n,t),a(n,t),n}}}(),c={options:{message:"This website uses cookies to ensure you get the best experience on our website. ",dismiss:"Got it!",learnMore:"More info",link:null,container:null,theme:"light-floating",markup:['<div class="cc_banner-wrapper {{containerClasses}}">','<div class="cc_banner cc_container cc_container--open">','<a href="#null" data-cc-event="click:dismiss" class="cc_btn cc_btn_accept_all">{{options.dismiss}}</a>','<p class="cc_message">{{options.message}} <a data-cc-if="options.link" class="cc_more_info" href="{{options.link || "#null"}}">{{options.learnMore}}</a></p>',"</div>","</div>"]},init:function(){var t=window[e];t&&this.setOptions(t),this.setContainer(),this.options.theme?this.loadTheme(this.render):this.render()},setOptionsOnTheFly:function(e){this.setOptions(e),this.render()},setOptions:function(e){s.merge(this.options,e)},setContainer:function(){this.container=this.options.container?document.querySelector(this.options.container):document.body,this.containerClasses="",navigator.appVersion.indexOf("MSIE 8")>-1&&(this.containerClasses+=" cc_ie8")},loadTheme:function(e){var t=this.options.theme;-1===t.indexOf(".css")&&(t=i+t+".css");var n=document.createElement("link");n.rel="stylesheet",n.type="text/css",n.href=t;var o=!1;n.onload=s.bind(function(){!o&&e&&(e.call(this),o=!0)},this),document.getElementsByTagName("head")[0].appendChild(n)},render:function(){this.element&&this.element.parentNode&&(this.element.parentNode.removeChild(this.element),delete this.element),this.element=r.build(this.options.markup,this),this.container.firstChild?this.container.insertBefore(this.element,this.container.firstChild):this.container.appendChild(this.element)},dismiss:function(e){e.preventDefault&&e.preventDefault(),e.returnValue=!1,this.setDismissedCookie(),this.container.removeChild(this.element)},setDismissedCookie:function(){s.setCookie(n,"yes")}},a=!1;(o=function(){a||"complete"!=document.readyState||(c.init(),a=!0,window[t]=s.bind(c.setOptionsOnTheFly,c))})(),s.addEventListener(document,"readystatechange",o)}}}();</script>
	
<script type="text/javascript">
    window.cookieconsent_options = {"message":"<?php echo $entry_cookie_msg; ?>","dismiss":"<?php echo $entry_cookie_accept; ?>","learnMore":"<?php echo $entry_cookie_more; ?>","link":"<?php echo $entry_cookie_link; ?>","theme":"<?php echo $data['config_cookie']; ?>"};
</script>

<!-- End Cookie plugin -->
              
            
	</footer>
    <!-- //end Footer -->
	
	<?php if(isset($soconfig_general["backtop"]) && $soconfig_general["backtop"] == 1):?>
		<div class="back-to-top"><i class="fa fa-angle-up"></i></div>
		<p id="gl_path" class="hidden"><?php echo $template; ?></p>
	<?php endif; ?>
	
	<?php if( $soconfig_general["cpanel"] ):?>
		<?php include('catalog/view/theme/'.$template.'/template/common/cpanel.php'); ?>
	<?php endif; ?>
	
	<?php if ($soconfig_general['scroll_animation'] || $soconfig_general["scroll_animation"] != 0): ?>
	<script type="text/javascript"> AniJS.run(); </script>	
	<?php endif; ?>
	
	<!-- Social widgets -->
	<?php if (!isset($soconfig_social["social_status"]) || $soconfig_social["social_status"] != 0) : ?>
	<section class="social-widgets visible-lg">
		<ul class="items">
			<?php if (isset($soconfig_social["facebook"]) && $soconfig_social["facebook"] != '') : ?>
			<li class="item item-01 facebook">
				<a href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/template/social/facebook.php?account=<?php echo $soconfig_social['facebook']; ?>" class="tab-icon"><span class="fa fa-facebook"></span></a>
				<div class="tab-content">
					<div class="title"><h5>FACEBOOK</h5></div>
					<div class="loading">
						<img src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/images/ajax-loader.gif" class="ajaxloader" alt="loader">
					</div>
				</div>
			</li>
			<?php endif; ?>

			<?php if (isset($soconfig_social["twitter"]) && $soconfig_social["twitter"] != '') : ?>
			<li class="item item-02 twitter">
				<a href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/template/social/twitter.php?account_twitter=<?php echo $soconfig_social['twitter']; ?>" class="tab-icon"><span class="fa fa-twitter"></span></a>
				<div class="tab-content">
					<div class="title"><h5>TWITTER FEEDS</h5></div>
					<div class="loading">
						<img src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/images/ajax-loader.gif" class="ajaxloader" alt="loader">
					</div>
				</div>
			</li>
			<?php endif; ?>

			<?php if (isset($soconfig_social["video_code"]) && $soconfig_social["video_code"] != '') : ?>
			<li class="item item-03 youtube">
				<a href="catalog/view/theme/<?php echo $config->get('config_template'); ?>/template/social/youtubevideo.php?account_video=<?php echo $soconfig_social['video_code']; ?>" class="tab-icon"><span class="fa fa-youtube"></span></a>
				<div class="tab-content">
					<div class="title"><h5>YouTube</h5></div>
					<div class="loading">
						<img src="catalog/view/theme/<?php echo $config->get('config_template'); ?>/images/ajax-loader.gif" class="ajaxloader" alt="loader">
					</div>
				</div>
			</li>
			<?php endif; ?>
		</ul>
	</section>
	<?php endif; ?>
	<!-- //end Social widgets -->

    </div>



</body>
</html>