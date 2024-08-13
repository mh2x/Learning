using System;
using AbpStudio1.Permissions;
using Volo.Abp.Application.Dtos;
using Volo.Abp.Application.Services;
using Volo.Abp.Domain.Repositories;

namespace AbpStudio1.Books;

public class BookAppService :
    CrudAppService<
        Book, //The Book entity
        BookDto, //Used to show books
        Guid, //Primary key of the book entity
        PagedAndSortedResultRequestDto, //Used for paging/sorting
        CreateUpdateBookDto>, //Used to create/update a book
    IBookAppService //implement the IBookAppService
{
    public BookAppService(IRepository<Book, Guid> repository)
        : base(repository)
    {
        GetPolicyName = AbpStudio1Permissions.Books.Default;
        GetListPolicyName = AbpStudio1Permissions.Books.Default;
        CreatePolicyName = AbpStudio1Permissions.Books.Create;
        UpdatePolicyName = AbpStudio1Permissions.Books.Edit;
        DeletePolicyName = AbpStudio1Permissions.Books.Delete;
    }
}