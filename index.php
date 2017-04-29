<?php 
/*
| A page on a site was needed to display information about a video. It should be able to display the video's title, its HTML description, and a link to the page 
| itself for sharing.A developer wrote this piece of code to do the job and review is needed.
| What do you think? Are there any obvious issues? Would you write it differently?
| Please rewrite it to meet your standards.
 */

// Code analysis

mysql_connect('localhost', 'root', ''); 
mysql_select_db('mydatabase');

/*
|  The mysql extension is deprecated,instead mysql need to use mysqli or PDO.I recomend PDO . Second - we would want to abstract creating the connection, so we    
|  have a  central location to manage it, and  likely also keep the credentials  in a separate file. 
|  Here we don't have error managment, what if we cant't conect on database.
 */

$id = $_GET['id'];
$query = mysql_query("SELECT * FROM videos WHERE id='" . $id . "'");
while ($video = mysql_fetch_assoc($query)) {

/*  
|   My opinion is better return object then array, becouse:   
|   Objects not only contain data but also functionality.
|   Objects have (in most cases) a predefined structure. This is very useful for API design. We also can set properties as public, protected, or private.
|   Objects better fit in object oriented development.
|   Here we don't need while loop. We only return one row from the table, and you don't have closing bracket   
 */


echo '<h3>' . $video['title'] . '</h3>';
echo $video['description'];
echo 'You are viewing <a href="' . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] . '">This video</a>';

// instead to use Superglobal directly, I will make constant in config file


/*

###########################################################################################################

My Code 

*/

require_once('config/config.php');

try {
// error handling	

if(!isset($_GET['id']) or $_GET['id'] == '') throw new Exception('Id not set or Id empty');
// if we don't have id

$id = $_GET['id'];

$pdo= new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
	
// abstract creating the connection, on this way I can always change credentials in separate file, and not touch my code here

$sql= " SELECT * from videos WHERE  id=:id";

// I am using Prepared statement, becouse is the only proper and safty way to run a query, if any variable is going to be used in it

    $query = $pdo->prepare($sql);

    $query->bindParam(':id', $id, PDO::PARAM_INT); 
    
    $query->execute();

    $result = $query->fetchObject();

    // return object

   // var_dump($result);

 // I am using only for debuing mode The var_dump() function to display structured information   
	
} catch (Exception $e) {
	
	echo $e->getMessage();
	
	// error reporting displaying and stop scripting
}

?>
<!DOCTYPE html>
<html>
<head></head>
<body>
	<?php if(isset($result) && $result): ?>
        <ul>
        	<li><?php echo $result->title; ?></li>
        	<li><?php echo $result->description;  ?></li>
        	<li><?php echo 'You are viewing <a href="' . _WEB_PATH . '?id=' . $result->id . '">This video</a>'; ?></li>
			
        </ul>
	<?php endif;?>
</body>
</html>





