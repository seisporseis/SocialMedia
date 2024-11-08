import { Dropzone } from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Arrastra aquí tu imagen',
    acceptedFiles: '.jpg,.jpeg,.png,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if(document.querySelector('[name="image"]').value.trim()) {
            const publishedImage = {}
            publishedImage.size = 1000;
            publishedImage.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, publishedImage);
            this.options.thumbnail.call(this, publishedImage,`/uploads/${publishedImage.name}`);

            publishedImage.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    }
})

dropzone.on('success', function(file, response) {
    
    console.log(response)
    document.querySelector('[name="image"]').value = response.image;
})

dropzone.on('removedFile', function() {
    document.querySelector('[name="image"]').value = "";
})

