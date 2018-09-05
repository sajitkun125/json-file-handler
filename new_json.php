<?php
//This is example json file stored in php variable.
$json = '
{
    "post_type":"request",
    "id":"0001",
    "pages":[
       {
          "page_id":"1",
          "page_name":"Startseite",
          "modules":[
             {
                "module_id":"1001",
                "module_cat":"headers",
                "fields":[
                   {
                      "title":"Headline1",
                      "subheadline":"Subheadlineohyeah",
                      "fifth":[
                        {
                          "first_arg":"this is first",
                          "second_arg":"this is second"
                      }
                    ]

                   }
                ]
             },
             {
                "module_id":"1002",
                "module_cat":"headers",
                "fields":[
                   {
                      "title":"Headline2",
                      "subheadline":"Subheadline"
                   }
                ]
             },
             {
                "module_id":"1003",
                "module_cat":"footers",
                "fields":[
                   {
                      "title":"Headline 3",
                      "subheadline":"Subheadline"

                   }
                ]
             },
             {
                "module_id":"1004",
                "module_cat":"footers",
                "fields":[
                   {
                      "title":"Headline 4",
                      "subheadline":"Subheadline"

                   }
                ]
             },
             {
                "module_id":"1005",
                "module_cat":"footers",
                "fields":[
                   {
                      "title":"Headline 5",
                      "subheadline":"Subheadline"

                   }
                ]
             }
          ]
       },
       {
          "page_id":"2",
          "page_name":"Kontakt",
          "modules":[
             {
                "module_id":"1004",
                "module_cat":"headers",
                "fields":[
                   {
                      "title":"Headline 5",
                      "subheadline":"Subheadline"
                   }
                ]
             },
             {
                "module_id":"1005",
                "module_cat":"headers",
                "fields":[
                   {
                      "title":"Headline 6",
                      "subheadline":"Subheadline"
                   }
                ]
             },
             {
                "module_id":"1006",
                "module_cat":"footers",
                "fields":[
                   {
                      "title":"Headline 7",
                      "subheadline":"Subheadline"
                   }
                ]
             },
             {
                "module_id":"1007",
                "module_cat":"footers",
                "fields":[
                   {
                      "title":"Headline 8",
                      "subheadline":"Subheadline"
                   }
                ]
             }
          ]
       }
    ]
}';
/**
 * Json handler
 *
 * @package  WPScaling
 * @since 1.0
 */
//Searrch by key value function
//Eg:finds all values where page_name=Startseite
 function search_by_key_value($array, $key, $value)
{
    $results = array();
    search_r($array, $key, $value, $results);
    return $results;
}
//Meta function for search by value
function search_r($array, $key, $value, &$results)
 {
    if (!is_array($array)) {
        return;
    }

    if (isset($array[$key]) && $array[$key] == $value) {
        $results[] = $array;
    }

    foreach ($array as $subarray) {
        search_r($subarray, $key, $value, $results);
    }
}

