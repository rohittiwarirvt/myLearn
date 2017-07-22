<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}


			$data['content_block1'] = $this->load->controller('common/content_block1');
			$data['content_block2'] = $this->load->controller('common/content_block2');
			$data['content_block3'] = $this->load->controller('common/content_block3');
			$data['content_block4'] = $this->load->controller('common/content_block4');
			$data['content_block5'] = $this->load->controller('common/content_block5');
			$data['content_block6'] = $this->load->controller('common/content_block6');
			$data['content_block7'] = $this->load->controller('common/content_block7');
			$data['content_block8'] = $this->load->controller('common/content_block8');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}