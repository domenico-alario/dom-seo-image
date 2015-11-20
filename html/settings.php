<br />
<h2><?= $this->name ?> - <b>Configurações</b></h2>

<?php if( isset($_POST['submit']) ): ?>
<div id="message" class="updated fade">
	<p><b><?= $this->name ?></b> - Configurações salvas com sucesso!</p>
</div>
<?php endif ?>

<br />
<div class="postbox">
	<div class="inside">
		<h3>Opções de Configuração</h3>
		<p>O <b><?= $this->name ?></b> é o plugin que renomeia de forma automática os atributos <i>alt</i> e <i>title</i> das imagens inseridas nos seus posts. Dessa forma você estará melhorando o SEO de sua página.</p>
		<p>Vale lembrar que o <b><?= $this->name ?></b> é totalmente compatível com o <b>Yoast</b> ou qualquer outro plugin de SEO convencional.</p>
		<hr />
		<h4>Monte sua configuração</h4>
		<p>Abaixo você pode de forma prática e rápida montar como as tags <b>ALT</b> e <b>TITLE</b> das suas imagens devem ser.</p>
		<p><b>Nome da imagem</b> - O nome da imagem é o nome dado a uma imagem no momento que você a carrega no seu post.<br /><b style="color: red">Para evitar duplicidade nos nomes gerados é altamente recomendado sempre utilizar essa opção.</b></p>
		<p><b>Título do post</b> - O título do post é o título dado a sua postagem na hora da criação.</p>
		<p><b>Categoria do post</b> - Nome da categoria a qual o post pertecem.</p>
		<p><b>Descrição META</b> - É a descrição usada na tag META. Ela geralmente é configurada por plugins SEO como o Yoast.</p>
		<p><b>Nome do site</b> - É o nome que seu site recebe na configuração do Wordpress.</p>
		<br />
		<p>A tag configurada terá o valor no formato <b>opção1-opção2-opção3</b>... Você não precisa utilizar todos os valores.</p>
	</div>
</div>
<br />
<form method="POST" action="<?= esc_url($_SERVER['REQUEST_URI']) ?>">
<div class="postbox">
	<div class="inside">
		<h3>Configurações</h3>
		<table class="form-table">
			<tr>
				<th>
					<label for="input-alt">Atributo <u>ALT</u> da imagem</label>
				</th>
				<td>
					<!-- <input name="alt" id="input-alt" type="text" value="<?= $data['alt'] ?>" /> -->
					<?= SEOImgly::generateHTMLOptions('img_alt') ?>
					<br />
			        <span class="description">Deixe em branco para não utilizar</span>
				</td>
			</tr>
			<tr>
				<th>
					<label for="input-title">Atributo <u>TITLE</u> da imagem</label>
					
				</th>
				<td>
					<?= SEOImgly::generateHTMLOptions('img_title') ?>
					<br />
			        <span class="description">Deixe em branco para não utilizar</span>
				</td>
			</tr>
		</table>
	</div>
</div>
<input type="submit" name="submit" class="button button-primary" value="Atualizar Configurações" />
</form>