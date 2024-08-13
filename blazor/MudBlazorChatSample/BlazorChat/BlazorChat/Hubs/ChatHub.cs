using BlazorChat.Shared.Models;
using Microsoft.AspNetCore.SignalR;

namespace BlazorChat.Hubs
{
    public class ChatHub : Hub
    {
        //Notifies all clients and add a new message to the chat.
        public async Task SendMessageAsync(ChatMessage message, string userName)
        {
            await Clients.All.SendAsync("ReceiveMessage", message, userName);
        }

        //Notifies the client who was logged in with a particular userId that a new message has been received.
        public async Task ChatNotificationAsync(string message, string receiverUserId, string senderUserId)
        {
            await Clients.All.SendAsync("ReceiveChatNotification", message, receiverUserId, senderUserId);
        }
    }
}
