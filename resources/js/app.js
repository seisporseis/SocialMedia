import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí una imagen para tu publicación',
    acceptedFiles: '.jpg,.jpeg,.png,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar',
    maxFiles: 1,
    uploadMultiple: false
})
