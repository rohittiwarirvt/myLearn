<?php
class ControllerModuleSopopulartags extends Controller {
	public function index($setting) {
		static $module = 1;
		$this->load->language('module/so_popular_tabs');
		$data['heading_title'] = $this->language->get('heading_title');
		$this->load->model('tool/image');
		$this->load->model('module/so_popular_tags');
		
	
	// Get data
		$data['class_suffix'] 			= $setting['class_suffix'];
		$data['moduleid']  				= $setting['moduleid'];
		$data['disp_title_module'] 		= (int)$setting['disp_title_module'];
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] 			= html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  		= $setting['head_name'];
		}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
		 	$data['base'] = $this->config->get('config_ssl');
		} else {
			$data['base'] = $this->config->get('config_url');
		}
		
		$language = $this->config->get('config_language_id');
		//get data tagclound
		$limit = isset($setting['limit_tags'])?$setting['limit_tags']:20;
		$min_font_size = isset($setting['min_font_size'])?$setting['min_font_size']:9;
		$max_font_size = isset($setting['max_font_size'])?$setting['max_font_size']:20;
		$font_weight = isset($setting['font_weight'])?$setting['font_weight']:'bold';
		$item_link_target = isset($setting['item_link_target']) ? $setting['item_link_target'] : '_blank';
		$data['class_suffix'] = isset($setting['class_suffix'])?$setting['class_suffix']:'';
		
		$tags = $this->model_module_so_popular_tags->getRandomTags($limit, $min_font_size, $max_font_size, $font_weight,$item_link_target);

		if (empty($tags)) {
			return;
		}
		
		$data['data'] = $tags;

		$data['module'] = $module++;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_popular_tags/default.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/so_popular_tags/default.tpl', $data);
		} else {
			return $this->load->view('default/template/module/so_popular_tags/default.tpl', $data);
		}
	
	}
	
}