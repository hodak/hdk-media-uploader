## WordPress Easy Include Media Uploader 

This is a library for creators of WordPress themes & plugins that makes it simple
to include Media Uploader in WordPress admin panel.
It's a fairly common client's requirement so why not make it simple.

It creates hidden input field with value set to the id of chosen attachment.

You can include it in any place (**in WordPress admin panel**) you want - meta boxes, option pages, you name it.

## Usage
```
new HdkMediaUploader( array(
  'name'          => 'your_input_name',       # <input name>
  'attachment_id' => $current_attachment_id,  # <input value>, empty if not set
  'button_text'   => 'Upload',
  'button_class'  => 'button'
) );
```

## Set up & Usage examples
### Theme
Let's assume we create a `test` theme.

1. Clone/copy repo contents to `/wp-content/themes/test/lib/hdk-media-uploader/`
2. Include `HdkMediaUploader.php` file, for example:

  ```
  include_once( get_stylesheet_directory() . '/lib/hdk-media-uploader/HdkMediaUploader.php' );
  ```
  
3. Use it inside your form:

  ```
  new HdkMediaUploader( array(
    'name'          => 'your_input_name',       # <input name>
    'attachment_id' => $current_attachment_id,  # <input value>
  ) );
  ```
  
### Plugin
Let's assume we create a `test` plugin.

1. Clone/copy repo contents to `/wp-content/plugins/test/lib/hdk-media-uploader/`
2. Include `HdkMediaUploader.php` file, for example:

  ```
  include_once( plugin_dir_path( __FILE__ ) . '/lib/hdk-media-uploader/HdkMediaUploader.php' );
  ```

3. Use it inside your form:

  ```
  new HdkMediaUploader( array(
    'name'          => 'your_input_name',       # <input name>
    'attachment_id' => $current_attachment_id,  # <input value>
  ) );
  ```
  
### Different path
If you don't want to use `/lib/hdk-media-uploader/` path, you're in luck. You can paste it whenever you want and use this one-line setup before creating instance:

```
HdkMediaUploader :: set_directory_url( 'your-url-for-this-repo' )
```

After this you can use it like you normally would.


**Remember:** url is not a path.

Path: http://codex.wordpress.org/Function_Reference/get_stylesheet_directory

URL: http://codex.wordpress.org/Function_Reference/get_stylesheet_directory_uri

## Credit
Most of the credit goes to Mike Jolley: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
