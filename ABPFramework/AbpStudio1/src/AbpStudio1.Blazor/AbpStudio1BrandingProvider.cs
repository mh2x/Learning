using Volo.Abp.DependencyInjection;
using Volo.Abp.Ui.Branding;

namespace AbpStudio1.Blazor;

[Dependency(ReplaceServices = true)]
public class AbpStudio1BrandingProvider : DefaultBrandingProvider
{
    public override string AppName => "AbpStudio1";
}
