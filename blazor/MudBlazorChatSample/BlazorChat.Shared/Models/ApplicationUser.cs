using Microsoft.AspNetCore.Identity;

namespace BlazorChat.Shared.Models
{
    // Add profile data for application users by adding properties to the ApplicationUser class
    public class ApplicationUser : IdentityUser
    {
        //C# ICollection: Benefits, Use Cases and More: https://www.bytehide.com/blog/icollection-csharp
        //MSDN: https://learn.microsoft.com/en-us/dotnet/api/system.collections.generic.icollection-1?view=net-8.0
        
        //the virtual keyword allows you to override the property in sub-classes

        public virtual ICollection<ChatMessage> ChatMessagesFromUsers { get; set; }
        public virtual ICollection<ChatMessage> ChatMessagesToUsers { get; set; }
        public ApplicationUser()
        {
            ChatMessagesFromUsers = new HashSet<ChatMessage>();
            ChatMessagesToUsers = new HashSet<ChatMessage>();
        }
    }
}
