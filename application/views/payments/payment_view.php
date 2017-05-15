<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "dd3pZx";

// Merchant Salt as provided by Payu
$SALT = "AXLTBV2u";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';
      $posted = array();
            $posted['key'] = 'dd3pZx';
            $posted['txnid'] = $txnid;
            $posted['amount'] = $amount;
            $posted['productinfo'] = $productinfo;
            $posted['firstname'] = $fullname;
            $posted['email'] = $email;
            $posted['phone'] = $phone;
            $posted['surl'] =  base_url().'success';//'https://www.onemove.in/success';
            $posted['furl'] = base_url().'failure';
            $posted['service_provider'] = 'payu_paisa';
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  echo "<pre>";
  print_r($posted);
  echo "</pre>";

  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
      || empty($posted['service_provider'])
  ) {
    $formError = 1;
  echo "string";
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2>Please wait we are redirecting you to payment gateway</h2>
    <br/>
    <?php if($formError) { ?>
  
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden1" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden1" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden1" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <!-- <td><b>Mandatory Parameters</b></td> -->
        </tr>
        <tr>
        <!-- <td>Amount: </td> -->
          <td><input name="amount" type="hidden1" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" /></td>
          <!-- <td>First Name: </td> -->
          <td><input name="firstname" type="hidden1"  id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <!-- <td>Email: </td> -->
          <td><input name="email" type="hidden1"  id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
         <!--  <td>Phone: </td> -->
          <td><input name="phone" type="hidden1"  value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>
        <tr>
          <!-- <td>Product Info: </td> -->
          <td colspan="3"><textarea name="productinfo" style="display:none;"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>
        </tr>
        <tr>
         <!--  <td>Success URI: </td> -->
          <td colspan="3"><input type="hidden1"  name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <!-- <td>Failure URI: </td> -->
          <td colspan="3"><input type="hidden1"  name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden1" name="service_provider" value="payu_paisa" size="64" /></td>
        </tr>

        <tr>
          <?php if(!$hash) { ?>
<!--             <td colspan="4"><input type="submit" value="Submit" /></td>
 -->          <?php }?>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php
exit();
?>