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
        <div class="row">
           
            <?php if ($column_left && $column_right) { ?>
                <?php $class = 'col-sm-4 col-xs-12'; ?>
            <?php } elseif ($column_left || $column_right) { ?>
                <?php $class = 'col-lg-9 col-sm-8 col-xs-12'; ?>
            <?php } else { ?>
                <?php $class = 'col-sm-12'; ?>
            <?php } ?>
            
            <div id="content" class="<?php echo $class; ?> <?php if($column_left){ echo "col-sm-push-4 col-lg-push-3"; }?> simple-blog">
                <?php echo $content_top; ?>
                <div class="blog-header">
					<h2><?php echo $heading_title; ?></h2>
					<?php echo (isset($description) && !empty($description)) ? $description: ''; ?>
				</div>
                <!-- Filters -->
				<div class="product-filter product-filter-top filters-panel" style="float: left; width: 100%;">
					<div class="row">
						<div class="col-md-2 hidden-sm hidden-xs">
							<div class="view-mode">
								<div class="list-view">
									<button class="btn btn-default grid active" data-view="grid" ><i class="fa fa-th-large"></i></button>
									<button class="btn btn-default list " data-view="list"><i class="fa fa-th-list"></i></button>
								</div>
							</div>
						</div>
						<div class="col-md-10"><div class="pull-right"><?php echo $pagination; ?></div></div>
					</div>
				</div>
				<!-- //end Filters -->
                <div class="blog-listitem">
                    <?php if($articles) { ?>
                        <?php foreach($articles as $article) { ?>                            
                        <div class="blog-item col-md-4">
						  <div class="itemBlogImg left-block col-md-4 col-sm-12">
							  <?php if($article['image']) { ?>
        							<?php if($article['featured_found']) { ?>
        								<div class="article-image ">
        									<a href="<?php echo $article['href']; ?>"><img  src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" /></a>
        								</div>
        							<?php } else { ?>
        								<div class="article-thumbnail-image ">
        									<img  src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" />
        									<span class="article-description">
        										<?php echo $article['description']; ?>
        									</span>
        								</div>
        							<?php } ?>
        						<?php } ?>
                                
						  </div>
						  <div class="itemBlogContent right-block col-md-8 col-sm-12">
							  <div class="article-title">
								<h4><a href="<?php echo $article['href']; ?>"><?php echo ucwords($article['article_title']); ?></a><h4>
							 </div>
							  
							  <div class="article-sub-title">
        							
        							<!-- <span class="article-author"><?php echo $article['author_name']; ?></span> -->
        							<span class="article-date">
								    <?php $datetotime = strtotime($article['date_added']); ?>
								    <i class="fa fa-calendar"></i><?php echo date("D, M j, Y" , $datetotime);?>
								</span>
        							
        						 </div>
							 
							 <?php if($article['featured_found']) { ?>						
								    <div class="article-description">
									     <?php echo utf8_substr( $article['description'],0, 250 );?>
								    </div>
							    <?php } else { ?>
        							<div class="article-description">
        								<?php echo utf8_substr( $article['description'],0, 250 );?>
        							</div>
        						<?php } ?>
							
							<div class="blog-meta">
								<?php if($article['allow_comment']) { ?>
									<span class="comment_count"><a href="<?php echo $article['comment_href']; ?>#comment-section"><?php echo $article['total_comment']; ?></a></span>
								<?php } ?>
								
								<span class="author"><span>Post by </span><?php echo $article['author_name']; ?></span>
								
							 </div>
							
							 <!-- <div align="right">
								<a class="btn btn-success btn-large" href="<?php //echo $article['href']; ?>"><b><?php //echo $button_continue_reading; ?></b></a>
							 </div> -->
							 
							 <?php if(!$article['featured_found']) { ?>
								    <div class="article-thumbnail-found"></div>
        						<?php } ?>    
						  </div>
                             
                                                            
                            </div>
                        <?php } ?>
                        
                        <!-- Filters -->
						<div class="product-filter product-filter-bottom filters-panel" style="float: left; width: 100%;">
							<div class="row">
								<div class="col-md-2 hidden-sm hidden-xs">
									<div class="view-mode">
										<div class="list-view">
											<button class="btn btn-default grid active" data-view="grid" ><i class="fa fa-th-large"></i></button>
											<button class="btn btn-default list " data-view="list"><i class="fa fa-th-list"></i></button>
										</div>
									</div>
								</div>
								<div class="col-md-10"><div class="pull-right"><?php echo $pagination; ?></div></div>
							</div>
						</div>
						<!-- //end Filters -->
                           
                    <?php } else { ?>
                        <h3 class="text-center"><?php echo $text_no_found; ?></h3>
                    <?php } ?>
                </div>               
                
                <?php echo $content_bottom; ?>
            </div>            
             <?php echo $column_left; ?>
            <?php
    if($column_right){
    ?>
    <div class="col-lg-3 col-sm-4 col-xs-12">
    <?php echo $column_right; ?>
    </div>
    <?php } ?>
        </div>        
    </div>    
<?php echo $footer; ?>

<script type="text/javascript"><!--
function display(view) {
	$('.blog-listitem').removeClass('list grid').addClass(view);
	$('.list-view .btn').removeClass('active');
	if(view == 'list') {
		$('.blog-listitem .blog-item').addClass('col-lg-12');
		$('.blog-listitem .blog-item .left-block').addClass('col-md-4');
		$('.blog-listitem .blog-item .right-block').addClass('col-md-8');
		$('.blog-listitem .blog-item .article-description').removeClass('hidden')
		$('.list-view .' + view).addClass('active');
		$.cookie('simple_blog_category', 'list'); 
	}else{
		$('.blog-listitem .blog-item').removeClass('col-lg-12');
		$('.blog-listitem .blog-item .left-block').removeClass('col-md-4');
		$('.blog-listitem .blog-item .right-block').removeClass('col-md-8');
		$('.blog-listitem .blog-item .article-description').addClass('hidden');
		$('.list-view .' + view).addClass('active');
		$.cookie('simple_blog_category', 'grid');
	}
}

$(document).ready(function () {
	// Check if Cookie exists
	if($.cookie('simple_blog_category')){
		view = $.cookie('simple_blog_category');
	}else{
		view = 'grid';
	}
	if(view) display(view);
	
	// Click Button
	$('.list-view .btn').each(function() {
		var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
		$(this).bind(event, function() {
			$(this).addClass(function() {
				if($(this).hasClass('active')) return ''; 
				return 'active';
			});
			$(this).siblings('.btn').removeClass('active');
			$catalog_mode = $(this).data('view');
			display($catalog_mode);
		});
		
	});
});

//--></script> 