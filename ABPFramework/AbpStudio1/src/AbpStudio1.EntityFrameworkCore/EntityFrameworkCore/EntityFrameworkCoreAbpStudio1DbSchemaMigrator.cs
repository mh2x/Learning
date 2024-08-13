using System;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using AbpStudio1.Data;
using Volo.Abp.DependencyInjection;

namespace AbpStudio1.EntityFrameworkCore;

public class EntityFrameworkCoreAbpStudio1DbSchemaMigrator
    : IAbpStudio1DbSchemaMigrator, ITransientDependency
{
    private readonly IServiceProvider _serviceProvider;

    public EntityFrameworkCoreAbpStudio1DbSchemaMigrator(IServiceProvider serviceProvider)
    {
        _serviceProvider = serviceProvider;
    }

    public async Task MigrateAsync()
    {
        /* We intentionally resolving the AbpStudio1DbContext
         * from IServiceProvider (instead of directly injecting it)
         * to properly get the connection string of the current tenant in the
         * current scope.
         */

        await _serviceProvider
            .GetRequiredService<AbpStudio1DbContext>()
            .Database
            .MigrateAsync();
    }
}
