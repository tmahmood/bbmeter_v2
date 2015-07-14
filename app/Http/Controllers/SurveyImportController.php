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
use BBMeter\Repositories\QuestionRepository;
use BBMeter\Repositories\SurveyRepository;

class SurveyImportController extends Controller {

	public function __construct()
	{
		$this->qr = new QuestionRepository;
		$this->sr = new SurveyRepository;
		$this->middleware('auth');
	}

	public function importSurveyFromCSV($filename)
	{
		$fpath = storage_path() . "/uploads/$filename.csv";

		$fp = fopen($fpath, 'r');
		$survey_data = fgetcsv($fp);
		$survey = $this->sr->save_survey($survey_data);

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
		$survey = $this->sr->save_survey([
			$survey_data->scope,
			$survey_data->participants,
			$survey_data->info,
			$survey_data->moe,
			$survey_data->date,
			$survey_data->survey_type,
			$survey_data->write_path
		]);

		foreach ($jobj->data as $question){
			$this->qr->save_question_and_options($survey, $question);
		}
	}


}

