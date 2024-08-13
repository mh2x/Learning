using AbpStudio1.Localization;
using Volo.Abp.Application.Services;

namespace AbpStudio1;

/* Inherit your application services from this class.
 */
public abstract class AbpStudio1AppService : ApplicationService
{
    protected AbpStudio1AppService()
    {
        LocalizationResource = typeof(AbpStudio1Resource);
    }
}
