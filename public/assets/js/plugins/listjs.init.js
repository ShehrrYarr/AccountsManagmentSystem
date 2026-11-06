/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: ListJs init js
*/

var options = {
    valueNames: [
        { name: 'name', attr: 'data-name' },
        { name: 'email', attr: 'data-email' },
    ],
};

var monkeyList = new List('pagination-list', {
    valueNames: ['name'],
    page: 5,
    pagination: true
});

// Function to toggle "No data found" message
function toggleNoResultsMessage() {
    var noResultsMessage = document.querySelector('.no-results');
    if (userList.matchingItems.length === 0) {
        noResultsMessage.style.display = 'block';
    } else {
        noResultsMessage.style.display = 'none';
    }
}

// Add an event listener to search and trigger the function
document.querySelector('.search').addEventListener('input', function () {
    userList.search(this.value);
    toggleNoResultsMessage();
});

var nodataListOptions = {
    valueNames: ['name', 'born'],
    item: '<li class="list-group-item"><h5 class="name mb-0"></h5><p class="born mb-0 text-muted"></p></li>',
};

var nodataListValues = [
    {
        name: 'Jonny Strömberg',
        born: 1986
    },
    {
        name: 'Jonas Arnklint',
        born: 1985
    },
    {
        name: 'Martina Elm',
        born: 1986
    },
    {
        name: 'Jhon Smith',
        born: 1850
    }
];

var nodataList = new List('nodataList', nodataListOptions);

nodataListValues.forEach(function (item) {
    nodataList.add(item);
});

// List.js options
var xxoptions = {
    valueNames: ['id', 'name', 'age', 'city']
};

// Init List.js
var contactList = new List('contacts', xxoptions);

// Variables for form fields and buttons
var idField = document.getElementById('id-field'),
    nameField = document.getElementById('name-field'),
    ageField = document.getElementById('age-field'),
    cityField = document.getElementById('city-field'),
    saveBtn = document.getElementById('save-btn');

// Search functionality
var searchInput = document.getElementById('search-input');
searchInput.addEventListener('input', function () {
    contactList.search(searchInput.value);
});

// Initial Add button click handler
var addBtn = document.getElementById('add-btn');
addBtn.addEventListener('click', function () {
    openAddModal();
    var modal = new bootstrap.Modal(document.getElementById('contactModal'));
    modal.show();
});

// Open modal to add a new contact
function openAddModal() {
    idField.value = '';
    nameField.value = '';
    ageField.value = '';
    cityField.value = '';
    saveBtn.textContent = 'Add Contact';
    saveBtn.onclick = addContact;
}

// Open modal to edit an existing contact
function openEditModal(itemId) {
    var itemValues = contactList.get('id', itemId)[0].values();
    idField.value = itemValues.id;
    nameField.value = itemValues.name;
    ageField.value = itemValues.age;
    cityField.value = itemValues.city;
    saveBtn.textContent = 'Save Changes';
    saveBtn.onclick = function () { editContact(itemId); };
}

// Add a new contact to the list
function addContact() {
    if (validateForm()) {
        contactList.add({
            id: Math.floor(Math.random() * 110000),
            name: nameField.value,
            age: ageField.value,
            city: cityField.value
        });

        // Show success alert using SweetAlert2
        Swal.fire({
            title: 'Success!',
            text: 'Contact has been added.',
            icon: 'success',
            confirmButtonText: 'OK'
        });

        // Close modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
        modal.hide();
        refreshCallbacks();
    }
}

// Edit an existing contact
function editContact(itemId) {
    if (validateForm()) {
        var item = contactList.get('id', itemId)[0];
        item.values({
            id: idField.value,
            name: nameField.value,
            age: ageField.value,
            city: cityField.value
        });

        // Show success alert using SweetAlert2
        Swal.fire({
            title: 'Updated!',
            text: 'Contact details have been updated.',
            icon: 'success',
            confirmButtonText: 'OK'
        });

        // Close modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
        modal.hide();
        refreshCallbacks();
    }
}

// Validate form before adding or editing
function validateForm() {
    var form = document.getElementById('contact-form');
    if (form.checkValidity() === false) {
        form.classList.add('was-validated');
        return false;
    }
    return true;
}

// Reattach event listeners to remove/edit buttons
function refreshCallbacks() {
    var removeBtns = document.querySelectorAll('.remove-item-btn');
    var editBtns = document.querySelectorAll('.edit-item-btn');

    removeBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var itemId = this.closest('tr').querySelector('.id').textContent;
            contactList.remove('id', itemId);
            Swal.fire({
                title: 'Deleted!',
                text: 'Contact has been removed.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });

    editBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var itemId = this.closest('tr').querySelector('.id').textContent;
            openEditModal(itemId);
            var modal = new bootstrap.Modal(document.getElementById('contactModal'));
            modal.show();
        });
    });
}

// Initial callbacks setup
refreshCallbacks();
