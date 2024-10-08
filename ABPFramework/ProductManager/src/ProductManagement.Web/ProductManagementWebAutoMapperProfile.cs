using AutoMapper;
using ProductManagement.DTOs.Products;
using ProductManagement.Web.Pages.Products;

namespace ProductManagement.Web;

public class ProductManagementWebAutoMapperProfile : Profile
{
    public ProductManagementWebAutoMapperProfile()
    {
        //Define your object mappings here, for the Web project
        CreateMap<CreateEditProductViewModel, CreateUpdateProductDto>();
        CreateMap<ProductDto, CreateEditProductViewModel>();
    }
}
