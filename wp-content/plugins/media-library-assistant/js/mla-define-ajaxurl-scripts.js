// defines Global ajaxurl if needed

//if ( ( typeof ajaxurl === 'undefined' ) && ( typeof wp.media.view.l10n.mla_strings.ajaxurl === 'string' ) ) {
//	var ajaxurl = wp.media.view.l10n.mla_strings.ajaxurl;
//}

if ( typeof ajaxurl === 'undefined' ) {
	// Default location at worst
	var ajaxurl = '/wp-admin/admin-ajax.php';

	// See if we can do better
	try {
		if ( typeof window._wpMediaViewsL10n === 'object' ) {
			if ( typeof window._wpMediaViewsL10n.mla_strings === 'object' ) {
				if ( typeof window._wpMediaViewsL10n.mla_strings.ajaxurl === 'string' ) {
					ajaxurl = window._wpMediaViewsL10n.mla_strings.ajaxurl;
				} else {
					console.log( 'mla-define-ajaxurl-scripts.js window._wpMediaViewsL10n.mla_strings.ajaxurl failed' );
				}
			} else {
				console.log( 'mla-define-ajaxurl-scripts.js window._wpMediaViewsL10n.mla_strings failed' );
			}
		} else {
			console.log( 'mla-define-ajaxurl-scripts.js window._wpMediaViewsL10n failed' );
		}
	} catch ( error ) {
		console.log( 'mla-define-ajaxurl-scripts.js error thrown' );
	};
}
