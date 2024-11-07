import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Arrastra aquí tu imagen',
    acceptedFiles: '.jpg,.jpeg,.png,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar',
    maxFiles: 1,
    uploadMultiple: false,
})

dropzone.on('sending', function(file, xhr, formData) {

    console.log(formData)
})

dropzone.on('success', function(file, response) {
    
    console.log(response)
})

dropzone.on('error', function(file, message) {
    
    console.log(message)
})

dropzone.on('removedFile', function() {
    
    console.log('archivo eliminado')
})
