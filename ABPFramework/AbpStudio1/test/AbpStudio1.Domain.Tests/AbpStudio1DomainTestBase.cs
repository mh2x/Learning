using Volo.Abp.Modularity;

namespace AbpStudio1;

/* Inherit from this class for your domain layer tests. */
public abstract class AbpStudio1DomainTestBase<TStartupModule> : AbpStudio1TestBase<TStartupModule>
    where TStartupModule : IAbpModule
{

}
