<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        
        <title><?= $title ?></title>
        <meta name="keywords" content="<?= $keywords ?>" />
        <meta name="description" content="<?= $description ?>" />
        <meta name="author" content="tony wang" />
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/public/v3.0.1/img/icon/apple-touch-icon-144-precomposed.png">
        
<?php foreach ($dns as $d) { ?>
<link rel="dns-prefetch" href="<?= $d ?>" />
<?php } ?>
        <!-- page css library -->
        <?= $this->assets->outputCss('header') ?>
        
    </head>
    <body>
        <script src="http://www.soolife.cn/assets/header.js"></script>
              <div class="search_bar clearfix">
            <div class="main-container ">
                <div class="logo left">
                    <a class="picture" href="http://www.soolife.cn" target="_blank">如此生活</a>
                </div>
                <div class="control left">
                    <div class="box">
                        <div class="form-panel">
                            <fieldset>
                                <div class="input clearfix">
                                    <div class="s-combobox">
                                        <div>
                                            <input type="text" title="请输入搜索文字" class="s-combobox-input" >
                                        </div>
                                        <label class="s-combobox-placeholder">打印机</label>
                                    </div>
                                    <button>搜索</button>
                                </div>
                            </fieldset>
                        </div>
                        <div class="search-box">
                            <!-- 点击显示的搜索的历史记录 -->
                        </div>
                        
                        <div class="form-tags">
                            <ul>
                                <li><a href="http://www.soolife.cn/search/-*54mb5aW2.html">牛奶</a></li>
                                <li><a href="http://www.soolife.cn/search/-*5qmE5qaE5rK5.html">橄榄油</a></li>
                                <li><a href="http://www.soolife.cn/search/-*5YGl6Lqr5Zmo5p2Q.html">健身器材</a></li>
                                <li><a href="http://www.soolife.cn/search/-*57qi6YWS.html">红酒</a></li>
                                <li><a href="http://www.soolife.cn/search/-*5oqk6IKk5ZOB.html">护肤品</a></li>
                                <li><a href="http://www.soolife.cn/search/-*6LGG6LGG6Z6L.html">豆豆鞋</a></li>
                                <li><a href="http://www.soolife.cn/search/-*6LeR5q2l5py6.html">跑步机</a></li>
                                <li><a href="http://www.soolife.cn/search/-*56m65rCU5YeA5YyW5Zmo.html">空气净化器</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="hotline right">
                    <a class="picture" href="http://help.soolife.cn" target="_blank">客服热线 400-068-5151</a>
                </div>
            </div>
        </div>
        
        <!-- begin 导航栏 -->
        <div class="navbar">
            <div class="nav">
                <div class="category left">
                    <h4>全部商品分类<i class="fa fa-angle-down fa-lg"></i></h4>
                    <div class="category-dropdown">
                        <div class="category-menus " style="display: none;">
                            <ul>
                                <li>
                                    <a href="http://www.soolife.cn/search/A.html">女装、男装、内衣、鞋靴</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/B.html">箱包、皮具、钟表饰品</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/C.html">运动户外</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/D.html">化妆品、个人护理、洗护</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/E.html">家居家纺、家装建材</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/F.html">汽车用品</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/G.html">日用厨具、收纳、宠物</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/H.html">母婴、玩具、童装</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/I.html">食品、饮料、酒类、生鲜</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/J.html">手机、数码、电脑办公</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                                <li>
                                    <a href="http://www.soolife.cn/search/K.html">大家电、小家电、生活电器</a>
                                    <i class="fa fa-angle-right fa-lg"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="category-pannel">
                            <div class="pannel">
                                <div class="content">
                                    <div class="tags-bd">
                                        <h5><a href="http://www.soolife.cn/search/A01.html">女装</a></h5>
                                        <p>
                                            <a href="http://www.soolife.cn/search/A01AA.html">连衣裙</a>
                                            <a href="http://www.soolife.cn/search/A01AB.html">半身裙</a>
                                            <a href="http://www.soolife.cn/search/A01AC.html">女士衬衫</a>
                                            <a href="http://www.soolife.cn/search/A01AD.html">女士T恤</a>
                                            <a href="http://www.soolife.cn/search/A01AE.html">雪纺衫</a>
                                            <a href="http://www.soolife.cn/search/A01AF.html">女士西服</a>
                                            <a href="http://www.soolife.cn/search/A01AG.html">女士套装</a>
                                            <a href="http://www.soolife.cn/search/A01AI.html">打底裤</a>
                                            <a href="http://www.soolife.cn/search/A01AJ.html">女士休闲裤</a>
                                            <a href="http://www.soolife.cn/search/A01AK.html">女士牛仔裤</a>
                                            <a href="http://www.soolife.cn/search/A01AL.html">女士羽绒服</a>
                                            <a href="http://www.soolife.cn/search/A01AM.html">女士大衣</a>
                                            <a href="http://www.soolife.cn/search/A01AO.html">裙装</a>
                                            <a href="http://www.soolife.cn/search/A01AP.html">女士针织/毛衣</a>
                                            <a href="http://www.soolife.cn/search/A01AR.html">女士风衣</a>
                                        </p>
                                    </div>
                                    <div class="tags-bd">
                                        <h5><a href="http://www.soolife.cn/search/A02.html">男装</a></h5>
                                        <p>
                                            <a href="http://www.soolife.cn/search/A02AA.html">男士T恤</a>
                                            <a href="http://www.soolife.cn/search/A02AB.html">男士衬衫</a>
                                            <a href="http://www.soolife.cn/search/A02AC.html">男士休闲裤</a>
                                            <a href="http://www.soolife.cn/search/A02AD.html">男士牛仔裤</a>
                                            <a href="http://www.soolife.cn/search/A02AF.html">男士西服</a>
                                            <a href="http://www.soolife.cn/search/A02AG.html">男士夹克</a>
                                            <a href="http://www.soolife.cn/search/A02AI.html">男士针织/毛衣</a>
                                            <a href="http://www.soolife.cn/search/A02AJ.html">男士卫衣/帽衫</a>
                                            <a href="http://www.soolife.cn/search/A02AL.html">男士套装</a>
                                            <a href="http://www.soolife.cn/search/A02AN.html">男士马甲</a>
                                            <a href="http://www.soolife.cn/search/A02AO.html">男士西裤</a>
                                            <a href="http://www.soolife.cn/search/A02AP.html">男士大衣</a>
                                            <a href="http://www.soolife.cn/search/A02AQ.html">男士棉衣</a>
                                        </p>
                                    </div>
                                    <div class="tags-bd">
                                        <h5><a href="http://www.soolife.cn/search/A03.html">内衣家居服</a></h5>
                                        <p>
                                            <a href="http://www.soolife.cn/search/A03AB.html">睡衣/家居服</a>
                                            <a href="http://www.soolife.cn/search/A03AC.html">文胸</a>
                                            <a href="http://www.soolife.cn/search/A03AD.html">内裤</a>
                                            <a href="http://www.soolife.cn/search/A03AE.html">塑身美体</a>
                                            <a href="http://www.soolife.cn/search/A03AF.html">吊带/背心</a>
                                            <a href="http://www.soolife.cn/search/A03AH.html">男袜/女袜</a>
                                            <a href="http://www.soolife.cn/search/A03AI.html">连体袜/丝袜</a>
                                            <a href="http://www.soolife.cn/search/A03AJ.html">打底裤袜</a>
                                            <a href="http://www.soolife.cn/search/A03AK.html">秋衣秋裤</a>
                                            <a href="http://www.soolife.cn/search/A03AL.html">内衣配件</a>
                                            <a href="http://www.soolife.cn/search/A03AM.html">情趣内衣</a>
                                        </p>
                                    </div>
                                    <div class="tags-bd">
                                        <h5><a href="http://www.soolife.cn/search/A04.html">女鞋</a></h5>
                                        <p>
                                            <a href="http://www.soolife.cn/search/A04AA.html">单鞋</a>
                                            <a href="http://www.soolife.cn/search/A04AB.html">休闲鞋</a>
                                            <a href="http://www.soolife.cn/search/A04AE.html">居家鞋/室内拖鞋</a>
                                            <a href="http://www.soolife.cn/search/A04AF.html">凉鞋</a>
                                        </p>
                                    </div>
                                    <div class="tags-bd">
                                        <h5><a href="http://www.soolife.cn/search/A05.html">男鞋</a></h5>
                                        <p>
                                            <a href="http://www.soolife.cn/search/A05AA.html">商务鞋</a>
                                            <a href="http://www.soolife.cn/search/A05AB.html">休闲鞋</a>
                                            <a href="http://www.soolife.cn/search/A05AE.html">居家鞋/室内拖鞋</a>
                                        </p>
                                    </div>
                                    <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/A06.html">服饰配件</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/A06AA.html">腰带</a>
                                        <a href="http://www.soolife.cn/search/A06AC.html">围巾/丝巾/披肩</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/B01.html">时尚女包</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/B01AA.html">女士单肩包</a>
                                        <a href="http://www.soolife.cn/search/B01AB.html">女士斜挎包</a>
                                        <a href="http://www.soolife.cn/search/B01AC.html">女士双肩包</a>
                                        <a href="http://www.soolife.cn/search/B01AD.html">女士手提包</a>
                                        <a href="http://www.soolife.cn/search/B01AE.html">女士手包</a>
                                        <a href="http://www.soolife.cn/search/B01AF.html">女士钱包/卡包</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/B02.html">精品男包</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/B02AC.html">男士手提包</a>
                                        <a href="http://www.soolife.cn/search/B02AD.html">男士手拿包</a>
                                        <a href="http://www.soolife.cn/search/B02AE.html">男士钱包/卡包</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/B03.html">功能箱包</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/B03AD.html">运动休闲</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/B04.html">钟表眼镜</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/B04AF.html">眼镜</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/B07.html">礼品乐器</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/B07AD.html">创意礼品</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/C04.html">户外装备</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/C04AB.html">帐篷</a>
                                        <a href="http://www.soolife.cn/search/C04AC.html">充气床/防潮垫</a>
                                        <a href="http://www.soolife.cn/search/C04AD.html">睡袋</a>
                                        <a href="http://www.soolife.cn/search/C04AF.html">便携桌椅床</a>
                                        <a href="http://www.soolife.cn/search/C04AG.html">野餐炊具</a>
                                        <a href="http://www.soolife.cn/search/C04AI.html">登山攀岩</a>
                                        <a href="http://www.soolife.cn/search/C04AL.html">户外水具</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/C05.html">体育休闲</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/C05AR.html">其他运动</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/C06.html">骑行装备</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/C06AF.html">电动车</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/C07.html">运动包/户外包/配件</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/C07AD.html">挎包/拎包/休闲包</a>
                                        <a href="http://www.soolife.cn/search/C07AI.html">运动/户外配件</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/C08.html">健身器材</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/C08AA.html">跑步机</a>
                                        <a href="http://www.soolife.cn/search/C08AB.html">健身车</a>
                                        <a href="http://www.soolife.cn/search/C08AD.html">踏步机</a>
                                        <a href="http://www.soolife.cn/search/C08AE.html">仰卧板/健腹板</a>
                                        <a href="http://www.soolife.cn/search/C08AF.html">健腹轮/健腹器</a>
                                        <a href="http://www.soolife.cn/search/C08AH.html">跳绳</a>
                                        <a href="http://www.soolife.cn/search/C08AJ.html">拉力绳/拉力器</a>
                                        <a href="http://www.soolife.cn/search/C08AK.html">中小型健身器材</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D01.html">面部护肤</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D01AA.html">洁面</a>
                                        <a href="http://www.soolife.cn/search/D01AB.html">护肤</a>
                                        <a href="http://www.soolife.cn/search/D01AC.html">面膜</a>
                                        <a href="http://www.soolife.cn/search/D01AD.html">面部护肤工具</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D02.html">身体护肤</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D02AA.html">沐浴</a>
                                        <a href="http://www.soolife.cn/search/D02AB.html">润肤</a>
                                        <a href="http://www.soolife.cn/search/D02AD.html">手足</a>
                                        <a href="http://www.soolife.cn/search/D02AG.html">身体护肤工具</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D03.html">洗发护发</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D03AA.html">洗发</a>
                                        <a href="http://www.soolife.cn/search/D03AB.html">护发</a>
                                        <a href="http://www.soolife.cn/search/D03AC.html">染烫造型</a>
                                        <a href="http://www.soolife.cn/search/D03AD.html">美发工具</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D04.html">口腔护理</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D04AA.html">牙膏/牙粉</a>
                                        <a href="http://www.soolife.cn/search/D04AB.html">牙刷/牙线</a>
                                        <a href="http://www.soolife.cn/search/D04AC.html">漱口水</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D05.html">个人护理</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D05AA.html">卫生巾</a>
                                        <a href="http://www.soolife.cn/search/D05AB.html">卫生护垫</a>
                                        <a href="http://www.soolife.cn/search/D05AC.html">私密护理</a>
                                        <a href="http://www.soolife.cn/search/D05AF.html">其他个人护理</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/D06.html">香水彩妆</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/D06AA.html">香水香氛</a>
                                        <a href="http://www.soolife.cn/search/D06AB.html">精油</a>
                                        <a href="http://www.soolife.cn/search/D06AC.html">面部底妆</a>
                                        <a href="http://www.soolife.cn/search/D06AD.html">眉部</a>
                                        <a href="http://www.soolife.cn/search/D06AE.html">眼部</a>
                                        <a href="http://www.soolife.cn/search/D06AF.html">唇部</a>
                                        <a href="http://www.soolife.cn/search/D06AG.html">美妆工具</a>
                                        <a href="http://www.soolife.cn/search/D06AJ.html">卸妆</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/E01.html">家纺</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/E01AA.html">床品套件</a>
                                        <a href="http://www.soolife.cn/search/E01AB.html">被芯</a>
                                        <a href="http://www.soolife.cn/search/E01AC.html">枕芯</a>
                                        <a href="http://www.soolife.cn/search/E01AD.html">凉席</a>
                                        <a href="http://www.soolife.cn/search/E01AF.html">靠垫/抱枕</a>
                                        <a href="http://www.soolife.cn/search/E01AG.html">床垫/床褥</a>
                                        <a href="http://www.soolife.cn/search/E01AH.html">床单/被罩/床笠</a>
                                        <a href="http://www.soolife.cn/search/E01AJ.html">毯子</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/E02.html">家居软饰</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/E02AG.html">相框装饰字画</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/E03.html">家具</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/E03AH.html">户外庭院家具</a>
                                        <a href="http://www.soolife.cn/search/E03AJ.html">架/箱类家具</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/F01.html">汽车电子</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/F01AG.html">车载空气净化</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/F03.html">汽车内饰</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/F03AE.html">头枕/颈枕</a>
                                        <a href="http://www.soolife.cn/search/F03AK.html">收纳用品</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/F05.html">清洁美容</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/F05AD.html">外部清洁</a>
                                    </p>
                                </div>
                            </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/G01.html">餐厨用具</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/G01AA.html">烹饪锅具</a>
                                        <a href="http://www.soolife.cn/search/G01AB.html">刀具/砧板</a>
                                        <a href="http://www.soolife.cn/search/G01AC.html">水壶/水杯</a>
                                        <a href="http://www.soolife.cn/search/G01AD.html">茶具</a>
                                        <a href="http://www.soolife.cn/search/G01AE.html">餐具</a>
                                        <a href="http://www.soolife.cn/search/G01AF.html">保鲜盒/便当盒</a>
                                        <a href="http://www.soolife.cn/search/G01AG.html">厨房小工具</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/G02.html">清洁用品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/G02AA.html">生活用纸</a>
                                        <a href="http://www.soolife.cn/search/G02AB.html">湿巾纸</a>
                                        <a href="http://www.soolife.cn/search/G02AC.html">衣物洗护</a>
                                        <a href="http://www.soolife.cn/search/G02AD.html">日化清洁</a>
                                        <a href="http://www.soolife.cn/search/G02AE.html">清洁工具</a>
                                        <a href="http://www.soolife.cn/search/G02AG.html">皮具护理</a>
                                        <a href="http://www.soolife.cn/search/G02AH.html">一次性用品</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/G03.html">生活日用</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/G03AA.html">收纳储物</a>
                                        <a href="http://www.soolife.cn/search/G03AB.html">洗晒用品</a>
                                        <a href="http://www.soolife.cn/search/G03AC.html">净化除味</a>
                                        <a href="http://www.soolife.cn/search/G03AE.html">驱蚊驱虫</a>
                                        <a href="http://www.soolife.cn/search/G03AG.html">装饰用品</a>
                                        <a href="http://www.soolife.cn/search/G03AH.html">其他生活日用品</a>
                                        <a href="http://www.soolife.cn/search/G03AI.html">鲜花速递</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H01.html">孕妈专区</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H01AF.html">妈咪外出用品</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H02.html">奶粉</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H02AC.html">一段奶粉</a>
                                        <a href="http://www.soolife.cn/search/H02AD.html">二段奶粉</a>
                                        <a href="http://www.soolife.cn/search/H02AE.html">三段奶粉</a>
                                        <a href="http://www.soolife.cn/search/H02AF.html">四段奶粉</a>
                                        <a href="http://www.soolife.cn/search/H02AG.html">五段奶粉</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H03.html">营养辅食</a></h5><p></p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H04.html">尿裤湿巾</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H04AA.html">纸尿裤 </a>
                                        <a href="http://www.soolife.cn/search/H04AB.html">湿巾 </a>
                                        <a href="http://www.soolife.cn/search/H04AC.html">母婴专用纸</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H05.html">洗护用品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H05AA.html">护肤用品</a>
                                        <a href="http://www.soolife.cn/search/H05AC.html">洗发沐浴</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H06.html">喂养用品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H06AA.html">喂养用品</a>
                                        <a href="http://www.soolife.cn/search/H06AB.html">母乳喂养</a>
                                        <a href="http://www.soolife.cn/search/H06AC.html">日常用品</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H07.html">玩具早教</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H07AC.html">毛绒玩具</a>
                                        <a href="http://www.soolife.cn/search/H07AE.html">DIY手工/绘画</a>
                                        <a href="http://www.soolife.cn/search/H07AG.html">积木拼插</a>
                                        <a href="http://www.soolife.cn/search/H07AH.html">模型玩具</a>
                                        <a href="http://www.soolife.cn/search/H07AJ.html">创意玩具</a>
                                        <a href="http://www.soolife.cn/search/H07AM.html">早教益智</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H08.html">童装童鞋</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H08AB.html">孕婴童服饰</a>
                                        <a href="http://www.soolife.cn/search/H08AC.html">宝宝寝居</a>
                                        <a href="http://www.soolife.cn/search/H08AE.html">童装</a>
                                        <a href="http://www.soolife.cn/search/H08AF.html">童鞋</a>
                                        <a href="http://www.soolife.cn/search/H08AG.html">配饰</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/H09.html">童车童床</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/H09AA.html">婴儿车</a>
                                        <a href="http://www.soolife.cn/search/H09AB.html">婴儿床椅</a>
                                        <a href="http://www.soolife.cn/search/H09AC.html">儿童家居</a>
                                        <a href="http://www.soolife.cn/search/H09AD.html">儿童安全座椅</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I01.html">酒类</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I01AA.html">白酒</a>
                                        <a href="http://www.soolife.cn/search/I01AB.html">葡萄酒/果味酒</a>
                                        <a href="http://www.soolife.cn/search/I01AD.html">养生酒</a>
                                        <a href="http://www.soolife.cn/search/I01AE.html">黄酒/米酒</a>
                                        <a href="http://www.soolife.cn/search/I01AF.html">啤酒</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I02.html">休闲食品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I02AA.html">饼干/糕点</a>
                                        <a href="http://www.soolife.cn/search/I02AB.html">坚果</a>
                                        <a href="http://www.soolife.cn/search/I02AC.html">巧克力</a>
                                        <a href="http://www.soolife.cn/search/I02AD.html">糖果</a>
                                        <a href="http://www.soolife.cn/search/I02AF.html">蜜饯/果脯</a>
                                        <a href="http://www.soolife.cn/search/I02AG.html">果冻/布丁</a>
                                        <a href="http://www.soolife.cn/search/I02AH.html">膨化食品</a>
                                        <a href="http://www.soolife.cn/search/I02AJ.html">卤味小食</a>
                                        <a href="http://www.soolife.cn/search/I02AK.html">海味即食</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I03.html">牛奶乳品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I03AA.html">乳制品</a>
                                        <a href="http://www.soolife.cn/search/I03AB.html">纯牛奶</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I04.html">饮料饮品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I04AA.html">饮用水</a>
                                        <a href="http://www.soolife.cn/search/I04AB.html">果汁/果蔬汁</a>
                                        <a href="http://www.soolife.cn/search/I04AC.html">茶饮料</a>
                                        <a href="http://www.soolife.cn/search/I04AD.html">咖啡饮料</a>
                                        <a href="http://www.soolife.cn/search/I04AE.html">碳酸饮料</a>
                                        <a href="http://www.soolife.cn/search/I04AF.html">功能饮料</a>
                                        <a href="http://www.soolife.cn/search/I04AG.html">含乳饮料</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I05.html">冲调饮品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I05AB.html">麦片/谷物</a>
                                        <a href="http://www.soolife.cn/search/I05AD.html">蜂蜜</a>
                                        <a href="http://www.soolife.cn/search/I05AE.html">果味冲饮</a>
                                        <a href="http://www.soolife.cn/search/I05AI.html">成人奶粉</a>
                                        <a href="http://www.soolife.cn/search/I05AK.html">咖啡</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I06.html">粮油干货</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I06AA.html">食用油</a>
                                        <a href="http://www.soolife.cn/search/I06AB.html">大米</a>
                                        <a href="http://www.soolife.cn/search/I06AD.html">枣类</a>
                                        <a href="http://www.soolife.cn/search/I06AF.html">米面制品</a>
                                        <a href="http://www.soolife.cn/search/I06AI.html">干货</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I07.html">方便速食</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I07AA.html">方便面</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I08.html">营养保健</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I08AA.html">维生素/矿物质</a>
                                        <a href="http://www.soolife.cn/search/I08AB.html">蛋白质/氨基酸</a>
                                        <a href="http://www.soolife.cn/search/I08AC.html">保健饮品</a>
                                        <a href="http://www.soolife.cn/search/I08AD.html">膳食纤维</a>
                                        <a href="http://www.soolife.cn/search/I08AE.html">动物精华/提取物</a>
                                        <a href="http://www.soolife.cn/search/I08AF.html">植物精华/提取物</a>
                                        <a href="http://www.soolife.cn/search/I08AI.html">传统滋补</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I09.html">厨房调料</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I09AA.html">酱油</a>
                                        <a href="http://www.soolife.cn/search/I09AB.html">食醋</a>
                                        <a href="http://www.soolife.cn/search/I09AE.html">调味料</a>
                                        <a href="http://www.soolife.cn/search/I09AH.html">腐乳</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/I10.html">生鲜食品</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/I10AB.html">新鲜蔬菜</a>
                                        <a href="http://www.soolife.cn/search/I10AD.html">蛋类</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J01.html">手机通讯</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J01AC.html">三星</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J02.html">手机配件</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J02AA.html">移动电源</a>
                                        <a href="http://www.soolife.cn/search/J02AC.html">其他配件</a>
                                        <a href="http://www.soolife.cn/search/J02AD.html">手机耳机</a>
                                        <a href="http://www.soolife.cn/search/J02AF.html">手机贴膜</a>
                                        <a href="http://www.soolife.cn/search/J02AG.html">保护壳/套</a>
                                        <a href="http://www.soolife.cn/search/J02AI.html">手机电池</a>
                                        <a href="http://www.soolife.cn/search/J02AJ.html">手机充电器</a>
                                        <a href="http://www.soolife.cn/search/J02AK.html">数据线</a>
                                        <a href="http://www.soolife.cn/search/J02AL.html">便携/蓝牙音箱</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J04.html">影音电子</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J04AA.html">耳机耳麦</a>
                                        <a href="http://www.soolife.cn/search/J04AC.html">数码相框</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J05.html">数码配件</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J05AG.html">摄影包</a>
                                        <a href="http://www.soolife.cn/search/J05AH.html">电池/充电器</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J06.html">电脑整机</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J06AA.html">笔记本</a>
                                        <a href="http://www.soolife.cn/search/J06AB.html">平板电脑</a>
                                        <a href="http://www.soolife.cn/search/J06AE.html">电脑一体机</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J07.html">DIY硬件</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J07AI.html">电源</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J08.html">键鼠</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J08AA.html">鼠标</a>
                                        <a href="http://www.soolife.cn/search/J08AB.html">键盘</a>
                                        <a href="http://www.soolife.cn/search/J08AC.html">键鼠套装</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J09.html">存储设备</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J09AA.html">移动硬盘</a>
                                        <a href="http://www.soolife.cn/search/J09AB.html">U盘</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J10.html">电脑外设</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J10AA.html">电脑音箱</a>
                                        <a href="http://www.soolife.cn/search/J10AB.html">电脑包</a>
                                        <a href="http://www.soolife.cn/search/J10AD.html">电脑清洁</a>
                                        <a href="http://www.soolife.cn/search/J10AE.html">电源/适配器</a>
                                        <a href="http://www.soolife.cn/search/J10AF.html">线材</a>
                                        <a href="http://www.soolife.cn/search/J10AI.html">电脑桌</a>
                                        <a href="http://www.soolife.cn/search/J10AL.html">平板配件</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/J13.html">办公文仪</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/J13AA.html">办公文具</a>
                                        <a href="http://www.soolife.cn/search/J13AB.html">办公用纸</a>
                                        <a href="http://www.soolife.cn/search/J13AC.html">笔类</a>
                                        <a href="http://www.soolife.cn/search/J13AD.html">本册/便签</a>
                                        <a href="http://www.soolife.cn/search/J13AE.html">财务用品</a>
                                        <a href="http://www.soolife.cn/search/J13AF.html">学生文具</a>
                                        <a href="http://www.soolife.cn/search/J13AG.html">文件管理</a>
                                        <a href="http://www.soolife.cn/search/J13AH.html">展示用品</a>
                                        <a href="http://www.soolife.cn/search/J13AM.html">装订/封装机</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="pannel">
                                <div class="content">
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/K01.html">大家电</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/K01AB.html">空调</a>
                                        <a href="http://www.soolife.cn/search/K01AC.html">冰箱/冷柜/酒柜</a>
                                        <a href="http://www.soolife.cn/search/K01AD.html">洗衣机</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/K03.html">生活小家电</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/K03AA.html">电风扇</a>
                                        <a href="http://www.soolife.cn/search/K03AB.html">空气净化器</a>
                                        <a href="http://www.soolife.cn/search/K03AC.html">吸尘器</a>
                                        <a href="http://www.soolife.cn/search/K03AD.html">清洁机</a>
                                        <a href="http://www.soolife.cn/search/K03AE.html">加湿器</a>
                                        <a href="http://www.soolife.cn/search/K03AH.html">挂烫机</a>
                                        <a href="http://www.soolife.cn/search/K03AK.html">取暖电器</a>
                                        <a href="http://www.soolife.cn/search/K03AL.html">其他生活小家电</a>
                                        <a href="http://www.soolife.cn/search/K03AM.html">饮水机</a>
                                        <a href="http://www.soolife.cn/search/K03AN.html">净水器</a>
                                        <a href="http://www.soolife.cn/search/K03AO.html">净水设备</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/K04.html">厨卫电器</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/K04AA.html">油烟机/灶具</a>
                                        <a href="http://www.soolife.cn/search/K04AB.html">消毒柜/洗碗机</a>
                                        <a href="http://www.soolife.cn/search/K04AC.html">嵌入式厨电</a>
                                        <a href="http://www.soolife.cn/search/K04AG.html">热水器</a>
                                        <a href="http://www.soolife.cn/search/K04AM.html">电磁炉</a>
                                        <a href="http://www.soolife.cn/search/K04AO.html">电饭煲</a>
                                        <a href="http://www.soolife.cn/search/K04AQ.html">榨汁机</a>
                                        <a href="http://www.soolife.cn/search/K04AU.html">电水壶</a>
                                        <a href="http://www.soolife.cn/search/K04BB.html">煎烤机</a>
                                        <a href="http://www.soolife.cn/search/K04BE.html">电烤箱</a>
                                        <a href="http://www.soolife.cn/search/K04BH.html">其他厨卫家电</a>
                                    </p>
                                </div>
                                <div class="tags-bd">
                                    <h5><a href="http://www.soolife.cn/search/K05.html">个护健康</a></h5>
                                    <p>
                                        <a href="http://www.soolife.cn/search/K05AF.html">美容器</a>
                                        <a href="http://www.soolife.cn/search/K05AI.html">电子秤</a>
                                        <a href="http://www.soolife.cn/search/K05AK.html">足浴盆</a>
                                        <a href="http://www.soolife.cn/search/K05AN.html">按摩椅</a>
                                        <a href="http://www.soolife.cn/search/K05AO.html">按摩器</a>
                                        <a href="http://www.soolife.cn/search/K05AP.html">其他健康电器</a>
                                    </p>
                                </div>
                                </div>
                                <div class="adverts clearfix">
                                    <!-- 品牌与广告 -->
                                    <div class="clearfix">
                                        <div class="box-120x50 left" style="background-color: red;">1</div>
                                        <div class="box-120x50 left" style="background-color: blue;">2</div>
                                        <div class="box-120x50 left" style="background-color: green;">3</div>
                                        <div class="box-120x50 left" style="background-color: #f6ab00;">4</div>
                                        <div class="box-120x50 left" style="background-color: red;">5</div>
                                        <div class="box-120x50 left" style="background-color: blue;">6</div>
                                    </div>
                                    <div class="hr-20"></div>
                                    <div class="clearfix">
                                        <div class="box-250x120"  style="background-color: blue;"></div>
                                        <div class="box-250x120" style="background-color: red;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lists left">
                    <ul>
                        <li><a href="http://www.soolife.cn/index.html" class="active" target="_blank">首  页</a></li>
                        <li><a href="http://www.soolife.cn/market.html" target="_blank">星超市</a></li>
                        <li><a href="http://www.soolife.cn/mall.html" target="_blank">星商城</a></li>
                        <li><a href="http://www.soolife.cn/clothes.html" target="_blank">服饰鞋包</a></li>
                        <li><a href="http://www.soolife.cn/discount.html" target="_blank">品牌特惠</a></li>
                        <li><a href="http://www.soolife.cn/zone.html" target="_blank">星粉专区</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end 导航栏 -->
    
         
        <?= $this->getContent() ?>
        <!-- <script src="http://www.soolife.cn/assets/footer.js"></script> -->
         



              <!-- 侧边栏 -->
