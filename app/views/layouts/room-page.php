<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Page</title>
    <link rel="stylesheet" href="../public/assets/css/room-page.css" />
</head>

<body>

    <div class="room-container">
        <div class='room-image'>
            <?php $imagePath = BASE_URL . "/assets/uploads/" . $room['filename']?>
            <img src="<?= $imagePath ?>" alt='Room Image' />
        </div>

        <div class='room-details'>
            <h2><?= $room['room_type'] ?></h2>
            <p class='description'><?= $room['descriptions'] ?></p>

            <p class='price'><strong>Rp. <?= $room['price'] ?></strong></p>

            <form class='booking-form' action='<?= BASE_URL ?>/book-room' method='post'>
                <input type='hidden' name='user_id' value='<?= $user['user_id'] ?>'>
                <input type='hidden' name='room_id' value='<?= $room['room_id'] ?>'>
                
                <div class='form-group'>
                    <label for='checking'>Check-in:</label>
                    <input type='date' id='check_in' name='check_in' required />
                </div>

                <div class='form-group'>
                    <label for='checkout'>Check-out:</label>
                    <input type='date' id='check_out' name='check_out' required />
                </div>

                <div class='form-group'>
                    <label for='adults'>Adults:</label>
                    <input type='number' id='adults' name='adults' min='1' value='1' />
                </div>

                <div class='form-group'>
                    <label for='children'>Children:</label>
                    <input type='number' id='children' name='children' min='0' value='0' />
                </div>

                <button type='submit' class='book-btn'>Book Now</button>
            </form>
        </div>
    </div>
</body>

</html>