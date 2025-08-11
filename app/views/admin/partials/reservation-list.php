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
                <?php foreach ($data["reservations"] as $reservations): ?>
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