<?php  
class ControllerModuleSosearchpro extends Controller {
	
	private $data = array();

	public function index( $setting ) { 
		
		static $module = 0;
		$this->load->language('module/so_searchpro');
	
			$this->load->language('common/soconfig');
			$this->data['btn_search'] = $this->language->get('btn_search');
		
		$this->load->model('tool/image');
		$this->load->model('catalog/category');
		$this->document->addStyle('catalog/view/javascript/so_searchpro/css/so_searchpro.css');
		
		/*Entry */
		$this->data['text_search'] 			= $this->language->get('text_search');	
		$this->data['text_category_all'] 	= $this->language->get('text_category_all');	
		$this->data['text_tax'] 			= $this->language->get('text_tax');	
		$this->data['text_price'] 			= $this->language->get('text_price');	
		$this->data['button_cart'] 			= $this->language->get('button_cart');
		$this->data['button_wishlist'] 		= $this->language->get('button_wishlist');
		$this->data['button_compare'] 		= $this->language->get('button_compare');	
		/*End Entry */
		
		/*Data */
		$this->data['disp_title_module'] = (int)$setting['disp_title_module'] ;
		$this->data['additional_class'] = isset($setting['class']) ? $setting['class']:'';
		$this->data['limit'] = isset($setting['limit']) ? $setting['limit'] : 5 ;
		$this->data['height'] = isset($setting['height']) ? $setting['height'] : 50 ;
		$this->data['width'] = isset($setting['width']) ? $setting['width'] : 50 ;
		$this->data['character'] = isset($setting['character']) ? $setting['character'] : 2 ;
		$this->data['showimage'] = isset($setting['showimage']) ? $setting['showimage'] : '1';
		$this->data['showprice'] = isset($setting['showprice']) ? $setting['showprice'] : '1';		
		$this->data['showcategory'] = isset($setting['showcategory']) ? $setting['showcategory']:'1';
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$this->data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$this->data['head_name']  = $setting['head_name'];
		}
		
		$this->data['categories'] = array();
		/*End Data //Code by tunghv */
		if($this->data['showcategory'] && $this->data['showcategory'] == 1){
	
			$this->data['categories'] = array();
			$this->data['category_id'] = 0;
			/* Level 1 */	
			$categories = $this->model_catalog_category->getCategories(0);

			foreach ($categories as $category) {
				$children_2 = array();
				/* Level 2 */	
				$categories_lv2 = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($categories_lv2 as $category_lv2) {
					$children_3 = array();
					/* Level 3 */	
					$categories_lv3 = $this->model_catalog_category->getCategories($category_lv2['category_id']);

					foreach ($categories_lv3 as $category_lv3) {
						$children_3[] = array(
							'category_id' => $category_lv3['category_id'],
							'name'        => $category_lv3['name'],
						);
					}

					$children_2[] = array(
						'category_id' => $category_lv2['category_id'],	
						'name'        => $category_lv2['name'],
						'children'    => $children_3
					);					
				}
				
				$this->data['categories'][] = array(
					'category_id' => $category['category_id'],
					'name'        => $category['name'],
					'children'    => $children_2
				);
			}

		}
		
		$this->data['module'] = $module++;
						
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_searchpro.tpl')) {
			$template = $this->config->get('config_template') . '/template/module/so_searchpro.tpl';
		} else {
			$template = 'default/template/module/so_searchpro.tpl';
		}
		
		return $this->load->view($template, $this->data);
	}
	public function autocomplete() {
		$json = array();

		$this->load->language('product/category');
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('tool/image');
			$this->load->model('catalog/product');
			$this->load->model('catalog/category');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_category_id'])) {
				$filter_category_id = $this->request->get['filter_category_id'];
			} else {
				$filter_category_id = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}
			
			if (isset($this->request->get['width'])) {
				$width = $this->request->get['width'];	
			} else {
				$width = 64;	
			}

			if (isset($this->request->get['height'])) {
				$height = $this->request->get['height'];	
			} else {
				$height = 64;	
			}			

			$data = array(
				'filter_name'  => $filter_name,
				'filter_tag'   => $filter_name,
				'filter_category_id' => $filter_category_id,
				'start'        => 0,
				'limit'        => $limit
			);
			
			$results = $this->model_catalog_product->getProducts($data);
			$total = $this->model_catalog_product->getTotalProducts($data);
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $width, $height);
				} else {
					$image = false;
				}
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}
				$path = 0;
				$category_name = '';
				$categories = $this->model_catalog_product->getCategories($result['product_id']);
				if ($categories){
				   $categories_info = $this->model_catalog_category->getCategory($categories[0]['category_id']);
				   $path=	$this->getCategoryPath($categories[0]['category_id']);
				   $category_name = $categories_info['name'];
				}   
  
				
				$json[] = array(
					'total' => $total,
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'category_name' => strip_tags(html_entity_decode($category_name, ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'image'		 => $image,
					'link'		 => $this->url->link('product/product','path='.$path.'&product_id='.$result['product_id']),
					'special'	 => $special,
					'tax'		 => $tax,
					'price'      => $price,
					'minimum'    =>  $result['minimum']
				);	
			}
			
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function getCategoryPath($category_id){
        $path = '';
			$category = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c WHERE c.category_id = " .(int)($category_id));
	   
		if($category->row['parent_id'] != 0){
			$path .= $this->getCategoryPath($category->row['parent_id']) . '_';
		}
	   
	   $path .= $category->row['category_id'];
	   
		return $path;
	}
}
?>
