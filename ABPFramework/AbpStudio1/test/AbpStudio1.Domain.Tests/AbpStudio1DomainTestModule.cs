using Volo.Abp.Modularity;

namespace AbpStudio1;

[DependsOn(
    typeof(AbpStudio1DomainModule),
    typeof(AbpStudio1TestBaseModule)
)]
public class AbpStudio1DomainTestModule : AbpModule
{

}
