using Microsoft.AspNetCore.Components.WebAssembly.Authentication;

namespace BlazingPizza.Client
{
    /*
     * Since you're building a client-side SPA, the application state (such as the current order) is held in the browser's memory. When you redirect away to log in, that state is discarded. When the user is redirected back, their order has now become empty!

       Check you can reproduce this bug. Start logged out, and create an order. When you try to place the order, you get redirected to the login page. After logging in, you are then redirected to the checkout page, but your pizzas in your order have now gone missing! This is a common concern with browser-based single-page applications (SPAs), but fortunately there is a straightforward solution.

       We'll fix the bug by persisting the order state. Blazor's authentication library makes this straight forward to do.
    */

    public class PizzaAuthenticationState : RemoteAuthenticationState
    {
        public Order Order { get; set; }
    }
}
