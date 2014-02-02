<div class="hdk-media-uploader">

	<input type="text" value="<?php echo $args['attachment_id']; ?>" name="<?php echo $args['name']; ?>" />

	<?php // todo merge these into one ?>
	<?php if( $attachment ) : ?>

		<div class="hdk-media-uploader-photo-wrap">
			<a href="#" class="hdk-media-uploader-del-photo">x</a>
			<img src="<?php echo $attachment -> url; ?>" alt="" class="hdk-media-uploader-photo" />
		</div><!-- .hdk-media-uploader-photo-wrap -->

	<?php else : ?>

		<div class="hdk-media-uploader-photo-wrap hidden">
			<a href="#" class="hdk-media-uploader-del-photo">x</a>
			<img src="" alt="" class="hdk-media-uploader-photo" />
		</div><!-- .hdk-media-uploader-photo-wrap -->

	<?php endif; ?>

	<button class="hdk-media-uploader-button <?php echo $args['button_class']; ?> <?php echo $attachment ? 'hidden' : ''; ?>"><?php echo $args['button_text']; ?></button> 

</div><!-- .hdk-media-uploader -->
