using Volo.Abp.Application.Dtos;

//ABP DTo base classes: https://docs.abp.io/en/abp/latest/Data-Transfer-Objects

namespace Acme.BookStore.DTOs.Authors
{
    public class GetAuthorListDto : PagedAndSortedResultRequestDto
    {
        //Filter is used to search authors. It can be null
        //(or empty string) to get all the authors.
        public string? Filter { get; set; }
    }
}
