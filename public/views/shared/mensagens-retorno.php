<div id="container-errors">

	<?php

		if (!empty($retorno)) {

			if (empty($retorno["status"])) {
				?>

				<div class="alert alert-block alert-danger text-center">
					<?= $retorno["mensagem"] ?>
				</div>

				<?php
			} else {
				?>

				<div class="alert alert-block alert-success text-center">
					<?= $retorno["mensagem"] ?>
				</div>

				<?php
			}

		}

	?>

</div>
