<!-- ***********************************模态框*********************************** -->

<!-- 轮播多图 -->
<div id="mainIcon-more" class="modal fade" tabindex="-1" role="dialog"/>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">轮播多图</h4>
        </div>
        <div class="modal-body">
            <div class="row">
               <div class="profile-user-info pull-left">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 模块标题 </div>
                        <div class="profile-info-value">
                            轮播多图
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">展示样式 </div>
                        <div class="profile-info-value">
                            <div class="display_style">
                                <img src="/public/icon/productList003.jpg"/>
                                <div class="display_style_checked"></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">添加图片</div>
                        <div class="profile-info-value pull-left">
                            <p><span class ="red">(图片小于200kb)</span> <span class="add_btn btn btn-xs btn-primary">继续添加</span></p>
                            <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr style="background:#438eb9; color:#fff;">
                                            <th style="width:100px;">目标</th>
                                            <th style="width:250px;">商品LOGO</th>
                                            <th style="width:100px;">链接类别</th>
                                            <th>链接地址</th>
                                            <th style="width:80px;">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody class="image_content">
                                        <tr class="image_item">
                                            <td style="vertical-align: middle;">
                                                <input class="sku_id" type="text" name="sku_id[]" placeholder="skuid/其他" style="width:100px;">
                                            </td>
                                            <td style="vertical-align: middle;width:250px;max-width: 250px;">
                                                <input  type="file" class="more_pic" name="more_pic[]" value="" multiple="" >
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <select class="pic_target" name="pic_target[]">
                                                    <option value="0">无</option>
                                                    <option value="1">商品</option>
                                                    <option value="2">店铺</option>
                                                    <option value="3">专题活动页</option>
                                                    <option value="4">其他自定义</option>
                                                </select>
                                            </td>
                                            <td class="target_link" style="vertical-align: middle;">
                                                <input class="pic_link" type="text" value="http://" name="pic_link[]" readonly="readonly" placeholder="http://" style="min-width:350px;">
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;">
                                               <i class="item_del red ace-icon fa fa-trash-o bigger-150"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-sm btn-primary">上传图片</button>

                            </form>  
                        </div>
                        <ul class="display_more_pic">
                            
                        </ul>
                    </div>
               </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"></i>    
                关闭
            </button>
            <button id="save_more_pic" type="button" class="btn btn-primary btn-sm">
                <i class="fa fa-check" aria-hidden="true"></i>  
                保存
            </button>
          </div>
        </div>
  </div>
</div>
<!-- 广告图 -->
<div id="mainIcon-adv" class="modal fade" tabindex="-1" role="dialog"/>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">广告图</h4>
        </div>
        <div class="modal-body">
            <div class="row">
               <div class="profile-user-info pull-left">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 模块标题 </div>
                        <div class="profile-info-value">
                            广告图
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">添加图片</div>
                        <div class="profile-info-value pull-left">
                            <p><span class ="red">(图片小于200kb)</span> <span class="add_btn btn btn-xs btn-primary">继续添加</span></p>
                            <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr style="background:#438eb9; color:#fff;">
                                            <th style="width:100px;">目标</th>
                                            <th style="width:250px;">商品LOGO</th>
                                            <th style="width:100px;">链接类别</th>
                                            <th>链接地址</th>
                                            <th style="width:80px;">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody class="image_content">
                                        <tr class="image_item">
                                            <td style="vertical-align: middle;">
                                                <input class="sku_id" type="text" name="sku_id[]" placeholder="skuid/其他" style="width:100px;">
                                            </td>
                                            <td style="vertical-align: middle;width:250px;max-width: 250px;">
                                                <input  type="file" class="more_pic" name="more_pic[]" value="" multiple="" >
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <select class="pic_target" name="pic_target[]">
                                                    <option value="0">无</option>
                                                    <option value="1">商品</option>
                                                    <option value="2">店铺</option>
                                                    <option value="3">专题活动页</option>
                                                    <option value="4">其他自定义</option>
                                                </select>
                                            </td>
                                            <td class="target_link" style="vertical-align: middle;">
                                                <input class="pic_link" type="text" value="http://" name="pic_link[]" readonly="readonly" placeholder="http://" style="min-width:350px;">
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;">
                                               <i class="item_del red ace-icon fa fa-trash-o bigger-150"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-sm btn-primary">上传图片</button>
                            </form>  
                        </div>
                        <ul class="display_more_pic">
                            
                        </ul>
                        </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>    
                    关闭
                </button>
                <button id="save_adv_pic" type="button" class="btn btn-primary btn-sm" >
                    <i class="fa fa-check" aria-hidden="true"></i>  
                    保存
                </button>
            </div>
        </div>
    </div>
