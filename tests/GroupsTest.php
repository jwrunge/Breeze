<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions; //Auto cleanup database changes

    //Ensure multiple group additions occur even with modifications needed
    public function test_add_and_modify_multiple_groups()
    {
        //Supply group data
        $peopledata = [
            [
                'group_id' => 1,
                'group_name' => 'Bible Study'
            ],
            [
                'group_id' => 3,
                'group_name' => 'Sunday School'
            ],
            [
                'group_id' => 5,
                'group_name' => 'Worship'
            ],
        ];

        //Post to database
        $this->json('POST', '/command/addgroupscsv', $peopledata);

        //Modify group data
        $peopledata[0] = [ 
            'group_id' => 1,
            'group_name' => 'Spaghetti Dinner' 
        ];
        array_push($people_data, [
            'group_id' => 10,
            'group_name' => 'Outreach'
        ]);

        //Post to database
        $this->json('POST', '/command/addgroupscsv', $peopledata);

        //Make sure both modified and added groups are present (Group 1 should be modified, 3 should be the same, 10 should be new)
        $this->seeInDatabase('groups', ['group_id' => 1, 'group_name' => 'Spaghetti Dinner']);
        $this->seeInDatabase('groups', ['group_id' => 3, 'group_name' => 'Sunday School']);
        $this->seeInDatabase('groups', ['group_id' => 10, 'group_name' => 'Outreach']);
    }
}
