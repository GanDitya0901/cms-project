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
        <h2>Enter Room Information</h2>
        <form action="<?= BASE_URL ?>/createRoom-form" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label>Room Type <span>*</span></label>
                    <input type="text" name="room_type" placeholder="Enter room type" required />
                </div>
                <div class="form-group">
                    <label>Price <span>*</span></label>
                    <input type="number" name="price" placeholder="Enter price" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Capacity <span>*</span></label>
                    <input type="number" name="max_capacity" placeholder="Enter capacity" required />
                </div>
                <div class="form-group">
                    <label>Total Availability <span>*</span></label>
                    <input type="number" name="total_available" placeholder="Enter total" required />
                </div>
                <div class="form-group">
                    <label>Image <span>*</span></label>
                    <input type="file" name="image" required />
                </div>
            </div>

            <div class="form-group">
                <label>Description <span>*</span></label>
                <textarea name="descriptions" rows="4" placeholder="Enter room description" required></textarea>
            </div>

            <div class="button-row">
                <a href="<?= BASE_URL ?>/admin-dashboard" class="back-btn">Back</a>
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>