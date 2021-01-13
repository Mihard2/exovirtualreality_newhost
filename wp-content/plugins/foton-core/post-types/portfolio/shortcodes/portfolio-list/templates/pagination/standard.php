<?php if ( $query_results->max_num_pages > 1 ) { ?>
	<div class="mkdf-pl-loading">
		<div class="mkdf-pl-loading-bounce1"></div>
		<div class="mkdf-pl-loading-bounce2"></div>
		<div class="mkdf-pl-loading-bounce3"></div>
	</div>
	<?php
	$pages = $query_results->max_num_pages;
	$paged = $query_results->query['paged'];
	
	if ( $pages > 1 ) { ?>
		<div class="mkdf-pl-standard-pagination">
			<ul>
				<li class="mkdf-pag-prev">
					<a href="#" data-paged="1"><span class="arrow_carrot-left"></span></a>
				</li>
				<?php for ( $i = 1; $i <= $pages; $i ++ ) { ?>
					<?php
					$link_classes = '';
					if ( $paged == $i ) {
						$link_classes = 'mkdf-pag-active';
					}
					?>
					<li class="mkdf-pag-number <?php echo esc_attr( $link_classes ); ?>">
						<a href="#" data-paged="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
					</li>
				<?php } ?>
				<li class="mkdf-pag-next">
					<a href="#" data-paged="2"><span class="arrow_carrot-right"></span></a>
				</li>
			</ul>
		</div>
	<?php }
} ?>
