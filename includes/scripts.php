<script src="js/sweetalert-min.js"></script>



<?php
       if(isset($_SESSION['status']) && $_SESSION['status'] !='')
       {

        echo $_SESSION['status'];
        ?>
<script>
swal({
title: "<?php echo $_SESSION['status'];?>",
icon: "<?php echo  $_SESSION['status_code'];?>",
button: "Ok Done!",
});
</script>

<?php
        unset($_SESSION['status']);
    }
?>

<?php

       if(isset($_SESSION['status_register']) && $_SESSION['status_register'] !='')
       {

        echo $_SESSION['status_register'];
        ?>
<script>
swal({
title: "<?php echo $_SESSION['status_register'];?>",
icon: "<?php echo  $_SESSION['status_code'];?>",
button: "Ok Done!",
});
</script>

<?php
        unset($_SESSION['status_register']);
       }
?>
?>





