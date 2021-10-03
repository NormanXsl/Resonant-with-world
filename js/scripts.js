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