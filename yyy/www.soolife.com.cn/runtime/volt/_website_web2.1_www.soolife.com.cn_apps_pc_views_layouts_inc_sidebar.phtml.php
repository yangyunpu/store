<?php foreach ($menus as $m) { ?>
	<?php  $mm = strpos($nav,strtolower($m['name'])); ?>
	<?php $active = (($mm === false) ? '' : 'active open'); ?>
		<li class="<?= $active ?>">
			<a href="<?= $m['target'] ?>" class="dropdown-toggle">
				<span class="menu-text"> <?= $m['text'] ?> </span>
			</a>
			<ul class="submenu">
				<?php foreach ($m['items'] as $n) { ?>
				<?php $active_n = (($n['name'] == $nav) ? 'active' : ''); ?>
				<li class="<?= $active_n ?>">
					<a href="<?= $n['target'] ?>">
						<?= $n['text'] ?>
					</a>
					<b class="arrow"></b>
				</li>
				<?php } ?>
			</ul>
		</li>
<?php } ?>