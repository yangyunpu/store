document.write('<div class="sidebar">');
document.write('	<div class="rtbar">');
document.write('		<div class="rtbar-tab rtbar-avatar">');
document.write('			<div class="rtbar-icon">');
document.write('				<img alt="<?= $m_nickname ?>" src="<?= (empty($avatar) ? ('/public/v3.0.1/img/s.gif') : ($avatar)) ?>" class="avatar-female" style="width: 26px;position: relative;left:-2px;">');
document.write('			</div>');
document.write('			<div class="rtbar-mbrcenter">');
				<?php if ($m_id > 0) { ?>
document.write('				<div class="rtbar-mbrcenter-info" >');
document.write('					<div class="rtbar-mbrcenter-info-hd left">');
document.write('						<img alt="<?= $m_nickname ?>" src="<?= (empty($avatar) ? ('/public/v3.0.1/img/icon/avatar-male.png') : ($avatar)) ?>" class="mui-mbarp-prof-icon">');
<!-- document.write('						<img alt="<?= $m_nickname ?>" src="/public/v3.0.1/img/icon/avatar-male.png" class="mui-mbarp-prof-icon">'); -->
document.write('						<div class="rtbar-mbrcenter-info-hd-edit">');
document.write('							<a onclick="" href="<?= $url_member ?>/settings/avatar.html" target="_blank">编辑</a>');
document.write('						</div>');
document.write('					</div>');
document.write('					<div class="rtbar-mbrcenter-info-bd left">');
document.write('						<p class="name"><?= $m_nickname ?> <small>个人</small></p>');
document.write('						<p> 星币数量 <span class="red"> <?= $asset['coin'] ?></span></p>');
document.write('						<!--p><i class="fa icon-coupon"></i> 优惠券数 <span class="blue"><?= $asset['coin'] ?></span></p-->');
document.write('						<p> 钱包余额 <span class="price">&yen; <?= $asset['money'] ?></span></p>');
document.write('					</div>');
document.write('				</div>');
				<?php } ?>
				<!--	 未登录头像			-->
document.write('				<div class="mui-mbarp-prof-bd" style="display: inline-block; margin: 30px;">');
document.write('					<div class="mui-mbarp-prof-icon-bd" style="display: inline-block;" >');
document.write('						<img class="mui-mbarp-prof-icon" src="<?= (empty($avatar) ? ('/public/v3.0.1/img/icon/avatar-male.png') : ($avatar)) ?>" style="width: 58px;height: 58px; border-radius: 50%;display:inline-block; " alt="头像">');
document.write('						<div class="mui-mbarp-prof-icon-edit-mask" style="display: none;"></div>');
document.write('						<div class="mui-mbarp-prof-icon-edit" style="display: none;">');
document.write('							<a target="_blank" href="#" onclick="_czc.push([\'_trackEvent\',\'我\',\'编辑\',\'已登录\',\'10481210\'])">编辑</a>');
document.write('						</div>');
document.write('						<span class="mui-mbarp-prof-icon-level" style="display: none;"> 个人 </span>');
document.write('					</div>');
document.write('					<div class="mui-mbarp-prof-lv-bd" style="display: inline-block !important;">');
document.write('						<div class="mui-mbarp-prof-lv-tl " style="display: inline-block !important;">');
document.write('							<span class="nofonts" style="color: #000 !important;">Hi,</span><a target="_blank" href="<?= $url_member ?>/login.html?return_url=" class="nologin">请登录</a>');
document.write('										</div>');
document.write('										<a target="_blank" href="<?= $url_member ?>" class="member_title" style="display: none;">');
document.write('											您是 <span class="mui-mbarp-prof-lv-num"> 个人 </span> 会员</a>');
document.write('									</div>');
document.write('									<div class="mui-mbarp-prof-sep"></div>');
document.write('								</div>');
							<!--	未登录头像end			-->
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');

document.write('		<div class="rtbar-tab rtbar-mycart">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_orders ?>" target="_blank"><i class="fa fa-shopping-cart fa-lg fa-spin"></i></a>');
document.write('			</div>');
document.write('			<a href="<?= $url_orders ?>" target="_blank">');
document.write('				<div class="rtbar-hint">');
document.write('					<div class="rtbar-tips">我的购物</div>');
document.write('					<div class="rtbar-arrow">◆</div>');
document.write('				</div>');
document.write('				<div class="rtbar-title">购物车</div>');
document.write('				<div id="amount" class="rtbar-amount"><?= (empty($cartnum) ? (0) : ($cartnum)) ?></div>');
document.write('			</a>');
document.write('		</div>');

document.write('		<div class="rtbar-tab rtbar-asset">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_member ?>/assets/wallet/index.html"><i class="fa fa-money fa-lg"></i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">我的资产</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');

document.write('		<div class="rtbar-tab rtbar-focus-goods">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_member ?>/focus/goods/index.html"><i class="fa fa-heart-o fa-lg"></i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">关注的商品</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');

document.write('		<div class="rtbar-tab rtbar-focus-shop">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_member ?>/focus/store/index.html"><i class="fa fa-star-o fa-lg" style="font-size:18px;"></i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">关注的店铺</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');

document.write('		<div class="rtbar-tab rtbar-history">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_member ?>/focus/history/index.html"><i class="fa fa-eye fa-lg"></i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">历史记录</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');

/*document.write('		<div class="rtbar-tab rtbar-suggestion">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="<?= $url_member ?>/feedback/index.html"><i class="fa fa-edit fa-lg"> </i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">我的意见</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');*/

document.write('		<div class="rtbar-tab rtbar-suggestion">');
document.write('			<div class="rtbar-icon hkl_user">');
document.write('				<a><i class="fa fa-user fa-lg" style="font-size:18px;"> </i></a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">客服</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');
document.write('		<script type="text/javascript" src="https://cs.ecqun.com/?id=1623872" charset="utf-8"></script>');
document.write('		<div class="rtbar-tab rtbar-rocket">');
document.write('			<div class="rtbar-icon">');
document.write('				<a href="#header"> <i class="fa fa-eject fa-lg"></i> </a>');
document.write('			</div>');
document.write('			<div class="rtbar-hint">');
document.write('				<div class="rtbar-tips">返回顶部</div>');
document.write('				<div class="rtbar-arrow">◆</div>');
document.write('			</div>');
document.write('		</div>');
document.write('	</div>');
document.write('</div>');