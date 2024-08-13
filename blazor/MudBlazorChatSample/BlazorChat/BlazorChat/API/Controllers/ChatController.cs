using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BlazorChat.Data;
using BlazorChat.Shared.Models;
using Microsoft.AspNetCore.Identity;
using System.Security.Claims;

namespace BlazorChat.API.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class ChatController : ControllerBase
    {
        private readonly UserManager<ApplicationUser> _userManager;
        private readonly ApplicationDbContext _context;

        public ChatController(UserManager<ApplicationUser> userManager, ApplicationDbContext context)
        {
            _userManager = userManager;
            _context = context;
        }

        // GET: api/users
        [HttpGet("users")]
        public async Task<IActionResult> GetUsersAsync()
        {
            var userId = User.Claims.Where(a => a.Type == ClaimTypes.NameIdentifier).Select(a => a.Value).FirstOrDefault();
            var allUsers = await _context.Users.Where(user => user.Id != userId).ToListAsync();
            return Ok(allUsers);
        }

        [HttpGet("users/{userId}")]
        public async Task<IActionResult> GetUserDetailsAsync(string userId)
        {
            var user = await _context.Users.Where(user => user.Id == userId).FirstOrDefaultAsync();
            return Ok(user);
        }

        [HttpPost]
        public async Task<IActionResult> SaveMessageAsync(ChatMessage message)
        {
            var userId = User.Claims.Where(a => a.Type == ClaimTypes.NameIdentifier).Select(a => a.Value).FirstOrDefault();
            message.FromUserId = userId;
            message.CreatedDate = DateTime.Now;
            message.ToUser = await _context.Users.Where(user => user.Id == message.ToUserId).FirstOrDefaultAsync();
            await _context.ChatMessages.AddAsync(message);
            return Ok(await _context.SaveChangesAsync());
        }

        [HttpGet("{contactId}")]
        public async Task<IActionResult> GetConversationAsync(string contactId)
        {
            var userId = User.Claims.Where(a => a.Type == ClaimTypes.NameIdentifier).Select(a => a.Value).FirstOrDefault();
            var messages = await _context.ChatMessages
                    .Where(h => h.FromUserId == contactId && h.ToUserId == userId || h.FromUserId == userId && h.ToUserId == contactId)
                    .OrderBy(a => a.CreatedDate)
                    .Include(a => a.FromUser)
                    .Include(a => a.ToUser)
                    .Select(x => new ChatMessage
                    {
                        FromUserId = x.FromUserId,
                        Message = x.Message,
                        CreatedDate = x.CreatedDate,
                        Id = x.Id,
                        ToUserId = x.ToUserId,
                        ToUser = x.ToUser,
                        FromUser = x.FromUser
                    }).ToListAsync();
            return Ok(messages);
        }


        //// GET: api/Chat
        //[HttpGet]
        //public async Task<ActionResult<IEnumerable<ChatMessage>>> GetChatMessages()
        //{
        //    return await _context.ChatMessages.ToListAsync();
        //}

        //// GET: api/Chat/5
        //[HttpGet("{id}")]
        //public async Task<ActionResult<ChatMessage>> GetChatMessage(long id)
        //{
        //    var chatMessage = await _context.ChatMessages.FindAsync(id);

        //    if (chatMessage == null)
        //    {
        //        return NotFound();
        //    }

        //    return chatMessage;
        //}

        //// PUT: api/Chat/5
        //// To protect from overposting attacks, see https://go.microsoft.com/fwlink/?linkid=2123754
        //[HttpPut("{id}")]
        //public async Task<IActionResult> PutChatMessage(long id, ChatMessage chatMessage)
        //{
        //    if (id != chatMessage.Id)
        //    {
        //        return BadRequest();
        //    }

        //    _context.Entry(chatMessage).State = EntityState.Modified;

        //    try
        //    {
        //        await _context.SaveChangesAsync();
        //    }
        //    catch (DbUpdateConcurrencyException)
        //    {
        //        if (!ChatMessageExists(id))
        //        {
        //            return NotFound();
        //        }
        //        else
        //        {
        //            throw;
        //        }
        //    }

        //    return NoContent();
        //}

        //// POST: api/Chat
        //// To protect from overposting attacks, see https://go.microsoft.com/fwlink/?linkid=2123754
        //[HttpPost]
        //public async Task<ActionResult<ChatMessage>> PostChatMessage(ChatMessage chatMessage)
        //{
        //    _context.ChatMessages.Add(chatMessage);
        //    await _context.SaveChangesAsync();

        //    return CreatedAtAction("GetChatMessage", new { id = chatMessage.Id }, chatMessage);
        //}

        //// DELETE: api/Chat/5
        //[HttpDelete("{id}")]
        //public async Task<IActionResult> DeleteChatMessage(long id)
        //{
        //    var chatMessage = await _context.ChatMessages.FindAsync(id);
        //    if (chatMessage == null)
        //    {
        //        return NotFound();
        //    }

        //    _context.ChatMessages.Remove(chatMessage);
        //    await _context.SaveChangesAsync();

        //    return NoContent();
        //}

        //private bool ChatMessageExists(long id)
        //{
        //    return _context.ChatMessages.Any(e => e.Id == id);
        //}
    }
}
