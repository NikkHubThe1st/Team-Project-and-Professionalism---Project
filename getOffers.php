<?php
try {
    require_once('functions.php');
    $dbConn = getConnection();
    echo getJSONOffer($dbConn);
} catch (Exception $e) {
    echo "Error " . $e->getMessage();
}

function getJSONOffer($dbConn) {
    header("Content-Type: application/json; charset=UTF-8");

    try {
        $sql = "SELECT eventID, eventTitle, catDesc, eventPrice FROM EGN_special_offers 
                INNER JOIN EGN_categories ON EGN_special_offers.catID = EGN_categories.catID 
                ORDER BY rand() LIMIT 1";

        $rsOffer = $dbConn->query($sql);
        $offer = $rsOffer->fetchObject();
        return json_encode($offer);
    } catch (Exception $e) {
        throw new Exception("Problem: " . $e->getMessage());
    }
}
?>
