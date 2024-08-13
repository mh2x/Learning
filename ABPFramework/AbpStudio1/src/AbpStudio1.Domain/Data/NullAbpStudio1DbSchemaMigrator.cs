using System.Threading.Tasks;
using Volo.Abp.DependencyInjection;

namespace AbpStudio1.Data;

/* This is used if database provider does't define
 * IAbpStudio1DbSchemaMigrator implementation.
 */
public class NullAbpStudio1DbSchemaMigrator : IAbpStudio1DbSchemaMigrator, ITransientDependency
{
    public Task MigrateAsync()
    {
        return Task.CompletedTask;
    }
}
