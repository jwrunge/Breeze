<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request as Request;
use League\Csv\Reader as Reader;
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
        //If it's a single entry, add or update
        if(array_key_exists('person_id', $people)) {
            \App\People::updateOrCreate(['person_id' => $people['person_id']], $people);
        }
        //If multiple entries, iterate
        else {
            foreach($people as $person) {
                //If it's clearly person data, add or update
                if(array_key_exists('person_id', $person) && array_key_exists('first_name', $person) && array_key_exists('last_name', $person)) {
                    \App\People::updateOrCreate(['person_id' => $person['person_id']], $person);
                }
                //Otherwise, fail gracefully
                else {
                    abort(400, "Sorry--we can't process that request. To add a person, you need at minimum to supply a person_id, first_name, and last_name field.");
                }
            }
        }
    }

    protected function add_groups($groups) {
        //If exists, add or update
        if(array_key_exists('group_id', $groups)) {
            \App\Group::updateOrCreate(['group_id' => $groups['group_id']], $groups);
        }
        //Otherwise, iterate
        else {
            foreach($groups as $group) {
                //If it's clearly group data, add or update
                if(array_key_exists('group_id', $group) && array_key_exists('group_name', $group)) {
                    \App\Group::updateOrCreate(['group_id' => $group['group_id']], $group);
                }
                //Otherwise, fail gracefully
                else {
                    abort(400, "Sorry--we can't process that request. To add a group, you need at minimum to supply a group_id and group_name field.");
                }
            }
        }
    }

    /**
     * These are to be accessible via the request routes
     */
    public function handle_people_csv(Request $request) {
        //If a CSV file was loaded
        if($request->hasFile('people_csv')) {

            //check file validity
            if($request->file('people_csv')->getMimeType() != 'text/csv' && $request->file('people_csv')->getMimeType() != 'text/plain')
                abort('400', 'Sorry--you can only upload CSV files! No other file type is yet supported.');

            //Parse CSV
            $csv = Reader::createFromPath($request->file('people_csv')->path(), 'r');
            $csv->setHeaderOffset(0);
            $this->add_people($csv);
        }
        else {
            $this->add_people($request->all());
        }

        return redirect('/people');
    }

    public function handle_groups_csv(Request $request) {
        //If a CSV file was loaded
        if($request->hasFile('group_csv')) {

            //check file validity
            if($request->file('group_csv')->getMimeType() !== 'text/csv' && $request->file('group_csv')->getMimeType() !== 'text/plain')
                abort(400, 'Sorry--you can only upload CSV files! No other file type is yet supported.');

            //Parse CSV
            $csv = Reader::createFromPath($request->file('group_csv')->path(), 'r');
            $csv->setHeaderOffset(0);
            $this->add_groups($csv);
        }
        else {
            $this->add_groups($request->all());
        }

        return redirect('/groups');
    }

    public function searchdb(Request $request) {
        //Set ascending/descending
        $sortorder = '';
        if($request->input('sortorder'))
            $sortorder = $request->input('sortorder');
        else
            $sortorder = 'asc';

        if($request->input('search') === 'people') {
            //Set order for search
            $orderby = '';
            if($request->input('orderedby')) 
                $orderby = $request->input('orderedby');
            else
                $orderby = 'person_id';

            //Get results by matching search string
            $results = \App\People::where('first_name', 'like', '%'.$request->input('value').'%')
                ->orWhere('last_name', 'like', '%'.$request->input('value').'%')
                ->orWhere('person_id', 'like', '%'.$request->input('value').'%')
                ->orWhere(\DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'like', '%'.$request->input('value').'%')
                ->orWhere(\DB::raw("CONCAT_WS(', ', last_name, first_name)"), 'like', '%'.$request->input('value').'%')
                ->orWhere('email_address', 'like', '%'.$request->input('value').'%')
                ->take(25)->orderBy($orderby, $sortorder)->get();

            $html = '';
            foreach($results as $result) {
                //Get group name
                $group_affiliation = '';
                if(isset($result->group))
                    $group_affiliation = $result->group->group_name;
                else
                    $group_affiliation = 'none';

                //Load html response
                $html .= "<tr><td>"
                    .$result->person_id
                    ."</td><td>".$result->last_name.", ".$result->first_name
                    ."</td><td>".$result->email_address
                    ."</td><td>".$group_affiliation
                    ."</td><td>".$result->state."</td></tr>";
            }
        }

        else if($request->input('search') === 'group') {
            //Set order for search
            $orderby = '';
            if($request->input('orderedby')) 
                $orderby = $request->input('orderedby');
            else
                $orderby = 'group_id';

            //Get results by matching search string
            $results = \App\Group::where('group_name', 'like', '%'.$request->input('value').'%')
                ->orWhere('group_id', 'like', '%'.$request->input('value').'%')
                ->take(25)->orderBy($orderby, $sortorder)->get();

            $html = '';
            foreach($results as $result) {
                $membercount = 0;
                if(isset($result->members))
                    $membercount = count($result->members);

                //Load html response
                $html .= "<tr><td>"
                    .$result->group_id
                    ."</td><td>".$result->group_name
                    ."</td><td>".$membercount."</td></tr>";
            }
        }

        return $html;
    }
}
