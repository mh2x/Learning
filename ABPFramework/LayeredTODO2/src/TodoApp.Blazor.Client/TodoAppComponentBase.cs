using TodoApp.Localization;
using Volo.Abp.AspNetCore.Components;

namespace TodoApp.Blazor.Client;

public abstract class TodoAppComponentBase : AbpComponentBase
{
    protected TodoAppComponentBase()
    {
        LocalizationResource = typeof(TodoAppResource);
    }
}
