<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * I'm putting all my controller logic in the main controller because this is going to be a small app. Ordinarily, I would extend the Controller into multiple, modular controllers.
     */

    /**
     * These functions are not meant to be called from a route; they are to be used only by other class methods
     */
    protected function add_people($people) {
        //Add people, return report
    }

    protected function add_groups($groups) {
        //Add group, return report
    }

    /**
     * These are to be accessible via the request routes
     */
    public function handle_people_csv(Request $request) {
        //Load a CSV file for people, pass to add_people
    }

    public function handle_groups_csv(Request $request) {
        //Load a CSV file for groups, pass to add_groups
    }
}
