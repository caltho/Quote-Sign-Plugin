<?php
/*
 * Template Name: New Quote
 * description: >-
  Page template without sidebar
 */

//get_header();

//HEADER END

 //$user_id = get_current_user_id();

 //Initialise $wpdb method
 global $wpdb;

    //in case you need a reminder of the db prefix
    //echo global $wpdb;
    // echo $wpdb->base_prefix

    //This will print out all the database names
    /*$mytables=$wpdb->get_results("SHOW TABLES");
        foreach ($mytables as $mytable)
        {
            foreach ($mytable as $t) 
            {       
                echo $t . "<br>";
            }
        }*/
    $table_name = $wpdb->prefix . 'quotes';

foreach ( $wpdb->get_col( "DESC " . $table_name, 0 ) as $column_name ) {
  echo $column_name . "\n \n";
}

    /* Show data in table */
    $quotes = $wpdb->get_results("SELECT * 
    FROM " . $wpdb->prefix . 'quotes');
    //print_r($result);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Quotes</title>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



  <div class="container">
        <div class="form-group">
            <div class="col-md-6">
                <h2>Upload New Quote</h2>
                <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                    <label for="quoteName">Quote Name</label>
                    <input class="form-control" id="quoteName" type="text" name="quoteName" value="">
                    <label for="clientName">Client Name (Addressee)</label>
                    <input class="form-control" id="clientName" type="text" name="clientName" value="">
                    <label for="clientEmail">Client Email</label>
                    <input class="form-control" id="clientEmail" type="text" name="clientEmail" value="">
                    <label for="amberContact">Amber Contact</label>
                    <select class="form-control" id="amberContact" type="text" name="amberContact" value="">
                        <option value="Mike Willson" selected>Mike Willson</option>
                        <option value="Callum Thomas">Callum Thomas</option>
                    </select>
                    <select class="form-control" id="amberEmail" type="text" name="amberEmail" value="">
                        <option value="mike@amberorg.com.au" selected>mike@amberorg.com.au</option>
                        <option value="cthomas@amberorg.com.au">cthomas@amberorg.com.au</option>
                    </select>
                    <label for="validUntil">Valid Until:</label>
                    <input class="form-control" type="date" id="start" name="validUntil" value="2022-01-01" min="2022-01-01" max="2025-01-01">
                    <label for="docs">Upload Quote (*.pdf)</label>
                    <input class="form-control" id="docs" type="file" name="doc">
                    <label for="feeValue">Value ($)</label>
                    <input class="form-control" id="feeValue" type="text" name="feeValue" value="">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>

        <div id="quotestable">
            <h2>All Quotes</h2>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">URL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Client</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Issued By</th>
                        <th scope="col">File</th>
                        <th scope="col">Price</th>
                        <th scope="col">Expires</th>
                        <th scope="col">Viewed</th>
                        <th scope="col">Signee</th>
                        <th scope="col">Date</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Company</th>
                        <th scope="col">Address</th>


                    </tr>
                </thead>
                <tbody>
            <?php    

            foreach($quotes as $row) {
                echo '<tr><td>'.$row->quote_id.'</td>';
                echo "<th scope='row'><a href='https://amberorg.com.au/sign-quote/?id=" . $row->quote_url. "'>" .$row->quote_url." </a></th>";
                echo '<td>'.$row->quoteName.'</td>';
                echo '<td>'.$row->clientName.'</td>';
                echo '<td>'.$row->contactName.'</td>';
                echo '<td>'.$row->clientEmail.'</td>';
                echo '<td>'.$row->amberContact.'</td>';
                if (!empty($row->documentLocation)) {
                    echo "<td><a href='". $row->documentLocation. "'>Download</a></td>";
                } else {
                    echo "<td>No file.</td>";
                }
                echo '<td>'.$row->price.'</td>';
                echo '<td>'.$row->validUntil.'</td>';
                echo '<td>'.$row->clientViewed.'</td>';
                echo '<td>'.$row->signedName.'</td>';
                echo '<td>'.$row->signedDate.'</td>';
                echo '<td>'.$row->clientEmail.'<br>'.$row->clientNumber.'</td>';
                echo '<td>'.$row->clientAddress2.'<br>'.$row->clientAddress1.'<br>'.$row->clientAddressCity.'<br>'.$row->clientAddressState.$row->clientAddressPostCode.'</td>';
                echo '<td>'.$row->signedDate.'</td>';

                echo "<tr>";
            }
            ?>
            </tbody>
            </table>
        </div>
  </div>

 <?php
 if ( isset( $_POST['submit'])) {
    $quote_url = random_int(10000000, 99999999);
    $quoteName = ( ! empty( $_POST['quoteName'])) ? sanitize_text_field( $_POST['quoteName']) : '';
    $clientName = ( ! empty( $_POST['clientName'])) ? sanitize_text_field( $_POST['clientName']) : '';
    $clientEmail = ( ! empty( $_POST['clientEmail'])) ? sanitize_text_field( $_POST['clientEmail']) : '';
    $amberContact = ( ! empty( $_POST['amberContact'])) ? sanitize_text_field( $_POST['amberContact']) : '';
    $amberEmail = ( ! empty ($_POST['amberEmail'])) ? sanitize_text_field( $_POST['amberEmail']) : '';
    $validUntil = ( ! empty ($_POST['validUntil'])) ? sanitize_text_field( $_POST['validUntil']) : '';
    $feeValue = ( ! empty ($_POST['feeValue'])) ? sanitize_text_field( $_POST['feeValue']) : '';


//***************FILE UPLOAD HANDLER****************//
    
        if ( $_FILES ) {            
            if ( ! function_exists( 'wp_handle_upload' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
            }
            $uploadedfile = $_FILES['doc'];
            $upload_overrides = array( 'test_form' => false );
            $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
            if ( $movefile ) {
                echo "File is valid, and was successfully uploaded.\n";
                var_dump( $movefile);
            } else {
                echo "Possible file upload attack!\n";
            }
        }



    //Insert into database
    $wpdb->insert($wpdb->prefix . 'quotes', array(
        'quote_url' => $quote_url,
        'quote_signed' => 0, 
        'quoteName' => $quoteName, 
        'clientName' => $clientName, 
        'clientEmail' => $clientEmail, 
        'amberContact' => $amberContact, 
        'amberEmail' => $amberEmail, 
        'validUntil' => $validUntil,
        'documentLocation' => $movefile['url'],
        'clientViewed' => 0,
        'price' => $feeValue,
        'signedName' => "",
        'signedDate' => "",
        'signature' => "",
        'contactName' => "",
        'clientAddress1' => "" ,
        'clientAddress2' => "" ,
        'clientAddressCity' => "" ,
        'clientAddressState' => "" ,
        'clientAddressPostCode' => "" ,
        'clientNumber' => ""
        ));
    
    /* DO NOT UNCOMMENT THIS ************************* EXTRA FUNCTIONS ***********************
    
    /*@ Add new column if not exist */
    /*
    $newcolname = "clientAddress1";
    $dbname = $wpdb->dbname;
    $table_name = $wpdb->prefix . 'quotes';
    $is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$table_name}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = '{$newcolname}'" );

    if( empty($is_status_col) ):
        $add_status_column = "ALTER TABLE `{$table_name}` ADD `{$newcolname}` VARCHAR(50) NULL DEFAULT NULL; ";

        $wpdb->query( $add_status_column );
    endif;
    */

    /* DELETES ALL ENTRIES */
    /*
    $table  = $wpdb->prefix . 'quotes';
    $delete = $wpdb->query("TRUNCATE TABLE $table");
    */

    /*  This function creates a new database table suitable for uploading quotes! - tehe
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
       
        //* Create the teams table
        $table_name = $wpdb->prefix . 'quotes';
        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}quotes` (
        quote_id INTEGER NOT NULL AUTO_INCREMENT,
        quote_url TEXT,
        quote_signed TINYINT,
        quoteName TEXT,
        clientName TEXT,
        clientEmail TEXT,
        amberContact TEXT,
        amberEmail TEXT,
        validUntil datetime,
        documentLocation TEXT,
        signedName TEXT,
        signedDate datetime,
        signature TEXT,
        PRIMARY KEY (quote_id)
        ) $charset_collate;";
         dbDelta( $sql );
         $is_error = empty( $wpdb->last_error );
         echo $is_error;
         
       *******************************************/

       
    ?>

<script type="text/javascript">window.location = "https://amberorg.com.au/sign-quote/?id=<?php echo $quote_url ?>";
    </script>

<?php
     

 }


 
 //get_footer();
 
 ?>
</body>
</html>
