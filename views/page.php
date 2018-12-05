<?php
if (empty($_GET['page'])) {
  echo "<script>window.location='/?';</script>";
}
$key = mysqli_escape_string($DBConnect, $_GET['page']);
    $sqlJoin = "SELECT * FROM `page_content` WHERE `page_content`.`cont_url` = '$key'";
    $result = mysqli_query($DBConnect, $sqlJoin, MYSQLI_USE_RESULT) or die('die');
    $row = mysqli_fetch_assoc($result);
    $result->close();
    if ($row['cont_published'] === 'off') {
        header("Location: /");
    }
?>
        <div class="row">
            <div class="column">
                <h5 class="text-blue text-18x"><i class="fa fa-fw fa-star" aria-hidden="true"></i> <?php echo $row['cont_title']; ?></h5>
            </div>
            <div class="u-full-width">
                <?php echo $row['cont_details']; ?>
            </div>
        </div>
