import './bootstrap';
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
const inputElement = document.querySelector('input[type="file"].filepond');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
import lightGallery from 'lightgallery';
import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'

window.lightGallery = lightGallery;
window.lgThumbnail = lgThumbnail;
window.lgZoom = lgThumbnail;

lightGallery(document.getElementById('animated-thumbnails'), {
    animateThumb: true,
    zoomFromOrigin: true,
    allowMediaOverlap: true,
    toggleThumb: true
});

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);

FilePond.create(inputElement).setOptions({
    server: {
        allowFileTypeValidation: true,
        acceptedFileTypes: ['image/*', 'video/*'],
        labelFileTypeNotAllowed: 'Chỉ cho phép tải lên ảnh hoặc video',
        process: './uploads/process',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    }
});

