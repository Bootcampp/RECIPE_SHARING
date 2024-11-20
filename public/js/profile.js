function editProfile() {
    document.getElementById("edit-modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("edit-modal").style.display = "none";
}

function saveProfile() {
    const name = document.getElementById("name").value;
    const role = document.getElementById("role").value;

    document.getElementById("profile-name").textContent = name;
    document.getElementById("profile-role").textContent = role;

    closeModal();
}
