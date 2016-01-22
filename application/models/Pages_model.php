<?php

/**
 * Pages model
 *
 * @package Models
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Pages_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->load->database();
    }
    
    /**
     * Get news
     * 
     * @param integer $offset - OFFSET
     * @param integer $limit - LIMIT
     * @return mixed[]
     */
    public function get_pages($offset = false, $limit = false)
    {
        if(is_int($offset) && is_int($limit)){
            $query = $this->db->get('pages', $offset, $limit);
        } else {
            $query = $this->db->get('pages');
        }
        
        return $query->result_array();
    }
    
    /**
     * Get page by id
     * 
     * @param integer $id - id of page to find
     * @return mixed[]
     */
    public function get_page($id)
    {
        $query = $this->db->get_where('pages', array(
            'id' => $id
        ));
        
        return $query->row_array();
    }
    
    /**
     * Get page by slug
     * 
     * @param string $slug - filter slug
     * @return mixed[]
     */
    public function get_page_by_slug($slug)
    {
        $query = $this->db->get_where('pages', array(
            'slug' => $slug
        ));
        
        return $query->row_array();
    }
    
    /**
     * Save new page  into db
     * 
     * @param mixed[] $page - page data
     * @return integer - id of inserted page
     */
    public function insert($page)
    {
        $page['creation_date'] = $this->getDateTimeString();
        $page['last_modified'] = $this->getDateTimeString();
        $this->db->insert('pages', $page);
        
        return $this->db->insert_id();
    }
    
    /**
     * Update page
     * 
     * @param integer $id - page id
     * @param mixed[] $data - new data to set
     */
    public function update($id, $data)
    {
        $data['last_modified'] = $this->getDateTimeString();
        
        $this->db->where('id', $id);
        $this->db->update('pages', $data);
    }
    
    /**
     * Delete page from database
     * 
     * @param integer $id - id of page to delete
     */
    public function delete_page($id)
    {
        $this->db->delete('pages', array(
            'id' => $id
        ));
    }
    
    /**
     * Get current DateTime as string
     * 
     * @return string
     */
    private function getDateTimeString()
    {
        $date = new DateTime();
        
        return $date->format('Y-m-d H:i:s');
    }
}
