using System;
using System.IO;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Design;
using Microsoft.Extensions.Configuration;

namespace AbpStudio1.EntityFrameworkCore;

/* This class is needed for EF Core console commands
 * (like Add-Migration and Update-Database commands) */
public class AbpStudio1DbContextFactory : IDesignTimeDbContextFactory<AbpStudio1DbContext>
{
    public AbpStudio1DbContext CreateDbContext(string[] args)
    {
        var configuration = BuildConfiguration();
        
        AbpStudio1EfCoreEntityExtensionMappings.Configure();

        var builder = new DbContextOptionsBuilder<AbpStudio1DbContext>()
            .UseSqlServer(configuration.GetConnectionString("Default"));
        
        return new AbpStudio1DbContext(builder.Options);
    }

    private static IConfigurationRoot BuildConfiguration()
    {
        var builder = new ConfigurationBuilder()
            .SetBasePath(Path.Combine(Directory.GetCurrentDirectory(), "../AbpStudio1.DbMigrator/"))
            .AddJsonFile("appsettings.json", optional: false);

        return builder.Build();
    }
}
