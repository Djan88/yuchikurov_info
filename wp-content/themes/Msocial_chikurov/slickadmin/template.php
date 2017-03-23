<div id="sa-wrapper">
	<div id="sa-header">
		<h2 id="sa-header-title"><?php _e( 'Theme options', 'slickadmin' ); ?></h2>
		<cite>Slick Admin <?php echo sa_info( 'ver' ); ?></cite>
	</div>
	<div id="sa-panel">
		<div class="sa-notification">
			<?php sa_notification(); ?>
		</div>
		<div id="sa-tabs">
			<ul>
				<?php sa_tabs(); ?>
			</ul>
		</div>
		<div id="sa-panes">
			<?php sa_panes(); ?>
		</div>
		<div class="cl"></div>
		<div class="sa-notification"></div>
	</div>
	<div id="sa-footer">
		<div id="sa-footer-shell">
			<?php sa_footer( '&nbsp;&nbsp;&ndash;&nbsp;&nbsp;' ); ?>
		</div>
	</div>
</div>