using Microsoft.AspNetCore.Components.WebAssembly.Authentication;
using System.Net.Http.Json;

namespace BlazingPizza.Client
{
    public class OrdersClient
    {
        private readonly HttpClient httpClient;

        public OrdersClient(HttpClient httpClient)
        {
            this.httpClient = httpClient;
        }

        public async Task<IEnumerable<OrderWithStatus>> GetOrders()
        {
            try
            {
                return await httpClient.GetFromJsonAsync("orders", OrderContext.Default.ListOrderWithStatus);
            }
            catch (AccessTokenNotAvailableException ex)
            {
                ex.Redirect();
                return null;
            }
        }
        public async Task<OrderWithStatus> GetOrder(int orderId)
        {
            try
            {
                return await httpClient.GetFromJsonAsync($"orders/{orderId}", OrderContext.Default.OrderWithStatus);
            }
            catch (AccessTokenNotAvailableException ex)
            {
                ex.Redirect();
                return null;
            }
        }
    
        public async Task<int> PlaceOrder(Order order)
        {
            try
            {
                var response = await httpClient.PostAsJsonAsync("orders", order, OrderContext.Default.Order);
                response.EnsureSuccessStatusCode();
                var orderId = await response.Content.ReadFromJsonAsync<int>();
                return orderId;
            }
            catch (AccessTokenNotAvailableException ex)
            {
                ex.Redirect();
                return 0;
            }
        }
    }
}
