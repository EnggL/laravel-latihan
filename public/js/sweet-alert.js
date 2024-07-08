class CustomSweetAlert {
    constructor() {
        this.title = 'Error';
        this.html = '';
        this.type = 'error';

        this.loadingTitle = 'Sedang Memuat...';
        this.loadingHtml = '';
        this.loadingType = '';
    }

    alert() {
        Swal.fire({
            title: this.title,
            html: this.html,
            icon: this.type
        });
    }

    error(html = '', title = 'Terjadi Kesalahan!') {
        Swal.fire({
            title: title,
            html: html,
            icon: 'error'
        });
    }

    loading() {
        Swal.fire({
            title: this.loadingTitle,
            html: this.loadingHtml,
            icon: this.loadingType,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
        });
    }

    setTitle(text) {
        this.title = text;
        this.loadingTitle = text;
        return this;
    }

    setHtml(html) {
        this.html = html;
        this.loadingHtml = html;
        return this;
    }

    setType(text) {
        this.type = text;
        this.loadingType = text;
        return this;
    }
}

const SweetAlert = new CustomSweetAlert();