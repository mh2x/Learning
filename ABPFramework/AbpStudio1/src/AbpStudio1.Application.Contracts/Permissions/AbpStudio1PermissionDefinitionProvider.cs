using AbpStudio1.Localization;
using Volo.Abp.Authorization.Permissions;
using Volo.Abp.Localization;
using Volo.Abp.MultiTenancy;

namespace AbpStudio1.Permissions;

public class AbpStudio1PermissionDefinitionProvider : PermissionDefinitionProvider
{
    public override void Define(IPermissionDefinitionContext context)
    {
        var myGroup = context.AddGroup(AbpStudio1Permissions.GroupName);

        var booksPermission = myGroup.AddPermission(AbpStudio1Permissions.Books.Default, L("Permission:Books"));
        booksPermission.AddChild(AbpStudio1Permissions.Books.Create, L("Permission:Books.Create"));
        booksPermission.AddChild(AbpStudio1Permissions.Books.Edit, L("Permission:Books.Edit"));
        booksPermission.AddChild(AbpStudio1Permissions.Books.Delete, L("Permission:Books.Delete"));
        //Define your own permissions here. Example:
        //myGroup.AddPermission(AbpStudio1Permissions.MyPermission1, L("Permission:MyPermission1"));
    }

    private static LocalizableString L(string name)
    {
        return LocalizableString.Create<AbpStudio1Resource>(name);
    }
}
