<?php
include "gsdb_main.php";

if ($gsdb->getLoggedOnUser()) {
    $gsdb->endUserSession();
    print "You have been logged out.";

}

print " Please wait for the page to redirect ...";
header("Refresh:5; url=MainPage.php", true, 303);

?>