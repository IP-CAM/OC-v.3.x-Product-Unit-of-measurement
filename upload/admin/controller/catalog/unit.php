<?php

class ControllerCatalogUnit extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('catalog/unit');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/unit');
        $this->getlist();
    }

    private function getlist()
    {
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'title';
        }
        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'asc';
        }
        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $url = '';
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }
        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true)
        );
        $data['add'] = $this->url->link('catalog/unit/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
        $data['delete'] = $this->url->link('catalog/unit/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
        $data['units'] = array();
        $filter_data = array('sort' => $sort, 'order' => $order, 'start' => ($page - 1) * $this->config->get('config_limit_admin'), 'limit' => $this->config->get('config_limit_admin'));
        $unit_total = $this->model_catalog_unit->getTotalUnits();
        $results = $this->model_catalog_unit->getUnits($filter_data);
        foreach ($results as $result) {
            $data['units'][] = array(
                'unit_id' => $result['unit_id'],
                'code' => $result['code'],
                'title' => $result['title'] . (($result['unit_id'] == $this->config->get('measure_unit_id')) ? $this->language->get('text_default') : null),
                'symbol_rus' => $result['symbol_rus'],
                'symbol_ukr' => $result['symbol_ukr'],
                'symbol_intl' => $result['symbol_intl'],
                'selected' => isset($this->request->post['selected']) && in_array($result['unit_id'], $this->request->post['selected']),
                'edit' => $this->url->link('catalog/unit/edit', 'user_token=' . $this->session->data['user_token'] . '&unit_id=' . $result['unit_id'] . $url, true)
            );
        }
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }
        $url = '';
        if ($order == 'asc') {
            $url .= '&order=desc';
        } else {
            $url .= '&order=asc';
        }
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['sort_unit_id'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=unit_id' . $url, true);
        $data['sort_code'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=code' . $url, true);
        $data['sort_title'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=title' . $url, true);
        $data['sort_symbol_rus'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=symbol_rus' . $url, true);
        $data['sort_symbol_ukr'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=symbol_ukr' . $url, true);
        $data['sort_symbol_intl'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . '&sort=symbol_intl' . $url, true);
        $url = '';
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }
        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }
        $pagination = new pagination();
        $pagination->total = $unit_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($unit_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($unit_total - $this->config->get('config_limit_admin'))) ? $unit_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $unit_total, ceil($unit_total / $this->config->get('config_limit_admin')));
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('catalog/unit_list', $data));
    }

    public function add()
    {
        $this->load->language('catalog/unit');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/unit');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateform()) {
            $unit_id = $this->model_catalog_unit->addUnit($this->request->post);
            $this->editSetting($unit_id);
            $this->session->data['success'] = $this->language->get('text_success');
            $url = '';
            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }
            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            $this->response->redirect($this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }
        $this->getform();
    }

    private function validateform()
    {
        if (!$this->user->hasPermission('modify', 'catalog/unit')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!is_numeric($this->request->post['code'])) {
            $this->error['code'] = $this->language->get('error_code');
        }

        if ((utf8_strlen($this->request->post['title']) < 2) || (utf8_strlen($this->request->post['title']) > 32)) {
            $this->error['title'] = $this->language->get('error_title');
        }
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    private function editSetting($unit_id)
    {
        $this->load->model('setting/setting');
        if (isset($this->request->post['default']) && $unit_id != $this->config->get('measure_unit_id')) {
            $this->model_setting_setting->editSetting('measure', array('measure_unit_id' => $unit_id));
        }
    }

    private function getform()
    {
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = array();
        }
        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }
        $url = '';
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }
        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true));

        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true));
        if (!isset($this->request->get['unit_id'])) {
            $data['action'] = $this->url->link('catalog/unit/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('catalog/unit/edit', 'user_token=' . $this->session->data['user_token'] . '&unit_id=' . $this->request->get['unit_id'] . $url, true);
        }
        $data['cancel'] = $this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true);
        if (isset($this->request->get['unit_id']) && ($this->request->server['REQUEST_METHOD'] != 'post')) {
            $measure_class_info = $this->model_catalog_unit->getUnit($this->request->get['unit_id']);
            $data['unit_id'] = $measure_class_info['unit_id'];
        }
        if (isset($this->request->post['default'])) {
            $data['default'] = $this->request->post['default'];
        } elseif (!empty($measure_class_info) && $this->config->get('measure_unit_id') == $measure_class_info['unit_id']) {
            $data['default'] = 1;
        } else {
            $data['default'] = 0;
        }
        if (isset($this->request->post['code'])) {
            $data['code'] = $this->request->post['code'];
        } elseif (!empty($measure_class_info)) {
            $data['code'] = $measure_class_info['code'];
        } else {
            $data['code'] = '';
        }
        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (!empty($measure_class_info)) {
            $data['title'] = $measure_class_info['title'];
        } else {
            $data['title'] = '';
        }
        if (isset($this->request->post['symbol_rus'])) {
            $data['symbol_rus'] = $this->request->post['symbol_rus'];
        } elseif (!empty($measure_class_info)) {
            $data['symbol_rus'] = $measure_class_info['symbol_rus'];
        } else {
            $data['symbol_rus'] = '';
        }
        if (isset($this->request->post['symbol_ukr'])) {
            $data['symbol_ukr'] = $this->request->post['symbol_ukr'];
        } elseif (!empty($measure_class_info)) {
            $data['symbol_ukr'] = $measure_class_info['symbol_ukr'];
        } else {
            $data['symbol_ukr'] = '';
        }
        if (isset($this->request->post['symbol_intl'])) {
            $data['symbol_intl'] = $this->request->post['symbol_intl'];
        } elseif (!empty($measure_class_info)) {
            $data['symbol_intl'] = $measure_class_info['symbol_intl'];
        } else {
            $data['symbol_intl'] = '';
        }
        if (isset($this->request->post['symbol_letter_intl'])) {
            $data['symbol_letter_intl'] = $this->request->post['symbol_letter_intl'];
        } elseif (!empty($measure_class_info)) {
            $data['symbol_letter_intl'] = $measure_class_info['symbol_letter_intl'];
        } else {
            $data['symbol_letter_intl'] = '';
        }
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('catalog/unit_form', $data));
    }

    public function edit()
    {
        $this->load->language('catalog/unit');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/unit');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateform()) {
            $this->model_catalog_unit->editUnit($this->request->get['unit_id'], $this->request->post);
            $this->editSetting($this->request->get['unit_id']);
            $this->session->data['success'] = $this->language->get('text_success');
            $url = '';
            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }
            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            $this->response->redirect($this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }
        $this->getform();
    }

    public function delete()
    {
        $this->load->language('catalog/unit');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/unit');
        if (isset($this->request->post['selected']) && $this->validatedelete()) {
            foreach ($this->request->post['selected'] as $unit_id) {
                $this->model_catalog_unit->deleteUnit($unit_id);
            }
            $this->session->data['success'] = $this->language->get('text_success');
            $url = '';
            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }
            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }
            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            $this->response->redirect($this->url->link('catalog/unit', 'user_token=' . $this->session->data['user_token'] . $url, true));
        }
        $this->getlist();
    }

    private function validatedelete()
    {
        if (!$this->user->hasPermission('modify', 'catalog/unit')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        $this->load->model('catalog/product');
        foreach ($this->request->post['selected'] as $unit_id) {
            if ($this->config->get('measure_unit_id') == $unit_id) {
                $this->error['warning'] = $this->language->get('error_default');
            }
            $product_total = $this->model_catalog_product->getTotalProductsByUnitId($unit_id);
            if ($product_total) {
                $this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
            }
        }
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}