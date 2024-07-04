$(document).on("input", ".numeric-only", function () {
    this.value = this.value.replace(/\D/g, '');
});