//Function to adda to json
function add_to_json($json,$path,$value){
    $stack = array();
    $arr=explode(".",$path);
    $array=json_decode($json, true);
    // Add array into array
    print_values(sizeof($arr));
    switch(sizeof($arr)){
        case 1:
            $array[$arr[0]]= $value;
            break;
        case 2:
            $array[$arr[0]][$arr[1]]=$value;
            break;
        case 3:
            $array[$arr[0]][$arr[1]][$arr[2]]=$value;
            break;
        case 4:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]]=$value;
            break;
        case 5:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]]=$value;
            break;
        case 6:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]]=$value;
            break;
        case 7:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]]=$value;
            break;
        case 8:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]]=$value;
            break;
        case 9:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]]=$value;
            break;
        case 10:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]][$arr[9]]=$value;
        default:
            echo "Invalid input path!";
            break;
    }
    $stack=json_encode($array);
    return $stack;
}
//Function to delete from json
function delete_from_json($json,$path){
    $stack = array();
    $array=json_decode($json, true);
    unset($array['pages'][0]['modules'][0]);
    unset($array['pages'][1]['modules'][1]['fields'][0]['title']);
    $stack = array();
    $arr=explode(".",$path);
    $array=json_decode($json, true);
    // Add array into array
    print_values(sizeof($arr));
    switch(sizeof($arr)){
        case 1:
        unset($array[$arr[0]]);
            break;
        case 2:
        unset($array[$arr[0]][$arr[1]]);
            break;
        case 3:
        unset($array[$arr[0]][$arr[1]][$arr[2]]);
            break;
        case 4:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]]);
            break;
        case 5:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]]);
            break;
        case 6:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]]);
            break;
        case 7:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]]);

        case 8:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]]);
            break;
        case 9:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]]);
            break;
        case 10:
        unset($array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]][$arr[9]]);
        default:
            echo "Invalid input path!";
            break;
    }
    $stack=json_encode($array);
    return $stack;
}
//Function to update json
function update_json($json,$path,$value){
    $stack = array();
    $arr=explode(".",$path);
    $array=json_decode($json, true);
    // Add array into array
    print_values(sizeof($arr));
    switch(sizeof($arr)){
        case 1:
            $array[$arr[0]]= $value;
            break;
        case 2:
            $array[$arr[0]][$arr[1]]=$value;
            break;
        case 3:
            $array[$arr[0]][$arr[1]][$arr[2]]=$value;
            break;
        case 4:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]]=$value;
            break;
        case 5:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]]=$value;
            break;
        case 6:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]]=$value;
            break;
        case 7:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]]=$value;
            break;
        case 8:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]]=$value;
            break;
        case 9:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]]=$value;
            break;
        case 10:
            $array[$arr[0]][$arr[1]][$arr[2]][$arr[3]][$arr[4]][$arr[5]][$arr[6]][$arr[7]][$arr[8]][$arr[9]]=$value;
        default:
            echo "Invalid input path!";
            break;
    }
    print_values($array);
    $stack=json_encode($array);
    return $stack;
}
//Function to get data by depth value
//Eg:get all page_names or modules or fields.
function get_json_data_by_depth($json,$depth){

    $stack = array();
    $array=json_decode($json, true);
	foreach ($array as $key => $value) {
	    if (!is_array($value)) {
            //This is first depth
            if($depth==1){
                array_push($stack,$value);
            }
		} else {
			foreach ($value as $key => $val) {
				if (!is_array($val)) {
					//do nothing
				}else{
					foreach ($val as $keyii => $new_val){
					 	if (!is_array($new_val)) {

                            if($depth==2){
                                array_push($stack,$new_val);
                            }
                        }
                          else{
                            foreach ($new_val as $key => $new_val1) {
                                if (!is_array($new_val1)) {
                                    //do nothing
                                }else{
                                    foreach ($new_val1 as $key => $new_val2) {
                                        //This is third depth
                                        if (!is_array($new_val2)) {
                                            if($depth==3){
                                                array_push($stack,$new_val2);
                                            }
                                        }
                                        else{
                                          foreach ($new_val2 as $key => $new_val3){
                                           if (!is_array($new_val3)) {
                                               //do nothing
                                            }else{
                                                foreach($new_val3 as $key => $new_val4){
                                                    //This is fourth depth
                                                    if(!is_array($new_val4)){
                                                        if($depth==4){
                                                            array_push($stack,$new_val4);
                                                        }

                                                    }else{
                                                        foreach($new_val4 as $key => $new_val5){
                                                            if(!is_array($new_val5)){
                                                                //do nothing
                                                            }else{
                                                                foreach($new_val5 as $key => $new_val6){
                                                                    //This is fifth depth
                                                                    if(!is_array($new_val6)){
                                                                        if($depth==5){
                                                                            array_push($stack,$new_val6);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                          }
                                     }
                                    }
                                }
                            }
                        }
					}
				}
			}
		}
	}
    return $stack;
 };

//Metafunction to print values
function print_values($values){
    echo '<pre>' ;
    print_r($values);
    echo '</pre>';
}

$path="pages.0.modules.0.fields.0" ;
$value=array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

// $added_json=add_to_json($json,$path,$value);
// $variables= get_json_data_by_depth($json,3);
// $deleted_json=delete_from_json($json,$path);
// $updated_json=update_json($json,$path,$value);
$arrayis=json_decode($json,true);

function array_set_value(array &$array, $parents, $value, $glue = '.')
{
    if (!is_array($parents)) {
        $parents = explode($glue, (string) $parents);
        
    }

    $ref = &$array;
 
    foreach ($parents as $parent) {
        if (isset($ref) && !is_array($ref)) {
            $ref = array();
            
        }

        $ref = &$ref[$parent];
        print_values($ref[$parent]);
    }

    $ref = $value;
    //print_values($array);
}
//array_set_value($arrayis,$path,$value,".");


//Searrch by key value function
//Eg:finds all values where page_name=Startseite
function search_for_key($array, $key)
{
    $results = array();
    search_key_meta($array, $key, $results);
    return $results;
}
//Meta function for search by value
function search_key_meta($array, $key, &$results)
 {

    if (isset($array[$key])&&(!is_array($array[$key]))) {
        $results[] = $array[$key];
    }else{
    foreach ($array as $subarray) {
        search_key_meta($subarray, $key, $results);
        }
    }
 }


$var_t=search_for_key($arrayis,"title");
print_values($var_t);

?>
