<div class="row my-3">
    <div class="col">
        <form method="POST" action="/administrator/moviesession/add">
            <div class="form-group">
                <label for="exampleFormControlInput1">Movie ID</label>
                <input type="number" name="movieId" <?php if (isset($data['movie_id'])) echo 'value="'.$data['movie_id'].'"';?> class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Start date and time (Y-m-d H:m:s)</label>
                <input type="text" name="start" <?php if (isset($data['start'])) echo 'value="'.$data['start'].'"';?> class="form-control" id="exampleFormControlInput2" placeholder="1997-12-31 23:59:00">
            </div>

            <div class="row">
                <div class="col-1">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <div class="col-1">
                    <a class="btn btn-danger" href="/administrator/moviesession/delete/<?php echo $data['id']; ?>" role="button">Delete</a>
                </div>
            </div>
        </form>
    </div>
</div>