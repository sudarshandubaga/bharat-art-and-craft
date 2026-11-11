/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
$(function () {
    // Single item delete
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                if (form.length && form[0]) {
                    form[0].submit();
                } else {
                    form.trigger('submit');
                }
            }
        });
    });

    // Bulk / Multi Delete & Multi Action
    $(document).on('click', '.multi-delete', function (e) {
        e.preventDefault();
        var $btn = $(this);
        // Find the table-form in the same card or first table-form on the page
        var form = $btn.closest('.card').find('.table-form');
        if (!form.length) {
            form = $('.table-form').first();
        }

        var checkedCount = form.find('input[name="check[]"]:checked').length;
        if (checkedCount === 0) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Items Selected',
                    text: 'Please select at least one item using the checkboxes before deleting.'
                });
            } else {
                alert('Please select at least one item using the checkboxes.');
            }
            return;
        }

        var action = $btn.data('action');
        if (action) {
            form.find('input[name="action"]').remove();
            form.append('<input type="hidden" name="action" value="' + action + '">');
        } else {
            form.find('input[name="action"]').remove();
        }

        var isRestore = action === 'restore';
        var isPermanent = action === 'permanent-delete';

        var title = isRestore
            ? 'Restore ' + checkedCount + ' item(s)?'
            : (isPermanent ? 'Permanently delete ' + checkedCount + ' item(s)?' : 'Delete ' + checkedCount + ' selected item(s)?');

        var text = isPermanent
            ? 'This will permanently remove the selected items from the database. This action CANNOT be undone!'
            : (isRestore ? 'The selected items will be restored to active status.' : "The selected items will be moved to trash.");

        var confirmBtnText = isRestore ? 'Yes, restore!' : (isPermanent ? 'Yes, permanently delete!' : 'Yes, delete selected!');
        var confirmColor = isRestore ? '#198754' : '#dc3545';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: confirmColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: confirmBtnText
            }).then((result) => {
                if (result.isConfirmed) {
                    if (form.length && form[0]) {
                        form[0].submit();
                    } else {
                        form.trigger('submit');
                    }
                }
            });
        } else {
            if (confirm(title)) {
                if (form.length && form[0]) form[0].submit();
            }
        }
    });

    // Sync Bulk Selection UI & Badges
    function syncBulkSelection() {
        var checkedCount = $('.check:checked').length;
        var totalCount = $('.check').length;

        if (checkedCount > 0) {
            $('.select-checked').removeClass('d-none').addClass('d-flex');
            $('.select-checked-count').text(checkedCount + ' selected');
            $('.no-select').addClass('d-none');

            if (totalCount > 0 && checkedCount === totalCount) {
                $('#checkAll').prop('checked', true).prop('indeterminate', false);
            } else {
                $('#checkAll').prop('checked', false).prop('indeterminate', true);
            }
        } else {
            $('.select-checked').addClass('d-none').removeClass('d-flex');
            $('.no-select').removeClass('d-none');
            $('#checkAll').prop('checked', false).prop('indeterminate', false);
        }
    }

    $(document).on('click', '#checkAll', function () {
        var checked = $(this).prop('checked');
        $('.check').prop('checked', checked);
        syncBulkSelection();
    });

    $(document).on('click', '.check', function () {
        syncBulkSelection();
    });


    $(document).on('click', '.add-image-btn', function () {
        $('.image-group').append(`
            <label class="col-3 position-relative">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxoAYvbTKpyLwOwP_oNMsAn2ku3DnLHURxYWHX1siq4w9oRmr75GK8hSSimbaC8Gb9K44&usqp=CAU"
                    class="img-fluid" alt="">
                <input type="file" name="images[]" accept="image/*" class="d-none">

                <button type="button" class="close position-absolute">&times;</button>
            </label>
        ` );
    });

    $(document).on('click', '.image-group .close:not(.remove-btn)', function () {
        $(this).closest('.position-relative').remove();
    });

    $(document).on('click', '.image-group .remove-btn', function () {
        let self = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this image!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).data('url'),
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                    },
                    success: function (res) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your image has been deleted.',
                            icon: 'success'
                        });
                        self.closest('.position-relative').remove();
                    }
                });
            }
        })
    });
    $(document).on('change', '.image-group input[type=file]', function () {
        const [file] = this.files;
        // console.log('files: ', URL.createObjectURL(file));

        if (file) {
            // blah.src = URL.createObjectURL(file)
            $(this).closest('.position-relative').find('img').attr('src', URL.createObjectURL(file));
        }
    });
    // Add Image Upload Option End



    // auto slug

    function convertToSlug(Text) {
        return Text.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
    }

    $(function () {
        $(document).on('keyup', '.title', function () {
            var sel = $(this).data('target');

            $(sel).val(convertToSlug($(this).val()));
        });

    });
});

