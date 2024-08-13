using Acme.BookStore.DTOs.Authors;
using Acme.BookStore.DTOs.Books;
using AutoMapper;

namespace Acme.BookStore.Blazor.Client;

public class BookStoreBlazorAutoMapperProfile : Profile
{
    public BookStoreBlazorAutoMapperProfile()
    {
        //Define your AutoMapper configuration here for the Blazor project.
        CreateMap<AuthorDto, UpdateAuthorDto>();
        CreateMap<BookDto, CreateUpdateBookDto>();
    }
}
