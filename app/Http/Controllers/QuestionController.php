<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;
use BBMeter\Group;
use BBMeter\Survey;
use BBMeter\Repositories\GroupRepository;
use BBMeter\Repositories\QuestionRepository;

class QuestionController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create(GroupRepository $gr)
	{
		$groups = $gr->toHierarchy();
		$tree = $gr->make_nice_tree($groups, "");
		return view('questions.form')->withGroups($tree);
	}


	function save(GroupRepository $gr, QuestionRepository $qr)
	{
		$fields = Request::except([ '_token', 'graph_data' ]);

		$graph_data = explode("\n", trim(Request::input('graph_data')));
		$lines = [];
		$survey = Survey::find($fields['survey_id']);
		$fields['guid'] = $survey['survey_guid'] . '_' . $fields['guid'];


		foreach ($graph_data as $line){
			$_line = trim($line);
			$_line = trim($_line, ",");
			$lines[] = str_getcsv($_line);
		}

		//$qr->save($fields);

		$fields['values'] = [];

		if ($qr->is_grouped_types($fields['graph_type'])) {

			$fields['values']['categories'] = array_shift($lines);

			foreach ($lines as $line){
				$d = array_shift($line);
				$_l = array_map(function($v) {
					return trim($v, '%');
				}, $line);
				$fields['values']['data'][] = [ 'name'=> $d, 'data'=> $_l ];
			}
		}

		dd ($fields);

		if (Question::create($fields) !== null) {
			redirect(url('/admin/survey/create'))
				->withMessage("New Survey Created");
		}
	}

	function parse_category_data($data)
	{
		$categories = array_shift ($data);
	}

}

