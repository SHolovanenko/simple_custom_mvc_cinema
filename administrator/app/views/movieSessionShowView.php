<div class="row mt-3">
    <div class="col">
        <h2>
            Total visitors: <?php echo $data['movieSession']['total_visitors']; ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col">
        <p>
            Movie ID: <?php echo $data['movieSession']['movie_id']; ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-3">
        <p>
            Start: <?php echo $data['movieSession']['start']; ?>
        </p>
    </div>
    <div class="col-3">
        <p>
            End: <?php echo $data['movieSession']['end']; ?>
        </p>
    </div>
</div>
<div class="row mb-5">
    <div class="col">
        <p>
            Room ID: <?php echo $data['movieSession']['room_id']; ?>
        </p>
    </div>
</div>

<div class="row">
    <div class="col">
        <h5>Visitors:</h5>
    </div>
</div>
<?php 
if (!empty($data['registrations'])) {
    foreach($data['registrations'] as $registration) {
?>
        <div class="row">
            <div class="col">
                <p>
                    Email: <?php echo $registration['email']; ?>
                </p>
            </div>
            <div class="col">
                <p>
                    Phone: <?php echo $registration['phone']; ?>
                </p>
            </div>
            <div class="col">
                <p>
                    Place: Row - <?php echo $registration['place_row']+1; ?>, Column - <?php echo $registration['place_column']+1; ?>
                </p>
            </div>
        </div>
<?php
    }
}
?>