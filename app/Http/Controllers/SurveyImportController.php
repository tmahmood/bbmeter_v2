<?php namespace BBMeter\Http\Controllers;

use Request;
use Storage;

use BBMeter\Survey;
use BBMeter\SurveyType;
use BBMeter\Question;
use BBMeter\Group;
use BBMeter\Option;
use BBMeter\OptionGroup;
use BBMeter\Response;

class SurveyImportController extends Controller {
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function importSurveyFromCSV($filename)
	{
		$fpath = storage_path() . "/uploads/$filename.csv";

		$fp = fopen($fpath, 'r');
		$survey_data = fgetcsv($fp);
		$survey = $this->save_survey($survey_data);

		fgetcsv($fp); // empty line

		while ($line = fgetcsv($fp) !== false) {
			new Question([ 'key' => $line ]);
		}

		fclose($logfp);
	}

	function importSurveyFromJSON($filename)
	{
		$fpath = storage_path() . "/uploads/$filename.json";
		$jobj = json_decode(file_get_contents($fpath));

		if (json_last_error() != JSON_ERROR_NONE) {
			dd(json_last_error_msg());
		}

		$survey_data = $jobj->meta;
		$survey = $this->save_survey([
			$survey_data->scope,
			$survey_data->participants,
			$survey_data->info,
			$survey_data->moe,
			$survey_data->date,
			$survey_data->survey_type,
			$survey_data->write_path
		]);

		foreach ($jobj->data as $question){
			$this->save_question_and_options($survey, $question);
		}
	}

	function save_question($survey, $question)
	{
		$group = $this->find_question_group($question->group);
		$q = Question::create([
				'key' => $question->key,
				'survey_id' => $survey->id,
				'group_id' => $group->id,
				'graph_type' => $question->type,
				'guid' => $survey->survey_guid . '_' . $question->filename,
		]);
		return $q;
	}


	function save_question_and_options($survey, $question)
	{
		if (!in_array($question->type, [ 'GroupedMultiBar', 'SimpleLine' ])) {

			$q = $this->save_question($survey, $question);
			$vals = [];

			foreach ($question->values as $value){
				$vals[] = new Option((array)$value);
			}
			return $q->options()->saveMany($vals);

		} else {

			if(!array_key_exists('related_to', $question)) {
				$q = $this->save_question($survey, $question);
				$vals = [];
				foreach ($question->values->data as $value){
					$vals[] = new Option([ "label"=> $value->name ]);
				}
				$q->options()->saveMany($vals);
			}

		}

		if (!isset($q) or $q == null) {
			$q = Question::where('guid', $survey->survey_guid . "_" . $question->related_to)->firstOrFail();
		}

		$option_group = OptionGroup::where("option_group_name", $question->option_group)->firstOrFail();

		foreach ($question->values->data as $data){

			$option = Option::where('question_id', $q->id)
								->where('label', $data->name)
								->firstOrFail();
			$responses = [];
			foreach ($question->values->categories as $idx => $category){
					$responses[] = new Response([
										"label" => $category,
										"value" => $data->data[$idx],
										"option_group_id" => $option_group->id
									]);
			}

			$option->responses()->saveMany($responses);
			$q->has_crosstabs = 1;
			$q->save();
		}
	}

	function find_question_group($group)
	{
		$groups = explode('/', $group);
		$root = Group::roots()->where('group_name', array_shift($groups))->first();
		foreach ($groups as $group){
			$root = $root->getDescendants()->where('group_name', $group)->first();
		}
		return $root;
	}

	function save_survey($survey_data)
	{
		$surveys = Survey::where('survey_guid', $survey_data[6])->get();

		if (count($surveys) == 1) {
			return $surveys->first();
		}

		$survey_type = SurveyType::where("survey_type_name", $survey_data[5])->firstOrFail();

		return Survey::create([
			'survey_name' => $survey_data[0],
			'participants' => $survey_data[1],
			'margin_or_error' => $survey_data[3],
			'survey_date' => $survey_data[4],
			'survey_type_id'=> $survey_type->id,
			'survey_guid'=> $survey_data[6]
		]);
	}
}

