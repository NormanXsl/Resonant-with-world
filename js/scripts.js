// Allow various Modal popups based on QueryString
let searchParams = new URLSearchParams(window.location.search)
// Logged out popup
if (searchParams.get('action') === 'logged-out') $('#loggedOutModal').modal('show');
if (searchParams.get('action') === 'error') {
    $('#errorModal .modal-body').text(searchParams.get('message'));
    $('#errorModal').modal('show');
}

$('form#send-emails').submit(function () {
    // Check if any user has been selected, or any fields are empty
    if ($('input#sendmailSubject').val() === '') {
        alert("Please add subject to the email before send.");
        return false;
    }
    if ($('input#sendmailMessage').val() === '') {
        alert("Please add message body to the email before send.");
        return false;
    }
    if ($('input.emails-to-send:checked:enabled').length <= 0) {
        alert("You must select at least one user to send email to.");
        return false;
    }
});

// Simple way to produce pdf of webpage
function printpage() {

    // get ids of buttons/menus needed to hide when outputting as pdf
    var printButton = document.getElementById("printpagebutton");
    var editButton = document.getElementById("editbutton");
    var menuBar = document.getElementById("menuBar");

    // hide the elements/objects from view before printing
    printButton.style.visibility = 'hidden';
    editButton.style.visibility = 'hidden';
    menuBar.style.visibility = 'hidden';

    window.print()

    // show them after the button is clicked (when trying to output as pdf)
    printButton.style.visibility = 'visible';
    editButton.style.visibility = 'visible';
    menuBar.style.visibility = 'visible';

}