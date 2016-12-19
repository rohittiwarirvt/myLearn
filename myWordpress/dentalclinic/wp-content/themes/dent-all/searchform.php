<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" placeholder="<?php esc_html_e( 'Search', 'dent-all' ); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
	<button type="submit" class="button"><i class="stm-icon-search"></i></button>
</form>