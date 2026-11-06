/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Calendar init js
*/

const inlinePickerEl = document.querySelector('#inline-date-picker')
if (inlinePickerEl) {
    const localeEn = {
        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        today: 'Today',
        clear: 'Clear',
        dateFormat: 'mm/dd/yyyy',
        timeFormat: 'hh:ii aa',
        firstDay: 0
    }
    new AirDatepicker(inlinePickerEl, {
        inline: true,
        locale: localeEn
    })
}

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const date = new Date();
    const d = date.getDate();
    const m = date.getMonth();
    const y = date.getFullYear();

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        timeZone: 'local',
        editable: true,
        droppable: true,
        selectable: true,
        navLinks: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dayMaxEvents: true,
        themeSystem: 'bootstrap',
        events: [
            {
                title: "World Braille Day",
                start: "2024-10-01T00:00:00",
                end: "2024-10-03T13:30:00",
                className: "bg-success-subtle",
                allDay: true,
                extendedProps: {
                    label: "Personal",
                    description: "Workshop on improving personal skills."
                },
            },
            {
                title: "World Leprosy Day",
                start: "2024-10-22T00:00:00",
                className: "bg-primary-subtle",
                allDay: true,
                extendedProps: {
                    label: "Business",
                    description: "Workshop on improving personal skills."
                },
            },
            {
                title: 'All Day Event',
                start: new Date(y, m, 1),
                className: 'bg-primary-subtle',
                allDay: true,
                extendedProps: {
                    label: "Business",
                    department: 'All Day Event'
                },
                description: 'An all-day event is an event that lasts an entire day or longer'
            },
            {
                title: 'All Day Event',
                start: new Date(y, m, 1),
                className: 'bg-primary-subtle',
                allDay: true,
                extendedProps: {
                    label: "Business",
                    department: 'All Day Event'
                },
                description: 'An all-day event is an event that lasts an entire day or longer'
            },
            {
                title: 'Visit Online Course',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2),
                allDay: true,
                className: 'bg-primary-subtle',
                extendedProps: {
                    label: "Business",
                    department: 'Long Event'
                },
                description: 'Long Term Event means an incident that last longer than 12 hours.'
            },
            {
                title: 'Client Meeting with Alexis',
                start: new Date(y, m, d + 22, 20, 0),
                end: new Date(y, m, d + 24, 16, 0),
                allDay: true,
                className: 'bg-danger-subtle',
                extendedProps: {
                    label: "ETC",
                    department: 'Meeting with Alexis'
                },
                description: 'A meeting is a gathering of two or more people that has been convened for the purpose of achieving a common goal through verbal interaction, such as sharing information or reaching agreement.'
            },
            {
                title: 'Repeating Event',
                start: new Date(y, m, d + 4, 16, 0),
                end: new Date(y, m, d + 9, 16, 0),
                allDay: true,
                className: 'bg-warning-subtle',
                extendedProps: {
                    label: "Holiday",
                    department: 'Repeating Event'
                },
                description: 'A recurring or repeating event is simply any event that you will occur more than once on your calendar. ',
            },
            {
                title: 'Weekly Strategy Planning',
                start: new Date(y, m, d + 9),
                end: new Date(y, m, d + 11),
                allDay: true,
                className: 'bg-info-subtle',
                extendedProps: {
                    label: "Family",
                    description: 'Strategies for Creating Your Weekly Schedule'
                },
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                allDay: true,
                className: 'bg-info-subtle',
                extendedProps: {
                    label: "Family",
                    description: 'Family slumber party – Bring out the blankets and pillows and have a family slumber party! Play silly party games, share special snacks and wind down the fun with a special movie.'
                },
            },
            {
                title: 'Herozi Project Discussion with Team',
                start: new Date(y, m, d + 23, 20, 0),
                end: new Date(y, m, d + 24, 16, 0),
                allDay: true,
                className: 'bg-success-subtle',
                extendedProps: {
                    label: "Personal",
                    description: 'Tell how to boost website traffic'
                },
            },
        ],
        eventClick: function (info) {
            showEventDetails(info.event);
        },
        dateClick: function (info) {
            openEventModal(info);
        }
    });

    calendar.render();

    new AirDatepicker('#startDate');
    new AirDatepicker('#endDate');

    // Initialize Choices.js
    const choices = new Choices('#eventLabel');

    // Open Add Event Modal
    document.getElementById('addEventBtn').addEventListener('click', function () {
        resetEventForm();
        showModal('eventModal');
    });

    function openEventModal(info) {
        document.getElementById('eventName').value = '';
        document.getElementById('startDate').value = info.dateStr;
        document.getElementById('endDate').value = info.dateStr;
        document.getElementById('eventLabel').value = '';
        document.getElementById('eventDescription').value = '';
        showModal('eventModal');

        // Set up the form handler for adding a new event
        document.getElementById('eventForm').onsubmit = (e) => {
            e.preventDefault();
            addEvent();
        };
    }

    function addEvent() {
        const eventName = document.getElementById('eventName').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const eventLabel = document.getElementById('eventLabel').value;
        const eventDescription = document.getElementById('eventDescription').value;

        const newEvent = {
            title: eventName,
            start: startDate,
            end: endDate,
            className: 'bg-primary-subtle', // You can customize the class as needed
            allDay: true,
            extendedProps: {
                label: eventLabel,
                description: eventDescription,
            },
        };

        // Add the event to the calendar
        calendar.addEvent(newEvent);

        // Reset the form and hide the modal
        resetEventForm();
        Swal.fire('Success!', 'Event added successfully!', 'success');
    }

    function showEventDetails(event) {
        document.getElementById('eventDetailsName').innerText = event.title;
        document.getElementById('eventDetailsDescription').innerText = event.extendedProps.description || 'No description';
        document.getElementById('eventDetailsStart').innerText = event.start.toLocaleString();
        document.getElementById('eventDetailsEnd').innerText = event.end ? event.end.toLocaleString() : 'N/A';
        document.getElementById('eventDetailsLabel').innerText = event.extendedProps.label || 'N/A';

        showModal('eventDetailsModal');

        // Set up edit and delete button actions
        document.getElementById('editEventBtn').onclick = function () {
            openEditModal(event);
        };
        document.getElementById('deleteEventBtn').onclick = function () {
            deleteEvent(event);
        };
    }

    function openEditModal(event) {
        hideModal('eventDetailsModal');

        document.getElementById('eventName').value = event.title;
        document.getElementById('startDate').value = event.start.toISOString().split('T')[0];
        document.getElementById('endDate').value = event.end ? event.end.toISOString().split('T')[0] : '';
        document.getElementById('eventLabel').value = event.extendedProps.label;
        document.getElementById('eventDescription').value = event.extendedProps.description || '';

        showModal('eventModal');

        // Update the submit handler for editing
        document.getElementById('eventForm').onsubmit = function (e) {
            e.preventDefault();
            updateEvent(event);
        };
    }

    function updateEvent(event) {
        const eventName = document.getElementById('eventName').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const eventLabel = document.getElementById('eventLabel').value;
        const eventDescription = document.getElementById('eventDescription').value;

        Swal.fire({
            title: 'Confirm Update',
            text: `Event Name: ${eventName}\nStart: ${startDate}\nEnd: ${endDate}\nLabel: ${eventLabel}\nDescription: ${eventDescription}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Update Event',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                event.setProp('title', eventName);
                event.setStart(startDate);
                event.setEnd(endDate);
                event.setExtendedProp('label', eventLabel);
                event.setExtendedProp('description', eventDescription);

                resetEventForm();
                Swal.fire('Success!', 'Event updated successfully!', 'success');
            }
        });
    }

    function deleteEvent(event) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete Event',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                event.remove();
                resetEventForm();
                Swal.fire('Deleted!', 'Your event has been deleted.', 'success');
            }
        });
    }

    function resetEventForm() {
        document.getElementById('eventForm').reset();
        hideModal('eventModal');
        hideModal('eventDetailsModal');
    }

    function showModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
        document.getElementById('modalOverlay').style.display = 'block';
        document.getElementById(modalId).setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }

    function hideModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
        document.getElementById(modalId).setAttribute('aria-hidden', 'true');
        document.body.style.overflow = 'auto'; // Allow background scrolling
    }

    // Close Modals
    document.getElementById('closeModalBtn').addEventListener('click', resetEventForm);
    document.getElementById('closeDetailsModalBtn').addEventListener('click', resetEventForm);

    // Filter Events by Label
    document.querySelectorAll('.labelFilter').forEach(checkbox => {
        checkbox.addEventListener('change', filterEvents);
    });

    function filterEvents() {
        const selectedLabels = Array.from(document.querySelectorAll('.labelFilter:checked')).map(cb => cb.value);
        calendar.getEvents().forEach(event => {
            if (selectedLabels.includes(event.extendedProps.label) || selectedLabels.length === 0) {
                event.setProp('display', 'auto');
            } else {
                event.setProp('display', 'none');
            }
        });
    }
});
