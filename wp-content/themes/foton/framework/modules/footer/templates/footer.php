<?php do_action( 'foton_mikado_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div> <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer <?php foton_mikado_class_attribute($holder_classes); ?>>
				<?php
					if($display_footer_top) {
						foton_mikado_get_footer_top();
					}
					if($display_footer_bottom) {
						foton_mikado_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.mkdf-wrapper-inner  -->
</div> <!-- close div.mkdf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>