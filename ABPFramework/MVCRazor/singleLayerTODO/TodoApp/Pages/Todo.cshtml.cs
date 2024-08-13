using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.Extensions.Logging;
using TodoApp.Services;
using TodoApp.Services.Dtos;

namespace TodoApp.Pages
{
    public class Todo : PageModel
    {
        private readonly ILogger<Todo> _logger;
        public List<TodoItemDto> TodoItems { get; set; }
        private readonly TodoAppService _todoAppService;

        public Todo(ILogger<Todo> logger, TodoAppService todoAppService)
        {
            _logger = logger;
            _todoAppService = todoAppService;
        }

        public async Task OnGetAsync()
        {
            TodoItems = await _todoAppService.GetListAsync();
        }
    }
}