using System;
using System.Linq;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Threading.Tasks;

using RadzenServerApp.Data;

namespace RadzenServerApp.Controllers
{
    public partial class ExportadminController : ExportController
    {
        private readonly adminContext context;
        private readonly adminService service;

        public ExportadminController(adminContext context, adminService service)
        {
            this.service = service;
            this.context = context;
        }

        [HttpGet("/export/admin/items/csv")]
        [HttpGet("/export/admin/items/csv(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportItemsToCSV(string fileName = null)
        {
            return ToCSV(ApplyQuery(await service.GetItems(), Request.Query), fileName);
        }

        [HttpGet("/export/admin/items/excel")]
        [HttpGet("/export/admin/items/excel(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportItemsToExcel(string fileName = null)
        {
            return ToExcel(ApplyQuery(await service.GetItems(), Request.Query), fileName);
        }

        [HttpGet("/export/admin/aspnetusers/csv")]
        [HttpGet("/export/admin/aspnetusers/csv(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportAspNetUsersToCSV(string fileName = null)
        {
            return ToCSV(ApplyQuery(await service.GetAspNetUsers(), Request.Query), fileName);
        }

        [HttpGet("/export/admin/aspnetusers/excel")]
        [HttpGet("/export/admin/aspnetusers/excel(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportAspNetUsersToExcel(string fileName = null)
        {
            return ToExcel(ApplyQuery(await service.GetAspNetUsers(), Request.Query), fileName);
        }

        [HttpGet("/export/admin/aspnetroles/csv")]
        [HttpGet("/export/admin/aspnetroles/csv(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportAspNetRolesToCSV(string fileName = null)
        {
            return ToCSV(ApplyQuery(await service.GetAspNetRoles(), Request.Query), fileName);
        }

        [HttpGet("/export/admin/aspnetroles/excel")]
        [HttpGet("/export/admin/aspnetroles/excel(fileName='{fileName}')")]
        public async Task<FileStreamResult> ExportAspNetRolesToExcel(string fileName = null)
        {
            return ToExcel(ApplyQuery(await service.GetAspNetRoles(), Request.Query), fileName);
        }
    }
}
