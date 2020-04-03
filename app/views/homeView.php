<div id="carouselExampleCaptions" class="carousel slide p-3" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php 
        foreach ($data['topPopular']['movies'] as $key => $popularItem) {
        ?>
            <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $key; ?>" <?php if ($key == 0) echo 'class="active"'; ?>></li>
        <?php
        }
        ?>
    </ol>
    <div class="carousel-inner">
        <?php 
        foreach ($data['topPopular']['movies'] as $key => $popularItem) {
        ?>
        <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>">
            <img src="<?php echo $popularItem['poster']; ?>" class="d-block w-100" alt="<?php echo $popularItem['title']; ?>">
            <div class="carousel-caption d-none d-md-block">
                <h5>
                    <a href="/movie/get/<?php echo $popularItem['alias']; ?>"
                        ><?php echo $popularItem['title']; ?>
                    </a>
                </h5>
                <p><?php echo $popularItem['description_short'] ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php 
foreach ($data['listMovies']['movies'] as $movie) {
?>
    <div class="media p-3">
        <img src="<?php echo $movie['poster']; ?>" class="mr-3" alt="<?php echo $movie['title']; ?>">
        <div class="media-body">
            
            <a href="/movie/get/<?php echo $movie['alias']; ?>">
                <h5 class="mt-0"><?php echo $movie['title']; ?></h5>
                
            </a>
            <?php echo $movie['description_short'] ?>
        </div>
    </div>
<?php 
}
?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php 
        for ($i = 1; $i <= $data['listMovies']['totalPages']; $i++) {
        ?>
            <li class="page-item <?php if ($i == $data['currentPage']) echo 'active'; ?>">
                <a class="page-link" href="/movie/index/<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php 
        }
        ?>
    </ul>
</nav>