<!-- 编辑模块id="modalEdit" -->
<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog"/>
  <div class="modal-dialog" role="document" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">编辑模块</h4>
    </div>
    <div class="modal-body">
        <div class="row">
           <div class="profile-user-info pull-left">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 模块标题 </div>
                    <div  class="profile-info-value modalName">
                        
                    </div>
                </div>
                <div class="space-10"></div>
                <div class="profile-info-row">
                    <div class="profile-info-name">添加图片</div>
                    <div class="profile-info-value pull-left">
                        <p><span class ="red">(图片小于200kb)</span></p>
                        <form name="image_upload" class="image_upload" method="POST" enctype="multipart/form-data" action="/mobile/index.html">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="background:#438eb9; color:#fff;">
                                        <th style="width:80px;">序号</th>
                                        <th style="min-width:100px;max-width: 150px;">Img</th>
                                        <th style="width:100px;">skuId</th>
                                    </tr>
                                </thead>
                                <tbody class="image_content">
                                    
                                </tbody>
                            </table>
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
        <button id="save_modal_edit" type="button" class="btn btn-primary">
            <i class="fa fa-check" aria-hidden="true"></i>  
            保存
        </button>
      </div>
    </div>
  </div>
</div>