<div class="page-title">
	<h3>Cover</h3>
</div>

<form action="#" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    	<div class="cover">
		    <div class="image" style="background-image: url('<?php echo URL . '/' . $user->getCover(); ?>')"></div>
		</div>
    	<label>Type : jpeg ou png et de taille 1184px x 200px</label>
        <input type="file" name="cover" />
    </div>
    <div class="form-group">
        <input class='btn-success' type="submit" value="Envoyer" />
    </div>
</form>

<div class="page-title">
	<h3>Couleur de fond</h3>
</div>

<form action="#" method="POST" enctype="multipart/form-data">
    <div class="form-group">
    	<label>Couleur : <span class="color" style="<?php echo (!empty($theme->getBg_color())) ? 'background-color: '. $theme->getBg_color() : ''; ?>"></span> (<a href="http://www.flatuicolorpicker.com/">flatuicolorpicker</a>)</label>
        <input type="text" name="theme[color]" value="<?php echo $theme->getBg_color();?>" />
    </div>
    <div class="form-group">
        <input class='btn-info' type="submit" value="Modifier" />
    </div>
</form>