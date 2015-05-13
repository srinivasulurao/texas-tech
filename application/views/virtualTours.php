<?php  $this->load->view('common/header',$data); ?>

<div style='width:80%;margin:auto;text-align:center;padding-top:50px'>
<?php
$underConstruction=site_url()."images/under-construction.jpg";

echo "<img src='$underConstruction' class='thumbnail conf-thumbnail' style='height:312px;width:624px'></div>";
?>

</div>



<?php $this->load->view('common/footer'); ?>