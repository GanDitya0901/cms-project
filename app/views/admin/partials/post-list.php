<div class="table-container">
    <h2>Post List</h2>

    <div class="table-actions">
        <a href="<?= BASE_URL ?>/createPost-form" class="add-room">Add Post</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data["posts"] as $posts):
                    $imagePath = BASE_URL . "/assets/uploads/" . $posts['filename'] ?>
                    <tr>
                        <td><?= $posts["post_id"] ?></td>
                        <td><?= $posts["title"] ?></td>
                        <td><?= $posts["body"] ?></td>
                        <td><?= $posts["username"] ?></td>
                        <td><?= $posts["created_at"] ?></td>
                        <td>
                            <image src="<?= $imagePath ?>" alt="Post Image"></image>
                        </td>
                        <td class="actions">
                            <a class='update'
                                href='<?= BASE_URL ?>/postUpdate-form?post_id=<?= $posts['post_id'] ?>'>Update</a>
                            <a class='delete' href='<?= BASE_URL ?>/delete-post?post_id=<?= $posts['post_id'] ?>'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>