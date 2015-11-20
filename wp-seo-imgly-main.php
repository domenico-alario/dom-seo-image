<?php
class SEOImgly
{
	public $name = 'DOM SEO Image';

	public $key = 'wp-seo-imgly';

	static $options = array(
		'image_name' => 'Nome da imagem',
		'post_title' => 'Título do post',
		'post_cat'   => 'Categoria do post',
		'meta_desc'  => 'Descrição da META',
		'site_name'  => 'Nome do site'
	);

	public function __construct() {}

	public static function generateHTMLOptions($name)
	{
		$stored = false;
		if(get_option(self::getKey()))
		{
			$stored = self::parseStoredData(get_option(self::getKey()));
		}

		$output = '';
		$index = 0;
		foreach(self::$options as $k => $v)
		{
			$options = '<select name="'.$name.'[]"><option></option>';			
			foreach(self::$options as $key => $val)
			{
				$selected = '';
				if($stored && $stored[$name][$index] == $key)
					$selected = 'selected';
				$options .= "<option value='".$key."' ".$selected.">". $val ."</option>";
			}
			$options .= "</select>";
			if($index != sizeof(self::$options)-1) $options .= '<span> - </span>';
			$output .= $options;
			$index++;
		}

		return $output;
	}

	public static function parseStoredData($data)
	{
		$result = array();
		foreach($data as $main_key => $main_val)
		{
			$result[$main_key] = array();
			foreach($main_val as $key => $val)
			{
				if(!empty($val))
					$result[$main_key][] = $val;
			}
		}

		return $result;
	}

	static public function init()
	{
		$instance = new SEOImgly();
		$instance->run();
	}

	public static function getKey()
	{
		$instance = new SEOImgly();
		return $instance->key;
	}

	public function run()
	{
		$this->loadActions();	
		$this->loadHooks();	
	}

	public function addAdminPages()
	{
		add_menu_page($this->name, $this->name, 'manage_options', 'simgly_settings', array(
			&$this,
			'pageHandleSettings'
		));

		add_submenu_page('simgly_settings', $this->name . ' Configurações', 'Configurações', 'manage_options', 'simgly_settings', array(
			&$this,
			'pageHandleSettings'
		));

		add_submenu_page('simgly_settings', $this->name . ' Sobre', 'Sobre', 'manage_options', 'simgly_about', array(
			&$this,
			'pageHandleAbout'
		));
	}

	public function parseStr( $str )
	{
		$str = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $str ) );
		$str = preg_replace('/[\s\.]/', '-', $str);
		return strtolower($str);
	}

	public function storePostData()
	{
		global $post;
		$this->data = array();
		$this->oldData = array();
		$categories = get_the_category();

		// Título do post
		$this->data['post_title'] = $this->parseStr($post->post_title);
		$this->oldData['post_title'] = $post->post_title;

		// Categorias do post
		$cats = '';
		$cats2 = '';
		foreach( $categories as $category ) {
			$cats .= $category->slug . '-';
			$cats2 .= $category->slug . ' ';
		}
		$this->data['post_cat'] = trim($cats, '-');
		$this->oldData['post_cat'] = trim($cats2);

		// Nome do site
		$this->data['site_name'] = $this->parseStr(get_bloginfo());
		$this->oldData['site_name'] = get_bloginfo();
	}

	public function parsePostContent($content)
	{
		$this->storePostData();
		$replaced = preg_replace_callback('/<img[^>]+/', array($this, 'processHTML'), $content);
		return $replaced;
	}

	public function generateImgAttr($type, $data) {
		$options = get_option($this->key);
		$options = ($type == 'title') ? $options['img_title'] : $options['img_alt'];
		$output = array();

		foreach( $options as $option )
		{
			if( $option )
				$output[] = $data[$option];
		}

		if( $type == 'alt' )
			return implode('-', $output);
		else
			return implode(' ', $output);
	}

	public function processHTML($match)
	{
		preg_match('/alt="(.+?)"/', $match[0], $matches);
		if( isset($matches[1]) ) {
			$this->data['image_name'] = $this->parseStr($matches[1]);
			$this->oldData['image_name'] = $matches[1];
		} else {
			$this->data['image_name'] = '';
			$this->oldData['image_name'] = '';
		}

		$title = $this->generateImgAttr('title', $this->oldData);
		$alt = $this->generateImgAttr('alt', $this->data);

		// Configuração do ALT
		if( $this->data['image_name'] )
			$tag = preg_replace('/alt=".+?"/', 'alt="'.$alt.'"', $match[0]);
		else
			$tag = str_replace('<img', '<img alt="'.$alt.'"', $tag);


		// Configuração do TITLE
		if(!preg_match('/title=".+?"/', $tag))
			$tag = str_replace('<img', '<img title="'.$title.'"', $tag);
		else
			$tag = preg_replace('/title=".+?"/', 'title="'.$title.'"', $tag);

		return $tag;
	}

	public function getPostData()
	{
		global $post;
		return $post;
	}

	public function pageHandleSettings()
	{
		if (isset($_POST['submit']))
		{
			$options = array(
				'img_title' => $_POST['img_title'],
				'img_alt' => $_POST['img_alt']
			);
			update_option($this->key, $options);
		}

		include( dirname( __FILE__ ) . '/html/settings.php' );
	}

	public function pageHandleAbout()
	{
		include( dirname( __FILE__ ) . '/html/about.php' );
	}

	public function loadHooks()
	{
		add_filter('the_content', array($this, 'parsePostContent'), 500);	
	}

	public function loadActions()
	{
		add_action('admin_menu', array($this, 'addAdminPages'));
	}

}
