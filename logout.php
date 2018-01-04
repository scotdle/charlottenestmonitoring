<?php
session_start();
session_destroy();
?>


<script>
    window.setTimeout(function() {

        // Move to a new location or you can do something else
        window.location.href = 'login.php';

    }, 000);
</script>