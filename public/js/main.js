function previewImg() {
    const cover = document.querySelector('#cover');
    const imgPreview = document.querySelector('.img-preview');

    const coverFile = new FileReader();
    coverFile.readAsDataURL(cover.files[0]);

    coverFile.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}