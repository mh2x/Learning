$(function () {

    //
    // Dynamic JavaScript Proxies & Auto API Controllers
    // we've used the todoApp.services.todo.delete(...) and 
    // todoApp.services.todo.create(...) functions to communicate with the server. 
    //These functions are dynamically created by the ABP, thanks to the 
    //Dynamic JavaScript Client Proxy system. They perform HTTP API calls to the 
    //server and return a promise, so you can register a callback to the 
    //then function as we've done here.
    //NOTE: services keyword comes from the namespace (namespace TodoApp.Services;). 
    //It's a naming convention.
    //ABP API Controllers are created automatically for you!
    //Checkout swagger UI!
    
    // DELETING ITEMS /////////////////////////////////////////
    $('#TodoList').on('click', 'li i', function(){
        var $li = $(this).parent();
        var id = $li.attr('data-id');
        
        todoApp.services.todo.delete(id).then(function(){
            $li.remove();
            abp.notify.info('Deleted the todo item.');
        });
    });
    
    // CREATING NEW ITEMS /////////////////////////////////////
    $('#NewItemForm').submit(function(e){
        e.preventDefault();
        
        var todoText = $('#NewItemText').val();        
        todoApp.services.todo.create(todoText).then(function(result){
            $('<li data-id="' + result.id + '">')
                .html('<i class="fa fa-trash-o"></i> ' + result.text)
                .appendTo($('#TodoList'));
            $('#NewItemText').val('');
        });
    });
});
