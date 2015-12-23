<br />
<h2><?= $this->name ?> - <b><?= __('Settings', 'dom-seo-image') ?></b></h2>

<?php if( isset($_POST['submit']) ): ?>
<div id="message" class="updated fade">
	<p><b><?= $this->name ?></b> - <?= __('Settings has been updated!', 'dom-seo-image') ?></p>
</div>
<?php endif ?>

<br />
<div class="postbox">
	<div class="inside">
		<h3><?= __('Settings Options', 'dom-seo-image') ?></h3>
		<p><?= __("<b>DOM SEO Image</b> is the plugin which automatically set the <i>ALT</i> and <i>TITLE</i> attribute of your posts images. In this way, you'll be improving the SEO traffic of your website.", 'dom-seo-image') ?></p>
		<hr />
		<h4><?= __('Set up', 'dom-seo-image') ?></h4>
		<p><?= __('Below, in an easy and quickly way, you can set up how the <b>ALT</b> and <b>TITLE</b> tags of images have to be.', 'dom-seo-image') ?></p>
		<p><b><?= __('Image name', 'dom-seo-image') ?></b> - <?= __('The title of the image that whas uploaded.', 'dom-seo-image') ?><br /><b style="color: red"><?= __('To avoid duplicate names, it\'s highly recommended always use this option.', 'dom-seo-image') ?></b></p>
		<p><b><?= __('Post title', 'dom-seo-image') ?></b> - <?= __('The title given to your post.', 'dom-seo-image') ?></p>
		<p><b><?= __('Post category', 'dom-seo-image') ?></b> - <?= __('The name of the category that the post belongs to', 'dom-seo-image') ?></p>
		<p><b><?= __('Meta Description', 'dom-seo-image') ?></b> - <?= __('Description used in META tag. It is usually setted up using SEO plugins like Yoast.', 'dom-seo-image') ?></p>
		<p><b><?= __('Site name', 'dom-seo-image') ?></b> - <?= __('The name of the site that is setted up on Wordpress settings', 'dom-seo-image')  ?></p>
		<br />
		<p><?= __('The tag will be showed in the format <b>option1-option2-option3</b>... You don\'t need choose all options.', 'dom-seo-image') ?></p>
	</div>
</div>
<br />
<form method="POST" action="<?= esc_url($_SERVER['REQUEST_URI']) ?>">
<div class="postbox">
	<div class="inside">
		<h3><?= __('Settings') ?></h3>
		<table class="form-table">
			<tr>
				<th>
					<label for="input-alt"><?= __("Image <u>ALT</u> Attribute", 'dom-seo-image') ?></label>
				</th>
				<td>
					<!-- <input name="alt" id="input-alt" type="text" value="<?= $data['alt'] ?>" /> -->
					<?= SEOImgly::generateHTMLOptions('img_alt') ?>
					<br />
			        <span class="description"><?= __('Leave blank to not use it', 'dom-seo-image') ?></span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="input-title"><?= __("Image <u>TITLE</u> Attribute", 'dom-seo-image') ?></label>
					
				</th>
				<td>
					<?= SEOImgly::generateHTMLOptions('img_title') ?>
					<br />
			        <span class="description"><?= __('Leave blank to not use it', 'dom-seo-image') ?></span>
				</td>
			</tr>
		</table>
	</div>
</div>
<input type="submit" name="submit" class="button button-primary" value="<?= __('Update Settings', 'dom-seo-image') ?>" />
</form>