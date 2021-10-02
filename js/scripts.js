// Allow various Modal popups based on QueryString
let searchParams = new URLSearchParams(window.location.search)
// Logged out popup
if (searchParams.get('action') === 'logged-out') $('#loggedOutModal').modal('show');
if (searchParams.get('action') === 'error') {
    $('#errorModal .modal-body').text(searchParams.get('message'));
    $('#errorModal').modal('show');
}