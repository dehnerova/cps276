<!-- Database Connection Function -->
<?php

$db = null;

// If you cannot connect to your local mysql,
// set $remoteDatabase = 'CPS276', and it will query the instructors database instead 
$remoteDatabase = null;
 
function getPDO($selectedDatabase) {
    global $db;
    if ($db != null) {
        return $db;
    }
    try {
        // This is the instructors connection string.
        // Substitute your own string if you wish to connect to your database.
        $db = new PDO('mysql:host=localhost;port=3306;dbname=CPS276','robreem','gR$$n810RR');
//        $db = new PDO('mysql:host=localhost;port=3306;dbname=CPS276','dandrew1','1234');
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
        return $db;
    }
    catch (Exception $e2) {
        echo('DB Connection Error - ' . $e2->getMessage());
        exit();
    }
}

function execute($sql,$returnResults=true,$bindingValues=null,$selectedDatabase = 'CPS276') {
// Uncomment the following when debugging your sql
//echo($sql . '<br>');    
//if ($bindingValues != null) {
//    var_dump($bindingValues);
//}
    global $remoteDatabase;
    if (!empty($remoteDatabase)) {
        return remoteExecute($sql,$returnResults,$bindingValues);
    }
    $db = getPDO($selectedDatabase);
    try {
        $statement = $db->prepare($sql);
        if (!$statement) {
            echo('DB Prepare Error - ' . $sql);
            exit();
        }
        if ($statement===false) {
            echo('DB Prepare Error - ' . $sql);
            exit();
        }
        if ($bindingValues != null) {
            for ($counter=0; $counter < sizeof($bindingValues); $counter++) {
                $statement->bindParam($counter + 1, $bindingValues[$counter]);
            }
        }
        $statement->execute();
        $results = array();
        if ($returnResults) {
            $results = $statement->fetchAll();
        }
        $statement->closeCursor();
        return $results;
    }
    catch (Throwable $e2) {
        echo('DB Error - ' . $sql);
        echo('<br>' . $e2->getMessage());
        exit();
    }
}

function remoteExecute($sql,$returnResults=true,$bindingValues=null) {
    global $remoteDatabase;
    $returnResults = !!$returnResults;
    $params['query'] = $sql;
    $params['db'] = $remoteDatabase;
    $params['returnResults'] = $returnResults ? 1 : 0;
    if (!empty($bindingValues)) {
        $params['binding'] = $bindingValues;
    }
    $params = json_encode($params);
    $params = base64_encode($params);
    $url = 'http://161.35.120.113/CPS276/shared/api.php?params=' . $params;
    $results = @file_get_contents($url);
    $results = @base64_decode($results);
    $results = @json_decode($results,true);        
    return $results;
}
