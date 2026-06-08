// Run when the page has finished loading
$(document).ready(function() {
    const translations = window.appLang || {};
    const datatableText = translations.datatable || {};

    // Initialize DataTables for all supported tables on the page
    $('#productTable, #salesTable, #reportTodayTable, #reportMonthTable').DataTable({
        order: [],
        language: {
            search: datatableText.search || 'Search:',
            lengthMenu: datatableText.lengthMenu || 'Show _MENU_ entries',
            info: datatableText.info || 'Showing _START_ to _END_ of _TOTAL_ entries',
            paginate: {
                previous: (datatableText.paginate && datatableText.paginate.previous) || 'Previous',
                next: (datatableText.paginate && datatableText.paginate.next) || 'Next'
            }
        }
    });

    // Toggle the sidebar menu when the button is clicked
    $('#sidebarToggle').on('click', function () {
        $('#wrapper').toggleClass('toggled');
    });

    // Automatically close sidebar when a link is clicked on mobile
    $('#sidebar-wrapper .list-group-item').on('click', function () {
        if ($(window).width() <= 768) {
            $('#wrapper').removeClass('toggled');
        }
    });

    // Close sidebar when clicking outside of it on mobile
    $(document).on('click', function (e) {
        if ($(window).width() <= 768 && $('#wrapper').hasClass('toggled')) {
            if (!$(e.target).closest('#sidebar-wrapper').length && !$(e.target).closest('#sidebarToggle').length) {
                $('#wrapper').removeClass('toggled');
            }
        }
    });

    // Recalculate the total amount using selected product price and quantity
    function computeTotal() {
        const qty = parseFloat($('#quantity').val()) || 0;
        const price = parseFloat($('#sale_price').val()) || 0;
        $('#total').val((qty * price).toFixed(2));
    }

    // Update the price and total when the product changes
    $('#product_select').on('change input', function () {
        const selected = $(this).find(':selected');
        const price = parseFloat(selected.data('price')) || 0;

        $('#sale_price').val(price.toFixed(2));
        computeTotal();
    });

    // Recalculate total when the quantity changes
    $('#quantity').on('change input', function () {
        let quantity = parseInt($(this).val(), 10);
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            $(this).val(quantity);
        }
        computeTotal();
    });

    // Initialize price and total on page load
    $('#sale_price').val('0.00');
    $('#total').val('0.00');
    if ($('#product_select').val()) {
        $('#product_select').trigger('change');
    }

    // Confirm before deleting a product or sale record
    $('.delete-product, .delete-sale').on('click', function(e) {
        const message = $(this).data('confirm') || translations.confirmDelete || 'Are you sure?';
        if (!confirm(message)) {
            e.preventDefault();
        }
    });
});
