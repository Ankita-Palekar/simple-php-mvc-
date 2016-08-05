<?php

class ItemsController extends Controller {

	function view($id = null,$name = null) {
		$query = $this->Item->select($id);
		
		$ob = $this->Item->prepare($query);
		$result  = Array();
		
		if ($ob->execute()) {
			while ($row = $ob->fetch()) {
				array_push($result, $row);
			}
		} else {
			throw new Excpetion("Execution could not be completed");
		}
		$result = Array("Item" => $result[0]);
 

		$this->set('title',$name.' - My Todo List App');
		$this->set('todo', $result);		 
	}
	
	function viewall() {
		$query = $this->Item->select_all();
		$ob = $this->Item->prepare($query);
		$result  = Array();
		if ($ob->execute()) {
			while ($row = $ob->fetch()) {
				array_push($result, Array("Item" => $row));
			}
		} else {
			throw new Excpetion("Execution could not be completed");
		}
		$this->set('title','All Items - My Todo List App');
		$this->set('todo', $result);
	}
	
	function add() {
		$todo = $_POST['todo'];
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('insert into items (item_name) values (\''.mysql_real_escape_string($todo).'\')'));	
	}
	
	function delete($id = null) {
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('delete from items where id = \''.mysql_real_escape_string($id).'\''));	
	}

}
