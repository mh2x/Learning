using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.JSInterop;
using Microsoft.AspNetCore.Components;
using Microsoft.AspNetCore.Components.Web;
using Radzen;
using Radzen.Blazor;

namespace RadzenServerApp.Pages
{
    public partial class Items
    {
        [Inject]
        protected IJSRuntime JSRuntime { get; set; }

        [Inject]
        protected NavigationManager NavigationManager { get; set; }

        [Inject]
        protected DialogService DialogService { get; set; }

        [Inject]
        protected TooltipService TooltipService { get; set; }

        [Inject]
        protected ContextMenuService ContextMenuService { get; set; }

        [Inject]
        protected NotificationService NotificationService { get; set; }

        [Inject]
        public adminService adminService { get; set; }

        protected IEnumerable<RadzenServerApp.Models.admin.Item> items;

        protected RadzenDataGrid<RadzenServerApp.Models.admin.Item> grid0;

        protected string search = "";

        protected async Task Search(ChangeEventArgs args)
        {
            search = $"{args.Value}";

            await grid0.GoToPage(0);

            items = await adminService.GetItems(new Query { Filter = $@"i => i.DueAt.Contains(@0) || i.Title.Contains(@0) || i.OwnerId.Contains(@0)", FilterParameters = new object[] { search } });
        }
        protected override async Task OnInitializedAsync()
        {
            items = await adminService.GetItems(new Query { Filter = $@"i => i.DueAt.Contains(@0) || i.Title.Contains(@0) || i.OwnerId.Contains(@0)", FilterParameters = new object[] { search } });
        }

        protected async Task AddButtonClick(MouseEventArgs args)
        {
            await grid0.InsertRow(new RadzenServerApp.Models.admin.Item());
        }

        protected async Task GridDeleteButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.Item item)
        {
            try
            {
                if (await DialogService.Confirm("Are you sure you want to delete this record?") == true)
                {
                    var deleteResult = await adminService.DeleteItem(item.Id);

                    if (deleteResult != null)
                    {
                        await grid0.Reload();
                    }
                }
            }
            catch (Exception ex)
            {
                NotificationService.Notify(new NotificationMessage
                { 
                    Severity = NotificationSeverity.Error,
                    Summary = $"Error", 
                    Detail = $"Unable to delete Item" 
                });
            }
        }

        protected async Task ExportClick(RadzenSplitButtonItem args)
        {
            if (args?.Value == "csv")
            {
                await adminService.ExportItemsToCSV(new Query
{ 
    Filter = $@"{(string.IsNullOrEmpty(grid0.Query.Filter)? "true" : grid0.Query.Filter)}", 
    OrderBy = $"{grid0.Query.OrderBy}", 
    Expand = "", 
    Select = string.Join(",", grid0.ColumnsCollection.Where(c => c.GetVisible()).Select(c => c.Property))
}, "Items");
            }

            if (args == null || args.Value == "xlsx")
            {
                await adminService.ExportItemsToExcel(new Query
{ 
    Filter = $@"{(string.IsNullOrEmpty(grid0.Query.Filter)? "true" : grid0.Query.Filter)}", 
    OrderBy = $"{grid0.Query.OrderBy}", 
    Expand = "", 
    Select = string.Join(",", grid0.ColumnsCollection.Where(c => c.GetVisible()).Select(c => c.Property))
}, "Items");
            }
        }

        protected async Task GridRowUpdate(RadzenServerApp.Models.admin.Item args)
        {
            await adminService.UpdateItem(args.Id, args);
        }

        protected async Task GridRowCreate(RadzenServerApp.Models.admin.Item args)
        {
            await adminService.CreateItem(args);
            await grid0.Reload();
        }

        protected async Task EditButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.Item data)
        {
            await grid0.EditRow(data);
        }

        protected async Task SaveButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.Item data)
        {
            await grid0.UpdateRow(data);
        }

        protected async Task CancelButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.Item data)
        {
            grid0.CancelEditRow(data);
            await adminService.CancelItemChanges(data);
        }
    }
}