<div class="sidebar">
    <div style="display:none" class="rtbar_cart">
        <div class="tright">
            <i id="removecart" class="fa fa-remove fa-lg"></i>
        </div>
        <div class="toolbar-hd-title">
            购物车
        </div>

        <div class="toolbar-bd">
            <div id="rtbar_cart" class="mini-cart-list tcenter">
                <!--购物车的内容-->
            </div>
        </div>
    </div>
    <div class="rtbar">
        <div class="rtbar-tab-avatar">
            <img alt="头像" src="http://static.soolife.cn/asset/icon/avatar-male.png" class="rtbar-avatar">
            <div class="rtbar-mbrcenter mui-mbarp-prof-tip">
                <div class="mui-mbarp-prof-bd">
                    <div class="mui-mbarp-prof-icon-bd">
                        <img alt="头像" style="width: 58px;height: 58px;" src="http://static.soolife.cn/asset/icon/avatar-male.png" class="mui-mbarp-prof-icon">
                        <div style="display: none;" class="mui-mbarp-prof-icon-edit-mask"></div>
                        <div style="display: none;" class="mui-mbarp-prof-icon-edit">
                            <a onclick="_czc.push(['_trackEvent','我','编辑','已登录','10481210'])" href="#" target="_blank">编辑</a>
                        </div>

                    </div>
                    <div class="mui-mbarp-prof-lv-bd">
                        <div class="mui-mbarp-prof-lv-tl">
                            Hi, <a href="http://www.soolife.cn/login.html" target="_blank">请登录</a>
                        </div>

                    </div>
                    <div class="mui-mbarp-prof-sep"></div>
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
        </div>

        <div class="rtbar-tab rtbar-cart">
            <a href="#">
            <div class="rtbar-img">
                <i class="fa fa-shopping-cart fa-lg"> </i>
            </div> </a>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    我的购物
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
            <div class="title">
                购物车
            </div>
            <div id="amount" class="amount">
                0
            </div>
            <div style="color: #fff;opacity: 1;right: 27px;display:none" class="rtbar-arrow rtbar-arrowbuy">
                ◆
            </div>

            <div class="rtbar-cart-recommend">
                <div class="rtbar-cart-recommend-arr">
                    ◆
                </div>
                <div class="rtbar-cart-recommend-close">
                    <i id="removerecomcart" class="icon-remove icon-large"></i>
                </div>
                <div class="rtbar-cart-recommend-con">
                    <div class="rtbar-cart-recommend-hd">
                        <span class="rtbar-cart-recommend-hd-logo"><i class="icon-ok-circle icon-large"></i></span>
                        <div class="rtbar-cart-recommend-hd-p">
                            <p class="rtbar-cart-recommend-hd-hint">
                                成功加入购物车！
                            </p>
                            <p class="rtbar-cart-recommend-hd-other">
                                您可以<a target="_blank" href="http://www.soolife.cn/cart/index.html">去购物车结算</a>
                            </p>
                        </div>
                    </div>
                    <div class="rtbar-cart-recommend-bd">
                        <p class="rtbar-cart-recommend-bd-p">
                            达人的购物车里都有啥 <a href="#" target="_blank">查看更多</a>
                        </p>
                        <!--购物车里的热销推荐-->
                    </div>
                </div>
            </div>
        </div>

        <div class="rtbar-tab rtbar-asset">
            <a href="http://www.soolife.cn/assets/balance">
            <div class="rtbar-img">
                <i class="fa fa-money fa-lg"></i>
            </div> </a>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    我的资产
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
        </div>
        <div class="rtbar-tab rtbar-favor">
            <a href="http://www.soolife.cn/favorite/goods" data-toggle="tooltip" data-placement="left" title="关注的商品" data-trigger="hover focus">
            <div class="rtbar-img">
                <i class="fa fa-heart-o fa-lg"></i>
            </div></a>
            <div class="rtbar-hint" style="display: none; right: 75px; opacity: 0;">
                <div class="rtbar-tip">
                    关注的商品
                </div>
                <div class="rtbar-arrow" style="opacity: 0; display: none;">
                    ◆
                </div>
            </div>

        </div>
        <div class="rtbar-tab rtbar-collect">
            <a href="http://www.soolife.cn/favorite/store">
            <div class="rtbar-img">
                <i class="fa fa-star-o fa-lg"></i>
            </div>
            </a>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    关注的店铺
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
        </div>
        <div class="rtbar-tab rtbar-foot">
            <a href="http://www.soolife.cn/favorite/history">
                <div class="rtbar-img">
                    <i class="fa fa-eye fa-lg"></i>
                </div> 
            </a>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    历史记录
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
        </div>

        <div class="rtbar-tab rtbar-suggest">
            <a href="http://www.soolife.cn/feedback/guest">
            <div class="rtbar-img">
                <i class="fa fa-edit fa-lg"> </i>
            </div> 
            </a>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    我的意见
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>
        </div>
        <div class="rtbar-tab rtbar-top" style="display: block;">
            <div class="rtbar-img">
                <a href="#header"> <i class="fa fa-eject fa-lg"></i> </a>
            </div>
            <div class="rtbar-hint">
                <div class="rtbar-tip">
                    返回顶部
                </div>
                <div class="rtbar-arrow">
                    ◆
                </div>
            </div>  
        </div>
    </div>
</div>

        <!-- basic js library -->
        <script type="text/javascript" src="/public/ext/jquery-2.2.4.min.js"></script>
        <script type="text/javascript" src="/public/ext/bootstrap/js/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="/public/js/pc_index.js"></script> -->        
     
        <!-- pages js library -->
        <?= $this->assets->outputJs('footer') ?>
    </body>
</html>