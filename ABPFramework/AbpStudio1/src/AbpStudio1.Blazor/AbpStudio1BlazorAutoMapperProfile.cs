using AutoMapper;
using AbpStudio1.Books;

namespace AbpStudio1.Blazor;

public class AbpStudio1BlazorAutoMapperProfile : Profile
{
    public AbpStudio1BlazorAutoMapperProfile()
    {
        CreateMap<BookDto, CreateUpdateBookDto>();
        
        //Define your AutoMapper configuration here for the Blazor project.
    }
}
