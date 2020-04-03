<div class="row justify-content-end mt-3">
    <div class="col-2">
        <a class="btn btn-primary" href="formAdd" role="button">Add new</a>
    </div>
</div>

<table class="table my-3">
    <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Movie ID</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Room ID</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($data['movieSessions'])) {
            foreach ($data['movieSessions'] as $movieSession) {
            ?>
                <tr>
                    <td>
                        <a href="/moviesession/get/<?php echo $movieSession['id']; ?>">
                            <?php echo $movieSession['id']; ?>
                        </a>
                    </td>
                    <td><?php echo $movieSession['movie_id']; ?></td>
                    <td><?php echo $movieSession['start']; ?></td>
                    <td><?php echo $movieSession['end']; ?></td>
                    <td><?php echo $movieSession['room_id']; ?></td>
                    <td>
                        <a href="/administrator/moviesession/show/<?php echo $movieSession['id']; ?>">Show</a> 
                        <a href="/administrator/moviesession/get/<?php echo $movieSession['id']; ?>">Edit</a> 
                        <a href="/administrator/moviesession/delete/<?php echo $movieSession['id']; ?>">Delete</a>
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
                <a class="page-link" href="/administrator/moviesession/all/<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php 
        }
        ?>
    </ul>
</nav>