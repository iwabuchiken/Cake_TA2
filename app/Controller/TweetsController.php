<?php

class TweetsController extends AppController {

	public $helpers = array('Html', 'Form');
// 	public $helpers = array('Html', 'Form', 'Main');
	
	public $components = array('Paginator');
	
	public function 
	index() {

		/*******************************
			options
		*******************************/
		$opt = $this->_index__Options();

		debug($opt);
		
		/*******************************
			paginate
		*******************************/
		$items_PerPage = 10;
		
		@$current_Page = $_REQUEST['page'];
		
		if ($current_Page == null) {
			
			$current_Page = 5;
			
		} else if (is_numeric($current_Page) === false) {
			
			$current_Page = 5;
			
		}
		
		$id_start = ($current_Page - 1) * 10;
		
		debug("id_start => ".$id_start);
		
		$result2 = Utils::paginate_Tweets($id_start, $items_PerPage, $opt);
// 		$result2 = Utils::paginate_Tweets($id_start, $items_PerPage);
		
		/*******************************
			set vars: tweets
		*******************************/
		// tweets
		$this->set("result", $result2[0]);
		
		/*******************************
			set vars: last page
		*******************************/
		$residue = $result2[1] % $items_PerPage;
		
		if ($residue == 0) {
		
			$this->set("last_Page", floor($result2[1] / $items_PerPage));
		
		} else {
		
			$this->set("last_Page", floor($result2[1] / $items_PerPage) + 1);
			
		}//if ($residue == 0)

		/*******************************
		 set vars: current page
		*******************************/
		$this->set("current_Page", $current_Page);
		
		/*******************************
			set vars: URI
		*******************************/
		$host = $_SERVER['HTTP_HOST'];
		
		$request_uri = $_SERVER['REQUEST_URI'];
		
		$param_position = strstr($request_uri, '?');
		
		$this->set("uri", str_replace($param_position, "", $request_uri));
		
	}//index()

