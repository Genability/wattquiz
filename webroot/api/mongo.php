<?
/** include the Genability PHP Library */
// MIHLE: make sure to mongo.so in the right directory and add 'extension=mongo.so' to PHP.ini file located in /etc
/**  phpinfo();  **/

// assumes connection to local database 
$m = new Mongo();

// select a database
$db = $m->wattquiz;

// select a collection (analogous to a relational database's table)
$collection = $db->questions;

// add a record 
$obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
$collection->insert($obj);

// add another record, with a different "shape"
$obj = array( "title" => "XKCD", "online" => true );
$collection->insert($obj);

// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $obj) {
    echo $obj["title"] . "\n";
}


?>


