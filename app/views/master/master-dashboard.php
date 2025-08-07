<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CMS-Project</title>
  <link rel="stylesheet" href="../public/assets/css/master-dashboard.css" />
</head>

<body>
  <div class="table-container">
    <h2>Admin List</h2>

    <div class="table-actions">
      <a href="<?= BASE_URL ?>/logout" class="logout">Log Out</a>
      <a href="<?= BASE_URL ?>/reg-form" class="add-admin">Register Admin</a>
    </div>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Admin ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data["admins"] as $admin): ?>
            <tr>
              <td><?= $admin['user_id'] ?></td>
              <td><?= $admin['username'] ?></td>
              <td><?= $admin['email'] ?></td>
              <td class="actions">
                  <a class='update' href='<?= BASE_URL ?>/update-form?user_id=<?= $admin['user_id'] ?>'>Update</a>
                  <a class='delete' href='<?= BASE_URL ?>/delete-admin?user_id=<?= $admin['user_id'] ?>'>Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="table-container">
    <h2>Room List</h2>
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
            <th>Image</th>
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
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>