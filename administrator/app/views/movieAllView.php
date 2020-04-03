<div class="row justify-content-end mt-3">
    <div class="col-2">
        <a class="btn btn-primary" href="formAdd" role="button">Add new</a>
    </div>
</div>

<table class="table my-3">
    <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['movies'])) {
            foreach ($data['movies'] as $movie) {
            ?>
                <tr>
                    <td><?php echo $movie['id']; ?></td>
                    <td>
                        <a href="/movie/get/<?php echo $movie['alias']; ?>">
                            <?php echo $movie['title']; ?>
                        </a>
                    </td>
                    <td><?php echo $movie['description_short']; ?></td>
                    <td>
                        <a href="/administrator/movie/get/<?php echo $movie['id']; ?>">Edit</a> 
                        <a href="/administrator/movie/delete/<?php echo $movie['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php   
            }
        }
        ?>
    </tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php 
        for ($i = 1; $i <= $data['totalPages']; $i++) {
        ?>
            <li class="page-item <?php if ($i == $data['currentPage']) echo 'active'; ?>">
                <a class="page-link" href="/administrator/movie/all/<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php 
        }
        ?>
    </ul>
</nav>