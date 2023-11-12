// initialize plugins and components
$(document).ready(function () {
    $('.selectize-singular').selectize({
        //options
    });

    $('.selectize-singular-linked').selectize({
        onChange(value) {
            window.location = value;
        }
    });

    $('.selectize-multiple').selectize({
        //options
    });
});


// Add headers into Ajax Request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Enable Bootstraps 5 tooltips everywhere
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})


// Initialize Simditor WYSIWYG
Simditor.locale = 'ru-RU';
let wysiwygs = [];
let simditorTextareas = document.getElementsByClassName('simditor-wysiwyg');

for (i = 0; i < simditorTextareas.length; i++) {
    wysiwygs.push(
        new Simditor({
            textarea: simditorTextareas[i],
            toolbarFloatOffset: '60px',
            imageButton: 'upload',
            toolbar: ['title', 'bold', 'italic', 'underline', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment'] //image removed
            // upload: {
            //    url: '/upload/simditor_photo',   //image upload url by server
            //    params: {
            //       folder: 'news' //used in store folder path
            //    },
            //    fileKey: 'simditor_photo', //name of input
            //    connectionCount: 10,
            //    leaveConfirm: 'Пожалуйста дождитесь окончания загрузки изображений на сервер! Вы уверены что хотите закрыть страницу?'
            // },
            // defaultImage: '/img/news/simditor/default/default.png', //default image thumb while uploading
            // cleanPaste: true, //clear all styles while copy pasting,
        })
    );
}


// toggle Aside Visibility
document.querySelector('#aside-toggler-button').addEventListener('click', (evt) => {
    document.body.classList.toggle('body_with_hidden_aside');

    evt.target.innerHTML = evt.target.innerHTML == 'chevron_left' ? 'menu' : 'chevron_left';
});


// Toggle Table Forms checkboxes on select all button click
if (document.querySelector('#header-select-all-button')) {
    document.querySelector('#header-select-all-button').addEventListener('click', (evt) => {
    let tableForm = document.querySelector('#table-form')
    let checkboxes = tableForm.querySelectorAll('input[type="checkbox"]');

    // check if all checkboxes selected
    let checkedAll = true;

    for (chb of checkboxes) {
        if (!chb.checked) {
            checkedAll = false;
            break;
        }
    }

    // toggle checkbox statements
    for (chb of checkboxes) {
        chb.checked = !checkedAll;
    }
});
}


// Submit Table Form on Multiple destroy items modal form submit
if (document.querySelector('#destroy-multiple-items-form-submit-button')) {
    document.querySelector('#destroy-multiple-items-form-submit-button').addEventListener('click', () => {
        document.getElementById('table-form').submit();
    });
}


// One modal is used to delete any item in Table Form or special item in single items edit page
document.querySelectorAll('[data-action="show-single-item-destroy-modal"]').forEach((item) => {
    item.addEventListener('click', () => {
        // Change value of input before modal show 
        document.querySelector('#destroy-single-item-modal-input').value = item.dataset.itemId;

        let modal = new bootstrap.Modal(document.getElementById('destroy-single-item-modal'));
        modal.show();
    });
});


// Show image from local on image input change
document.querySelectorAll('[data-action="show-image-from-local"]').forEach(input => {
    input.addEventListener("change", event => {
        var file = input.files[0];
        var imageType = /image.*/;

        if (file.type.match(imageType)) {
            document.getElementById(input.dataset.target).src = URL.createObjectURL(file);
        } else {
            input.value = '';
            alert('Формат файла не поддерживается!');
        }
    });
});


// show spinner on form submit while uploading big files
document.querySelectorAll('[data-on-submit="show-spinner"]').forEach((item) => {
    item.addEventListener('submit', () => {
        document.querySelector('#spinner').classList.remove('spinner--hidden');
    });
});