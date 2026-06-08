        </div>
    </div>
</div>
<footer class="footer bg-light border-top py-3">
    <div class="container-fluid px-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <small class="text-muted">&copy; <?= date('Y') ?> <?= htmlspecialchars(t('app_title')) ?>.</small>
            <small class="text-muted"><?= htmlspecialchars(t('language')) ?>: <?= strtoupper(htmlspecialchars(current_lang())) ?></small>
        </div>
    </div>
</footer>

<!-- Expose translations to JavaScript for DataTables and confirmation messages -->
<script>
window.appLang = {
    locale: <?= json_encode(current_lang()) ?>,
    datatable: {
        search: <?= json_encode(t('datatable_search')) ?>,
        lengthMenu: <?= json_encode(t('datatable_lengthMenu')) ?>,
        info: <?= json_encode(t('datatable_info')) ?>,
        paginate: {
            previous: <?= json_encode(t('datatable_previous')) ?>,
            next: <?= json_encode(t('datatable_next')) ?>
        }
    },
    confirmDelete: <?= json_encode(t('confirm_delete')) ?>,
    allMessages: {
        productAdded: <?= json_encode(t('product_added')) ?>,
        productUpdated: <?= json_encode(t('product_updated')) ?>,
        productDeleted: <?= json_encode(t('product_deleted')) ?>,
        saleSaved: <?= json_encode(t('sale_saved')) ?>,
        selectProductInvalid: <?= json_encode(t('select_product_invalid')) ?>,
        outOfStock: <?= json_encode(t('out_of_stock')) ?>,
        saleSaveError: <?= json_encode(t('sale_save_error')) ?>,
        productNotFound: <?= json_encode(t('product_not_found')) ?>,
        allFieldsRequired: <?= json_encode(t('all_fields_required')) ?>,
        numericValuesRequired: <?= json_encode(t('numeric_values_required')) ?>
    }
};
</script>

<!-- Load JavaScript libraries and project scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>