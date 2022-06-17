window.addEventListener('error', event => {
    alertify.error(event.detail.error);
});
window.addEventListener('success', event => {
    alertify.success(event.detail.success);
});
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})