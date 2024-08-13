using System.Threading.Tasks;

namespace AbpStudio1.Data;

public interface IAbpStudio1DbSchemaMigrator
{
    Task MigrateAsync();
}
