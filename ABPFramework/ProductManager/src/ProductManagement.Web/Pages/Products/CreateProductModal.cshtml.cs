using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using AutoMapper.Internal.Mappers;
using Microsoft.AspNetCore.Http.HttpResults;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.Extensions.Logging;
using ProductManagement.DTOs.Products;
using ProductManagement.Enums.Products;
using ProductManagement.Services.Products;
using Volo.Abp.Timing;

namespace ProductManagement.Web.Pages.Products
{
    public class CreateProductModalModel : ProductManagementPageModel
    {
        private readonly ILogger<CreateProductModalModel> _logger;
        private readonly IProductAppService _productAppService;
        private readonly IClock _clock;

        public CreateProductModalModel(
                ILogger<CreateProductModalModel> logger,
                IProductAppService productAppService,
                IClock clock)
        {
            _logger = logger;
            _productAppService = productAppService;
            _clock = clock;
        }

        [BindProperty]
        public CreateEditProductViewModel Product { get; set; }
        public SelectListItem[] Categories { get; set; }


        public async Task OnGetAsync()
        {
            Product = new CreateEditProductViewModel
            {
                /*
                DateTime.Now returns a DateTime object with the 
                local date & time of the server. A DateTime object 
                doesn't store the time zone information. So, you 
                can not know the absolute date & time stored in 
                this object. You can only make assumptions, like 
                assuming that it was created in UTC+05 time zone. 
                The things especially gets complicated when you 
                save this value to a database and read later, 
                or send it to a client in a different time zone.

                One solution to this problem is always use DateTime.UtcNow 
                and assume all DateTime objects as UTC time. 
                In this way, you can convert it to the time 
                zone of the target client when needed.

                IClock provides an abstraction while getting the 
                current time, so you can control the kind of the 
                date time (UTC or local) in a single point in 
                your application.
                */
                ReleaseDate = _clock.Now,
                StockState = ProductStockState.PreOrder
            };

            var categoryLookup =

                await _productAppService.GetCategoriesAsync();
            Categories = categoryLookup.Items
            .Select(x => new SelectListItem(x.Name, x.Id.ToString()))
            .ToArray();
        }

        public async Task<IActionResult> OnPostAsync()
        {
            await _productAppService.CreateAsync(
                    ObjectMapper
                    .Map<CreateEditProductViewModel, CreateUpdateProductDto>(Product)
            );
            return NoContent();
        }
    }
}