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
 * Search function by key and values. parameters: @jsonfile , @key and @value
 * @package  WPScaling
 * @since 1.0
 */
//Searrch by key value function
//Eg:finds all values where page_name=Startseite 
 function search_by_key_value($json, $key, $value)
{
    $array=json_decode($json, true);
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
      //Check for required result       
    if (isset($array[$key]) && $array[$key] == $value) {
        $results[] = $array;
    }
             
    foreach ($array as $subarray) {
        //Function is called recursively
        search_r($subarray, $key, $value, $results);
    }
}
 
//Metafunction to print values
function print_values($values){
    echo '<pre>' ;
    print_r($values);
    echo '</pre>';  
}
/**
 * function to add values to json file. parameters: @jsonfile , @path to add , @value to be added
 * @package  WPScaling
 * @since 1.0
 */
//Add values to json 
function add_to_json($json,$path,$value){
    $array=json_decode($json, true);
    array_set_value($array,$path,$value,".");
    //print_values($array);
    $stack=array();
    $stack=json_encode($array);
    print_values($array);
    return $stack;
}
//Meta function for setting values
function array_set_value(array &$array, $parents, $value, $glue = '.')
{
    if (!is_array($parents)) {
        $parents = explode($glue, (string) $parents);
    }
    //reference to array set
    $ref = &$array;
    foreach ($parents as $parent) {        
        if (isset($ref) && !is_array($ref)) {
            $ref = array();
        }
        //reference set to required position    
        $ref = &$ref[$parent];
    }
    //value of reference updated
    $ref = $value;
}
/**
 * function to Delete values from json file. parameters: @jsonfile , @path to delete from
 * @package  WPScaling
 * @since 1.0
 */
function delete_from_json($json,$path){
    $array=json_decode($json, true);
    array_unset_value($array,$path,".");
    $stack=array();
    $stack=json_encode($array);
    //print_values($array);
    return $stack;
}
//Meta function for delete 
function array_unset_value(&$array, $parents, $glue = '.')
{
    if (!is_array($parents)) {
        $parents = explode($glue, $parents);
    }
    //removes first value and returns the array    
    $key = array_shift($parents);
    if (empty($parents)) {
        unset($array[$key]);
    } else {
        //recursive call 
        array_unset_value($array[$key], $parents);
    }
}
/**
 * Function to get values form json. parameters: @jsonfile , @path to get values from
 * @package  WPScaling
 * @since 1.0
 */
function get_value_from_json($json,$path){
    $array=json_decode($json, true);
    $return_value=array_get_value($array,$path,".");
    //print_values($array);
    return $return_value;
}
//Meta function for get values
function array_get_value(array &$array, $parents, $glue = '.')
{
    if (!is_array($parents)) {
        $parents = explode($glue, $parents);
    }
    //reference is set
    $ref = &$array;
    foreach ((array) $parents as $parent) {
        if (is_array($ref) && array_key_exists($parent, $ref)) {
            $ref = &$ref[$parent];
        } else {
            return null;
        }
    }
    return $ref;
}
/**
 * Searrch by key function. parameters: @jsonfile , @key to get values from
 * Display values within a single nest or depth eg: pages , or title key values
 * Eg:
 * @package  WPScaling
 * @since 1.0
 */
function search_by_key($json, $key)
{
    $array=json_decode($json,true);
    $results = array();
    search_key_meta($array, $key, $results);
    return $results;
}
//Meta function for search by key
function search_key_meta($array, $key, &$results)
 {
    if (isset($array[$key])){
        if(!is_array($array[$key])){
            $results[$key] = $array[$key] ;
        }else{
            foreach($array[$key] as $nested_in){
                if(!is_array($nested_in)){
                    //donothing
                }else{
                    foreach($nested_in as $valz){
                        if(!is_array($valz)){
                           $results[]=$valz;
                        }
                    }
                }
            }
           // $results[] = $array;
        }
    }else{
    foreach ($array as $subarray) {
        search_key_meta($subarray, $key, $results);
        }
    }
 }
//path values
$path="pages.0.modules.0.fields.0.title" ;
//test values for functions
//$value=array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
//$value="some string"; 
//uncomment to use the functions
//$return_Value=add_to_json($json,$path,$value);
//delete_from_json($json,$path,".");
//$vale_retur=get_value_from_json($json,$path);
//print_values($vale_retur);
//print_values(search_by_key_value($json,"module_id","1005"));
//$var_t=search_by_key($json,"fields");
//var_dump($var_t);
//exit();
?>
