<div class="m-5 alert alert-<?php if ($data['success']) {echo 'success';} else {echo 'danger';}?>" role="alert">
    <?php 
    if ($data['success']) {
        echo 'Success! ';
    } else {
        echo 'Something went wrong! ';
    }
    ?>
    (<a href="/moviesession/get/<?php echo $data['movieSessionId']; ?>">back</a>)
</div>