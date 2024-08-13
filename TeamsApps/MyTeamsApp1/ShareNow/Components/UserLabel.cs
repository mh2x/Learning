using Microsoft.FluentUI.AspNetCore.Components;

namespace ShareNow.Components
{
    public class UserLabel : FluentLabel
    {
        public void Refresh()
        {
            InvokeAsync(() => StateHasChanged());
        }
    }
}
