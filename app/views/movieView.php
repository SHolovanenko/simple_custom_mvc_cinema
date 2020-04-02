<div class="row">
    <div class="col">
        <img src="<?php echo $data['movie']['poster']; ?>" class="img-fluid p-3" alt="Responsive image">
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="p-3">
            <h2>
                <?php echo $data['movie']['title']; ?>
            </h2>
            <div>
                Duration: <?php echo $data['movie']['duration_mins']; ?> minutes
            </div>
            <p>
                <?php echo $data['movie']['description_full']; ?>
            </p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <h5 class="pl-3">Register:</h5>    
    </div>
</div>

<?php 
if (!empty($data['movieSessions'])) {
    foreach($data['movieSessions'] as $movieSession) 
    {
?>
        <div class="row">
            <div class="col">
                <a class="text-body" href="/moviesession/get/<?php echo $movieSession['id']; ?>">
                    <div class="p-3">
                        <div>Cinema hall: <?php echo $movieSession['room']; ?></div>
                        <div>Start: <?php echo $movieSession['start']; ?></div>
                        <div>End: <?php echo $movieSession['end']; ?></div>
                    </div>
                </a>
            </div>
        </div>
<?php 
    }
}
?>