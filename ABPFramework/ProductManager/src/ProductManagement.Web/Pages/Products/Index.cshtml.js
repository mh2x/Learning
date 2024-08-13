//abp.libs.datatables.normalizeConfiguration is a 
//helper function defined by ABP Framework. 
//It simplifies the data table's configuration by providing 
//conventional default values for missing options.

//abp.libs.datatables.createAjax is another helper function 
//that adapts ABP's dynamic JavaScript client proxies to
// the data table's parameter format.

//productManagement.products.product.getList is the 
//dynamic JavaScript proxy function introduced earlier.

$(function () {
    var l = abp.localization.getResource('ProductManagement');
    var editModal = new abp.ModalManager(abp.appPath + 'Products/EditProductModal');
    var createModal = new abp.ModalManager(abp.appPath + 'Products/CreateProductModal');
   
    var dataTable = $('#ProductsTable').DataTable(
        abp.libs.datatables.normalizeConfiguration({
            serverSide: true,
            paging: true,
            order: [[0, "asc"]],
            searching: false,
            scrollX: true,
            ajax: abp.libs.datatables.createAjax(
                productManagement.services.products.product.getList),
            columnDefs: [
                {
                    title: l('Actions'),
                    rowAction: {
                        items:
                            [
                                {
                                    text: l('Edit'),
                                    action: function (data) {
                                        editModal.open({ id: data.record.id });
                                    }
                                },
                                {
                                    text: l('Delete'),
                                    confirmMessage: function (data) {
                                    return l('ProductDeletionConfirmationMessage',data.record.name);
                                    },
                                    action: function (data) {
                                        productManagement.services.products.product
                                        .delete(data.record.id)
                                        .then(function() {
                                            abp.notify.info(l('SuccessfullyDeleted'));
                                            dataTable.ajax.reload();
                                        });
                                    }
                                },
                            ]
                    }
                },
                /*Typically, a column definition has a title 
                field (display name) and a data field. The data 
                field matches the property names in the ProductDto 
                class, formatted as camelCase (a naming style in 
                which the first letter of each word is capitalized, 
                except for the first word; it is commonly used in 
                the JavaScript language).
                */
                {
                    title: l('Name'),
                    data: "name"
                },
                {
                    title: l('CategoryName'),
                    data: "categoryName",
                    orderable: false
                },
                {
                    title: l('Price'),
                    data: "price"
                },
                {
                    title: l('StockState'),
                    data: "stockState",
                    render: function (data) {
                        /*
                        The render option can be used to 
                        finely control how to show the column 
                        data. We are providing a function to 
                        customize the rendering of the stock 
                        state column. 
                        */
                        return l('Enum:StockState:' + data);
                    }
                },
                {

                    title: l('CreationTime'),
                    data: "creationTime",
                    dataFormat: 'date'
                }
            ]
        })
    );
 
    editModal.onResult(function () {
        dataTable.ajax.reload();
    });

    createModal.onResult(function () {
        dataTable.ajax.reload();
    });
    $('#NewProductButton').click(function (e) {
        e.preventDefault();
        createModal.open();
    });
});