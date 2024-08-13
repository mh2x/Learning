using AbpStudio1.Localization;
using Volo.Abp.AspNetCore.Mvc;

namespace AbpStudio1.Controllers;

/* Inherit your controllers from this class.
 */
public abstract class AbpStudio1Controller : AbpControllerBase
{
    protected AbpStudio1Controller()
    {
        LocalizationResource = typeof(AbpStudio1Resource);
    }
}
