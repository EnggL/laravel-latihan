$(document).on("input", ".numeric-only", function () {
    this.value = this.value.replace(/\D/g, '');
});

$(document).on('input', 'input.uppercase', function () {
    this.value = this.value.toUpperCase()
});