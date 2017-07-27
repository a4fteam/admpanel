$("#inputSlide").fileinput({
    showUpload: false,
    browseLabel: 'Выберите файл...',
    maxFileCount: 1,
    showRemove: false,
    previewFileType: 'image',
    initialPreviewCount: 1,
    autoReplace: true,
    allowedFileTypes: ['image'],
    previewTemplates: {
        image: '<div class="" id="{previewId}" data-fileindex="{fileindex}">\n' +
        '   <img src="{data}" style="max-width: 100%;" class="" title="{caption}" alt="{caption}">\n' +
        '</div>\n',
        generic: '<div class="" id="{previewId}" data-fileindex="{fileindex}">\n' +
        '   {content}\n' +
        '</div>\n'
    }
});

$("#inputAvatar").fileinput({
    showUpload: false,
    browseLabel: 'Выберите файл...',
    maxFileCount: 1,
    showRemove: false,
    previewFileType: 'image',
    initialPreviewCount: 1,
    autoReplace: true,
    allowedFileTypes: ['image'],
    previewTemplates: {
        image: '<div class="" id="{previewId}" data-fileindex="{fileindex}">\n' +
        '   <img src="{data}" style="max-width: 100%;" class="" title="{caption}" alt="{caption}">\n' +
        '</div>\n',
        generic: '<div class="" id="{previewId}" data-fileindex="{fileindex}">\n' +
        '   {content}\n' +
        '</div>\n'
    }
});


