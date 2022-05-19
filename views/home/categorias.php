


<?php print_list($viewmodel);?>


<?php function print_list($viewmodel, $parent=0) {
    print "<ul>";
    foreach ($viewmodel as $row) {
        if ($row['IdPad'] == $parent) {

            print "<li>";         
            print "<a class=";
            print "btn ";
            print "href=";
            print ROOT_PATH;;
            print "shares/recursocat/";
            print $row['IdCat'];
            print " role=";
            print "button";
            print ">";
            print $row['NomCat'];
            print "</a>";
            print_list($viewmodel, $row['IdCat']);  #recursividad        
            print "</li>";
        }
    }
    print "</ul>";
}?>



