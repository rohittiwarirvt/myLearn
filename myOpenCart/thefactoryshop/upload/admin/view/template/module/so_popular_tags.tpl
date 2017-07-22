<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save'); ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $objlang->get('entry_button_save')?></button>
				<a class="btn btn-success" onclick="$('#action').val('save_edit');$('#form-featured').submit();" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save_and_edit'); ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo $objlang->get('entry_button_save_and_edit')?></a>
				<a class="btn btn-info" onclick="$('#action').val('save_new');$('#form-featured').submit();" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_save_and_new'); ?>" ><i class="fa fa-book"></i>  <?php echo $objlang->get('entry_button_save_and_new')?></a>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $objlang->get('entry_button_cancel'); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>  <?php echo $objlang->get('entry_button_cancel')?></a>
			</div>
			<h1><?php echo $objlang->get('heading_title'); ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if (isset($error['warning'])) { ?>
			<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error['warning']; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<?php if (isset($success) && !empty($success)) { ?>
			<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
			<div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_layout; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $subheading; ?></h3>
		</div>
		<div class="panel-body">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
				<!-- Nav tabs -->
                <div class="row">
                  <ul class="nav nav-tabs" role="tablist">
                    <li <?php if( $selectedid ==0 ) { ?>class="active" <?php } ?>> <a href="<?php echo $link; ?>"> <span class="fa fa-plus"></span> <?php echo $objlang->get('button_add_module');?></a></li>
                    <?php $i=1; foreach( $moduletabs as $key => $module ){ ?>
                    <li role="presentation" <?php if( $module['module_id']==$selectedid ) {?>class="active"<?php } ?>>
                      <a href="<?php echo $link; ?>&module_id=<?php echo $module['module_id']?>" aria-controls="bannermodule-<?php echo $key; ?>"  >
                        <span class="fa fa-pencil"></span> <?php echo $module['name']?>
                       </a>
                      </li>
                    <?php $i++ ;} ?>
                  </ul>
                </div>
			
				<div class="row">
					<div class="col-sm-12">
						<?php $module_row = 1; ?>
						<?php foreach ($modules as $module) { ?>
						<?php if( $selectedid ){ ?>
							<div class="pull-right">
								<a href="<?php echo $action;?>&delete=1" class="remove btn btn-danger" ><span><i class="fa fa-remove"></i> <?php echo $objlang->get('entry_button_delete');?></span></a>
							</div>
						<?php } ?>
							<div  id="tab-module<?php echo $module_row; ?>" class="col-sm-12">
								<div class="form-group"> <!--Module Name -->
									<input type="hidden" name="action" id="action" value=""/>
									<input type="hidden" name="moduleid" value="<?php echo $module['last_moduleid']; ?>" />
									<label class="col-sm-3 control-label" for="input-name" ><b style="color:#f00">*</b> <span data-toggle="tooltip" title="<?php echo $objlang->get('entry_name_desc'); ?>"><?php echo $objlang->get('entry_name'); ?></span> </label>
										<div class="col-sm-9">
											<div class="col-sm-5">
												<input type="text" name="name" value="<?php echo $module['name']; ?>" placeholder="<?php echo $objlang->get('entry_name'); ?>" id="input-name" class="form-control" />
											</div>
											<?php if (isset($error['name'])) { ?>
												<div class="text-danger col-sm-12"><?php echo $error['name']; ?></div>
											<?php }?>
										</div>
								</div>
								<div class="form-group"> <!--Header title-->
									<label class="col-sm-3 control-label" for="input-head_name"><b style="color:#f00">*</b> <span data-toggle="tooltip" title="<?php echo $objlang->get('entry_head_name_desc'); ?>"><?php echo $objlang->get('entry_head_name'); ?></span></label>
									
									<div class="col-sm-9">
										<div class="col-sm-5">
											<?php
												$i = 0;
												foreach ($languages as $language) { $i++; ?>
											<input type="text" name="module_description[<?php echo $language['language_id']; ?>][head_name]" placeholder="<?php echo $objlang->get('entry_head_name'); ?>" id="input-head-name-<?php echo $language['language_id']; ?>" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" class="form-control <?php echo ($i>1) ? ' hide ' : ' first-name'; ?>" />
											<?php
													 if($i == 1){ ?>
											<input type="hidden" class="form-control" id="input-head_name" placeholder="<?php echo $objlang->get('entry_head_name'); ?>" value="<?php echo isset($module_description[$language['language_id']]['head_name']) ? $module_description[$language['language_id']]['head_name'] : ''; ?>" name="head_name">
											<?php }
													 ?>
											<?php } ?>
										</div>
										<div class="col-sm-3">
											<select  class="form-control" id="language">
												<?php foreach ($languages as $language) { ?>
												<option value="<?php echo $language['language_id']; ?>" style="background:url('../image/flags/<?php echo $language['image']; ?>');"> <?php echo $language['name']; ?> </option>
												<?php } ?>
											</select>
										</div>
										<?php if (isset($error['head_name'])) { ?>
										<div class="text-danger col-sm-12"><?php echo $error['head_name']; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="form-group"> <!--Display header title -->
									<label class="col-sm-3 control-label" for="input-disp_title_module"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_display_title_module_desc'); ?>"><?php echo $objlang->get('entry_display_title_module'); ?></span></label>
									<div class="col-sm-9">
										<div class="col-sm-5">
											<select name="disp_title_module" id="input-disp_title_module" class="form-control">
												<?php if ($module['disp_title_module']) { ?>
												<option value="1" selected="selected"><?php echo $objlang->get('text_yes'); ?></option>
												<option value="0"><?php echo $objlang->get('text_no'); ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $objlang->get('text_yes'); ?></option>
												<option value="0" selected="selected"><?php echo $objlang->get('text_no'); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group"> <!--Status -->
									<label class="col-sm-3 control-label" for="input-status"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_status_desc'); ?>"><?php echo $objlang->get('entry_status'); ?></span></label>
									<div class="col-sm-9">
										<div class="col-sm-5">
											<select name="status" id="input-status" class="form-control">
												<?php if ($module['status']) { ?>
												<option value="1" selected="selected"><?php echo $objlang->get('text_enabled'); ?></option>
												<option value="0"><?php echo $objlang->get('text_disabled'); ?></option>
												<?php } else { ?>
												<option value="1"><?php echo $objlang->get('text_enabled'); ?></option>
												<option value="0" selected="selected"><?php echo $objlang->get('text_disabled'); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane">
								<ul class="nav nav-tabs" id="so_youtech">
									<li>
										<a href="#so_module_module" data-toggle="tab">
											<?php echo $objlang->get('entry_module') ?>
										</a>
									</li>
								</ul>
								<div class="tab-content">
							<!-- -------------------------------------------------------------- -->
									<div class="tab-pane" id="so_module_module"> <!--General Option -->
										<div class="form-group"> <!--Class suffix -->
											<label class="col-sm-3 control-label" for="input-class_suffix"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_class_suffix_desc'); ?>"><?php echo $objlang->get('entry_class_suffix'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<input type="text" name="class_suffix" value="<?php echo $module['class_suffix']; ?>" id="input-class_suffix" class="form-control" />
												</div>
											</div>
										</div>
										<div class="form-group"> <!--Open link -->
											<label class="col-sm-3 control-label" for="input-open_link"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_open_link_desc'); ?>"><?php echo $objlang->get('entry_open_link'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<select name="item_link_target" id="input-open_link" class="form-control">
														<?php 
															foreach($item_link_targets as $option_id => $option_value)
															{
																$selected = ($option_id == $module['item_link_target']) ? 'selected' :'';
														?>
																<option value="<?php echo $option_id ?>" <?php echo $selected ?> ><?php echo $option_value ?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group"> <!--Limit tags -->
											<label class="col-sm-3 control-label" for="input-limit_tags"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_limit_tags_desc'); ?>"><?php echo $objlang->get('entry_limit_tags'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<input type="text" name="limit_tags" value="<?php echo $module['limit_tags']; ?>" id="input-limit_tags" class="form-control" />
												</div>
												<?php if (isset($error['limit_tags'])) { ?>
													<div class="text-danger col-sm-12"><?php echo $error['limit_tags']; ?></div>
												<?php }?>
											</div>
										</div>								
										<div class="form-group"> <!--Min font-size -->
											<label class="col-sm-3 control-label" for="input-min_font_size"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_min_font_size_desc'); ?>"><?php echo $objlang->get('entry_min_font_size'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<input type="text" name="min_font_size" value="<?php echo $module['min_font_size']; ?>" id="input-min_font_size" class="form-control" />
												</div>
												<?php if (isset($error['min_font_size'])) { ?>
													<div class="text-danger col-sm-12"><?php echo $error['min_font_size']; ?></div>
												<?php }?>
											</div>
										</div>									
										<div class="form-group"> <!--Max font-size -->
											<label class="col-sm-3 control-label" for="input-max_font_size"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_max_font_size_desc'); ?>"><?php echo $objlang->get('entry_max_font_size'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<input type="text" name="max_font_size" value="<?php echo $module['max_font_size']; ?>" id="input-max_font_size" class="form-control" />
												</div>
												<?php if (isset($error['max_font_size'])) { ?>
													<div class="text-danger col-sm-12"><?php echo $error['max_font_size']; ?></div>
												<?php }?>
											</div>
										</div>
										<div class="form-group"> <!--Font-weight -->
											<label class="col-sm-3 control-label" for="input-font_weight"><span data-toggle="tooltip" title="<?php echo $objlang->get('entry_font_weight_desc'); ?>"><?php echo $objlang->get('entry_font_weight'); ?></span></label>
											<div class="col-sm-9">
												<div class="col-sm-5">
													<select name="font_weight" id="input-font_weight" class="form-control">
														<?php 
															foreach($font_weights as $option_id => $option_value)
															{
																$selected = ($option_id == $module['font_weight']) ? 'selected' :'';
														?>
																<option value="<?php echo $option_id ?>" <?php echo $selected ?> ><?php echo $option_value ?></option>
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
							<!-- ------------------------------------------------------------- -->
							
								</div>
							</div>
							
						<?php $module_row++; ?>
						<?php } ?>
					</div>
				</div>
			</form>	
		</div>
    </div>	
  </div>
<script type="text/javascript"><!--
$('#so_youtech a:first').tab('show');


if($("input[name='child_category']:radio:checked").val() == '0')
{
	$('#input-category_depth_form').hide();
}else
{
	$('#input-category_depth_form').show();
}

$("input[name='child_category']").change(function(){
	val = $(this).val();
	if(val ==0)
	{
		$('#input-category_depth_form').hide();
	}else
	{
		$('#input-category_depth_form').show();
	}
});
	$('#language').change(function(){
		var that = $(this), opt_select = $('option:selected', that).val() , _input = $('#input-head-name-'+opt_select);
		$('[id^="input-head-name-"]').addClass('hide');
		_input.removeClass('hide');
	});

	$('.first-name').change(function(){
		$('input[name="head_name"]').val($(this).val());
	});
//--></script>
</div>
<?php echo $footer; ?>