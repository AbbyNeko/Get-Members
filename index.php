<?php

//Grabbed data from URL
$senateMembers = simplexml_load_file("https://www.senate.gov/general/contact_information/senators_cfm.xml");

//array of full state names to respective state abbreviations
$states = array(
    "AL"=> "Alabama",
    "AK"=> "Alaska",
    "AS"=> "American Samoa",
    "AZ"=> "Arizona",
    "AR"=> "Arkansas",
    "CA"=> "California",
    "CO"=> "Colorado",
    "CT"=> "Connecticut",
    "DE"=> "Delaware",
    "DC"=> "District Of Columbia",
    "FM"=> "Federated States Of Micronesia",
    "FL"=> "Florida",
    "GA"=> "Georgia",
    "GU"=> "Guam",
    "HI"=> "Hawaii",
    "ID"=> "Idaho",
    "IL"=> "Illinois",
    "IN"=> "Indiana",
    "IA"=> "Iowa",
    "KS"=> "Kansas",
    "KY"=> "Kentucky",
    "LA"=> "Louisiana",
    "ME"=> "Maine",
    "MH"=> "Marshall Islands",
    "MD"=> "Maryland",
    "MA"=> "Massachusetts",
    "MI"=> "Michigan",
    "MN"=> "Minnesota",
    "MS"=> "Mississippi",
    "MO"=> "Missouri",
    "MT"=> "Montana",
    "NE"=> "Nebraska",
    "NV"=> "Nevada",
    "NH"=> "New Hampshire",
    "NJ"=> "New Jersey",
    "NM"=> "New Mexico",
    "NY"=> "New York",
    "NC"=> "North Carolina",
    "ND"=> "North Dakota",
    "MP"=> "Northern Mariana Islands",
    "OH"=> "Ohio",
    "OK"=> "Oklahoma",
    "OR"=> "Oregon",
    "PW"=> "Palau",
    "PA"=> "Pennsylvania",
    "PR"=> "Puerto Rico",
    "RI"=> "Rhode Island",
    "SC"=> "South Carolina",
    "SD"=> "South Dakota",
    "TN"=> "Tennessee",
    "TX"=> "Texas",
    "UT"=> "Utah",
    "VT"=> "Vermont",
    "VI"=> "Virgin Islands",
    "VA"=> "Virginia",
    "WA"=> "Washington",
    "WV"=> "West Virginia",
    "WI"=> "Wisconsin",
    "WY"=> "Wyoming"
);

$pastFirst = false;

foreach($senateMembers->children() as $member) {

    try {

        /*
        $state = $member->state;
        //get full state name
        $stateName = $states[strval($state)];

        if(isset($member->address)) {

            $fullAddress = $member->address;
            $splitAddress = explode(strval($stateName), strval($fullAddress));
            $street = $splitAddress[0];

            $cityZipSplit = explode(' ', strval($splitAddress[1]));
            $city = $cityZipSplit[0];
            $zip = $cityZipSplit[1];

        }
        */

        $firstName = strval($member->first_name);
        $lastName = strval($member->last_name);
        $fullName = strval($member->member_full);
        $chartId = strval($member->bioguide_id);
        $phone = strval($member->phone);


        $memberArr[] = array(
            'firstName'=>$firstName, 
            'lastName'=>$lastName,
            'fullName'=>$fullName,
            'chartId'=>$chartId,
            'mobile'=>$phone
        );


    } catch(Exception $e) {
        throw $e;
    }
}

$memberJSON = json_encode($memberArr);

echo $memberJSON;


?>