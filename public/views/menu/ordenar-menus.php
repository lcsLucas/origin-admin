<!-- Breadcrumb-->
<!--
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?= URL ?>">Dashboard</a>
	</li>
	<li class="breadcrumb-item active">Permissões</li>
	<li class="breadcrumb-item active">Ordenar Menus</li>
</ol>
-->

<div class="animated fadeIn <?= empty($this->dados->todos_menus) ? 'h-100' : '' ?>">

	<div id="conteudo" class="container-fluid <?= empty($this->dados->todos_menus) ? 'h-100 d-flex flex-column justify-content-center align-items-center text-center' : '' ?>">

		<?php
			if (!empty($this->dados->todos_menus)) {
				?>

				<div id="sortable-menu">

                    <?php

                        foreach ($this->dados->todos_menus as $secao) {
							?>
                            <h5 class="text-uppercase text-dark mb-2 mt-5">Ordenar menus da seção:
                                <strong><?= !empty($secao['nome']) ? $secao['nome'] : 'Sem seção' ?></strong></h5>

                            <ul class="nav flex-column">

								<?php
									foreach ($secao['menus'] as $id_men => $menu) {
										?>

                                        <li class="nav-item">
                                            <input type="hidden" name="men_id[]" value="<?= $id_men ?>"/>
                                            <div class="d-flex justify-content-between mb-2 py-3 px-3 text-uppercase text-dark">
										<span>
											<i class="fas fa-arrows-alt-v mr-2 text-muted"></i>
											<?= $menu['nome'] ?>
										</span>

												<?= !empty($menu['submenus']) ? '<a href="" class="text-primary toggle-menu"><i class="fas fa-fw fa-plus mr-1"></i></a>' : '' ?>
                                            </div>

											<?php
												if (!empty($menu['submenus'])) {
													?>

                                                    <ul class="nav flex-column ml-5">

														<?php
															foreach ($menu['submenus'] as $submenu) {
																?>

                                                                <li class="nav-item">
                                                                    <input type="hidden" name="men_id[]"
                                                                           value="<?= $submenu['id'] ?>"/>
                                                                    <div class="d-flex justify-content-between mb-2 py-3 px-3 text-uppercase text-dark">
                                                                <span>
                                                                    <i class="fas fa-arrows-alt-v mr-2 text-muted"></i>
                                                                    <?= $submenu['nome'] ?>
                                                                </span>
                                                                    </div>
                                                                </li>

																<?php
															}
														?>

                                                    </ul>

													<?php
												}
											?>

                                        </li>

										<?php
									}
								?>

                            </ul>

							<?php
						}
                    ?>

				</div>

				<?php
			} else {
				?>
				<h4 class="m-0 text-muted text-center font-weight-light">Nenhum menu para ser listado</h4>
		<?php
			}
		?>

	</div>

</div>
