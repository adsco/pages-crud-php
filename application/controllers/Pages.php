<?php

/**
 * Pages manipulation controller
 *
 * @package Controllers
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Pages extends CI_Controller
{   
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('pages_model');
    }
    
    /**
     * Index page controller
     */
    public function index()
    {
        $data['title'] = 'Pages';
        $data['pages'] = $this->pages_model->get_pages();
        $data['crumbs'] = array(
            array('url' => null, 'title' => 'Pages')
        );
        
        $this->loadViews('pages/index', $data);
    }
    
    /**
     * Create page controller
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules($this->getRules());
        
        if(false === $this->form_validation->run()){
            $data['title'] = 'Create new page';
            $data['crumbs'] = array(
                array('url' => 'pages', 'title' => 'Pages'),
                array('url' => null, 'title' => 'Create page')
            );
            
            $this->loadViews('pages/create', $data);
        } else {
            $page = $this->getPageFromRequest();
            
            //banner and thumbnail are not crucial, so form still valid even if
            //banner and/or thumbnail is/are not loaded
            $imageName = $this->uploadFile('banner', $this->config->item('banner_config'));
            $page['banner'] = $imageName ?: null;
			
            $imageName = $this->uploadFile('thumbnail', $this->config->item('thumbnail_config'));
            $page['thumbnail'] = $imageName ?: null;
            
            $pageId = $this->pages_model->insert($page);
            redirect('pages/edit/' . $pageId);
        }
    }
    
    /**
     * Edit page controller
     * 
     * @param string $id - id editing page
     */
    public function edit($id)
    {
        $page = $this->pages_model->get_page($id);
        if(empty($page)){
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->getPageFromRequest();
        $this->form_validation->set_rules($this->getRules($data));
        
        if(true === $this->form_validation->run()){
            $data = $this->getPageFromRequest();
            //banner and thumbnail are not crucial, so form still valid even if
            //banner and/or thumbnail is/are not loaded
            $imageName = $this->uploadFile('banner', $this->config->item('banner_config'));
            $data['banner'] = $imageName ?: $page['banner'];

            $imageName = $this->uploadFile('thumbnail', $this->config->item('thumbnail_config'));
            $data['thumbnail'] = $imageName ?: $page['thumbnail'];

            $this->pages_model->update($id, $data);
            $page = $this->pages_model->get_page($id);
        }
        
        $data['title'] = sprintf('Page edit: "%s"', $page['title']);
        $data['page'] = $page;
        $data['crumbs'] = array(
            array('url' => 'pages', 'title' => 'Pages'),
            array('url' => null, 'title' => $data['title'])
        );
        
        $this->loadViews('pages/edit', $data);
    }
    
    /**
     * Remove page action
     * 
     * @param string $id - id of page to remove
     */
    public function remove($id)
    {
        $this->pages_model->delete_page($id);
        redirect('pages');
    }
    
    /**
     * Grab page data from request
     * 
     * @return mixed[]|null
     */
    private function getPageFromRequest()
    {
        if($this->input->server('REQUEST_METHOD') != 'POST'){
            return null;
        }
        
        $page = array();
        
        $page['id'] = $this->input->post('id');
        $page['slug'] = url_title($this->input->post('slug'));
        $page['name'] = $this->input->post('name');
        $page['title'] = $this->input->post('title');
        $page['content'] = $this->input->post('content');
        
        return $page;
    }
    
    /**
     * Upload banner/thumbnail images
     * 
     * @param string $name - input field name
     * @param mixed $config - upload config
     * @return boolean
     */
    private function uploadFile($name, $config)
    {
        if(!property_exists($this, 'upload')){
            $this->load->library('upload');
        }
        
        $this->upload->initialize($config);
        
        if(!$this->upload->do_upload($name)){
            return false;
        }
        
        return $this->upload->data()['client_name'];
    }
    
    /**
     * Get page rules, special workaround used for slug unique constraint
     * 
     * @param mixed[] $page - Modified page model, but not persisted yet
     * @return mixed[]
     */
    private function getRules($page = null)
    {
        $unique = '|is_unique[pages.slug]';
        
        if(null !== $page){
            if(!$page['id']){
                throw new Exception('Page id required in order to define page form rules');
            }
            
            //get original page values
            $pageSlug = $this->pages_model->get_page($page['id']);
            //slug didn't changed, no need to validate for uniqueness
            if($page['slug'] == $pageSlug['slug']){
                $unique = '';
            }
        }
        
        return array(
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|required|max_length[255]'
            ),
            array(
                'field' => 'slug',
                'label' => 'Url',
                'rules' => 'trim|required|max_length[255]' . $unique
            ),
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|max_length[255]'
            )
        );
    }
    
    /**
     * Shortcut for loading templates
     * 
     * @param string $template - template to load in the middle
     * @param mixed[] $data - data that will be passed into template
     */
    private function loadViews($template, $data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view($template, $data);
        $this->load->view('templates/footer');
    }
}
