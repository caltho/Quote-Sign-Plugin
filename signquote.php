<?php
/*
 * Template Name: Sign Quote
 * description: >-
  
 */


?>


<?php
/*
 * Template Name: New Quote
 * description: >-
  Page template without sidebar
 */



//Initialise $wpdb method
global $wpdb;
$table_name = $wpdb->prefix . 'quotes';


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

    <?php //Update database with client viewed (additional funciton)
    /*$wpdb->update($wpdb->prefix . 'quotes', 
                  array('clientViewed' => 0
                    ),
                  array('quote_url' => $quote_url)
                ); */?>

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <img class="img-fluid" style="margin-top:40px" src="https://amberorg.com.au/wp-content/uploads/2019/09/amber-traffic-planning.png" alt="">
            </div>
            <div class="col-md-3"></div>
        </div>

<?php 
if ( !isset($_GET)  ) {
    // If an invalid url is called ?>
    <div class="row">
    <div class="col-md">
        <h2>Invalid Request</h2>
        <p>There doesn't seem to be anything here. For any queries, please contact info@amberorg.com.au</p>
    </div>
    </div>

<?php
} else {
    if (isset($_GET['id'])) {
        $quote_url = $_GET['id'];    

        //Get quote data
        $quote = $wpdb->get_results("SELECT * 
        FROM wpkg_quotes 
        WHERE wpkg_quotes.quote_url = " . $quote_url);

        //Only one entry
        $quote = $quote[0];
        //print_r($quote);
    }
if( !empty($quote) && $quote->quote_signed == 0 && !isset($_POST['submit']) && isset($_GET['id'])) { 
    // If the quote number is correct, it hasn't been signed and no form is posted ?>

        <div class="row">
            <div class="col-md">
                <h2><?php echo $quote->quoteName; ?></h2>
                <h4>Traffic Engineering Works - Quote Received</h4>
                <p>You have received a new quote from <?php echo $quote->amberContact; ?> at Amber. Please download and review the document and sign below to accept.</p>
                
                <div class="mb-3">
                    <iframe src="<?php echo $quote->documentLocation; ?>" width="100%" height="650px"></iframe>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <h4>Sign Quote</h4>
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                            <div class="col-md-8">
                                <label for="signedName">Full Name</label>
                                <input class="form-control" id="quoteName" type="text" name="signedName" value="" required>
                            </div>
                            <div class="col-md-4">
                                <label for="signedDate">Date</label>
                                <input class="form-control" type="date" name="start" name="signedDate" Date022-01-01" min="2022-01-01" max="2025-01-01" value="<?php echo date('Y-m-d')?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="inputEmail" value="<?php echo $quote->clientEmail; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contactNumber">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" name="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Address 2</label>
                                <input type="text" class="form-control" name="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Suburb/City</label>
                                <input type="text" class="form-control" name="inputCity">
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">State</label>
                                <select name="inputState" class="form-select">
                                <option>ACT</option>
                                <option selected>NSW</option>
                                <option>NT</option>
                                <option>QLD</option>
                                <option>SA</option>
                                <option>TAS</option>
                                <option>VIC</option>
                                <option>WA</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputZip" class="form-label">Post Code</label>
                                <input type="text" class="form-control" name="inputZip">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="gridCheck" required>
                                <label class="form-check-label" for="gridCheck">
                                    I have read and agree to the Short Form Contract as provided by Consult Australia
                                </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                            </div>
                        </form>
                    </div>
        </div>
                </tbody>
                </table>
            </div>
        </div>



<?php
} elseif ( !empty($quote) && $quote->quote_signed == 0 && isset( $_POST['submit'])) {
    // If the quote number is correct, it hasn't been signed and the form is posted
var_dump($_POST);
exit;
    $signedName = ( ! empty ( $_POST ['signedName'])) ? sanitize_text_field( $_POST['signedName']) : '';
    $signedDate = ( ! empty ( $_POST ['signedDate'])) ? sanitize_text_field( $_POST['signedDate']) : '';
    $inputEmail = ( ! empty ( $_POST ['inputEmail'])) ? sanitize_text_field( $_POST['inputEmail']) : '';
    $contactNumber = ( ! empty ( $_POST ['contactNumber'])) ? sanitize_text_field( $_POST['contactNumber']) : '';
    $inputAddress = ( ! empty ( $_POST ['inputAddress'])) ? sanitize_text_field( $_POST['inputAddress']) : '';
    $inputAddress2 = ( ! empty ( $_POST ['inputAddress2'])) ? sanitize_text_field( $_POST['inputAddress2']) : '';
    $inputCity = ( ! empty ( $_POST ['inputCity'])) ? sanitize_text_field( $_POST['inputCity']) : '';
    $inputState = ( ! empty ( $_POST ['inputState'])) ? sanitize_text_field( $_POST['inputState']) : '';
    $inputZip = ( ! empty ( $_POST ['inputZip'])) ? sanitize_text_field( $_POST['inputZip']) : '';
    
    //Insert into database
    $wpdb->update($wpdb->prefix . 'quotes', 
                  array(
                    'quote_signed' => 1, 
                    'clientEmail' => $inputEmail, 
                    'signedName' => $signedName,
                    'signedDate' => $signedDate,
                    'signature' => "",
                    'contactName' => "",
                    'clientAddress1' => $inputAddress ,
                    'clientAddress2' => $inputAddress2 ,
                    'clientAddressCity' => $inputCity ,
                    'clientAddressState' => $inputState ,
                    'clientAddressPostCode' => $inputZip ,
                    'clientNumber' => $contactNumber
                    ),
                  array('quote_url' => $quote_url)
                );
?>
<script type="text/javascript">window.location = "https://amberorg.com.au/sign-quote/?signed=success&c=<?php echo $quote->amberContact; ?>&e=<?php echo $quote->amberEmail; ?>";
    </script>
    
<?php
} elseif ( isset($_GET['signed']) && $_GET['signed'] == 'success') {
    // If the quote was signed and redirected ?>
    <div class="row">
            <div class="col-md">
                <h2>Quote</h2>
                <p>This quote has successfully been signed. For any queries, please contact <?php echo $_GET['c']; ?> via <?php echo $_GET['e']; ?>.</p>
             </div>
        </div>
<?php
} elseif ($quote->quote_signed == 1) { 
    // Display message that quote has already been signed ?>
        <div class="row">
            <div class="col-md">
                <h2>Quote</h2>
                <p>This quote has successfully been signed. For any queries, please contact <?php echo $quote->amberContact; ?> via <?php echo $quote->amberEmail; ?>.</p>
             </div>
        </div>
<?php } else { 
    // Display message that no quote was found ?>
        <div class="row">
            <div class="col-md">
                <h2>Invalid Request</h2>
                <p>There doesn't seem to be anything here. For any queries, please contact info@amberorg.com.au</p>
            </div>
        </div>
<?php }
}
?>

        <div style="height:100px" class="row">
        </div>
        </div>
    </body>
</html>

