/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = 'http://127.0.0.1:8000/admin-assets/ckf/ckfinder.html';
    config.filebrowserImageBrowseUrl = 'http://127.0.0.1:8000/admin-assets/ckf/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = 'http://127.0.0.1:8000/admin-assets/ckf/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = 'http://127.0.0.1:8000/admin-assets/ckf/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = 'http://127.0.0.1:8000/admin-assets/ckf/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = 'http://127.0.0.1:8000/admin-assets/ckf/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    config.extraPlugins = 'video';

};