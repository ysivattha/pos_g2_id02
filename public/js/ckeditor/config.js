/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.cke_toolgroup = '#cccccc';
	CKEDITOR.config.toolbar = [
	   { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
	   { name: 'editing', items: ['Find', 'Replace', '-', 'SpellChecker'] },
	   { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
	   { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
	   '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
	   },
	   { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
	   { name: 'colors', items: ['TextColor', 'BGColor'] },
	   { name: 'tools', items: ['Maximize'] }
	];
	
};
