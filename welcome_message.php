<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pokedex</title>
</head>
<body>
	<form action="" method="get">
		<div>
			<label for="pokemon-id">Pokemon Numero</label>
			<input type="text" name = "id" id = "pokemon-id" value=<?= $this->input->get('id')?>>
		</div>
		<button type="submit">Buscar</button>
		<button type="button">
			<a href="<?= base_url("?id=$aleatorio")?>">
				Pokemon Aleatorio
			</a>
		</button>
	</form>

	<div>
		<?php
			if (isset($erro)) {
				echo $erro;
			}
		?>
	</div>

	<?php
		if (isset($pokemon)) { ?>
			<h1>#<?= $pokemon['id'] ?> - <?= $pokemon['nome'] ?> </h1>
			<img src ="<?=$pokemon['imagem']?>" alt = "<?=$pokemon['nome'] ?>">
	<?php	} ?>

</body>
</html>