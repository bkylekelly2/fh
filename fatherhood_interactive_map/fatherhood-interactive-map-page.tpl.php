<?php

/**
 * Implementation of drupal_add_js()
 */

drupal_add_js(drupal_get_path('module', 'fatherhood_interactive_map') . '/js/scripts.js');

/**
 * Implementation of drupal_add_css()
 */

drupal_add_css(drupal_get_path('module', 'fatherhood_interactive_map') .'/css/styles.css');

//$args = arg();


$node_type = "fatherhood_programs "; // can find this on the node type's "edit" screen in the Drupal admin section.

$nodes = db_query("SELECT nid FROM {node} WHERE status = 1 AND type = :type", array(':type' => $node_type))->fetchCol();

$nodes = node_load_multiple($nodes);
$x=1;
foreach ($nodes as $node) {


  $node = objectToArray($node);

  $nid=($node['nid']);

  $title = $node['title'];
  $address = $node['field_street_address']['und'][0]['value'];
  $city = $node['field_city']['und'][0]['value'];
  $state = $node['field_state']['und'][0]['value'];
  $zipcode = $node['field_zipcode']['und'][0]['value'];
  $phone = $node['field_phone']['und'][0]['value'];
  //$body = $node['body']['und'][0]['safe_value'];
  $url = url(drupal_get_path_alias('node/' . $node['nid']));



$output .= <<<EOHTML
<div class="row" >
<div id="" class="line"></div>
<div id="" class="heading_3">
    <div id="" class="text " style="margin-bottom:15px;">
        <p><span style="color:#000000;font-weight:bold;">$x. </span><span style="color:#169BD5;font-weight:bold;">$title</span></p>
    </div>
</div>

<div id="" class="paragraph">
    <div id="" class="text ">
        <p><span>$address</span></p><p><span>$city, $state $zipcode</span></p><p><span>$phone</span></p>
    </div>
</div>

<div id="" class="label">
    <div id="" class="text ">
        <p><span>0.36 mi</span></p>
    </div>
</div>

<div id="" class="primary_button">
    <div id="" class="text ">
        <p><a href="$url"><button>View Details</button></a></p>
    </div>
</div>
</div>
EOHTML;
$x++;
}


$output .='<div id="" class="line"></div>';

?>

<div id="page" class="clearfix">
    <div class="container-fluid" id="main-content">

<section style="min-height:auto;">

    <div class="row">
        <div class="column col-left" >

            <div class="column1" >

                <div id="programLocator">

                <h2>Program Locator</h2>

                <form>

                    <input type="text" name="location"><button name="btnSearch">Search</button>
                    <div>Enter City, State or Zip</div>

                </form>

                </div>

                <div id="programLocatorparameters" style="overflow-y:hidden;">
                    <div id="programLocatorresults">10 Locations found near "Washington, DC 20012, USA"</div>
                <form>
                    <div>Show:</div><BR>
                    <div style="float:right">
                     Distance:
                        <select name="distance">
                            <option value="1">1 mile</option>
                            <option value="2">2 miles</option>
                            <option value="3">3 miles</option>
                            <option value="5">5 miles</option>
                            <option value="10">10 miles</option>
                            <option value="25">25 miles</option>
                            <option value="50">50 miles</option>
                        </select>
                    </div>
                    <input type="checkbox" name="searchType" value="state_agencies"> State Agencies<br>
                    <input type="checkbox" name="searchType" value="regional_agencies"> Regional Agencies<br>
                    <input type="checkbox" name="searchType" value="practitioners"> Practitioners<br>
                    <input type="checkbox" name="searchType" value="programs"> Programs<br>
                    <div id="programPrintAll" style="padding-right:20px;"><img src="/sites/all/modules/fatherhood_interactive_map/images/printer.png"> Print All</div>
                </form>

                    <div style="overflow-y:auto;height:350px;width:100%;">
                    <?php echo $output; ?>
                    </div>

                </div>

        </div>
            <div class="column1" style="background-color:#e5e5e5;"> column1 2


            </div>

        </div>
        <div class="column col-right" style="background-color:#bbb;">
            <h2>Column 2</h2>

        </div>
    </div>

</section>


    </div>
</div>
