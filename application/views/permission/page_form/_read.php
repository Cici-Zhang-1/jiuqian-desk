<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2016年1月20日
 * @author Administrator
 * @version
 * @des
 */
?>
    <div class="page-line" id="pageForm">
        <div class="my-tools col-md-12">
            <div class="col-md-3">
                <div class="hide input-group" data-toggle="search" data-target="#pageFormTable">
		      		<input type="text" class="form-control" name="keyword" placeholder="搜索">
		      		<span class="input-group-btn">
		        		<button class="btn btn-default" id="pageFormSearchBtn" type="button">Go!</button>
		      		</span>
		    	</div>
			</div>
	  		<div class="col-md-offset-3 col-md-6 text-right" id="pageFormFunction">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						共选中<span id="pageFormTableSelected" data-num="">0</span>项
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" data-table="#pageFormTable">
						<li><a id="pageFormEdit" href="javascript:void(0);" data-toggle="modal" data-target="#pageFormModal" data-action="<?php echo site_url('permission/page_form/edit');?>" data-multiple=false><i class="fa fa-pencil"></i>&nbsp;&nbsp;编辑</a></li>
					</ul>
				</div>
				<button class="btn btn-primary" type="button" value="新增" data-toggle="modal" data-target="#pageFormModal" data-action="<?php echo site_url('permission/page_form/add');?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;新增</button>
				<button class="btn btn-default" data-toggle="refresh" type="button" value="刷新"><i class="fa fa-refresh"></i>&nbsp;&nbsp;刷新</button>
				<a class="btn btn-default" data-toggle="backstage" data-target="#pageFormTable" href="<?php echo site_url('permission/page_form/remove');?>" data-multiple=true><i class="fa fa-trash-o"></i>&nbsp;&nbsp;删除</a>
				<button class="btn btn-default" data-toggle="reply" type="button" value="返回"><i class="fa fa-refresh"></i>&nbsp;&nbsp;返回</button>
	  		</div>
        </div>
		<div class="my-table col-md-12">
			<table class="table table-bordered table-hover table-responsive table-condensed" id="pageFormTable">
				<thead>
					<tr>
						<th class="td-xs" data-name="selected">#</td>
						<th data-name="name">名称</th>
						<th data-name="label">标签</th>
						<th data-name="form_type">类型</th>
						<th data-name="url">Url</th>
                        <th data-name="dv">默认值</th>
                        <th data-name="placeholder">Placeholder</th>
                        <th data-name="classes">样式</th>
                        <th data-name="readonly">只读</th>
                        <th data-name="required">必存</th>
                        <th data-name="multiple">多选</th>
                        <th data-name="max">最大值</th>
                        <th data-name="min">最小值</th>
                        <th data-name="maxlength">最长</th>
                        <th data-name="pattern">模式</th>
                        <th data-name="ide">ID</th>
						<th class="hide" data-name="mid">Menu</th>
					</tr>
				</thead>
				<tbody>
				    <?php
				    if(isset($Error)){
				        echo <<<END
<tr class="no-data"><td colspan="9">$Error</td></tr>  
END;
				    }else{
				        $Tr = '';
				        foreach ($content as $key => $value){
							$Tr .= <<<END
<tr>
	<td><input name="pfid"  type="checkbox" value="$value[pfid]"/></td>
	<td name="name">$value[name]</td>
	<td name="label">$value[label]</td>
	<td name="form_type">$value[form_type]</td>
	<td name="url">$value[url]</td>
	<td name="dv">$value[dv]</td>
	<td name="placeholder">$value[placeholder]</td>
	<td name="classes">$value[classes]</td>
	<td name="readonly">$value[readonly]</td>
	<td name="required">$value[required]</td>
	<td name="multiple">$value[multiple]</td>
	<td name="max">$value[max]</td>
	<td name="min">$value[min]</td>
	<td name="maxlength">$value[maxlength]</td>
	<td name="pattern">$value[pattern]</td>
	<td name="ide">$value[ide]</td>
	<td class="hide" name="mid">$value[mid]</td>
</tr>
END;
				        }
				        echo $Tr;
				    }
				    ?>
				</tbody>
			</table>
		</div>
    </div>
	<div class="modal fade" id="pageFormModal" tabindex="-1" role="dialog" aria-labelledby="pageFormModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" id="pageFormForm" action="" method="post" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="pageFormModalLabel">编辑</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="selected" value="" />
						<input type="hidden" name="mid" value="<?php echo $Id;?>" />
						<div class="form-group">
							<label class="control-label col-md-2">名称:</label>
							<div class="col-md-6">
								<input class="form-control" name="name" type="text" placeholder="名称" value=""/>
							</div>
						</div>
                        <div class="form-group">
                          <label class="control-label col-md-2">Label:</label>
                          <div class="col-md-6">
                            <input class="form-control" name="label" type="text" placeholder="Label" value=""/>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">类型:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="form_type">
                                    <option value="1">TEXT</option>
                                    <option value="2">HIDDEN</option>
                                    <option value="3">COLOR</option>
                                    <option value="4">DATE</option>
                                    <option value="5">DATETIME</option>
                                    <option value="6">DATETIME-LOCAL</option>
                                    <option value="7">EMAIL</option>
                                    <option value="8">FILE</option>
                                    <option value="9">IMAGE</option>
                                    <option value="10">MONTH</option>
                                    <option value="11">NUMBER</option>
                                    <option value="12">PASSWORD</option>
                                    <option value="13">RANGE</option>
                                    <option value="14">SEARCH</option>
                                    <option value="15">TEL</option>
                                    <option value="16">TIME</option>
                                    <option value="17">URL</option>
                                    <option value="18">WEEK</option>
                                    <option value="19">SELECT</option>
                                    <option value="20">RADIO</option>
                                    <option value="21">CHECKBOX</option>
                                    <option value="22">TEXTAREA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Url:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="url" type="text" placeholder="Url" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">默认值:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="dv" type="text" placeholder="默认值" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Placeholder:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="placeholder" type="text" placeholder="Placeholder" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">样式:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="classes" type="text" placeholder="样式" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">只读:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="readonly">
                                    <option value="2">否</option>
                                    <option value="1">是</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">必存:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="required">
                                    <option value="2">否</option>
                                    <option value="1">是</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">多选:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="multiple">
                                    <option value="2">否</option>
                                    <option value="1">是</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">最大值:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="max" type="text" placeholder="最大值" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">最小值:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="min" type="text" placeholder="最小值" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">最长值:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="maxlength" type="text" placeholder="最长值" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">模式:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="pattern" type="text" placeholder="模式" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">ID:</label>
                            <div class="col-md-6">
                                <input class="form-control" name="ide" type="text" placeholder="ID" value=""/>
                            </div>
                        </div>
						<div class="alert alert-danger alert-dismissible fade in serverError" role="alert"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						<button type="submit" class="btn btn-primary" data-save="ajax.modal">保存</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		(function($, window, undefined){
			$('div#pageForm').handle_page();
			$('div#pageFormModal').handle_modal_000();
		})(jQuery);
	</script>
