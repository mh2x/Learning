using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
//using Shouldly;
using System.Threading.Tasks;
using Volo.Abp.Application.Dtos;
//using Xunit;
using ProductManagement;
using ProductManagement.Services.Products;
using Xunit;
using Shouldly;
using Volo.Abp.Modularity;

namespace ProductManagement.Products
{
    public abstract class ProductAppService_Tests<TStartupModule> : ProductManagementApplicationTestBase<TStartupModule>
    where TStartupModule : IAbpModule
    {
        private readonly IProductAppService _productAppService;
        public ProductAppService_Tests()
        {
            _productAppService =
                GetRequiredService<IProductAppService>();
        }

        /* TODO: Test methods */
        [Fact]

        public async Task Should_Get_Product_List()
        {
            //Act
            var output = await _productAppService.GetListAsync(
                new PagedAndSortedResultRequestDto()
            );

            //Assert
            output.TotalCount.ShouldBe(3);
            output.Items.ShouldContain(
                x => x.Name.Contains("Acme Monochrome Laser Printer")
            );
        }
    }
}