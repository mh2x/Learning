using BlazorChat.Shared.Models;
using System.Net.Http.Json;

namespace BlazorChat.Shared.ChatManager
{
    public class ChatManager : IChatManager
    {
        private readonly HttpClient _httpClient;

        public ChatManager(HttpClient httpClient = null)
        {
            _httpClient = httpClient;
        }
        public async Task<List<ChatMessage>> GetConversationAsync(string contactId)
        {
            if (null == _httpClient) return Enumerable.Empty<ChatMessage>().ToList(); ;
            return await _httpClient.GetFromJsonAsync<List<ChatMessage>>($"api/chat/{contactId}");
        }
        public async Task<ApplicationUser> GetUserDetailsAsync(string userId)
        {
            if (null == _httpClient) return null;
            return await _httpClient.GetFromJsonAsync<ApplicationUser>($"api/chat/users/{userId}");
        }
        public async Task<List<ApplicationUser>> GetUsersAsync()
        {
            if (null == _httpClient) return null;
            var data = await _httpClient.GetFromJsonAsync<List<ApplicationUser>>("api/chat/users");
            return data;
        }
        public async Task SaveMessageAsync(ChatMessage message)
        {
            if (null == _httpClient) return;
            await _httpClient.PostAsJsonAsync("api/chat", message);
        }
    }
}
