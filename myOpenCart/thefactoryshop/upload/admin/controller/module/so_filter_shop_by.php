<?php
class ControllerModuleSoFilterShopBy  extends Controller {
	private $error = array(); 
	public function build_data(){
	
	}
	public function index() { 
	$this->load->language('module/so_filter_shop_by');
	$data['objlang'] = $this->language;
	$this->load->model('extension/module');
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('module/so_filter_shop_by'); 
			if (isset($this->request->post['build_color'])) {
				$data['build_color'] = $this->request->post['build_color'];
			} elseif (!empty($module_info)) {
				$data['build_color'] = $module_info['build_color'];
			} else {
				$data['build_color'] = 1;
			}
			$action = isset($this->request->post["action"]) ? $this->request->post["action"] : "";
			unset($this->request->post['action']);
			if($data['build_color'] == 1){
				$check = $this->model_module_so_filter_shop_by->checkFieldColor();		
				if($check == 0){
					$language_id = $this->model_module_so_filter_shop_by->getLanguagePublish();
					$this->model_module_so_filter_shop_by->updateFieldColor($language_id);
				}
			}else{
				$this->model_module_so_filter_shop_by->deleteFieldColor();
			}
			if (!isset($this->request->get['module_id'])) {				
				$this->model_extension_module->addModule('so_filter_shop_by', $this->request->post);				
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			if($action == "save_edit") {
				$this->response->redirect($this->url->link('module/so_filter_shop_by', 'module_id='.$this->request->post['moduleid'].'&token=' . $this->session->data['token'], 'SSL'));
			}elseif($action == "save_new"){
				$this->response->redirect($this->url->link('module/so_filter_shop_by', 'token=' . $this->session->data['token'], 'SSL'));
			}else{
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	$this->document->addStyle('../catalog/view/javascript/so_filter_shop_by/css/so-filter-shop-by-back-end.css');

	$this->load->language('module/so_filter_shop_by');
    $this->document->setTitle($this->language->get('heading_title'));
	$this->load->model('module/so_filter_shop_by'); 
	$data['objlang'] = $this->language;
    $this->load->model('setting/setting'); 
	$data['field_atribute']                     = $this->model_module_so_filter_shop_by->getFieldAtribute();
	$data['manufacture']                     = $this->model_module_so_filter_shop_by->getMenufacture();
	$data['field_color']                     = $this->model_module_so_filter_shop_by->getFieldColor();
	$data['all_languge']                     = $this->model_module_so_filter_shop_by->getAllLanguages();
	$moduleid_new= $this->model_module_so_filter_shop_by->getModuleId();
	if (!isset($this->request->get['module_id'])) {
		$data['mod_id'] = $moduleid_new[0]['Auto_increment'];
	}else{
		$data['mod_id'] = $this->request->get['module_id'];
	}
	$data['field_default'] = array();
	$data['field_default'][] = 'model';
	$data['field_default'][] = 'price';
	$data['field_default'][] = 'quantity';
	$data['field_default'][] = 'weight';
	$data['header']                              = $this->load->controller('common/header');
	$data['footer']                               = $this->load->controller('common/footer');
    $data['column_left']                       = $this->load->controller('common/column_left');
	$this->load->language('module/so_filter_shop_by');
	$data['heading_title']                     = $this->language->get('heading_title');
	$data['button_save'] 					 = $this->language->get('button_save');
	$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
	$data['button_cancel'] 					 = $this->language->get('button_cancel');
	$data['text_edit'] 			                 = $this->language->get('text_edit');
	$data['entry_name'] 					= $this->language->get('entry_name');
	$data['entry_name_desc'] 				= $this->language->get('entry_name_desc');
	$data['entry_status'] 					= $this->language->get('entry_status');
	$data['text_enabled'] 		= $this->language->get('text_enabled');
	$data['text_disabled'] 		= $this->language->get('text_disabled');
	$data['text_edit_content'] 		= $this->language->get('text_edit_content');
	$data['breadcrumbs'] = array();
	
	$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_home'),
		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
	);

	$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_module'),
		'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
	);

	if (!isset($this->request->get['module_id'])) {
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/so_filter_shop_by', 'token=' . $this->session->data['token'], 'SSL')
		);
	} else {
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/so_filter_shop_by', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
		);
	}
	if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
	} else {
			$data['error_warning'] = '';
	}
	if (!isset($this->request->get['module_id'])) {
		$data['action'] = $this->url->link('module/so_filter_shop_by', 'token=' . $this->session->data['token'], 'SSL');
	} else {
		$data['action'] = $this->url->link('module/so_filter_shop_by', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
	}
	
	if (isset($this->error['head_name'])) {
		$data['head_name'] = $this->error['head_name'];
	} else {
		$data['head_name'] = '';
	}
	if (isset($this->error['name'])) {
		$data['error_name'] = $this->error['name'];
	} else {
		$data['error_name'] = '';
	}
	if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
	}
	if (isset($this->request->post['name'])) {
		$data['name'] = $this->request->post['name'];
	} elseif (!empty($module_info)) {
		$data['name'] = $module_info['name'];
		$data['status'] = $module_info['status'];
	} else {
		$data['name'] = '';
		$data['status'] = 0;
	}
	
	if (isset($this->request->post['build_color'])) {
		$data['build_color'] = $this->request->post['build_color'];
	} elseif (!empty($module_info)) {
		$data['build_color'] = $module_info['build_color'];
	} else {
		$data['build_color'] = 1;
	}
	
	if($data['build_color'] == 1){
		$check = $this->model_module_so_filter_shop_by->checkFieldColor();		

		if($check == 0){
			$language_id = $this->model_module_so_filter_shop_by->getLanguagePublish();
			$this->model_module_so_filter_shop_by->updateFieldColor($language_id);
		}
	}else{
		$this->model_module_so_filter_shop_by->deleteFieldColor();
	}
	
	if (isset($this->request->post['database'])) {
		$data['database'] = $this->request->post['database'];
	} elseif (!empty($module_info)) {
		$data['database'] = $module_info['database'];
	} else {
		$data['database'] = '';
	}
	if (isset($this->request->post['language'])) {
		$data['language'] = $this->request->post['language'];
	} elseif (!empty($module_info)) {
		$data['language'] = $module_info['language'];
	} else {
		$data['language'] = $data['all_languge'][0]['language_id'];
	}
	if (isset($this->request->post['in_class'])) {
		$data['in_class'] = $this->request->post['in_class'];
	} elseif (!empty($module_info) && isset($module_info['in_class'])) {
		$data['in_class'] = $module_info['in_class'];
	} else {
		$data['in_class'] = '#content .row';
	}
	
	if($data['in_class'] == ''){
		$data['in_class'] = '#content .row';
	}
	
	if (isset($this->request->post['column_in_row'])) {
		$data['column_in_row'] = $this->request->post['column_in_row'];
	} elseif (!empty($module_info) && isset( $module_info['column_in_row'])) {
		$data['column_in_row'] = $module_info['column_in_row'];
	} else {
		$data['column_in_row'] = '';
	}
	$default = array(
			'name'					=> '',
			'module_description'	=> array(),
			'disp_title_module'		=> '1',
			'item_link_target'		=> '_blank',
			'status'				=> '1',
			'class_suffix'			=> '',
			'limit_tags' 			=> 20,
			'min_font_size'			=> '9',
			'max_font_size'			=> '25',
			'font_weight'			=> array(),
			
		);
	if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST') || $this->request->server['REQUEST_METHOD'] == 'POST' && !$this->validate() && isset($this->request->get['module_id'])) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		} else {
			$module_info = $default;
			if(isset($this->request->post))
			{
				$module_info = array_merge($module_info,$this->request->post);
			}				

		}
	$data['modules'] = array( 0=> $module_info );
	$data['module'] = $data['modules'][0];
	$this->load->model('localisation/language');
	$data['languages'] 	= $this->model_localisation_language->getLanguages();
	if(isset($module_info['module_description']))
	$data['module_description'] = $module_info['module_description'];
	$data['categories'] = $this->getAllCategory();
	$data['products'] = $this->getAllProducts();
	
    $this->response->setOutput($this->load->view('module/so_filter_shop_by/default.tpl', $data));
	}
	protected function getAllCategory(){
		$sql = 'SELECT cd.category_id AS category_id,cd.name AS name,cd.language_id AS language_id FROM '.DB_PREFIX.'category_description AS cd INNER JOIN '.DB_PREFIX.'category AS c ON cd.category_id = c.category_id WHERE c.status = 1' ;
		$query = $this->db->query($sql);
		$results = $query->rows;
		foreach ($results as $result) {
			$categories[] = array(
				'category_id' => $result['category_id'],
				'name'        => $result['name'],
				'language_id' => $result['language_id']
			);
		}
	
		return $categories;
	}
	
	protected function getAllProducts(){
		$this->load->model('tool/image');
		$this->load->model('catalog/product');
		$product_total = $this->model_catalog_product->getTotalProducts();
		$products = array();
		$results = $this->model_catalog_product->getProducts();
		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

			foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $product_special['price'];
					break;
				}
			}

			$products[] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      	=> $result['price'],
				'special'    => $special,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
			);
		}
		return $products;
	}
	protected function validate() {
 
       
        if (!$this->user->hasPermission('modify', 'module/so_filter_shop_by')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
        $this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach($languages as $language){
			$module_description = $this->request->post['module_description'];
			
			if ((utf8_strlen($module_description[$language['language_id']]['head_name']) < 3) || (utf8_strlen($module_description[$language['language_id']]['head_name']) > 64)) {
				$this->error['head_name'] = $this->language->get('error_head_name');
			}
		}
        if (!$this->error) {
            return true;
        } else {
            return false;
        }   

    }
}