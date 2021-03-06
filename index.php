<?php
//sets content type to JSON
header('Content-Type: application/json');

//Grabbed data from URL
$senateMembers = simplexml_load_file("https://www.senate.gov/general/contact_information/senators_cfm.xml");

//searching for the state part of the address using the state list and returning state abbreviation
function getState($fullAddress) {

    //array of full state names to respective state abbreviations
    $states = array(
        "AL",
        "AK",
        "AS",
        "AZ",
        "AR",
        "CA",
        "CO",
        "CT",
        "DE",
        "DC",
        "FM",
        "FL",
        "GA",
        "GU",
        "HI",
        "ID",
        "IL",
        "IN",
        "IA",
        "KS",
        "KY",
        "LA",
        "ME",
        "MH",
        "MD",
        "MA",
        "MI",
        "MN",
        "MS",
        "MO",
        "MT",
        "NE",
        "NV",
        "NH",
        "NJ",
        "NM",
        "NY",
        "NC",
        "ND",
        "MP",
        "OH",
        "OK",
        "OR",
        "PW",
        "PA",
        "PR",
        "RI",
        "SC",
        "SD",
        "TN",
        "TX",
        "UT",
        "VT",
        "VI",
        "VA",
        "WA",
        "WV",
        "WI",
        "WY"
    );

    foreach($states as $state) {
        $stateMatch = preg_match('/('.strval($state).')/', $fullAddress);
        if($stateMatch){
            return strval($state);
            break;
        }
    }

}

//Loops through each XML node and creates an object in an array for each member
foreach($senateMembers->children() as $member) {

    try {

        
        $state = strval($member->state);
        $addrObj = "";

        if(isset($member->address)) {

            $fullAddress = strval($member->address);

            //searching for the state part of the address using the state list
            $stateName = getState($fullAddress);

            //split address string before state to get city
            $splitAddr1 = explode($stateName, $fullAddress);
            $firstPart = trim($splitAddr1[0]);
            //get last word from first part of address
            $city = end(explode(' ', $firstPart));

            //splitting address by city and state to locate street and zip
            $splitAddr2 = explode($city, $fullAddress);
            $splitAddr3 = explode($stateName, $fullAddress);

            $street = $splitAddr2[0];
            $zip = $splitAddr3[1];

            $addrObj = array(
                "street"=>trim($street),
                "state"=>$stateName,
                "city"=>$city,
                "postal"=>trim($zip)
            );

        }

        //print_r($addrObj);

        $firstName = strval($member->first_name);
        $lastName = strval($member->last_name);
        $fullName = $firstName.' '.$lastName;
        $chartId = strval($member->bioguide_id);
        $phone = strval($member->phone);
        $address = $addrObj;

        $memberArr[] = array(
            "firstName"=>$firstName, 
            "lastName"=>$lastName,
            "fullName"=>$fullName,
            "chartId"=>$chartId,
            "mobile"=>$phone,
            "address"=>$addrObj
        );

    } catch(Exception $e) {
        throw $e;
    }
}

$memberJSON = json_encode($memberArr, JSON_PRETTY_PRINT);

//prints JSON to screen
echo $memberJSON;

?>