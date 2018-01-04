<?php  include('styles.php');?>
<h1>Looks like that username is already taken! Flying you back to the registration page...</h1>

<script>
    window.setTimeout(function() {

        // Move to a new location or you can do something else
        window.location.href = 'register.php';

    }, 3000);
</script>