</div>
<!-- 列表多图 -->
<div id="mainIcon-col" class="modal fade" tabindex="-1" role="dialog"/>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">列表多图</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="profile-user-info pull-left">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 模块标题 </div>
                            <div class="profile-info-value">
                                列表多图
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name">展示样式 </div>
                            <div class="profile-info-value">
                                <div class="display_style">
                                    <img src="/public/icon/productList09.jpg"/>
                                    <div class="display_style_checked"></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name">添加图片</div>
                            <div class="profile-info-value pull-left">
                                <p><span class ="red">(图片小于200kb)</span> <span class="add_btn btn btn-xs btn-primary">继续添加</span></p>
                                <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr style="background:#438eb9; color:#fff;">
                                                <th style="width:100px;">目标</th>
                                                <th style="width:250px;">商品LOGO</th>
                                                <th style="width:100px;">链接类别</th>
                                                <th>链接地址</th>
                                                <th style="width:80px;">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody class="image_content">
                                            <tr class="image_item">
                                                <td style="vertical-align: middle;">
                                                    <input class="sku_id" type="text" name="sku_id[]" placeholder="skuid/其他" style="width:100px;">
                                                </td>
                                                <td style="vertical-align: middle;width:250px;max-width: 250px;">
                                                    <input  type="file" class="more_pic" name="more_pic[]" multiple="" >
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <select class="pic_target"  name="pic_target[]">
                                                        <option value="0">无</option>
                                                        <option value="1">商品</option>
                                                        <option value="2">店铺</option>
                                                        <option value="3">专题活动页</option>
                                                        <option value="4">其他自定义</option>
                                                    </select>
                                                </td>
                                                <td class="target_link" style="vertical-align: middle;">
                                                    <input class="pic_link" type="text" name="pic_link[]" value="http://" readonly="readonly" placeholder="http://" style="min-width:350px;">
                                                </td>
                                                <td style="vertical-align: middle;text-align:center;">
                                                   <i class="item_del red ace-icon fa fa-trash-o bigger-150"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-sm btn-primary">上传图片</button>
                                </form>  
                            </div>
                            <ul class="display_more_pic"> 

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>    
                    关闭
                </button>
                <button id="save_list_pic" type="button" class="btn btn-primary">
                    <i class="fa fa-check" aria-hidden="true"></i>  
                    保存
                </button>
            </div>
        </div>
    </div>
