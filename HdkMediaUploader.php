<?php
DEFINE( 'HDK_MEDIA_UPLOADER_DIR', dirname( __FILE__ ) );
class HdkMediaUploader {
	private $ver = '0.1';
	# we need directory url in order to enqueue script. there's now way for us to retrieve it if we want to allow people to paste this library anywhere (and we do)
	private static $directory_url;

	public function __construct( $args ) {
		if( empty( $this -> get_directory_url() ) ) {
			$this -> go_and_die( "You must provide directory url" );
		}
		if( empty( $args ) ) {
			$this -> go_and_die( 'You must provide arguments' );
		}
		# we don't alllow empty <input name="" />
		if( !isset( $args['name'] ) || empty( $args['name'] ) ) {
			$this -> go_and_die( 'You must provide input name' );
		}
		# merge with defaults
		$args = array_merge( array(
			'name' => '',               # necessary input name
			'attachment_id' => '',      # photo id
			'button_text' => 'Upload',
			'button_class' => 'btn',
			# 'multiple' => false # maybe some day. it's kind of complicated
		), $args );

		# enqueue script
		wp_enqueue_script( 'hdk_media_uploader_script', $this -> get_directory_url() . 'hdk-media-uploader-script.js', array( 'jquery' ), $this -> ver, true );
		# enqueue style
		wp_enqueue_style( 'hdk_media_uploader_style', $this -> get_directory_url() . 'hdk-media-uploader-style.css', array(), $this -> ver );

		# show it
		echo $this -> show_input( $args );
	}

	public function show_input( $args ) {
		if( intval( $args['attachment_id'] ) > 0 ) {
			$attachment = new stdClass();
			$attachment -> id = intval( $args['attachment_id'] );
			// get thumbnail size
			$attachment -> url = wp_get_attachment_image_src( $attachment -> id, 'thumbnail' )[0];
			if( empty( $attachment -> url ) ) {
				$attachment = null;
			}
		}
		include( HDK_MEDIA_UPLOADER_DIR . '/view-input.php' );
	}

	# static directory_url
	public static function set_directory_url( $directory_url ) {
		# remove trailing slashes and add one at the end
		HdkMediaUploader :: $directory_url = rtrim( $directory_url, '/' ) . '/';
	}
	private function get_directory_url() {
		return HdkMediaUploader :: $directory_url;
	}

	# todo get to know more (documentation)
	private function go_and_die( $msg ) {
		die( 'HdkMediaUploader: ' . $msg );
	}

}
?>
