<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CMS-Project</title>
  <link rel="stylesheet" href="../public/assets/css/admin-dashboard.css" />
</head>

<body>
  <div class="table-container">
    <h2>Room List</h2>

    <div class="table-actions">
      <a href="<?= BASE_URL ?>/logout" class="logout">Log Out</a>
      <a href="<?= BASE_URL ?>/createRoom-form" class="add-room">Add Room</a>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Room ID</th>
            <th>Room Type</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Status</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data["rooms"] as $rooms): $imagePath = BASE_URL . "/assets/uploads/" . $rooms['filename']?>
            <tr>
              <td><?= $rooms['room_id'] ?></td>
              <td><?= $rooms['room_type'] ?></td>
              <td><?= $rooms['price'] ?></td>
              <td><?= $rooms['total_available'] ?></td>
              <td><?= $rooms['status'] ?></td>
              <td><?= $rooms['descriptions'] ?></td>
              <td><image src="<?= $imagePath ?>" alt="Room Image"></image></td>
              <td class="actions">
                  <a class='update' href='<?= BASE_URL ?>/updateRoom-form?room_id=<?= $rooms['room_id'] ?>'>Update</a>
                  <a class='delete' href='<?= BASE_URL ?>/delete-room?room_id=<?= $rooms['room_id'] ?>'>Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

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
          <?php foreach($data["posts"] as $posts): $imagePath = BASE_URL . "/assets/uploads/" . $posts['filename']?>
            <tr>
              <td><?= $posts["post_id"] ?></td>
              <td><?= $posts["title"] ?></td>
              <td><?= $posts["body"] ?></td>
              <td><?= $posts["username"] ?></td>
              <td><?= $posts["created_at"] ?></td>
              <td><image src="<?= $imagePath ?>" alt="Post Image"></image></td>
              <td class="actions">
                  <a class='update' href='<?= BASE_URL ?>/postUpdate-form?post_id=<?= $posts['post_id'] ?>'>Update</a>
                  <a class='delete' href='<?= BASE_URL ?>/delete-post?post_id=<?= $posts['post_id'] ?>'>Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="table-container">
    <h2>Reservation List</h2>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Reservation ID</th>
            <th>Check-In Date</th>
            <th>Check-Out Date</th>            
            <th>Room Type</th>
            <th>Total</th>
            <th>Guest</th>
            <th>Created At</th>
            <!-- <th>Actions</th> -->
          </tr>
        </thead>
        <tbody>
          <?php foreach($data["reservations"] as $reservations): ?>
            <tr>
              <td><?= $reservations['reservation_id'] ?></td>
              <td><?= $reservations['check_in'] ?></td>
              <td><?= $reservations['check_out'] ?></td>
              <td><?= $reservations['room_type'] ?></td>
              <td><?= $reservations['total'] ?></td>
              <td><?= $reservations['username'] ?></td>
              <td><?= $reservations['created_at'] ?></td>
              <!-- <td class="actions">
                  <a class='update'>Update</a>
                  <a class='delete'>Delete</a>
              </td> -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>