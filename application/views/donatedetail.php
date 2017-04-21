<html>
<body class="weshare">
  <div class="container-fluid news">
    <div class="container">
      <h3>Shoes Detail</h3>
      <hr />
      <div class="row">
        <div class="col-md-6" align="center">
          <img src="<?php echo base_url($shoe['imurl']); ?>" class="img-rounded" height="300" width="350" alt="Donation Image">
        </div>
        <div class="col-md-5">
          <b>
          <?php echo '<span name="date" id="date" value="'.$shoe['datetime'].'" hidden>'.$shoe['datetime'].'</span>'; ?>
          <p>Name : <?php echo $shoe['name']; ?></p>
          <p>Detail : <?php echo $shoe['detail'];/*str_replace(["\r\n", "\r", "\n"],'<br />',$shoe['detail']);*/ ?></p>
          <p>Gender : <?php echo $shoe['gender']; ?></p>
          <p>Type : <?php echo str_replace("_"," & ",$shoe['type']); ?></p>
          <p>Size : <?php echo $shoe['size'] . "  " . $shoe['sizeType']; ?></p>
          <p>Color : <?php echo $shoe['color']; ?></p>
          <p>Shipping Method : <?php if($shoe['shipmethod']=='post') echo 'Post/Mail';
          if($shoe['shipmethod']=='company') echo 'Weshare Company';
          if($shoe['shipmethod']=='appointment') echo 'Appointment';
           ?></p>
          <?php if($shoe['shipmethod'] == 'appointment'){
            echo '<p>Appointment place : '. $shoe['shipaddress'] .'</p>';
          } ?>
          <hr />
          <?php $attributes = array("name" => "AddToCart_Form", "id" => "AddToCart_Form" , "class" => "form-horizontal");
                    echo form_open_multipart("DonateItem/addToCart", $attributes);?>

    <!-- Amount -->
            <div class="form-group">
              <label for="inputAmount" class="col-md-3 control-label">Amount : </label>
              <div class="col-md-5">
                <input type="number" min="1" max="<?= $shoe['amount'] ?>" class="form-control" id="amount" name="amount" placeholder="Amount : Pair(s)" value="<?= $shoe['amount'] ?>">
              </div>
            </div>
            <div class="form-group" style="text-align:center;">
              <div class="col-md-12">
                <input type="submit" class="btn btn-wonder" id="needThis"  name="needThis" id="needThis" value="I NEED THIS"></input>
              </div>
            </div>
          <!--</form>-->

          <?php echo form_close(); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <hr />
          </div>
          <div class="col-md-2" style="text-align:center;margin-top:10px">
            Similar Items
          </div>
          <div class="col-md-5">
            <hr />
          </div>
        </div>
        <div class="row col-md-offset-1">
          <?php
            if (is_array($similar)){ //Check isset
              $count = 1;
            foreach ($similar as $row){
              $itemid = $row["id"];
              $itemimg = $row["imurl"];
              echo '<div class="col-md-3">';
              echo '<div class="col-md-2 col-sm-3 col-xs-6 donateitem">';
              echo '<div class="donateImage">';
              echo '<a name="imgURL" href="'. base_url("index.php/DonateItem/Detail/".$itemid) .'"><img class="img-responsive" name="similarImg'.$count.'" src="'. base_url($itemimg) .'" alt height="224" width="224"></a>';
              echo '</div>';
              echo '<div class="donateText">';
              echo '<a href="'. base_url("index.php/DonateItem/Detail/".$itemid) .'" name="similarText'.$count.'">'. $row["name"] .'</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              $count++;
            }
          }
          ?>
        </div>
        <hr />
    </div>
  </body>
</html>
