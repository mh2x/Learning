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
    public partial class AspNetUsers
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

        protected IEnumerable<RadzenServerApp.Models.admin.AspNetUser> aspNetUsers;

        protected RadzenDataGrid<RadzenServerApp.Models.admin.AspNetUser> grid0;

        protected string search = "";

        protected async Task Search(ChangeEventArgs args)
        {
            search = $"{args.Value}";

            await grid0.GoToPage(0);

            aspNetUsers = await adminService.GetAspNetUsers(new Query { Filter = $@"i => i.Id.Contains(@0) || i.ConcurrencyStamp.Contains(@0) || i.Email.Contains(@0) || i.LockoutEnd.Contains(@0) || i.NormalizedEmail.Contains(@0) || i.NormalizedUserName.Contains(@0) || i.PasswordHash.Contains(@0) || i.PhoneNumber.Contains(@0) || i.SecurityStamp.Contains(@0) || i.UserName.Contains(@0)", FilterParameters = new object[] { search } });
        }
        protected override async Task OnInitializedAsync()
        {
            aspNetUsers = await adminService.GetAspNetUsers(new Query { Filter = $@"i => i.Id.Contains(@0) || i.ConcurrencyStamp.Contains(@0) || i.Email.Contains(@0) || i.LockoutEnd.Contains(@0) || i.NormalizedEmail.Contains(@0) || i.NormalizedUserName.Contains(@0) || i.PasswordHash.Contains(@0) || i.PhoneNumber.Contains(@0) || i.SecurityStamp.Contains(@0) || i.UserName.Contains(@0)", FilterParameters = new object[] { search } });
        }

        protected async Task AddButtonClick(MouseEventArgs args)
        {
            await grid0.InsertRow(new RadzenServerApp.Models.admin.AspNetUser());
        }

        protected async Task GridDeleteButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.AspNetUser aspNetUser)
        {
            try
            {
                if (await DialogService.Confirm("Are you sure you want to delete this record?") == true)
                {
                    var deleteResult = await adminService.DeleteAspNetUser(aspNetUser.Id);

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
                    Detail = $"Unable to delete AspNetUser" 
                });
            }
        }

        protected async Task ExportClick(RadzenSplitButtonItem args)
        {
            if (args?.Value == "csv")
            {
                await adminService.ExportAspNetUsersToCSV(new Query
{ 
    Filter = $@"{(string.IsNullOrEmpty(grid0.Query.Filter)? "true" : grid0.Query.Filter)}", 
    OrderBy = $"{grid0.Query.OrderBy}", 
    Expand = "", 
    Select = string.Join(",", grid0.ColumnsCollection.Where(c => c.GetVisible()).Select(c => c.Property))
}, "AspNetUsers");
            }

            if (args == null || args.Value == "xlsx")
            {
                await adminService.ExportAspNetUsersToExcel(new Query
{ 
    Filter = $@"{(string.IsNullOrEmpty(grid0.Query.Filter)? "true" : grid0.Query.Filter)}", 
    OrderBy = $"{grid0.Query.OrderBy}", 
    Expand = "", 
    Select = string.Join(",", grid0.ColumnsCollection.Where(c => c.GetVisible()).Select(c => c.Property))
}, "AspNetUsers");
            }
        }

        protected async Task GridRowUpdate(RadzenServerApp.Models.admin.AspNetUser args)
        {
            await adminService.UpdateAspNetUser(args.Id, args);
        }

        protected async Task GridRowCreate(RadzenServerApp.Models.admin.AspNetUser args)
        {
            await adminService.CreateAspNetUser(args);
            await grid0.Reload();
        }

        protected async Task EditButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.AspNetUser data)
        {
            await grid0.EditRow(data);
        }

        protected async Task SaveButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.AspNetUser data)
        {
            await grid0.UpdateRow(data);
        }

        protected async Task CancelButtonClick(MouseEventArgs args, RadzenServerApp.Models.admin.AspNetUser data)
        {
            grid0.CancelEditRow(data);
            await adminService.CancelAspNetUserChanges(data);
        }
    }
}