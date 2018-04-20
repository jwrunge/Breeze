<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions; //Auto cleanup database changes

    //Ensure single people additions work
    public function test_single_addition_groups() {
        $groupdata = [
            'group_id' => 1,
            'group_name' => 'Bible Study'
        ];

        //Post to database
        $this->json('POST', '/command/addgroupscsv', $groupdata);

        //Make sure both modified and added people are present (person 1 should be modified, 3 should be the same, 10 should be new)
        $this->seeInDatabase('groups', ['group_id' => 1, 'group_name' => 'Bible Study']);
    }

    //Ensure multiple group additions occur even with modifications needed
    public function test_add_and_modify_multiple_groups()
    {
        //Supply group data
        $groupdata = [
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
        $this->json('POST', '/command/addgroupscsv', $groupdata);

        //Modify group data
        $groupdata[0] = [ 
            'group_id' => 1,
            'group_name' => 'Spaghetti Dinner' 
        ];
        array_push($groupdata, [
            'group_id' => 10,
            'group_name' => 'Outreach'
        ]);

        //Post to database
        $this->json('POST', '/command/addgroupscsv', $groupdata);

        //Make sure both modified and added groups are present (Group 1 should be modified, 3 should be the same, 10 should be new)
        $this->seeInDatabase('groups', ['group_id' => 1, 'group_name' => 'Spaghetti Dinner']);
        $this->seeInDatabase('groups', ['group_id' => 3, 'group_name' => 'Sunday School']);
        $this->seeInDatabase('groups', ['group_id' => 10, 'group_name' => 'Outreach']);
    }
}
