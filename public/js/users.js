document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('userModal');
    const closeModal = document.querySelector('.close');
    const userDetails = document.getElementById('userDetails');
    const readButtons = document.querySelectorAll('.btn-read');

    // Pre-defined user details (hardcoded)
    const userInfo = [
        'Name: Nana Afia Asante\nEmail: afia.asante@gmail.com\nRole: Admin',
        'Name: Natalie Yeboah\nEmail: natalie.yeboah@gmail.com\nRole: User',
        'Name: Kim Djan\nEmail: kim.djan@gmail.com\nRole: User',
        'Name: Papa Asante\nEmail: papa.asante@gmail.com\nRole: User',
        'Name: James Tetteh\nEmail: james.tetteh@gmail.com\nRole: User'
    ];

    // "View More" feature to display hardcoded user details
    readButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            userDetails.textContent = userInfo[index];
            modal.style.display = 'block';
        });
    });

    // Close the modal
    closeModal.onclick = function() {
        modal.style.display = 'none';
    };

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // Form validation for update buttons (for demonstration purposes)
    const updateButtons = document.querySelectorAll('.btn-update');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const email = prompt("Enter new email:");
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (email && emailRegex.test(email)) {
                alert("Email updated successfully.");
                // Code to update the user email (if connected to a real backend)
            } else {
                alert("Invalid email format.");
            }
        });
    });

    // Confirmation dialog for deleting users
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            const confirmDelete = confirm("Are you sure you want to delete this user?");
            if (confirmDelete) {
                alert(`User ${userInfo[index].split('\n')[0]} deleted.`);
                // Code to delete the user (if connected to a real backend)
            }
        });
    });
});
