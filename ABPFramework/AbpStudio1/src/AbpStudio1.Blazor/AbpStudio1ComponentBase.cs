using AbpStudio1.Localization;
using Volo.Abp.AspNetCore.Components;

namespace AbpStudio1.Blazor;

public abstract class AbpStudio1ComponentBase : AbpComponentBase
{
    protected AbpStudio1ComponentBase()
    {
        LocalizationResource = typeof(AbpStudio1Resource);
    }
}
