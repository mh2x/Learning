using Volo.Abp.Modularity;

namespace AbpStudio1;

[DependsOn(
    typeof(AbpStudio1ApplicationModule),
    typeof(AbpStudio1DomainTestModule)
)]
public class AbpStudio1ApplicationTestModule : AbpModule
{

}
