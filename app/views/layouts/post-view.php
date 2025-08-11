<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post View</title>
    <link rel="stylesheet" href="../public/assets/css/post-view.css">
</head>
<body>

    <div class="container">
        <a href="<?= BASE_URL ?>/landing-page" class="back-btn">← Back</a>

        <div class="post">
            <h1 class="post-title"><?= $post['title'] ?></h1>
            <?php $imagePath = BASE_URL . "/assets/uploads/" . $post['filename'] ?>
            <img src="<?= $imagePath ?>" alt="Post Image" class="post-image">
            <p class="post-content">
                <?= $post['body'] ?>
            </p>
        </div>

        <div class="comment-section">
            <h2>Leave a Comment</h2>
            <form id="commentForm" action="<?= BASE_URL ?>/make-comment" method="post">
                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                <textarea id="comment_text" name="comment_text" placeholder="Your Comment" required></textarea>
                <button type="submit">Submit Comment</button>
            </form>

            <h3>Comments</h3>
            <div id="commentsList">
                <?php foreach($data['comment'] as $comment): ?>
                    <div class="comment">
                        <h3><?= $comment['username'] ?> - <?= $comment['created_at'] ?></h3>
                        <p><?= $comment['comment_text'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
