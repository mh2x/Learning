using AutoMapper;
using ProductManagement.DTOs.Categories;
using ProductManagement.DTOs.Products;
using ProductManagement.Entities.Categories;
using ProductManagement.Entities.Products;

namespace ProductManagement;

public class ProductManagementApplicationAutoMapperProfile : Profile
{
    public ProductManagementApplicationAutoMapperProfile()
    {
        /* You can configure your AutoMapper mapping configuration here.
         * Alternatively, you can split your mapping configurations
         * into multiple profile classes for a better organization. */

        CreateMap<Product, ProductDto>();
        CreateMap<CreateUpdateProductDto, Product>();
        CreateMap<Category, CategoryLookupDto>();
    }
}
