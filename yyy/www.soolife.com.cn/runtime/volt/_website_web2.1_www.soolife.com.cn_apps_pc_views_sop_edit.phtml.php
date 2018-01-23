<?php
	$css = $this->assets->get('header');
	$css -> addCss("public/css/p/view.shopapply.css");
	$css -> addCss("public/css/ace.min.css");

	$js  = $this->assets->get('footer');
    $js -> addJs("public/js/p/jedate/jedate.js");
	$js -> addJs("public/js/jquery.validate.min.js");
	$js -> addJs("public/js/ace.min.js");
	$js -> addJs("public/js/ace-elements.min.js");
    $js -> addJs("public/js/p/shopapply.js");
    $js -> addJs("public/js/p/view.data.edit.js");
?>
<script type="text/javascript">
	var region = <?= $region ?>;
</script>
<input type="hidden" name="edit" value="1">
<input type="hidden" name="apply_id" value="<?= $result['apply_id'] ?>">
<input type="hidden" name="signed" value="<?= $result['signed'] ?>">
<div class="lj_wrap">
	<div class="banner"><img src="/public/img/sop/banner.jpg"></div>
	<div class="process">
		<div class="model">
			<div class="enter">入驻流程</div>
			<div class="enters">Process of settlement</div>
			<div class="undeline"></div>
		</div>
		<ul class="icon">
			<li class="first_step">
				<img src="/public/img/sop/select.png">
				<p class="gulp">第一步</p>
				<p class="gulps">选择套餐</p>
			</li>
			<li class="second_step">
				<img src="/public/img/sop/fillin.png">
				<p class="gulp">第二步</p>
				<p class="gulps">填写资料</p>
			</li>
			<li class="third_step">
				<img src="/public/img/sop/takephone.png">
				<p class="gulp">第三步</p>
				<p class="gulps">上传图片</p>
			</li>
			<li class="fourth_step">
				<img src="/public/img/sop/bargain.png">
				<p class="gulp">第四步</p>
				<p class="gulps">合同签约</p>
			</li>
		</ul>
	</div>
	<form id="form_all_data" method="post" enctype="multipart/form-data">
		<!-- 选择套餐 -->
		<div class="lj_emboitement">
			<div class="model">
				<div class="enter">套餐组成</div>
				<div class="enters">Composition of package</div>
				<div class="undeline"></div>
			</div>
			<ul class="combo">
				<li>
					<img src="/public/img/sop/money.png">
					<p class="serve">保证金</p>
					<p class="serves">10000元</p>
				</li>
				<li class="online">
					<img src="/public/img/sop/fill.png">
					<p class="serve">线上服务</p>
					<p class="serves">必选</p>
				</li>
				<li class="offline">
					<img src="/public/img/sop/offhelp.png">
					<p class="serve">线下服务</p>
					<p class="serves">可选</p>
				</li>
			</ul>
			<div class="lj_onlines">
				<div class="model">
					<div class="enter">线上服务(必选)</div>
					<div class="enters">Online service (required)</div>
					<div class="undeline"></div>
				</div>
				<br><br>
				<div class="row">
					<table align="center" class="table table-bordered" style="width: 800px; margin:0 auto;">
						<tr class="lj_head" align="center" >
							<td style="line-height: 42px;">线上服务</td>
							<td style="line-height: 42px;">服务费</td>
							<td style="line-height: 42px;">线上销售</td>
							<td style="line-height: 42px;">仓储服务</td>
							<td style="line-height: 42px;">代运营服务</td>
							<td style="line-height: 42px;">赠送星币</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								<?php if ($result['servicecontent']['online_type'] == 1) { ?>
								<img class="choose" src="/public/img/sop/Group19.png" value="1">&nbsp;选择一
								<?php } else { ?>
								<img class="choose" src="/public/img/sop/Group21.png" value="1">&nbsp;选择一
								<?php } ?>
							</td>
							<td value='10000'>1W</td>
							<td>有</td>
							<td>无</td>
							<td>无</td>
							<td value='10000'>1W</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								<?php if ($result['servicecontent']['online_type'] == 2) { ?>
								<img class="choose" src="/public/img/sop/Group19.png" value="2">&nbsp;选择二
								<?php } else { ?>
								<img class="choose" src="/public/img/sop/Group21.png" value="2">&nbsp;选择二
								<?php } ?>
							</td>
							<td value='30000'>3W</td>
							<td>有</td>
							<td>有</td>
							<td>无</td>
							<td value='30000'>3W</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								<?php if ($result['servicecontent']['online_type'] == 3) { ?>
								<img class="choose" src="/public/img/sop/Group19.png" value="3">&nbsp;选择三
								<?php } else { ?>
								<img class="choose" src="/public/img/sop/Group21.png" value="3">&nbsp;选择三
								<?php } ?>
							</td>
							<td value='50000'>5W</td>
							<td>有</td>
							<td>有</td>
							<td>有</td>
							<td value='50000'>5W</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="model">
					<div class="enter">线下服务(可选)</div>
					<div class="enters">Offline service (optional)</div>
					<div class="undeline"></div>
			</div>
			<div class="serviceitem">
				<?php if ($result['servicecontent']['offline_item']) { ?>
				<?php foreach ($result['servicecontent']['offline_item'] as $d) { ?>
				<?php if ($d['store_id'] == 1) { ?>
				<ul >
					<li>
						<?php if ($d['store_id'] == 1 && $d['type'] != '') { ?>
						<img class="choice" src="/public/img/sop/Group20.png" value="1">&nbsp;上海松江万达店
						<?php } else { ?>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="1">&nbsp;上海松江万达店
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 1 && $d['type'] == 1) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;" value="<?= $d['num'] ?>">
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 1 && $d['type'] == 2) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="2">&nbsp;专柜
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 1 && $d['type'] == 3) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="3">&nbsp;专区
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
						<?php } ?>
					</li>
				</ul>
				<?php } elseif ($d['store_id'] == 2) { ?>
				<ul >
					<li>
						<?php if ($d['store_id'] == 2 && $d['type'] != '') { ?>
						<img class="choice" src="/public/img/sop/Group20.png" value="2">&nbsp;上海嘉定宝龙店
						<?php } else { ?>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="2">&nbsp;上海嘉定宝龙店
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 2 && $d['type'] == 1) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;" value="<?= $d['num'] ?>">
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 2 && $d['type'] == 2) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="2">&nbsp;专柜
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 2 && $d['type'] == 3) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="3">&nbsp;专区
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
						<?php } ?>
					</li>
				</ul>
				<?php } elseif ($d['store_id'] == 3) { ?>
				<ul >
					<li>
						<?php if ($d['store_id'] == 3 && $d['type'] != '') { ?>
						<img class="choice" src="/public/img/sop/Group20.png" value="3">&nbsp;苏州国发店
						<?php } else { ?>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="3">&nbsp;苏州国发店
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 3 && $d['type'] == 1) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;" value="<?= $d['num'] ?>">
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 3 && $d['type'] == 2) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="2">&nbsp;专柜
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 3 && $d['type'] == 3) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="3">&nbsp;专区
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
						<?php } ?>
					</li>
				</ul>
				<?php } elseif ($d['store_id'] == 4) { ?>
				<ul >
					<li>
						<?php if ($d['store_id'] == 4 && $d['type'] != '') { ?>
						<img class="choice" src="/public/img/sop/Group20.png" value="4">&nbsp;镇江宝龙店
						<?php } else { ?>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="4">&nbsp;镇江宝龙店
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 4 && $d['type'] == 1) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;" value="<?= $d['num'] ?>">
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 4 && $d['type'] == 2) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="2">&nbsp;专柜
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 4 && $d['type'] == 3) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="3">&nbsp;专区
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
						<?php } ?>
					</li>
				</ul>
				<?php } elseif ($d['store_id'] == 5) { ?>
				<ul >
					<li>
						<?php if ($d['store_id'] == 5 && $d['type'] != '') { ?>
						<img class="choice" src="/public/img/sop/Group20.png" value="5">&nbsp;厦门集美万达店
						<?php } else { ?>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="5">&nbsp;厦门集美万达店
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 5 && $d['type'] == 1) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;" value="<?= $d['num'] ?>">
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 5 && $d['type'] == 2) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="2">&nbsp;专柜
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
						<?php } ?>
					</li>
					<li>
						<?php if ($d['store_id'] == 5 && $d['type'] == 3) { ?>
						<img class="chooses" src="/public/img/sop/Group19.png" value="3">&nbsp;专区
						<?php } else { ?>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
						<?php } ?>
					</li>
				</ul>
				<?php } ?>
				<?php } ?>
				<?php } else { ?>
				<ul >
					<li>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="1">&nbsp;上海松江万达店
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
					</li>
				</ul>
				<ul >
					<li>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="2">&nbsp;上海嘉定宝龙店
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
					</li>
				</ul>
				<ul >
					<li>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="3">&nbsp;苏州国发店
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
					</li>
				</ul>
				<ul >
					<li>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="4">&nbsp;镇江宝龙店
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
					</li>
				</ul>
				<ul >
					<li>
						<img class="choice" src="/public/img/sop/Rectangle5Copy.png" value="5">&nbsp;厦门集美万达店
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="1">SKU <input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" type="text" name="" placeholder="请输入数量" style="display:none;width: 76px;height: 24px; font-size: 12px;border-radius: 4px;border:1px solid #999;">
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="2">&nbsp;专柜
					</li>
					<li>
						<img class="chooses" src="/public/img/sop/Group21.png" value="3">&nbsp;专区
					</li>
				</ul>
				<?php } ?>
				<br><br>
				<div class="row">
					<table align="center" class="table table-bordered" style="width: 800px; margin:0 auto;">
						<tr class="lj_head" align="center" >
							<td style="line-height: 42px;">线上服务</td>
							<td style="line-height: 42px;">服务费</td>
							<td style="line-height: 42px;">线上销售</td>
							<td style="line-height: 42px;">仓储服务</td>
							<td style="line-height: 42px;">代运营服务</td>
							<td style="line-height: 42px;">赠送星币</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								SKU(建议30个sku以下)
							</td>
							<td>1k/sku</td>
							<td>有</td>
							<td>无</td>
							<td>无</td>
							<td>1k/sku</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								专柜(建议30个sku以上)
							</td>
							<td>3W</td>
							<td>有</td>
							<td>有</td>
							<td>无</td>
							<td>3W</td>
						</tr>
						<tr align="center">
							<td class="lj_radio">
								专区(建议30个sku以上)
							</td>
							<td>10W</td>
							<td>有</td>
							<td>有</td>
							<td>有</td>
							<td>10W</td>
						</tr>
					</table>
				</div>
				<br><br>
			</div>
			<!-- <div class="protocol">
				<img class="choo" src="/public/img/sop/Group21.png">&nbsp;<a href="/sop/protocols.html" target="_blank">同意协议，点击查看电子协议文档</a>
			</div> -->
		</div>
		<!-- 填写资料 -->
		<div class="lj_datum" id="basic_information" style="display: block !important;">
			<div class="model">
				<div class="enter">公司基本信息</div>
				<div class="enters">Basic information</div>
				<div class="undeline"></div>
			</div>
			<div class="message">
				<div>
					<span>公司名称</span>
					<input type="text" value="<?= $result['company_name'] ?>" name="company_name" placeholder="请输入公司名称">
				</div>
				<div>
					<span>公司所在地</span>
	                <div class="" id='area'>
	                    <select id="province" name="province" class="province" style="margin-bottom: 20px;"></select>
	                    <select id="city" name="city" class="city" style="margin-bottom: 20px;"></select>
	                    <select id="county" name="county" class="county" style="margin-bottom: 20px;"></select>
	                </div>
				</div>
				<div>
					<span>公司详情地址</span>
					<input type="text" value="<?= $result['address'] ?>" name="address" placeholder="请输入详细地址">
				</div>
				<div>
					<span>公司行业</span>
					<input type="text" value="<?= $result['industry'] ?>" name="industry" placeholder="请输入公司所属行业">
				</div>
				<div>
					<span>经营范围</span>
					<input type="text" value="<?= $result['scope'] ?>" name="scope" placeholder="请输入公司经营范围">
				</div>
				<div>
					<span>注册资本</span>
					<input type="text" value="<?= $result['capital'] ?>" name="capital" placeholder="请输入公司注册资本">W元
				</div>
				<div>
					<span>公司法人</span>
					<input type="text" value="<?= $result['corporation'] ?>" name="corporation" placeholder="请输入公司法人姓名">
				</div>
				<div>
					<span>法人身份证</span>
					<input type="text" value="<?= $result['identitycard'] ?>" name="identitycard" placeholder="请输入法人身份证号">
				</div>
				<div>
					<span>营业执照号</span>
					<input type="text" value="<?= $result['business_card'] ?>" name="business_card" placeholder="请输入公司营业执照号">
				</div>
				<div>
					<span>成立日期</span>
					<input id="dateinfo" class="establish" name="establish" type="text" value="<?= $result['establish'] ?>" placeholder="请选择公司成立日期"  readonly>
				</div>
				<div>
					<span>营业期限</span>
					<input type="text" value="<?= $result['begin_date'] ?>" name="begin_date" id="dateinfos" class="lj_start" placeholder="请选择营业开始日期" readonly>
					<input type="text" value="<?= $result['end_date'] ?>" name="end_date" id="dateinfoer" class="lj_end" placeholder="请输入营业结束日期" readonly>
				</div>
				<div>
					<span>公司电话</span>
					<input type="text" value="<?= $result['company_tel'] ?>" name="company_tel" placeholder="请输入公司联系电话">
				</div>
				<div>
					<span>公司备注</span>
					<input type="text" value="<?= $result['company_remark'] ?>" name="company_remark">
				</div>
			</div>
			<div class="model">
				<div class="enter">联系人信息</div>
				<div class="enters">Contacter’s information</div>
				<div class="undeline"></div>
			</div>
			<div class="message">
				<div>
					<span>联系人</span>
					<input type="text" value="<?= $result['linkman'] ?>" name="linkman" placeholder="请输入联系人姓名">
				</div>
				<div>
					<span>联系人电话</span>
					<input type="text" value="<?= $result['phone'] ?>" name="phone" placeholder="请输入联系人电话号码">
				</div>
				<div>
					<span>联系人邮箱</span>
					<input type="text" value="<?= $result['email'] ?>" name="email" placeholder="请输入联系人邮箱地址">
				</div>
				<div>
					<span>联系人职务</span>
					<input type="text" value="<?= $result['duty'] ?>" name="duty" placeholder="请输入联系人职务">
				</div>
				<div>
					<span>联系人传真</span>
					<input type="text" value="<?= $result['facsimile'] ?>" name="facsimile" placeholder="请输入联系人传真号码">
				</div>
				<div>
					<span>紧急联系人</span>
					<input type="text" value="<?= $result['urgency_linkman'] ?>" name="urgency_linkman" placeholder="请输入紧急联系人姓名">
				</div>
				<div>
					<span>紧急联系人电话</span>
					<input type="text" value="<?= $result['urgency_phone'] ?>" name="urgency_phone" placeholder="请输入联系人姓名电话">
				</div>
			</div>
		</div>
		<!-- 上传资料 -->
		<div class="uploading" style="display: block !important;overflow: auto;">
			<div class="model">
				<div class="enter">上传图片</div>
				<div class="enters">Upload pictures</div>
				<div class="undeline"></div>
			</div>
			<div class="grule">以下所需要上传电子版资质仅支持JPG、GIF、PNG格式的图片，大小不超过150k，且必须加盖企业公章;</div>
			<div class="take_phone col-sm-12">
				<from class="form-horizontal dropzone dz-clickable" id="form_add" method="post" onsubmit="return false;">
					 <div class="space-30"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传营业执照</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="businesslicence"/>
		                    </label>
		                    <?php if ($result['businesslicence_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['businesslicence_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传税务登记证（或三证合一营业执照）</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="papertax"/>
		                    </label>
		                    <?php if ($result['papertax_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['papertax_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传组织机构代码证（或三证合一营业执照）</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="organizeid"/>
		                    </label>
		                    <?php if ($result['organizeid_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['organizeid_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传开户银行许可证</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="paperbank"/>
		                    </label>
		                    <?php if ($result['paperbank_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['paperbank_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传相关纳税人资格证明</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="generaltax"/>
		                    </label>
		                    <?php if ($result['generaltax_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['generaltax_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传法人身份证</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="agentid"/>
		                    </label>
		                    <?php if ($result['agentid_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['agentid_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传商标注册证</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="papertrademark"/>
		                    </label>
		                    <?php if ($result['papertrademark_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['papertrademark_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传品牌销售授权证明</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="paperbrandsales"/>
		                    </label>
		                    <?php if ($result['paperbrandsales_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['paperbrandsales_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
		            <div class="space-10"></div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label no-padding-right">请上传质检报告或产品质量合格证明</label>
		                <div class="col-sm-8">
		                    <label class="ace-file-input ace-file-multiple col-sm-6">
		                        <input type="file" class="scertified_image" name="paperquality"/>
		                    </label>
		                    <?php if ($result['paperquality_md5']) { ?>
		                    <div id="up_photo"><img src="<?= $result['paperquality_md5'] ?>"></div>
		                    <?php } ?>
		                </div>
		            </div>
					<div class="hr"></div>
				</from>
			</div>
		</div>
		<!-- 合同签约 -->
		<div class="bargain" style="display: block !important;">
			<div class="model">
				<div class="enter">已选套餐</div>
				<div class="enters">Selected package</div>
				<div class="undeline"></div>
			</div>
			<br>
			<div class="row">
				<table align="center" class="table table-bordered" style="width: 800px; margin:0 auto;">
					<tr class="lj_head" align="center" >
						<td style="line-height: 42px;">套餐服务</td>
						<td style="line-height: 42px; width: 300px;">金额</td>
						<td style="line-height: 42px;">赠送星币数</td>
					</tr>
					<tr align="center">
						<td class="lj_radio">
							保证金
						</td>
						<td>1W</td>
						<td>/</td>
					</tr>
					<tr align="center">
						<td class="lj_radio">
							线上服务
						</td>
						<td><span class="last_online_money"><?= $result['servicecontent']['service_cost']['online_money'] / 10000 ?></span>W</td>
						<td><span class="last_online_coin"><?= $result['servicecontent']['service_cost']['online_coin'] / 10000 ?></span>W枚</td>
					</tr>
					<tr align="center">
						<td class="lj_radio">
							线下服务
						</td>
						<td><span class="last_offline_money"><?= $result['servicecontent']['service_cost']['offline_money'] / 10000 ?></span>W</td>
						<td><span class="last_offline_coin"><?= $result['servicecontent']['service_cost']['offline_coin'] / 10000 ?></span>W枚</td>
					</tr>
					<tr align="center">
						<td class="lj_radio">
							总计
						</td>
						<td><span class="last_total_money"><?= $result['servicecontent']['service_cost']['total_money'] / 10000 ?></span>W</td>
						<td><span class="last_total_coin"><?= $result['servicecontent']['service_cost']['total_coin'] / 10000 ?></span>W枚</td>
					</tr>
				</table>
			</div>
			<br>
			<div class="bargain_way">
				<div class="model">
					<div class="enter">选择签约方式</div>
					<div class="enters">Choose contract mode</div>
					<div class="undeline"></div>
				</div>
				<div class="lane">线上签约</div>
				<div class="details"><a href="/sop/protocols.html" target="_blank">点击查看协议详情，勾选同意后视为签约成功</a></div>
				<?php if ($result['signed'] == 1) { ?>
				<div class="lj_gree" style="color: #EC6D65"><img class="on_grees" src="/public/img/sop/Group19.png">&nbsp;&nbsp;同意</div>
				<?php } else { ?>
				<div class="lj_gree"><img class="on_grees" src="/public/img/sop/Group21.png">&nbsp;&nbsp;同意</div>
				<?php } ?>
				<div class="lane">线下签约</div>、
				<div class="details"> 如有疑问，请拨打客服电话，将有专人为您服务。客服电话：400-6699-878</div>
				<?php if ($result['signed'] == 0) { ?>
				<div class="lj_grees" style="color: #EC6D65"><img class="off_grees" src="/public/img/sop/Group19.png">&nbsp;&nbsp;同意</div>
				<?php } else { ?>
				<div class="lj_grees"><img class="off_grees" src="/public/img/sop/Group21.png">&nbsp;&nbsp;同意</div>
				<?php } ?>
			</div>
			<div class="lj_sub" style="display: block;">提交审核</div>
		</div>
	</form>
</div>