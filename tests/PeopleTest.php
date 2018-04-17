<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PeopleTest extends TestCase
{
    use DatabaseTransactions; //Auto cleanup database changes

    //Ensure multiple people additions occur even with modifications needed
    public function test_add_and_modify_multiple_people()
    {
        //Supply people data
        $peopledata = [
            [
                'person_id' => 1,
                'first_name' => 'Jake',
                'last_name' => 'Runge',
                'email_address' => 'jwrunge@gmail.com',
            ],
            [
                'person_id' => 3,
                'first_name' => 'Mary',
                'last_name' => 'Runge',
                'email_address' => 'maryrunge@gmail.com',
            ],
            [
                'person_id' => 5,
                'first_name' => 'Lucky',
                'last_name' => 'Runge',
                'email_address' => 'luckyrunge@gmail.com',
            ]
        ];

        //Post to database
        $this->json('POST', '/command/addpeoplecsv', $peopledata);

        //Modify people data
        $peopledata[0] = [
            'person_id' => 1,
            'first_name' => 'NOT_Jake',
            'last_name' => 'Runge',
            'email_address' => 'jwrunge@gmail.com',
        ];

        array_push($people_data, [
            'person_id' => 10,
            'first_name' => 'Max',
            'last_name' => 'Runge',
            'email_address' => 'maxrunge@gmail.com',
        ]);

        //Post to database again
        $this->json('POST', '/command/addpeoplecsv', $peopledata);

        //Make sure both modified and added people are present (person 1 should be modified, 3 should be the same, 10 should be new)
        $this->seeInDatabase('people', ['person_id' => 1, 'first_name' => 'NOT_Jake']);
        $this->seeInDatabase('people', ['person_id' => 3, 'first_name' => 'Mary']);
        $this->seeInDatabase('people', ['person_id' => 10, 'first_name' => 'Max']);
    }
}
