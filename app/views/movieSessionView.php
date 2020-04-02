<div class="row">
    <div class="col p-3">
        <h2>
            Registration
        </h2>
    </div>
</div>

<div class="row">
    <div class="col p-3">
        <form method="POST" action="/sessionregistration/add">
            <input type="hidden" name="movieSessionId" value="<?php echo $data['movieSession']['id']; ?>">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="email" placeholder="email" require>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="phone" placeholder="phone" require>
                </div>
            </div>

            <div class="row">
                <div class="col p-3">
                    <h5>
                        Pick your seat:
                    </h5>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="pt-2 pb-5">
                        <div style="content:' '; width:100%; border-bottom: 3px solid #000;"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php 
                    foreach ($data['room'] as $rowKey => $row) { 
                    ?>
                        <div class="row">
                    <?php
                        foreach ($row as $colKey => $col) {
                    ?>
                            <div class="col">
                                <div class="form-check text-center border border-<?php if($col){echo 'primary';}else{echo 'dark';}?> py-4 m-1">
                                    <input class="form-check-input position-static" 
                                        type="radio" 
                                        name="place" 
                                        id="blankRadio1" 
                                        value="<?php echo $rowKey.'_'.$colKey; ?>" 
                                        aria-label="..."
                                        <?php if(!$col) echo 'disabled'; ?>
                                    >
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary m-3">Register</button>
        </form>
    </div>
</div>