</div>
<!-- 产品展示 -->
<div id="mainIcon-pro" class="modal fade" tabindex="-1" role="dialog"/>
  <div class="modal-dialog" role="document" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">产品展示</h4>
    </div>
    <div class="modal-body">
        <div class="row">
           <div class="profile-user-info pull-left">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 模块标题 </div>
                    <div class="profile-info-value">
                        产品展示
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name">展示样式 </div>
                    <div class="profile-info-value">
                        <div class="display_style">
                            <img src="/public/icon/productList1.jpg"/>
                            <div class="display_style_checked"></div>
                        </div>
                    </div>
                </div>
                <div class="space-4"></div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 商品信息 </div>
                    <div class="profile-info-value">
                        <input class="ace" type="radio" value="0" name="goods_info" checked="checked">
                        <span class="lbl">&nbsp;显示</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="ace" type="radio" value="1" name="goods_info">
                        <span class="lbl">&nbsp;隐藏</span>
                    </div>
                </div>
                <div class="space-4"></div>
                <div class="profile-info-row">
                    <div class="profile-info-name">添加图片</div>
                    <div class="profile-info-value pull-left">
                        <p><span class ="red">(图片小于200kb)</span> <span class="add_btn_tr btn btn-xs btn-primary">继续添加</span></p>
                        <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background:#438eb9; color:#fff;">
                                        <th style="width:100px;">目标</th>
                                        <th style="width:100px;">LOGO</th>
                                        <th style="width:150px;">上传图片</th>
                                        <th style="width:380px;">商品信息</th>
                                        <th style="width:80px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody class="image_content">
                                    <tr class="image_item">
                                        <td style="vertical-align: middle;">
                                            <input class="sku_id" type="text" name="sku_id[]" placeholder="skuId" style="width:100px;">
                                        </td>
                                        <td style="vertical-align: middle;max-width:100px; ">
                                            <img class = "goodsimglogo" style="width:100%;" src="">
                                        </td>
                                        <td style="vertical-align: middle;width:150px;">
                                            <input  type="file" class="more_pic" name="more_pic[]" multiple="" >
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <h5>
                                                <span  class="blue">商品名称：</span>
                                                <span class="goodsname"></span>
                                            </h5>
                                            <h5>
                                                <span  class="blue">活动价：</span>
                                                <span class="goodsshopprice"></span>
                                            </h5>
                                            <h5>
                                                <span  class="blue">原价：</span>
                                                <span class="goodsmarketprice"></span>
                                            </h5>
                                        </td>
                                        <td style="vertical-align: middle;text-align:center;">
                                           <i class="item_del red ace-icon fa fa-trash-o bigger-150"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-primary">上传图片</button>
                        </form>  
                    </div>
                    <ul class="display_more_pic">
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="fa fa-times" aria-hidden="true"></i>    
            关闭
        </button>
        <button id="save_pro_pic" type="button" class="btn btn-primary">
            <i class="fa fa-check" aria-hidden="true"></i>  
            保存
        </button>
      </div>
    </div>
  </div>
</div>
<!-- 图文展示 -->
<div id="mainIcon-dis" class="modal fade" tabindex="-1" role="dialog"/>
  <div class="modal-dialog" role="document" style="width:1000px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">图文展示</h4>
        </div>
        <div class="modal-body">
            <div class="row">
               <div class="profile-user-info pull-left">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 模块标题 </div>
                        <div class="profile-info-value">
                            产品展示
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">展示样式 </div>
                        <div class="profile-info-value">
                            <div class="display_style">
                                <img src="/public/icon/richpic09.jpg"/>
                                <div class="display_style_checked"></div>
                            </div>
                            <div class="display_style">
                                <img src="/public/icon/richpic10.jpg"/>
                                <div class=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">添加图片</div>
                        <div class="profile-info-value pull-left">
                            <p><span class ="red">(图片小于200kb)</span> <span class="add_btn_tr btn btn-xs btn-primary">继续添加</span></p>
                            <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr style="background:#438eb9; color:#fff;">
                                            <th style="width:100px;">目标</th>
                                            <th style="width:100px;">LOGO</th>
                                            <th style="width:150px;">上传图片</th>
                                            <th style="width:380px;">商品信息</th>
                                            <th style="width:80px;">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody class="image_content">
                                        <tr class="image_item">
                                            <td style="vertical-align: middle;">
                                                <input class="sku_id" type="text" name="sku_id[]" placeholder="skuid/其他" style="width:100px;">
                                            </td>
                                            <td style="vertical-align: middle;max-width:100px;">
                                                <img class = "goodsimglogo" style="width:100%;" src="">
                                            </td>
                                            <td style="vertical-align: middle;width:150px;">
                                                <input  type="file" class="more_pic" name="more_pic[]" multiple="" >
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <h5>
                                                    <span  class="blue">商品名称：</span>
                                                    <span class="goodsname"></span>
                                                </h5>
                                                <div class="space-4"></div>
                                                <h5>
                                                    <span  class="blue">活动价：</span> 
                                                    <span class="goodsshopprice"></span>
                                                </h5>
                                                <div class="space-4"></div>
                                                <h5>
                                                    <span  class="blue">原价：</span> 
                                                    <span class="goodsmarketprice"></span>
                                                </h5>
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;">
                                               <i class="item_del red ace-icon fa fa-trash-o bigger-150"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-sm btn-primary">上传图片</button>
                            </form>  
                        </div>
                        <ul class="display_more_pic">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"></i>    
                关闭
            </button>
            <button id="save_dis_pic" type="button" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i>  
                保存
            </button>
        </div>
    </div>
  </div>
</div>