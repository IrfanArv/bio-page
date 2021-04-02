<?php

class Pages_model extends CI_Model {

    function __construct() {
        parent :: __construct();
    }

	public function get_page_member($id)
	{
        
        $this->db->select('*');
        $this->db->from('page');
        $this->db->where('account_id', $id);
        $this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
    }

    public function getBio($url)
	{
        $this->db->select('link,title,url,icon,status,account_id');
        $this->db->from('page');
        $this->db->join('account','account.oauth_uid=page.account_id');
        $this->db->where('account.link', $url);
        $this->db->where('page.status', 1);
        $this->db->order_by("page.id", "desc");
		$query = $this->db->get();
		return $query->result();
    }

    public function getUserBio($url)
	{
        $this->db->select('first_name,last_name,picture,bio,picture,link');
        $this->db->from('account');
        $this->db->where('link', $url);
        $this->db->group_by('id');
        $this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result();
    }


    public function getURL($url)
    {
        $this->db->where('link', $url);
        $query = $this->db->get('account');
        if($query->num_rows()>0){
        return true;
        }
        else {
        return false;
        }
    }

    function updateLink($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('page', $data);
        return $result;
    }

    public function deleteURL($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('page');
    }
    
    public function UrlMatch($id)
    {
        $this->db->where('oauth_uid' , $id);
        $query = $this->db->get('account');

        if($query->num_rows()>0){
        return true;
        }
        else {
        return false;
        }
    }

    public function getUsername($id)
    {
        $this->db->select('link');
        $this->db->from('account');
        $this->db->where('oauth_uid', $id);
        $query = $this->db->get();
        $ret = $query->row();
        return $ret->link;
    }
    
}


