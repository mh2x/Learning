using AbpStudio1.EntityFrameworkCore;
using Volo.Abp.Autofac;
using Volo.Abp.Modularity;

namespace AbpStudio1.DbMigrator;

[DependsOn(
    typeof(AbpAutofacModule),
    typeof(AbpStudio1EntityFrameworkCoreModule),
    typeof(AbpStudio1ApplicationContractsModule)
)]
public class AbpStudio1DbMigratorModule : AbpModule
{
}
