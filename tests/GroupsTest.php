<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    use DatabaseTransactions; //Auto cleanup database changes

    //Ensure multiple people additions occur even with modifications needed
    public function test_add_and_modify_multiple_people()
    {
        //Supply people data

        //Post to database

        //Modify people data

        //Post to database again

        //Make sure both modified and added people are present
        
    }
}
