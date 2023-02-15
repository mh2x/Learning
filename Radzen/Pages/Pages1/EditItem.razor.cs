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
    public partial class EditItem
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

        [Parameter]
        public byte[] Id { get; set; }

        protected override async Task OnInitializedAsync()
        {
            item = await adminService.GetItemById(Id);
        }
        protected bool errorVisible;
        protected RadzenServerApp.Models.admin.Item item;

        protected async Task FormSubmit()
        {
            try
            {
                await adminService.UpdateItem(Id, item);
                DialogService.Close(item);
            }
            catch (Exception ex)
            {
                errorVisible = true;
            }
        }

        protected async Task CancelButtonClick(MouseEventArgs args)
        {
            DialogService.Close(null);
        }
    }
}