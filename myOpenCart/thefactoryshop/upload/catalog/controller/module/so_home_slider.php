<?php
class ControllerModuleSohomeslider extends Controller {
	public function index($setting) {
		static $module = 1;
		$this->load->language('module/so_home_slider');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_tax'] = $this->language->get('text_tax');
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('module/so_home_slider');
		$this->document->addStyle('catalog/view/javascript/so_home_slider/css/style.css');
		if (!defined ('OWL_ANIMATE'))
		{
			$this->document->addStyle('catalog/view/javascript/so_home_slider/css/animate.css');
			define( 'OWL_ANIMATE', 1 );
		}
		
		if (!defined ('OWL_CAROUSEL'))
		{
			
			$this->document->addStyle('catalog/view/javascript/so_home_slider/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_home_slider/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
		
		if (!isset($setting['width'])) {
			$setting['width'] = 100;
		}
		if (!isset($setting['height'])) {
			$setting['height'] = 200;
		}
		$data['disp_title_module'] 	= $setting['disp_title_module'];
		//General 
		$data['item_link_target'] 	= $setting['item_link_target'];
		//Items Option
		$data['class_suffix'] 			= $setting['class_suffix'];
		
		//Effect Option
		$data['autoplay'] 				= ($setting['autoplay'] ==1 ? "true" : "false");
		$data['autoplayHoverPause'] 	= ($setting['autoplayHoverPause'] ==1 ? "true" : "false");
		$data['autoplayTimeout'] 		= $setting['autoplayTimeout'];
		$data['autoplaySpeed'] 			= $setting['autoplaySpeed'];
		$data['startPosition'] 			= $setting['startPosition'];
		$data['mouseDrag'] 				= ($setting['mouseDrag'] == 1 ? "true" : "false" );
		$data['touchDrag'] 				= ($setting['touchDrag'] == 1 ? "true" : "false" );
		$data['loop'] 					= ($setting['loop'] == 1 ? "true" : "false" );
		$data['dots'] 					= ($setting['dots'] == 1 ? "true" : "false");
		$data['nav'] 					= ($setting['navs'] == 1 ? "true" : "false");
		$data['animateOut'] 			= $setting['animateOut'];
		$data['animateIn'] 				= $setting['animateIn'];
		$data['NoItem'] 				= $this->language->get('text_noitem');
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = $setting['head_name'];
		}
		
		//Default
		$slide_arr = array();
		$slide_arr = self::getSlides($setting);
		$data['list'] = $slide_arr;
		$data['module'] = $module++;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_home_slider/default.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/so_home_slider/default.tpl', $data);
		} else {
			return $this->load->view('default/template/module/so_home_slider/default.tpl', $data);
		}
	}
	
	public function getSlides($setting)
	{
		$list = array();
		$slides_arr = $this->model_module_so_home_slider->getListSlider($setting);
		foreach($slides_arr as $slide_info)
			{	
				$image = $this->model_tool_image->resize($slide_info['image'],$setting['width'],$setting['height']);
				$list[] = array(
					'slider_id'  	=> $slide_info['id'],
					'thumb'       	=> $image,
					'title'        	=> $slide_info['title'],
					'description' 	=> $slide_info['description'],
					'caption'       => $slide_info['caption'],
					'url'     		=> $slide_info['url']
				);
			}
		return $list;
	}
		
}