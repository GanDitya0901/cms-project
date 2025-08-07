<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="../public/assets/css/crudRoom-form.css" />
</head>

<body>
    <div class="form-container">
        <h2>Update Room Information</h2>
        <form action="<?= BASE_URL ?>/room-update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="room_id" value="<?= $room["room_id"] ?>" required />
            <div class="form-row">
                <div class="form-group">
                    <label>Room Type <span>*</span></label>
                    <input type="text" name="room_type" value="<?= $room["room_type"] ?>" required />
                </div>
                <div class="form-group">
                    <label>Price <span>*</span></label>
                    <input type="number" name="price" value="<?= $room["price"] ?>"  required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Capacity <span>*</span></label>
                    <input type="number" name="max_capacity" value="<?= $room["max_capacity"] ?>"  required />
                </div>
                <div class="form-group">
                    <label>Total Availability <span>*</span></label>
                    <input type="number" name="total_available" value="<?= $room["total_available"] ?>"  required />
                </div>
                <div class="form-group">
                    <label>Image <span>*</span></label>
                    <input type="file" name="image" required />
                </div>
            </div>

            <div class="form-group">
                <label>Description <span>*</span></label>
                <textarea name="descriptions" rows="4" value="<?= $room["descriptions"] ?>"  required></textarea>
            </div>

            <div class="button-row">
                <a href="<?= BASE_URL ?>/admin-dashboard" class="back-btn">Back</a>
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>