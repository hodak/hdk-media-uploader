/*
 * http://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
 * http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */

( function($) {
	$( document ).ready( function() {
		var hdkMediaUploaderClass = function() {
			var fileFrame, parentWrap, inputField, photoUploaderWrap, img, uploadButton;

			this.init = function() {
				attachHandlers();
			}

			var attachHandlers = function() {
				var buttons = document.querySelectorAll( '.hdk-media-uploader-button' );
				for( i = 0; i < buttons.length; i++ ) {
					buttons[ i ].addEventListener( 'click', onUploadClick );
				}

				$( '.hdk-media-uploader-del-photo' ).on( 'click', onDelPhotoClick );
			}

			/* Changes on adding/deleting photo:
			 * - inputField: value
			 * - photoUploaderWrap: .hidden
			 * - img: src
			 * - uploadButton: .hidden
			 */

			// We need to initialize vars after selecting image or choosing to delete photo
			var initializeVars = function( target ) {
				target = $( target );

				parentWrap = target.parents( '.hdk-media-uploader' );
				inputField = parentWrap.find( 'input' ).first();
				photoUploaderWrap = parentWrap.find( '.hdk-media-uploader-photo-wrap' ).first();
				img = parentWrap.find( '.hdk-media-uploader-photo' ).first();
				uploadButton = parentWrap.find( '.hdk-media-uploader-button' );
			}

			var onUploadClick = function( e ) {
				e.preventDefault();

				// If the media frame already exists, reopen it.
				if( fileFrame ) {
					fileFrame.open();
					return;
				}

				// Create the media frame.
				fileFrame = wp.media.frames.file_frame = wp.media( {
					title: jQuery( this ).data( 'uploader_title' ),
					button: {
						text: jQuery( this ).data( 'uploader_button_text' ),
					},
					multiple: false  // Set to true to allow multiple files to be selected
				} );

				// When an image is selected, run a callback.
				fileFrame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = fileFrame.state().get( 'selection' ).first().toJSON();
					initializeVars( e.target );
					onFileSelected( attachment );
				} );

				// Finally, open the modal
				fileFrame.open();
			}

			var onFileSelected = function( attachment ) {
				inputField.val( attachment.id );
				photoUploaderWrap.removeClass( 'hidden' );

				img.attr( 'src', attachment.sizes.thumbnail.url );
				uploadButton.addClass( 'hidden' );
			}

			var onDelPhotoClick = function( e ) {
				e.preventDefault();
				initializeVars( e.target );

				inputField.val( '' );
				photoUploaderWrap.addClass( 'hidden' );
				img.attr( 'src', '' );
				uploadButton.removeClass( 'hidden' );
			}

		}

		var hdkMediaUploader = new hdkMediaUploaderClass();
		hdkMediaUploader.init();
	} ); // ready
} ) ( jQuery ); // function $
