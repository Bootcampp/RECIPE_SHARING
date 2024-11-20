<?php
include_once '../db/database.php';
include_once '../functions/user_functions.php';

// Get all users
$users = getAllUsers($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../public/css/users.css">
</head>
<body>
    <header>
        <h1>User Management</h1>
    </header>
    
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars(getRoleName($user['role'])); ?></td>
                        <td>
                            <button class="btn btn-read" data-userid="<?php echo $user['user_id']; ?>">View more</button>
                            <button class="btn btn-update" data-userid="<?php echo $user['user_id']; ?>">Update</button>
                            <?php if ($user['role'] != 1): // Don't show delete button for super admin ?>
                                <button class="btn btn-delete" data-userid="<?php echo $user['user_id']; ?>">Delete</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../view/admin/dashboard.php" class="btn">Back to Dashboard</a>
    </main>

    <!-- View More Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Details</h2>
            <div id="userDetails"></div>
        </div>
    </div>

    <!-- Add these modal elements for Update and Delete confirmations -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update User</h2>
            <form id="updateForm">
                <input type="hidden" id="updateUserId" name="userId">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="2">Admin</option>
                        <option value="1">Super Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn">Update User</button>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete this user?</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn btn-delete">Delete</button>
                <button id="cancelDelete" class="btn">Cancel</button>
            </div>
        </div>
    </div>
    <script>
        // public/js/users.js
document.addEventListener('DOMContentLoaded', function() {
    const viewModal = document.getElementById('userModal');
    const updateModal = document.getElementById('updateModal');
    const deleteModal = document.getElementById('deleteModal');
    const closeButtons = document.getElementsByClassName('close');

    // Close modals when clicking the X
    Array.from(closeButtons).forEach(button => {
        button.onclick = function() {
            viewModal.style.display = "none";
            updateModal.style.display = "none";
            deleteModal.style.display = "none";
        }
    });

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target === viewModal || event.target === updateModal || event.target === deleteModal) {
            viewModal.style.display = "none";
            updateModal.style.display = "none";
            deleteModal.style.display = "none";
        }
    }

    // View More button handler
    document.querySelectorAll('.btn-read').forEach(button => {
        button.onclick = function() {
            const userId = this.getAttribute('data-userid');
            fetch(`../functions/get_user_details.php?id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('userDetails').innerHTML = `
                        <p><strong>ID:</strong> ${data.user_id}</p>
                        <p><strong>Name:</strong> ${data.fname} ${data.lname}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Role:</strong> ${data.role}</p>
                        <p><strong>Created:</strong> ${data.created_at}</p>
                        <p><strong>Last Updated:</strong> ${data.updated_at}</p>
                    `;
                    viewModal.style.display = "block";
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Update button handler
    document.querySelectorAll('.btn-update').forEach(button => {
        button.onclick = function() {
            const userId = this.getAttribute('data-userid');
            fetch(`../functions/get_user_details.php?id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('updateUserId').value = data.user_id;
                    document.getElementById('firstName').value = data.fname;
                    document.getElementById('lastName').value = data.lname;
                    document.getElementById('email').value = data.email;
                    document.getElementById('role').value = data.role;
                    updateModal.style.display = "block";
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Delete button handler
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.onclick = function() {
            const userId = this.getAttribute('data-userid');
            document.getElementById('confirmDelete').setAttribute('data-userid', userId);
            deleteModal.style.display = "block";
        }
    });

    // Handle delete confirmation
    document.getElementById('confirmDelete').onclick = function() {
        const userId = this.getAttribute('data-userid');
        fetch('../functions/delete_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `userId=${userId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting user');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Handle update form submission
    document.getElementById('updateForm').onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('../functions/update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating user');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Cancel delete
    document.getElementById('cancelDelete').onclick = function() {
        deleteModal.style.display = "none";
    }
});
    </script>

    <script src="../../public/js/users.js"></script>
</body>
</html>

