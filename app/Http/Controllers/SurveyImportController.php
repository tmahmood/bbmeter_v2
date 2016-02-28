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
		$this->middleware('auth');
		$this->qr = new QuestionRepository;
		$this->sr = new SurveyRepository;
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

		if (property_exists($survey_data, 'reverse_order')) {
			$data = array_reverse($jobj->data);
			$later = [];
			foreach ($data as $question){
				if (array_key_exists('related_to', $question)) {
					$later[] = $question;
					continue;
				}
				$this->qr->save_question_and_options($survey, $question);
			}

			foreach ($later as $q){
				$this->qr->save_question_and_options($survey, $q);
			}
		} else {
			foreach ($jobj->data as $question){
				$this->qr->save_question_and_options($survey, $question);
			}
		}
	}

	function listAllUploadedSources()
	{
		$files = [];
		$full_path = storage_path() . '/uploads/';
		if ($handle = opendir($full_path)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					if (!is_dir($full_path . $entry)) {
						$files[] = str_replace('.json', '', $entry);
					}
				}
			}
			closedir($handle);
		}
		sort($files);
		foreach ($files as $file){
			$this->importSurveyFromJSON($file);
		}
		return $files;
	}

	function refresh()
	{
		OptionGroup::where('id', '>', 0)->delete();
		Survey::where('id', '>', 0)->delete();
		Group::where('id', '>', 0)->delete();
		$this->listAllUploadedSources();
	}

}

