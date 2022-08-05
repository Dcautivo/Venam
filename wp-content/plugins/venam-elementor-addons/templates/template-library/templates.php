<?php
/**
 * Template library templates
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-venamTemplateLibrary__header-logo">
    <span class="venamTemplateLibrary__logo-wrap">
		<i class="hm hm-happyaddons"></i>
	</span>
    <span class="venamTemplateLibrary__logo-title">NINETHEME {{{ title }}}</span>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __( 'Back to Library', 'happy-elementor-addons' ); ?></span>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__header-menu-responsive">
	<div class="elementor-component-tab venamTemplateLibrary__responsive-menu-item elementor-active" data-tab="desktop">
		<i class="eicon-device-desktop" aria-hidden="true" title="<?php esc_attr_e( 'Desktop view', 'happy-elementor-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Desktop view', 'happy-elementor-addons' ); ?></span>
	</div>
	<div class="elementor-component-tab venamTemplateLibrary__responsive-menu-item" data-tab="tab">
		<i class="eicon-device-tablet" aria-hidden="true" title="<?php esc_attr_e( 'Tab view', 'happy-elementor-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Tab view', 'happy-elementor-addons' ); ?></span>
	</div>
	<div class="elementor-component-tab venamTemplateLibrary__responsive-menu-item" data-tab="mobile">
		<i class="eicon-device-mobile" aria-hidden="true" title="<?php esc_attr_e( 'Mobile view', 'happy-elementor-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Mobile view', 'happy-elementor-addons' ); ?></span>
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__header-actions">
	<div id="venamTemplateLibrary__header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'happy-elementor-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'happy-elementor-addons' ); ?></span>
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__preview">
    <iframe></iframe>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ ha.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__insert-button">
	<a class="elementor-template-library-template-action elementor-button venamTemplateLibrary__insert-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'happy-elementor-addons' ); ?></span>
	</a>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__pro-button">
	<a class="elementor-template-library-template-action elementor-button venamTemplateLibrary__pro-button" href="https://happyaddons.com/pricing/" target="_blank">
		<i class="eicon-external-link-square" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php esc_html_e( 'Get Pro', 'happy-elementor-addons' ); ?></span>
	</a>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php esc_html_e( 'Loading', 'happy-elementor-addons' ); ?></div>
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__templates">
	<div id="venamTemplateLibrary__toolbar">
		<div id="venamTemplateLibrary__toolbar-filter" class="venamTemplateLibrary__toolbar-filter">
			<# if (ha.library.getTypeTags()) { var selectedTag = ha.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="venamTemplateLibrary__filter-btn">{{{ ha.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="venamTemplateLibrary__filter-btn"><?php esc_html_e( 'Filter', 'happy-elementor-addons' ); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="venamTemplateLibrary__filter-tags" class="venamTemplateLibrary__filter-tags">
					<li data-tag="">All</li>
					<# _.each(ha.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ ha.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
		<div id="venamTemplateLibrary__toolbar-counter"></div>
		<div id="venamTemplateLibrary__toolbar-search">
			<label for="venamTemplateLibrary__search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'happy-elementor-addons' ); ?></label>
			<input id="venamTemplateLibrary__search" placeholder="<?php esc_attr_e( 'Search', 'happy-elementor-addons' ); ?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="venamTemplateLibrary__templates-window">
		<div id="venamTemplateLibrary__templates-list"></div>
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__template">
	<div class="venamTemplateLibrary__template-body" id="venamTemplate-{{ template_id }}">
		<div class="venamTemplateLibrary__template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="venamTemplateLibrary__template-thumbnail" src="{{ thumbnail }}">
		<# if ( obj.isPro ) { #>
		<span class="venamTemplateLibrary__template-badge"><?php esc_html_e( 'Pro', 'happy-elementor-addons' ); ?></span>
		<# } #>
	</div>
	<div class="venamTemplateLibrary__template-footer">
		{{{ ha.library.getModal().getTemplateActionButton( obj ) }}}
		<a href="#" class="elementor-button venamTemplateLibrary__preview-button">
			<i class="eicon-device-desktop" aria-hidden="true"></i>
			<?php esc_html_e( 'Preview', 'happy-elementor-addons' ); ?>
		</a>
	</div>
</script>

<script type="text/template" id="tmpl-venamTemplateLibrary__empty">
	<div class="elementor-template-library-blank-icon">
		<img src="<?php echo ELEMENTOR_ASSETS_URL . 'images/no-search-results.svg'; ?>" class="elementor-template-library-no-results" />
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
	<div class="elementor-template-library-blank-footer">
		<?php esc_html_e( 'Want to learn more about the Happy Library?', 'happy-elementor-addons' ); ?>
		<a class="elementor-template-library-blank-footer-link" href="https://happyaddons.com/docs/happy-addons-for-elementor/happy-features/happy-templates/" target="_blank"><?php echo __( 'Click here', 'happy-elementor-addons' ); ?></a>
	</div>
</script>
