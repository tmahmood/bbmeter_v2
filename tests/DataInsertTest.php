<?php

class DataInsertTest extends TestCase {

	public function testInsertJSONData()
	{
		$response = $this->call('GET', 'admin/import/json/dec_2014_proper');

	}

}
