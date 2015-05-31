<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use BBMeter\User;
use Bican\Roles\Models\Role;
use BBMeter\Group;
use BBMeter\Survey;
use BBMeter\SurveyType;
use BBMeter\OptionGroup;
use BBMeter\Question;
use BBMeter\Response;
use BBMeter\Option;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('UserTableSeeder');
		$this->call('SurveyGroupCreator');
		$this->call('SurveyDataSeed');
	}
}

/**
 * Class SurveyGroupCreator
 * @author Tarin Mahmood
 */
class SurveyGroupCreator extends Seeder
{
	public function run()
	{
		DB::statement("set foreign_key_checks=0");
		DB::statement("truncate survey_types");
		DB::statement("truncate groups");
		DB::statement("set foreign_key_checks=1");

		SurveyType::create([ "survey_type_name" => "Face to Face" ]);
		SurveyType::create([ "survey_type_name" => "CATSS" ]);

		$cceg = [
					[ "group_name" => "Governance" ],
					[ "group_name" => "Service Delivery" ],
					[ "group_name" => "Election", "children"  => [
								[ "group_name" => "General" ],
								[ "group_name" => "Campaign" ],
								[ "group_name" => "Candidates" ],
								[ "group_name" => "Voting Behavior" ],
								[ "group_name" => "Election Commission" ]
							]
						]
					];

		$groups = [
					[ 'group_name' => 'Poll 2015',
						'children' => [
										[ "group_name" => "Face to face",
											"children" => [
															[ "group_name" => "City Corporation", "children"  =>
																[
																	[ 'group_name' => 'Dhaka North', "children" => $cceg ],
																	[ 'group_name' => 'Dhaka South', "children" => $cceg ],
																	[ 'group_name' => 'Chittagong', "children" => $cceg ],
																]
															]
														]
													],
										[ "group_name" => "CATSS",
											"children"=> [
															[ "group_name" => "Media Habit" ] ,
															[ "group_name" => "Party Survey March 2015" ] ,
															[ "group_name" => "Party Survey February 2015" ] ,
															[ "group_name" => "Political Party and Violence" ] ,
															[ "group_name" => "Political Participation" ]
														]
													]
												]
											],
					[ 'group_name'=> 'Poll 2014',
						'children' => [
										[
											"group_name" => "DPR DEC", "children"  => [
												[ "group_name" => "Economy" ],
												[ "group_name" => "Governance" ],
												[ "group_name" => "Political Leadership" ],
												[ "group_name" => "Political Participation" ],
												[ "group_name" => "Jan 5 Election"],
												[ "group_name" => "Political Parties" ],
											],
										]
									],
								],
							];

		Group::buildTree($groups);

	}
}


class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::statement("set foreign_key_checks=0");
		DB::statement("truncate users");
		DB::statement("truncate roles");
		DB::statement("set foreign_key_checks=1");


		$usr_admin = User::create([
			'name' => 'admin',
			'email' => 'admin@bbmeter.com',
			'password' => bcrypt('@dmin p@55 for_change'),
		]);

		$usr_normal = User::create([
			'name' => 'normal',
			'email' => 'normal@bbmeter.com',
			'password' => bcrypt('normal user'),
		]);


		$role_admin = Role::create([
			'name' => 'Admin',
			'slug' => 'admin',
			'description' => 'administrative user, can create/delete users' // optional
		]);

		$role_normal = Role::create([
			'name' => 'Normal',
			'slug' => 'normal',
			'description' => 'User who can only login and see things' // optional
		]);

		$usr_admin->attachRole($role_admin);
		$usr_normal->attachRole($role_normal);
	}
}

class SurveyDataSeed extends Seeder
{
	function run()
	{
		DB::statement("set foreign_key_checks=0");
		DB::statement('truncate surveys');
		DB::statement('truncate questions');
		DB::statement('truncate responses');
		DB::statement('truncate option_groups');
		DB::statement('truncate options');
		DB::statement("set foreign_key_checks=1");

		OptionGroup::create( [ "option_group_name" => "By Gender" ]);
		OptionGroup::create( [ "option_group_name" => "By City Corporation" ]);
		OptionGroup::create( [ "option_group_name" => "By Division" ]);
		OptionGroup::create( [ "option_group_name" => "By Area" ]);
		OptionGroup::create( [ "option_group_name" => "By Age Group" ]);
		OptionGroup::create( [ "option_group_name" => "Political Parties" ]);
		OptionGroup::create( [ "option_group_name" => "Political Leaders" ]);
		OptionGroup::create( [ "option_group_name" => "Institute" ]);
		OptionGroup::create( [ "option_group_name" => "Name Recognition" ]);

		return
		$f2f = SurveyType::where("survey_type_name", "Face to Face")->firstOrFail();
		$catss = SurveyType::where("survey_type_name", "CATSS")->firstOrFail();

		$s = Survey::create([
						"survey_name" 	=> "City Poll Survey",
						"survey_name" 	=> "city_poll_survey",
						"survey_date" 	=> "2015-04-1",
						"participants"  => 1500,
						"margin_or_error" => 2.5,
						"survey_type_id"=> $f2f->id
					]);

		$dpr = Group::roots()->where('group_name', 'DPR')->first();
		$eco = $dpr->getDescendants()->where('group_name', 'Economy')->first();

		$q = Question::create( [
				"key" => "Direction in which Bangladesh is going",
				"survey_id" => $s->id,
				"group_id" => $eco->id,
				"graph_type" => 'DiscretBar',
				"guid" => $s->guid . '_' . 'direction_bangladesh'
			]);

		$data = [
			new Option([ 'label'=>"Wrong direction", 'value' => 44.1 ]),
			new Option([ 'label'=>"Neither right nor wrong", 'value' => 13.2 ]),
			new Option([ 'label'=>"Right direction", 'value' => 34.8 ]),
			new Option([ 'label'=>"Refused", 'value' => 3.7 ]),
			new Option([ 'label'=>"Don't know", 'value' => 4.3] ),
		];
		$q->options()->saveMany($data);
	}
}

