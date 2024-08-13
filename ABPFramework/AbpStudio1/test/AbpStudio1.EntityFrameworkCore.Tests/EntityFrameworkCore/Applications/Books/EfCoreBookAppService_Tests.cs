using AbpStudio1.Books;
using Xunit;

namespace AbpStudio1.EntityFrameworkCore.Applications.Books;

[Collection(AbpStudio1TestConsts.CollectionDefinitionName)]
public class EfCoreBookAppService_Tests : BookAppService_Tests<AbpStudio1EntityFrameworkCoreTestModule>
{

}