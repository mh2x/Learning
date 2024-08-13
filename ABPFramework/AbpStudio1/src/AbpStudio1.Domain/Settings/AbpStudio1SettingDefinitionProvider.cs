using Volo.Abp.Settings;

namespace AbpStudio1.Settings;

public class AbpStudio1SettingDefinitionProvider : SettingDefinitionProvider
{
    public override void Define(ISettingDefinitionContext context)
    {
        //Define your own settings here. Example:
        //context.Add(new SettingDefinition(AbpStudio1Settings.MySetting1));
    }
}
