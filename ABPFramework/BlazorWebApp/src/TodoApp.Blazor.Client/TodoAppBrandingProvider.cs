using Volo.Abp.DependencyInjection;
using Volo.Abp.Ui.Branding;

namespace TodoApp.Blazor.Client;

[Dependency(ReplaceServices = true)]
public class TodoAppBrandingProvider : DefaultBrandingProvider
{
    public override string AppName => "TodoApp";
}
