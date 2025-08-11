<div class="table-container">
  <h2>Room List</h2>
  <div class="table-actions">
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
            <td><img src="<?= $imagePath ?>" alt="Room Image"></td>
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
