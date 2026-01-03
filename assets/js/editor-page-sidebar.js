( function ( wp ) {
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editPost;
	const { SelectControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;
	const { createElement, Fragment } = wp.element;

	function SidebarPanel() {
		const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType(), [] );
		if ( postType !== 'page' ) {
			return null;
		}

		const meta = useSelect( ( select ) => {
			const m = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
			return ( m && m.nexawp_page_sidebar_layout ) ? m.nexawp_page_sidebar_layout : 'none';
		}, [] );

		const { editPost } = useDispatch( 'core/editor' );

		return createElement( PluginDocumentSettingPanel, { name: 'nexawp-page-sidebar', title: 'Page Sidebar', className: 'nexawp-page-sidebar-panel' },
			createElement( SelectControl, {
				label: 'Sidebar Layout',
				value: meta,
				options: [
					{ value: 'none', label: 'No sidebar' },
					{ value: 'right', label: 'Right' },
					{ value: 'left', label: 'Left' },
				],
				onChange: ( val ) => editPost( { meta: { nexawp_page_sidebar_layout: val } } ),
			}
		)
		);
	}

	registerPlugin( 'nexawp-page-sidebar', { render: SidebarPanel } );
} )( window.wp );
