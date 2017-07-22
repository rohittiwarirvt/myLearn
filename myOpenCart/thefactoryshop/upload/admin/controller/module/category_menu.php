<?php
class ControllerModuleCategoryMenu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/category_menu');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('category_menu', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->cache->delete('category_menu');

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $data['text_edit'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_horisontal'] = $this->language->get('entry_horisontal');
		$data['entry_vertical'] = $this->language->get('entry_vertical');
		$data['entry_max_cat'] = $this->language->get('entry_max_cat');

		$data['text_help'] = $this->language->get('text_help');

		$data['entry_levels'] = $this->language->get('entry_levels');
		$data['entry_count'] = $this->language->get('entry_count');
		$data['entry_images'] = $this->language->get('entry_images');

		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_child'] = $this->language->get('entry_child');
		$data['entry_subchild'] = $this->language->get('entry_subchild');


		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/category_menu', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/category_menu', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/category_menu', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
			$data['module'] = $module_info;
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = '15';
		}
		
		if (isset($this->request->post['level'])) {
			$data['level'] = $this->request->post['level'];
		} elseif (!empty($module_info)) {
			$data['level'] = $module_info['level'];
		} else {
			$data['level'] = 3;
		}

		if (isset($this->request->post['style'])) {
			$data['style'] = $this->request->post['style'];
		} elseif (!empty($module_info)) {
			$data['style'] = $module_info['style'];
		} else {
			$data['style'] = 1;
		}
        /* COUNT OPTIONS */
		if (isset($this->request->post['category_count'])) {
			$data['category_count'] = $this->request->post['category_count'];
		} elseif (!empty($module_info)) {
			$data['category_count'] = $module_info['category_count'];
		} else {
			$data['category_count'] = 1;
		}

		if (isset($this->request->post['child_count'])) {
			$data['child_count'] = $this->request->post['child_count'];
		} elseif (!empty($module_info)) {
			$data['child_count'] = $module_info['child_count'];
		} else {
			$data['child_count'] = 1;
		}

		if (isset($this->request->post['subchild_count'])) {
			$data['subchild_count'] = $this->request->post['subchild_count'];
		} elseif (!empty($module_info)) {
			$data['subchild_count'] = $module_info['subchild_count'];
		} else {
			$data['subchild_count'] = 1;
		}

		/* IMAGES OPTIONS */
		if (isset($this->request->post['category_images'])) {
			$data['category_images'] = $this->request->post['category_images'];
		} elseif (!empty($module_info)) {
			$data['category_images'] = $module_info['category_images'];
		} else {
			$data['category_images'] = array('status'	=> 1,
											'width'		=> 10,
											'height'	=> 10
											);
		}

		if (isset($this->request->post['child_images'])) {
			$data['child_images'] = $this->request->post['child_images'];
		} elseif (!empty($module_info)) {
			$data['child_images'] = $module_info['child_images'];
		} else {
			$data['child_images'] = array('status'	=> 1,
											'width'		=> 15,
											'height'	=> 15
											);
		}

		if (isset($this->request->post['subchild_images'])) {
			$data['subchild_images'] = $this->request->post['subchild_images'];
		} elseif (!empty($module_info)) {
			$data['subchild_images'] = $module_info['subchild_images'];
		} else {
			$data['subchild_images'] = array('status'	=> 1,
											'width'		=> 20,
											'height'	=> 20
											);
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = 1;
		}


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/category_menu.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/category_menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>