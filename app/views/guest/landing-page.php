<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/assets/css/landing-page.css" />
    <title>CMS-Project</title>
</head>

<body>
    <div class="container">
        <h1>Rooms for Reservation</h1>
        <div class='card-row'>
            <?php foreach ($data["room"] as $rooms):
                $imagePath = BASE_URL . "/assets/uploads/" . $rooms["filename"] ?>
                <div class='card-group'>
                    <img src='<?= $imagePath ?>' alt='Room Image' />
                    <div class='card-content'>
                        <h3><?= $rooms['room_type'] ?></h3>
                        <p><?= $rooms['descriptions'] ?></p>
                        <p>Rp. <?= $rooms['price'] ?></p>
                        <a href='<?= BASE_URL ?>/room-page?room_id=<?= $rooms['room_id'] ?>'>More details →</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <h1>All Posts</h1>
        <div class='card-row'>
            <?php foreach ($data["post"] as $posts):
                $imagePath = BASE_URL . "/assets/uploads/" . $posts["filename"] ?>
                <div class='card-group'>
                    <img src='<?= $imagePath ?>' alt='Room Image' />
                    <div class='card-content'>
                        <h3><?= $posts['title'] ?></h3>
                        <p><?= $posts['body'] ?></p>
                        <a href='<?= BASE_URL ?>/view-post?post_id=<?= $posts['post_id'] ?>'>View →</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>