	public function 
	_index__Options() {

		/*******************************
			filter
		*******************************/
		@$filter = $this->request->query['filter'];
		
// 		if ($filter == null) {
		
// 			debug("filter => null");
		
// 		} else {
		
// // 			debug("filter => $filter");
// 			debug($filter);
			
// 		}//if ($filter == null)
		
		/*******************************
			return
		*******************************/
		return array("filter" => $filter);
		
	}//_index__Options()
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid video'));
		}
	
		$keyword = $this->Keyword->findById($id);
		if (!$keyword) {
			throw new NotFoundException(__('Invalid video'));
		}
		
		$this->set('keyword', $keyword);
		
	}
	
	public function add() {
		if ($this->request->is('post')) {
			
			$this->Keyword->create();
			
			$this->request->data['Keyword']['created_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
			$this->request->data['Keyword']['updated_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
			// ruby
// 			$this->Keyword->rubi = 
			$this->request->data['Keyword']['rubi'] =
						Utils::conv_Word_2_Rubi($this->request->data['Keyword']['word']);
			
			// save
			if ($this->Keyword->save($this->request->data)) {
				
				$this->Session->setFlash(
						__("Keyword saved => ".$this->request->data['Keyword']['word']));
// 				$this->Session->setFlash(__('Your keyword has been saved.'));
				return $this->redirect(array('action' => 'index'));
				
			}
			$this->Session->setFlash(__('Unable to add your keyword.'));
			
		} else {
			
		}
		
	}//public function add()

	public function add_bulk() {
		if ($this->request->is('post')) {
			
			$this->Keyword->create();
			
			$words_str = $this->request->data['Keyword']['word'];
			
			$tokens = explode(" ", $words_str);
			
			$counter = 0;
			
			$len = count($tokens);
			
// 			debug($this->request->data['Keyword']);
			
// 			debug("genre => ".isset($this->request->data['Keyword']['genre_id']));
			
			for ($i = 0; $i < $len; $i++) {
				
				$this->Keyword->create();
				
				$time = Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
				
				$this->Keyword->created_at = $time;
// 							Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
				$this->Keyword->updated_at = $time;
// 							Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);

				$this->Keyword->word = $tokens[$i];
// 				$this->Keyword->word = "aaa";

				$this->Keyword->rubi = 
						Utils::conv_Word_2_Rubi_V2($this->Keyword->word);
// 						Utils::conv_Word_2_Rubi($this->Keyword->word);
// 						Utils::conv_Word_2_Rubi($this->request->data['Keyword']['word']);
				
				$this->Keyword->memo = 
							$this->request->data['Keyword']['memo'];
				
				$this->Keyword->genre_id = 
							isset($this->request->data['Keyword']['genre_id']) ? 
								intval($this->request->data['Keyword']['genre_id']) : -1;
// 							$this->request->data['Keyword']['genre_id'];
				
				$this->Keyword->type_id = 
							isset($this->request->data['Keyword']['type_id']) ?
								intval($this->request->data['Keyword']['type_id']) : -1;
// 							$this->request->data['Keyword']['type_id'];
				
// 				debug($this->Keyword->word);
// 				debug($this->Keyword->rubi);
				
				// save
				if ($this->Keyword->save($this->Keyword)) {
// 				if ($this->Keyword->save($this->request->data)) {

					$counter += 1;
	
				}
				
			}//for ($i = 0; $i < $len; $i++)
			
			debug("counter => ".$counter);
			
// 			debug($tokens);
			
// 			debug($this->request->data['Keyword']['word']);
			
// 			$this->request->data['Keyword']['created_at'] =
// 						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
// 			$this->request->data['Keyword']['updated_at'] =
// 						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
			
// 			// ruby
// // 			$this->Keyword->rubi = 
// 			$this->request->data['Keyword']['rubi'] =
// 						Utils::conv_Word_2_Rubi($this->request->data['Keyword']['word']);
			
// 			// save
// 			if ($this->Keyword->save($this->request->data)) {
				
// 				$this->Session->setFlash(
// 						__("Keyword saved => ".$this->request->data['Keyword']['word']));
// // 				$this->Session->setFlash(__('Your keyword has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
				
// 			}
// 			$this->Session->setFlash(__('Unable to add your keyword.'));
			
		} else {
			
		}
		
	}//public function add()

	public function 
	add_from_sqlite() {
		
		/*******************************
			action?
		*******************************/
		@$action = $this->request->query['action'];
		
// 		debug($action);

		/*******************************
			validate
		*******************************/
		if ($action == null) {
			
			debug("add param => '?action=go'");
			
			return ;
			
		}//$action == null
		
		debug("action => ".$action);
		
		/*******************************
			build: tweet list
		*******************************/
		$tweets = Utils::find_All_Tweets_from_SQLiteDB();
		
		if ($tweets !== null) {
		
// 			debug(count($tweets));
			
// 			debug($tweets[0]);
		
		} else {
		
			debug("tweets => null");
			
			return ;
			
		}//if ($tweets !== null)
		
		/*******************************
			save data
		*******************************/
// 		debug($_SERVER);
// 		debug(gethostname());

		$hostname = @$_SERVER['HTTP_HOST'];
		
		$tweets = array_values($tweets);
		
// 		if ($hostname != 'localhost') {
			
			$count = count($tweets);
			
// 			$tmp = count($tweets);
			
// 			debug("tweets => ".$tmp);
			
			$count_Success = 0;
			
			$count_Failed = 0;
			
			for ($i = 0; $i < $count; $i++) {
				
	// 			debug($tweets[0]);
			
				$this->Tweet->create();
	// 			$this->TA2->create();
				
				$data = array();
				
	// 			_id				INTEGER PRIMARY KEY AUTOINCREMENT	NOT NULL,
	// 			created_at		VARCHAR(30),
	// 			modified_at		VARCHAR(30),
	// 			text			TEXT,
	// 			uploaded_at		VARCHAR(30),
	// 			twted_at		VARCHAR(30),
	// 			twt_id			INTEGER,
	// 			twt_created_at	VARCHAR(30),
				
	// 			orig_id			INT
					
				$data['Tweet']['created_at'] = $tweets[$i]['created_at'];
				$data['Tweet']['modified_at'] = $tweets[$i]['modified_at'];
				
				$data['Tweet']['text'] = $tweets[$i]['text'];
				$data['Tweet']['uploaded_at'] = $tweets[$i]['uploaded_at'];
				$data['Tweet']['twted_at'] = $tweets[$i]['twted_at'];
				$data['Tweet']['twt_id'] = $tweets[$i]['twt_id'];
				$data['Tweet']['twt_created_at'] = $tweets[$i]['twt_created_at'];
				
				$data['Tweet']['orig_id'] = $tweets[$i]['orig_id'];
				
	// 			$this->Tweet->text = $tweets[0]['text'];
				
	// 			debug($this->Tweet);
				
				if ($this->Tweet->save($data)) {
				
					$count_Success += 1;
				
				} else {
				
					$count_Failed += 1;
					
				}//if ($this->Tweet->save($data))
				
				
				
// 				$this->Tweet->save($data);
	// 			$this->Tweet->save();
	
			}//for ($i = 0; $i < $count; $i++)
			
			
			debug("saved => $count_Success / failed => $count_Failed");
			
// 			$this->TA2->
			
// 		}//$hostname != 'localhost'
		
		
	}//add_from_sqlite()
	
	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid keyword id'));
			
			return;
			
		}
	
		$keyword = $this->Keyword->findById($id);
	
		if (!$keyword) {
			throw new NotFoundException(__("Can't find the keyword. id = %d", $id));
			
			return;
			
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Keyword->delete($id)) {
			// 		if ($this->Keyword->save($this->request->data)) {
				
			$this->Session->setFlash(__("Keyword deleted => %s", $keyword['Keyword']['word']));
				
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'index'
							
					));
				
		} else {
				
			$this->Session->setFlash(
					__("Keyword can't be deleted => %s", $keyword['Keyword']['title']));
				
			// 			$page_num = _get_Page_from_Id($id - 1);
				
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'view',
							$id
					));
				
		}
	
	}//public function delete($id)
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('id => null'));
			
			return;
			
		}
	
		/****************************************
			* Keyword
		****************************************/
		$keyword = $this->Keyword->findById($id);
		
		if (!$keyword) {
			
			throw new NotFoundException(__("Keyword not found: id => ".$id));
			
			return;
			
		}
	
		if (count($this->params->data) != 0) {
				
			$this->Keyword->id = $id;
				
			$this->params->data['Keyword']['updated_at'] =
						Utils::get_CurrentTime2(CONS::$timeLabelTypes["rails"]);
				
			if ($this->Keyword->save($this->request->data)) {
	
				$this->Session->setFlash(__("Keyword has been updated: ".$id));
				
				return $this->redirect(
						array(
								'action' => 'view',
								$id));
	
			}//if ($this->Text->save($this->request->data))
				
			$this->Session->setFlash(__("Unable to update your keyword: ".$id));
				
		} else {
			
			// no param => set keyword variable
			$this->set("keyword", $keyword);
			
		}//if (count($this->params->data) != 0)
	
		if (!$this->request->data) {
			$this->request->data = $keyword;;
		}
	
	}//public function edit($id = null)
	
	public function get_keywords_mix($num = 3) {
// 	public function get_keywords_mix($num) {
		
		Utils::write_Log(
					Utils::get_dPath_Log(),
					"get_keywords_mix: num = ".$num,
					__FILE__, __LINE__);
		
		/*******************************
			get: all keywords
		*******************************/
		$keywords = $this->Keyword->find('all');
// 		$keywords = count($this->Keyword->find('all'));
		
		/*******************************
			get keywords: num
		*******************************/
		// get total number
		$total = count($keywords);

// 		debug("total => ");
		
// 		debug($total);
		
		// adjust number
		$num = ($num > $total) ? $total : $num;
		
// 		debug("num => adjusted");
		
// 		debug($num);
		
		srand(time());
		
		// id array
		$ids = array();
		
		// found
		$found = 0;
		
		while($found < $num) {
			
			$id = rand(0, $total - 1);
			
			if (!in_array($id, $ids)) {
				
				array_push($ids, $id);
				
				$found += 1;
				
			}
			
		}
		
// 		for ($i = 0; $i < $num; $i++) {
			
// 			$id = rand(0, $total - 1);
			
// 			array_push($ids, $id);
			
// 		}
		
// 		debug($ids);
		
// 		debug(time());
		
		/*******************************
			build: keywords list
		*******************************/
		$kw_selected = array();
		
		foreach ($ids as $i) {
			
			array_push($kw_selected, $keywords[$i]);
			
		}

		/*******************************
			set
		*******************************/
		$this->set('kw_selected', $kw_selected);
		
		
// 		debug($kw_selected);
		
		/*******************************
			render
		*******************************/
		$this->layout = 'plain';
		
		/*******************************
			log
		*******************************/
		Utils::write_Log(
					Utils::get_dPath_Log(),
					"get_keywords_mix => set ",
					__FILE__, __LINE__);
		
		
	}//get_keywords_mix($num = 3)
	
	public function get_keywords_mix_Main() {
		
	}
	
}//class ArticlesController extends AppController
