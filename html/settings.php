<br />
<h2><?php echo $this->name ?> - <b><?php _e('Settings', 'dom-seo-image') ?></b></h2>

<?php if( isset($_POST['submit']) && !isset($errorSubmit)): ?>
<div id="message" class="updated fade">
	<p><b><?php echo $this->name ?></b> - <?php _e('Settings has been updated!', 'dom-seo-image') ?></p>
</div>
<?php endif ?>

<br />
<div class="postbox">
	<div class="inside">
		<h3><?php _e('Settings Options', 'dom-seo-image') ?></h3>
		<p><?php _e("<b>DOM SEO Image</b> is the plugin which automatically set the <i>ALT</i> and <i>TITLE</i> attribute of your posts images. In this way, you'll be improving the SEO traffic of your website.", 'dom-seo-image') ?></p>
		<hr />
		<h4><?php _e('Set up', 'dom-seo-image') ?></h4>
		<p><?php _e('Below, in an easy and quickly way, you can set up how the <b>ALT</b> and <b>TITLE</b> tags of images have to be.', 'dom-seo-image') ?></p>
		<p><b><?php _e('Image name', 'dom-seo-image') ?></b> - <?php _e('The title of the image that whas uploaded.', 'dom-seo-image') ?><br /><b style="color: red"><?php _e('To avoid duplicate names, it\'s highly recommended always use this option.', 'dom-seo-image') ?></b></p>
		<p><b><?php _e('Post title', 'dom-seo-image') ?></b> - <?php _e('The title given to your post.', 'dom-seo-image') ?></p>
		<p><b><?php _e('Post category', 'dom-seo-image') ?></b> - <?php _e('The name of the category that the post belongs to', 'dom-seo-image') ?></p>
		<p><b><?php _e('Meta Description', 'dom-seo-image') ?></b> - <?php _e('Description used in META tag. It is usually setted up using SEO plugins like Yoast.', 'dom-seo-image') ?></p>
		<p><b><?php _e('Site name', 'dom-seo-image') ?></b> - <?php _e('The name of the site that is setted up on Wordpress settings', 'dom-seo-image')  ?></p>
		<br />
		<p><?php _e('The tag will be showed in the format <b>option1-option2-option3</b>... You don\'t need choose all options.', 'dom-seo-image') ?></p>
	</div>
</div>
<br />
<form method="POST" action="<?php echo esc_url($_SERVER['REQUEST_URI']) ?>">
<div class="postbox">
	<div class="inside">
		<h3><?php _e('Settings') ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label for="input-alt"><?php _e("Image <u>ALT</u> Attribute", 'dom-seo-image') ?></label>
				</th>
				<td>
					<!-- <input name="alt" id="input-alt" type="text" value="<?php echo $data['alt'] ?>" /> -->
					<?php echo SEOImgly::generateHTMLOptions('img_alt') ?>
					<br />
			        <span class="description"><?php _e('Leave blank to not use it', 'dom-seo-image') ?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="input-title"><?php _e("Image <u>TITLE</u> Attribute", 'dom-seo-image') ?></label>
					
				</th>
				<td>
					<?php echo SEOImgly::generateHTMLOptions('img_title') ?>
					<br />
			        <span class="description"><?php _e('Leave blank to not use it', 'dom-seo-image') ?></span>
				</td>
			</tr>
		</table>
	</div>
</div>
<input type="hidden" name="_wpnonce" value="<?php echo $nonce ?>" />
<input type="submit" name="submit" class="button button-primary" value="<?php _e('Update Settings', 'dom-seo-image') ?>" />
</form>