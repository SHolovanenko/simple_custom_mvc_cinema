<div class="row my-3">
    <div class="col">
        <form method="POST" action="/administrator/movie/add">
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" name="title" <?php if (isset($data['title'])) echo 'value="'.$data['title'].'"';?> class="form-control" id="exampleFormControlInput1" placeholder="Movie Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Alias (optional)</label>
                <input type="text" name="alias" <?php if (isset($data['alias'])) echo 'value="'.$data['alias'].'"';?> class="form-control" id="exampleFormControlInput2" placeholder="movie-title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Duration in minutes</label>
                <input type="number" name="durationMins" <?php if (isset($data['durationMins'])) echo 'value="'.$data['durationMins'].'"';?> class="form-control" id="durationMins">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Poster</label>
                <input type="text" name="poster" <?php if (isset($data['poster'])) echo 'value="'.$data['poster'].'"';?> class="form-control" id="exampleFormControlInput4" placeholder="http://example.com/poster.jpg">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Short description (optional)</label>
                <input type="text" name="descriptionShort" <?php if (isset($data['descriptionShort'])) echo 'value="'.$data['descriptionShort'].'"';?> class="form-control" id="exampleFormControlInput3" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" name="descriptionFull" id="exampleFormControlTextarea5" rows="3"><?php if (isset($data['descriptionFull'])) echo $data['descriptionFull']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>