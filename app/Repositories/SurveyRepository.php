<?php namespace BBMeter\Repositories;

use BBMeter\Repositories\BaseRepositoryInterface;
use BBMeter\Survey;
use BBMeter\SurveyType;
use BBMeter\Group;

/**
 * Class QuestionRepository
 * @author Tarin Mahmood
 */
class SurveyRepository implements BaseRepositoryInterface
{
	public function all()
	{
		return Survey::all();
	}


	function latest()
	{
		return Survey::orderBy('id', 'desc')->firstOrFail();
	}

	function find($id)
	{
		return Survey::find($id);
	}

	function save($data)
	{
		return Survey::create($data);
	}

	public function get_by($by, $val)
	{
		return Survey::where($by, $val)->firstOrFail();
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


