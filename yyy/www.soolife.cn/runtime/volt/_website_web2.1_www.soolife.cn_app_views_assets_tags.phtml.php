document.write('<ul>');
	<?php foreach ($tags as $d) { ?>
document.write('	<li>');
document.write('		<a href="<?= $url_search ?>/search?keyword=<?= $d['keywords'] ?>" target="_blank" ><?= $d['name'] ?></a>');
document.write('	</li>');
	<?php } ?>
document.write('</ul>');