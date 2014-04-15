<?php

class HomeController extends BaseController {

	private function dprint($data) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}



	public function getIndex() {
		$data = Session::all();
		$this->dprint($data);

		$items = Auth::user()->items;
		return View::make('home', array(
			'items' => $items
		));
	}

	public function postIndex() {
		$id = Input::get('id');	echo $id;
		$userId = Auth::user()->id; 
		$item = Item::findOrFail($id);
		
		if ($item->owner_id == $userId) {
			$item->mark();
		}

		return Redirect::route('home');
	}

	public function getNew() {
		return View::make('new');
	}

	public function postNew() {
		$rules = array('name' => 'required|min:3|max:255');

		$validator = Validator::make(Input::all(), $rules);

		if ( $validator->fails()) {
			return Redirect::route('new')->withErrors($validator);
		}

		$item = new Item;
		$item->name = Input::get('name');
		$item->owner_id = Auth::user()->id;						//Auth::user()->id; 
		$item->save();

		return Redirect::route('home');
	}

	public function getDelete(Item $task) {

	if($task->owner_id == Auth::user()->id){
		$task->delete();
	}
		

		return Redirect::route('home');
	}

}
