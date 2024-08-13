using AutoMapper;
using AbpStudio1.Books;

namespace AbpStudio1;

public class AbpStudio1ApplicationAutoMapperProfile : Profile
{
    public AbpStudio1ApplicationAutoMapperProfile()
    {
        CreateMap<Book, BookDto>();
        CreateMap<CreateUpdateBookDto, Book>();
        /* You can configure your AutoMapper mapping configuration here.
         * Alternatively, you can split your mapping configurations
         * into multiple profile classes for a better organization. */
    }
}
