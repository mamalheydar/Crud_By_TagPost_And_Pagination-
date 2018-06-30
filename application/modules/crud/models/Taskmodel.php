<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Taskmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//tosh khali bashe khodesh az config .php mikhone
    }

    public function get($limit = 5, $offset)
    {
        if ($offset == "") {
            $offset = 0;
        }
        $str = "LIMIT " . $offset . "," . $limit;
        $query_result = $this->db->query("SELECT tasks.*,tags.id AS tg ,GROUP_CONCAT(tags.name) AS tg_name FROM tasks 
INNER JOIN task_tag  ON tasks.id=task_tag.task_title_id
INNER JOIN tags ON tags.id=task_tag.tag_name_id  GROUP BY tasks.id $str 
;");
        /* foreach ($query_result as $row) {
             if ($row['tasks.id'] == $row['tasktag.task_title_id']) {
                 $resultname[] = $row['name'];
             }
         }*/
        return $query_result->result();
    }//ok

    public function insert($data, $tags)
    {
        $this->db->insert('tasks', $data); //ok
        $task_id = $this->db->insert_id();

        foreach ($tags as $tag) {
            $this->db->insert('tags', ['name' => $tag]); //ok
            $tag_id = $this->db->insert_id();
            $insert_array[] = ['task_title_id' => $task_id, 'tag_name_id' => $tag_id];
        }

        $this->db->insert_batch('task_tag', $insert_array);
        var_dump($this->db->last_query());
    }

    public function delete($id)
    {

        $sql = <<<SQL
DELETE tasks.* FROM tasks
WHERE id=$id
SQL;

        $this->db->query($sql);
    }

    public function edit($id, $datatitle, $datacontent, $tags)
    {


        /*      foreach ($tags as $tag) {
                  $finaltags[]= ["name" => $tag];//behesh begim chiro berize too chi
                  $this->db->insert('tags', $finaltags);
                  $insert_id = $this->db->insert_id();
                  $this->db->update('task_tag.task_title_id', $id);
              }*/

        $sql = <<<SQL
UPDATE tasks
JOIN task_tag ON task_tag.task_title_id=tasks.id
JOIN tags ON  tags.id=task_tag.tag_name_id
SET tasks.title ='$datatitle', tasks.content='$datacontent',tags.name='$tags'
where tasks.id=$id
SQL;

        $this->db->query($sql);

        //ok
    }

    public function find($id)
    {
        $sql = <<<SQL
SELECT tasks.* , GROUP_CONCAT(tags.name) as tags FROM tasks 
INNER JOIN task_tag ON tasks.id=task_tag.task_title_id
INNER JOIN tags  ON tags.id=task_tag.tag_name_id
WHERE  tasks.id=$id GROUP BY tasks.id
SQL;
        $query_result = $this->db->query($sql);
        /*foreach ($query_result->result() as $row) {
            if ($row->name) {
                $rows_name[] = $row->name;
            }
        }*/
        return $query_result->result();

        //return $query;
        /* $this->db->select('title,content,name');
         $this->db->from('tasks,tags,task_tag');
         $this->db->where('tasks.id', $id);
         $this->db->where(' task_title_id', 'tasks.id');
         $this->db->where('tags.id','tag_name_id' );
         $query = $this->db->get();
         $row_array = $query->row_array();
         return $row_array;*/
    }

    public function count()
    {
        return $this->db->count_all('tasks');
    }

    /*  public function get_tag($id)
      {
          $this->db->select('id,name');
          $this->db->from('tags');
          $this->db->where('id', $id);
          $query = $this->db->get('');
          return $query->result();
      }//ok

      public function task_tag($id1, $id2)
      {
          $this->db->select('task_title_id,tag_name_id');
          $this->db->from('task_tag');
          $this->db->where(array('task_title_id' => $id1, 'tag_name_id' => $id2));
          $query = $this->db->get();
          $row_array = $query->row_array();
          return $row_array;
      }*/


}